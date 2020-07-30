<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../Db.php';
include_once '../entity/Task.php';

$database = new Db();
$db = $database->connect();

$task = new Task($db);

$data = json_decode(file_get_contents('php://input'));

$task->name = $data->name;
$task->description = $data->description;
$task->list_id = $data->list_id;

if ($task->create()) {

	http_response_code(201);

	$message = ["message" => "Task created"];
	echo json_encode($message);
} else {
	http_response_code(503);

	$message_err = ["message" => "Cannot create task"];
	echo json_encode($message_err);
}
?>