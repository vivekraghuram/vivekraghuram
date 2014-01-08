<?php

require_once 'constants.php';

class Mysql {

	private $conn;

	function __construct(){
		$this->conn = new mysql(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)  or die('There was a problem connecting to the database');
	}

	function verifyUserPass($un, $pwd) {


		$query = "SELECT *
				FROM users
				WHERE username = ? AND password = ?
				LIMIT 1";
				
		if($stmt = $this->conn->prepare($query)){
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->execute();
			
			if($stmt->fetch()){
				$stemt->close();
				return true;
			};
		
		
		}
	}

}