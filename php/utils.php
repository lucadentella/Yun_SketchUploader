<?php

	// authenticate a user
	function authenticate() {
	
		if(isset($_POST["password"])) {
		
			$password = $_POST["password"];
			if(check_password($password)) {
			
				session_start();
				$_SESSION['logged'] = true;
				session_commit();
			}
		}
	}
	
	// checks if the user is authenticated to view the page
	function check_security() {
	
		session_start();
		if(!$_SESSION['logged']) {			
			header("Location: ../index.html");
		}
		
	}
	
	// check if the given password is correct
	function check_password($password) {
	
		$hash = hash('sha256', $password);
		if(strcmp($hash, get_password_hash()) == 0) return true;
		return false;
	}
	
	// retrieves the password hash from the Yun config file
	function get_password_hash() {
	
		$handler = fopen('/etc/config/arduino', 'r');
		if(!$handler) return "";
		
		while(!feof($handler)) {
			
			$line = fgets($handler);
			if(strstr($line, 'option password')) {
			
				$start = strpos($line, "'");
				$end = strrpos($line, "'");
				$hash = substr($line, $start + 1, $end - $start - 1);
			}
		}
		
		fclose($handler);
		return $hash;
	}
	
	// logout
	function logout() {
	
		session_start();
		session_unset();
		session_destroy();
		header("Location: ../index.html");
	}
	
	// merge sketch with bootloader
	function sketch_merge() {
		
		$filename = $_GET["filename"];
		$command = "merge-sketch-with-bootloader.lua /tmp/" . escapeshellarg($filename);
		system($command, $returncode);
		return $returncode;
	}
	
	// upload sketch to ATMEGA32u4
	function sketch_upload() {
	
		$filename = $_GET["filename"];
		$command =  "run-avrdude " . escapeshellarg("/tmp/" .$filename);
		system($command, $returncode);
		return $returncode;
	}
	
	// delete the file
	function sketch_delete() {
	
		$filename = $_GET["filename"];
		$command =  "rm " . escapeshellarg("/tmp/" .$filename);
		system($command, $returncode);
		return $returncode;
	}
?>