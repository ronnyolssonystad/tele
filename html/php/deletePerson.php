<!DOCTYPE html>
<html>
<body>

<style>
<?php
    include 'formstyle.css';
?>
</style>   


<body>  

<?php
$id=NULL;
$namn='';
// define variables and set to empty values
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
  getOnePerson($res, $_GET['id']);
  $namn=$res['name'];
  $id=$_GET["id"];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["delete"] == 'y' && isset($_POST["id"] )) {
  $id=$_POST["id"];  
  deleteperson($id);
  //header('Location: /index.html');
  exit();
}

?>



<form method="post" action="">
    <input type="hidden" name='id' value="<?php echo($id);?>">
  <label for="choice">Är du säker:</label>
  <select id="choice" name="delete">
    <option value="y">Ja</option>
    <option value="n">Nej</option>
  </select>
  <input type="submit">
</form>

</body>
</html>