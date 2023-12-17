<!DOCTYPE HTML>  
<html>
<style>
<?php
    include 'formstyle.css';
?>
</style>   

<head>
</head>
<body>  

<?php
// define variables and set to empty values
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET['id'])) {
  $res['ID']=-1;
  $res['name']='';
  $res['lname']='';
  $res['email']='';
  $res['etage']='';
  $res['adress']='';
  $res['nr']='';  
  $res['ID']=createrec();
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
  getOnePerson($res, $_GET['id']);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $res['name'] = test_input($_POST["name"]);
  $res['lname'] = test_input($_POST["lname"]);
  $res['email'] = test_input($_POST["email"]);
  $res['etage'] = test_input($_POST["etage"]);
  $res['nr'] = test_input($_POST["nr"]);
  $res['adress'] = test_input($_POST["adress"]);
  if (isset($_POST["ID"]) && $_POST["ID"]> 0) {
      $res['ID'] = $_POST["ID"];
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
<form method="post" id="tele" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
  <input type="submit" name="submit" value="Spara" onclick="checkform(names);">  
</form>

<?php

?>

</body>
<script>
  var names=['name','lname', 'adress', 'nr']
  //JavaScript
function checkform(names) {
    var i
    form=document.getElementById("tele")
    for(i=0; i < names.length; i++) {
    if(form[names[i]].value.length == 0) {
      alert("please enter " + names[i]);
      return false;
    } 
  }
}
</script>
</html>