<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
// define variables and set to empty values
$res['ID']=-1;
$res['name']='';
$res['lname']='';
$res['email']='';
$res['etage']='';
$res['adress']='';
$res['nr']='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $res['ID'] = test_input($_POST["ID"]);
  $res['name'] = test_input($_POST["name"]);
  $res['fname'] = test_input($_POST["lname"]);
  $res['email'] = test_input($_POST["email"]);
  $res['etage'] = test_input($_POST["etage"]);
  $res['nr'] = test_input($_POST["nr"]);
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
<input type="hidden" name="ID" value='<?php $res['ID']; ?>'>

  Förnamn: <input type="text" name="name" value='<?php $res['name']; ?>'>
  <br><br>
  Efternamn: <input type=text name="lname" value='<?php $res['lname']; ?>'>
  <br><br>
  E-mail: <input type="text" name="email" value='<?php $res['email']; ?>'>
  <br><br>
  Adress: <input type="text" name="adress" value='<?php $res['adress']; ?>'>
  <br><br>
  Vån: <input name="etage" type=text value='<?php $res['etage']; ?>'>
  <br><br>
  Telefon: <input type=text name="nr" value='<?php $res['nr']; ?>'>
  <br><br>
  <input type="submit" name="submit" value="Spara">  
</form>

<?php
if (isset($res['ID']) && $res['ID']> 0) {
  include('db_connect.php');
  save($$res); 
}

?>

</body>
</html>