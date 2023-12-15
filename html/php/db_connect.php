<?php

$pdo = new PDO(
    'mysql:host=127.0.0.1;port=3306;dbname=' . getenv('MYSQL_DATABASE'),
    getenv('MYSQL_USER'),
    getenv('MYSQL_PASSWORD')
);

if ($pdo) {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} else {
  die();
}
function update($res) {
  



  try {
    $sql = "UPDATE persons SET lastname='Doe' WHERE id=2";
    // Prepare statement
    $stmt= $GLOBALS['pdo']->prepare($sql);
   // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
  }
}
function createrec() {
  $sql = "INSERT INTO persons (name, lname, adress,  email) VALUES (?,?,?,?)";
  $stmt= $GLOBALS['pdo']->prepare($sql);
  $stmt->execute(['', '', '', '']);
  return $GLOBALS['pdo']->lastInsertId($sql);;
}

?>