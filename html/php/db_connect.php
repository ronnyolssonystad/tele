<?php

$pdo = new PDO(
    'mysql:host=127.0.0.1;port=3306;dbname=' . getenv('MYSQL_DATABASE'),
    getenv('MYSQL_USER'),
    getenv('MYSQL_PASSWORD')
);
if ($pdo) {
} else {
  die();
}
function update($res) {

}
function createrec() {


  $sql = "INSERT INTO persons (name, lname, adress,  email) VALUES (?,?,?,?)";
  
  $stmt= $GLOBALS['pdo']->prepare($sql);
  $stmt->execute(['', '', '', '']);
  return $GLOBALS['pdo']->lastInsertId($sql);;
}


?>