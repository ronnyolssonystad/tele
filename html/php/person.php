<!DOCTYPE html>


<style>
<?php
    include 'formstyle.css';
?>
</style>   
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	include('db_connect.php');
	$sts = 0;
	if (isset($_GET['ID'])) {
		$querystr = "SELECT * FROM `persons` WHERE id=". $_GET['ID'];	
	} else {
		$querystr = "SELECT * FROM `persons`";
	}
	$n = 0;

	$stmt = $pdo->query($querystr);
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

	if($sts > 0) {
    	response($res, $sts, 'OK');
		$pdo = NULL;
	} else {
        $res[0]['ID'] = '';  
		$res[0]['name'] = '';
		$res[0]['lname'] = '';
		$res[0]['adress'] = '';
		$res[0]['nr'] = '';
		$res[0]['email'] = '';
		$res[0]['etage'] = '';
    }
}
?>

<html lang="en">
<head>    
<title>Kontakt</title>
</head>
<body>
    <div>
  <form action='php/save.php' method="POST">
    <fieldset>
    <h1>Detaljer</h1>
    <p>
        Förnamn: <input type = "text" name = "fname" ><?php $res[0]['name']?></input>
    </p>
    <p>
        Efternamn: <input type = "text" name = "lname" ><?php $res[0]['ename']?></input>
    </p>
    <p>
        Adress: <input type = "text" name = "adress" ><?php $res[0]['adress']?></input>
    </p>
    <p>
        Våning: <input type = "text" name = "etage" ><?php $res[0]['etage']?></input>
    </p> 
    <p>
        Telefonnummer: <input type = "text" name = "tel1" ><?php $res[0]['tel']?></input>
    </p>
    <p>
        email: <input type = "email" name = "email" ><?php $res[0]['email']?></input>
    </p>    
 <p>
      <input type = "submit" name = "submit" value = "Spara" />
    </p>
</fieldset>
</form>
</div>
</body>
</html>