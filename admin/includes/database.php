<?php

//require_once("new_config.php");

class Database {

	public $connection;

	function __construct(){
		$this->open_db_connection();
	}



	public function open_db_connection(){
		//$this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		//if(mysqli_connect_errno()){
		//	die("Database connection failed" . mysqli_error());
		//}

		$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
		
		$server = $url["host"];
		$username = $url["user"];
		$password = $url["pass"];
		$db = substr($url["path"], 1);
	
		$this->connection = new mysqli($server, $username, $password, $db);

		if($this->connection->connect_errno){
			die("Database connection failed" . $this->connection->connect_error);
		}
	}

	public function query($sql){

		$result = $this->connection->query($sql);

		$this->confirm_query($result);

		//$result = mysqli_query($this->connection, $sql);
		
		return $result;
	}

	private function confirm_query($result){
		if(!$result) {
			die("Query failed" . $this->connection->error);
		}

	}

	public function escape_string($string){
		$escaped_string =$this->connection->real_escape_string($string);
		return $escaped_string;
	}

	public function the_insert_id(){

		return mysqli_insert_id($this->connection);


		//return $this->connection->insert_id;
	}



}


$database = new Database();
















?>

