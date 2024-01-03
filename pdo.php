<?php
	function tt($data){
		echo "<xmp>";
		print_r($data);
		echo "</xmp>";
		echo "<br>";
	}

	$db['host'] = '10.41.88.48';
	$db['name'] = "erpconn";
	$db['user'] = "dbconn";
	$db['pass'] = "alfo#dkdldpsTl";
	$db['port'] = "3306";

	try{
		// MySQL PDO 객체 생성
		$dbconn = new PDO('mysql:host='.$db['host'].';dbname='.$db['name'].';charset=utf8', $db['user'], $db['pass']);

		// 에러 출력
		$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(Exception $e) {
		echo 'Failed to obtain database handle : '.$e->getMessage();
	}

	/*
	PDO::FETCH_BOTH		: default, 일반배열, 연관배열 두 형태로 결과값 반환
	PDO::FETCH_ASSOC	: 연관배열로 반환 key값으로 접근 가능
	PDO::FETCH_NUM		: 일반배열로 반환 인덱스로 접근 가능
	*/
	//print_r( date("Y-m-d H:i:s") );

	/////////////////////////////////////////////////////////////// SELECT ///////////////////////////////////////////////////////////////////////////////////////////
	$sql = "select * from yk.nik_board";
	//$sql = "
		//select * from yk.nik_board
		//where suid in(?)
	//";
	$stmt = $dbconn->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	tt($row);



	/////////////////////////////////////////////////////////////// INSERT ///////////////////////////////////////////////////////////////////////////////////////////
	//$sql = "
		//insert into yk.nik_board
		//set sabun = ?
			//, w_name = ?
			//, title = ?
			//, content = ?
			//, reqdate = ?
	//";
	//$stmt = $dbconn->prepare($sql);
	//$stmt->execute(['B220607', '노인균', 'pdo', 'pdo 테스트', date("Y-m-d H:i:s")]);
	
?>