<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type:application/json");
require_once ('db_connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$sts = 0;
	$res = [];
	if (isset($_GET['ID'])) {
		$querystr = "SELECT * FROM `persons` WHERE id=". $_GET['ID'];	
	} else {
		$querystr = "SELECT * FROM `persons`";
	}
	getPerson($querystr, $res, $sts);
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




?>