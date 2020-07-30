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

$task->id = $data->id;

$task->name = $data->name;
$task->description = $data->description;
$task->list_id = $data->list_id;

if ($task->update()) {

	http_response_code(200);

	$message = ["message" => "Task updated"];
	echo json_encode($message);

} else {
	http_response_code(503);

	$message_err = ["message" => "Cannot update task"];
	echo json_encode($message_err);
}

?>
