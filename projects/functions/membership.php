<?php

require 'Mysql.php';

class Membership {

	function validateUser($un, $pwd){
		$mysql = New Mysql();
		$ensure_credentials = $mysql->verifyUserPass($un, $pwd);
	
		if($ensure_credentials){
			$_SESSION['status']= 'authorized';
			header ("location:formproject4.php");
			
		} else return True;
	}



}