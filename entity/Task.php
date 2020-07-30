<?php
class Task {
	public $id;
	public $name;
	public $description;
	public $list_id;
	private $table_name = "tasks";

	public function __construct($db) {
		$this->conn = $db;
	}

	function create() {
		$query = "INSERT INTO " . $this->table_name . " (name, description, list_id)
VALUES (?, ?, ?) ";

		$result = $this->conn->prepare($query);

		$result->bind_param("ssi", $this->name, $this->description, $this->list_id);

		if ($result->execute()) {
			return true;
		}
		return false;

	}
	function read() {
		$query = "SELECT * FROM " . $this->table_name;
		$result = $this->conn->query($query);

		return $result;

	}
	function update() {

		$query = "UPDATE " . $this->table_name . "
SET name=?, description=?, list_id=?
WHERE id=? ";
		$result = $this->conn->prepare($query);
		$result->bind_param("ssii", $this->name, $this->description, $this->list_id, $this->id);

		if ($result->execute()) {
			return true;
		}
		return false;

	}

	function delete() {
		$query = "DELETE FROM " . $this->table_name . "
WHERE id=?";
		$result = $this->conn->prepare($query);
		$result->bind_param("i", $this->id);

		if ($result->execute()) {
			return true;
		}
		return false;

	}
}

?>