<?php


require_once 'db_connect.php';
// Retrieve JSON data from the POST request
$jsonData = json_decode($_POST['jsonData'], true);

// Process the JSON data (for example, you can save it to a file or perform other operations)
// In this example, just echoing it back
echo json_encode(['status' => 'success', 'data' => $jsonData]);

for( $i = 0; $i < count($jsonData); $i++) {
    $person = $jsonData[$i];
    createPerson($person);

}

