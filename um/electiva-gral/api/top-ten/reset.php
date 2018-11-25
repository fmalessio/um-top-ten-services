<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../../../../api/config/database.php';
include_once '../../model/top-ten.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$topTen = new TopTen($db);

if($topTen->reset()) {
    echo '{';
        echo '"success": "true"';
    echo '}';
} else {
    echo '{';
        echo '"success": "false"';
    echo '}';
}
?>