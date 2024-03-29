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

$user_obj = new Customer($connection);
$util = new Util();

if($_SERVER['REQUEST_METHOD'] === "POST"){

   $data = json_decode(file_get_contents("php://input"));

    if($util::validate_is_empty($data->user_id))
    {
        if($util::validate_isNumeric($data->user_id))
        {
            $user_obj->user_id=$data->user_id;
            if($user_obj->delete_user())
            {
                http_response_code(200);
                echo json_encode(["status" => "1", "data" => "USER DELETED SUCCESSFULLY"]);
            }
            else
            {
                http_response_code(200);
                echo json_encode(["status" => "0", "data" => "SOMETHING WENT WRONG"]);
            }

        }else
        {
            http_response_code(200);
            echo json_encode(["status" => "0", "data" => "USER ID MUST BE ONLY NUMERIC"]);
        }
    }
    else
    {
        http_response_code(200);
        echo json_encode(["status" => "0", "data" => "FILL THE USER ID"]);
    }
}
else {

    http_response_code(403);
    echo json_encode(["status" => "0", "data" => "This Api Supports Only Post Method"]);

  }