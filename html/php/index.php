<?php


$req = array_filter( explode('/', $_SERVER['QUERY_STRING']));
$domain = $_SERVER["SERVER_NAME"];
$requri = $_SERVER['REQUEST_URI'];



$url="";
// request command
if (isset($req) && count($req) > 0) {
    $command=$req[1];
    switch ($command) {
        case 'edit': $url="location: /php/editpers.php";
            break;
        case 'Persons' : $url="location: /php/Persons.php";
            break;
        case 'delete' :
            $url = "location: /php/deletePerson.php";
            break;
        case 'upload' :
            $url = "location: /php/upload.php";
            break;
        default:
            echo("<P> Nothing to see here, dude :)</>");
            exit();
    
    }
}
if (isset($req) && count($req) > 1) {
    $url=$url.'?id='.$req[2];
}
if ($url<>"") {    
    header($url);
    exit();
}




?>