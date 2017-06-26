<?php 
	ob_start();
	session_start();

	define('dbhost', 'localhost');
	define('dbname', 'root');
	define('dbpass', '');
	define('database', 'file_server');

	$conn = new MySQLi(dbhost,dbname,dbpass,database);
	if ($conn->connect_errno) {
		die("Error: ".$conn->connect_errno);
	}
	
	
