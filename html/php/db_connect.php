<?php

$pdo = new PDO(
    'mysql:host=127.0.0.1;port=3306;dbname=' . getenv('MYSQL_DATABASE'),
    getenv('MYSQL_USER'),
    getenv('MYSQL_PASSWORD')
);

if ($pdo) {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  sanitize();
} else {
  die();
}
function update($res) {

  $sql = "UPDATE persons SET ";
  $keys=['name', 'lname', 'adress','nr' ,'etage','email'];
  $num_data = [ 'nr', 'etage'];
  $columns=['name','lname',	'adress','nr', 'etage', 'email'];

  $index = 0;
  foreach($keys as $key) {
    if (in_array($key, $num_data)) {
      $as = '';
      if ($res[$key]=='') {
        $data = 0;
      }
    } else {
      $as = '\'';
      $data='';
    }
    $sql = $sql.$columns[$index].' = ' .$as.$res[$key].$data.$as. ', ';
    $index++;
  }
  $sql = rtrim($sql, ', ');
  $sql = $sql.' WHERE id='.$res['ID'];

  try {
    
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
function getPerson($qry, &$res, &$sts){
  $pdo=$GLOBALS['pdo'];
	$n = 0;
	$stmt = $pdo->query($qry);
	while ($row = $stmt->fetch()) {

		$res[$n]['ID'] = $row['id'];  
		$res[$n]['name'] = $row['name'];
		$res[$n]['lname'] = $row['lname'];
		$res[$n]['adress'] = $row['adress'];
		$res[$n]['nr'] = $row['nr'];
		$res[$n]['email'] = $row['email'];
		$res[$n]['etage'] = $row['etage'];
		$sts++;
		$n++;
	}

}
function getOnePerson(&$res, $id) {
  $query= "SELECT * FROM `persons` WHERE id=". $id. 'and name <> ""';
  getPerson($query, $res, $sts);
  $res=$res[0];
}
function deletePerson($id) {

  $query= 'DELETE FROM persons WHERE id='. $id;
  getPerson($query, $res, $sts);
  if($sts == 0) {
    echo('<p> '.$id.' Deleted </p>');
  } 

}
// delete all records without name more than 30 minutes old
function sanitize(){
  $pdo=$GLOBALS['pdo'];
  $qry = "delete from persons where name='' and minute(timediff(current_timestamp,date_time)) >  1";
  
  if ($pdo->query($qry) === TRUE) {
    return true;
  } else {
    return false;
  }

}




?>