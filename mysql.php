<?php
	// MySQL 데이터베이스 접속
	$host = '127.0.0.1';
	$user = 'root';
	$pw = 'root';
	$dbname = 'nik';

	// Create connection
	$conn = new mysqli($host, $user, $pw, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}else {
	}

	//$query = "select * from nik.board";
	//$result = mysqli_query($db_main, $query);
	//$data = array();
	//while( $row = mysqli_fetch_assoc($result) ){
		//$data[] = $row;
	//}

	//print_r($data);
?>