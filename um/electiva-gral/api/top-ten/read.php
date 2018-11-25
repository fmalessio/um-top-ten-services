<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../../../api/config/database.php';
include_once '../../model/top-ten.php';
 
// instantiate database
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$topTen = new TopTen($db);
 
// Read
$topTen_arr = $topTen->read();

echo json_encode($topTen_arr);
?>