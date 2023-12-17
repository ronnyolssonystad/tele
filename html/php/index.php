<?php


$req = array_filter( explode('/', $_SERVER['QUERY_STRING']));
$url="";
// request command
if (isset($req) && count($req) > 0) {
    $command=$req[1];
    switch ($command) {
        case 'edit': $url='./editpers.php';
    }
}
if (isset($req) && count($req) > 1) {
    $url=$url.'?id='.$req[2];
}
if ($url<>"") {
    echo file_get_contents($url);
}




?>