<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type:application/json");

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
	}

	else{
		response(NULL, 200,"No Record Found");
	}
}else{
	response(NULL, 400,"Invalid Request");
}

function response($res, $sts, $message){

//
	$json_response = json_encode($res);
	echo $json_response;
}
function responsen($ID,$name,$lname,$adress,$nr, $etage,$email, $sts, $message){

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