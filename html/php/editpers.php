<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
// define variables and set to empty values
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $res['ID']=-1;
  $res['name']='';
  $res['lname']='';
  $res['email']='';
  $res['etage']='';
  $res['adress']='';
  $res['nr']='';  
  $res['ID']=createrec();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $res['name'] = test_input($_POST["name"]);
  $res['lname'] = test_input($_POST["lname"]);
  $res['email'] = test_input($_POST["email"]);
  $res['etage'] = test_input($_POST["etage"]);
  $res['nr'] = test_input($_POST["nr"]);
  $res['adress'] = test_input($_POST["adress"]);
  if (isset($_POST["ID"]) && $_POST["ID"]> 0) {
      update($res); 
  }
}


function test_input($data) {
  if (isset($data)) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
        
  } else {
    $data=''; 
  }
  return $data;
}
?>

<h2>Persondata</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="ID" value='<?php echo($res['ID']); ?>'>

  Förnamn: <input type="text" name="name" value='<?php echo($res['name']); ?>'>
  <br><br>
  Efternamn: <input type=text name="lname" value='<?php echo($res['lname']); ?>'>
  <br><br>
  E-mail: <input type="text" name="email" value='<?php echo($res['email']); ?>'>
  <br><br>
  Adress: <input type="text" name="adress" value='<?php echo($res['adress']); ?>'>
  <br><br>
  Vån: <input name="etage" type=text value='<?php echo($res['etage']); ?>'>
  <br><br>
  Telefon: <input type=text name="nr" value='<?php echo($res['nr']); ?>'>
  <br><br>
  <input type="submit" name="submit" value="Spara" onclick="checkform();">  
</form>

<?php

?>

</body>
<script>
  //JavaScript
function checkform() {
    if(document.frmMr.start_date.value == "") {
        alert("please enter start_date");
        return false;
    } else {
        document.frmMr.submit();
    }
}
</script>
</html>