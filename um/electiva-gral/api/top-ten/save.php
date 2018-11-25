<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../../../../api/config/database.php';
include_once '../../model/top-ten.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$topTen = new TopTen($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set properties
$topTen->id = null;
$topTen->name = $data->name;
$topTen->attempts = $data->attempts;
$topTen->date = $data->date;

if($topTen->addToTopTen()) {
    echo '{';
        echo '"success": "true"';
    echo '}';
} else{
    echo '{';
        echo '"success": "false"';
    echo '}';
}
?>