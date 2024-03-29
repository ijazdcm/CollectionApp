<?php
ini_set("display_errors", 1);

//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../config/database.php");
include_once("../model/customer.php");
include_once("../utility/utility.php");

//objects
$db = new Database();
$connection = $db->Connect();
$customer_obj = new Customer($connection);
$util = new Util();

if($_SERVER['REQUEST_METHOD'] === "POST"){

   $data = json_decode(file_get_contents("php://input"));
      
   if($customer_obj->super_complement_update_multiple($data->list))
   {
      http_response_code(200);
      //print_r($data);
      //echo (json_encode($data));
      echo json_encode(["status"=>"1","data"=>"Complement Updated For selected User"]);
   }
   else
   {
      http_response_code(500);
      echo json_encode(["status"=>"0","data"=>"Something Went Wrong"]);
   }
    
}
else
{
    http_response_code(403);
    echo json_encode(["status"=>"0","data"=>"This Api Supports Only Post Method"]);
}