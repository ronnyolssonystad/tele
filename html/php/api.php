



<?php

/*ID	int(11) unsigned Auto Increment	
FirstName	varchar(50)	
LastName	varchar(50)	
Adress	varchar(50)	
Nr	varchar(50)	
Vån	varchar(50) NULL
*/


header("Content-Type:application/json");
if (isset($_GET['ID']) && $_GET['ID']!="") {
	include('db.php');
	$ID = $_GET['ID'];
	$result = mysqli_query(
	$con,
	"SELECT * FROM `persons` WHERE ID=$ID");
	if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result);
    $ID = $row['ID'];  
	$name = $row['FirstName'];
	$lname = $row['LastName'];
	$adress = $row['Adress'];
    $nr = $row['Nr'];
    $etage = $row['Vån'];

	response($ID, $name, $lname, $adress, $nr, $etage, $sts, $message);
	mysqli_close($con);
	}else{
		response(NULL, NULL,NULL, NULL, NULL,NULL, 200,"No Record Found");
		}
}else{
	response(NULL, NULL,NULL, NULL, NULL,NULL, 400,"Invalid Request");
	}

function response($ID,$name,$lname,$adress,$nr, $etage, $sts, $message){

	$response['id'] = $ID;
	$response['name'] = $name;
	$response['lname'] = $lname;
	$response['adress'] = $adress;
    $response['nr'] = $nr;
    $response['etage'] = $etage;
    $response['sts'] = $sts;
    $response['message'] = $message;

	$json_response = json_encode($response);
	echo $json_response;
}
?>