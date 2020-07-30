<?php  

class Db{
	private $host = "localhost";
	private $db_name = "db";
	private $username = "root";
	private $password = "";
	public $con;

	function connect(){
		$this->con = null;

		$this->con = new mysqli($this->host,$this->username,$this->password, $this->db_name );
		

		return $this->con;

	}
}

?>