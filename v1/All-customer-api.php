<?php
ini_set("display_errors", 1);


//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:GET");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../config/database.php");
include_once("../model/customer.php");
include_once("../utility/utility.php");

//objects
$db = new Database();

$connection = $db->Connect();

$customer_obj = new Customer($connection);


if($_SERVER['REQUEST_METHOD'] === "GET"){

   $data = json_decode(file_get_contents("php://input"));
    
   $data=$customer_obj->get_all_customer();
   $response_data=array();
   foreach($data as $key=>$customer)
   {
       $response_data[$key]=$customer;
   }
   echo json_encode(["status"=>"1","data"=>$response_data],JSON_INVALID_UTF8_IGNORE);
  
  
}
else
{
    http_response_code(403);
    echo json_encode(["status"=>"0","data"=>"This Api Supports Only Get Method"]);
}