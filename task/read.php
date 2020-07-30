<?php
include_once '../Db.php';
include_once '../entity/Task.php';

$database = new Db();
$db = $database->connect();

$task = new Task($db);

$result = $task->read();

if ($result->num_rows > 0) {
	$task_arr = [];
	$task_arr["tasks"] = [];
	// fetch all rows
	while ($row = $result->fetch_assoc()) {

		$id = $row['id'];
		$name = $row['name'];
		$description = $row['description'];
		$list_id = $row['list_id'];

		$task_item = [
			"id" => $id,
			"name" => $name,
			"description" => $description,
			"list_id" => $list_id];

		array_push($task_arr["tasks"], $task_item);
	}

	http_response_code(200);

	echo json_encode($task_arr);

} else {
	echo 'No tasks found';
}
?>