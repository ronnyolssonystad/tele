<?php
header("Content-Type:application/json");



if (isset($_GET['ID']) && $_GET['ID']!="") {
	include('db_connect.php');
	$sts = 0;
	$ID = $_GET['ID'];

	$stmt = $pdo->query("SELECT * FROM `persons` WHERE id=$ID");
	while ($row = $stmt->fetch()) {
		$ID = $row['id'];  
		$name = $row['name'];
		$lname = $row['lname'];
		$adress = $row['adress'];
		$nr = $row['nr'];
		$email = $row['email'];
		$etage = $row['etage'];
		$sts++;
	}

	if($sts > 0) {
    	response($ID, $name, $lname, $adress, $nr, $etage,$email, $sts, 'OK');
		$pdo = NULL;
	}
	else{
		response(NULL, NULL,NULL, NULL, NULL,NULL,NULL, 200,"No Record Found");
	}
}else{
	response(NULL, NULL,NULL, NULL, NULL,NULL, NULL, 400,"Invalid Request");
}

function response($ID,$name,$lname,$adress,$nr, $etage,$email, $sts, $message){

	$response['id'] = $ID;
	$response['name'] = $name;
	$response['lname'] = $lname;
	$response['adress'] = $adress;
    $response['nr'] = $nr;
    $response['etage'] = $etage;
	$response['email'] = $email;
    $response['sts'] = $sts;
    $response['message'] = $message;

	$json_response = json_encode($response);
	echo $json_response;
}
?>