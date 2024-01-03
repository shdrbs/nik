<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/dbconnect_main.php";
	include $_SERVER["DOCUMENT_ROOT"]."/include/function/common_function.php";

	// datatable setting parameter
	$draw					= isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '' ;
	$startnum				= isset($_REQUEST['start']) ? $_REQUEST['start'] : 0 ;
	$lengthnum				= isset($_REQUEST['length']) ? $_REQUEST['length'] : 10 ;
	$ordercolumn			= isset($_REQUEST["order"][0]['column']) ? $_REQUEST["order"][0]['column'] : "" ;
	$orderdir				= isset($_REQUEST["order"][0]['dir']) ? $_REQUEST["order"][0]['dir'] : "" ;
	$searchValue			= isset($_REQUEST["search"]['value']) ? getTextAreaString($_REQUEST["search"]['value']) : '' ;  
	$ordercolumnName		= isset($_REQUEST['columns']) ? $_REQUEST["columns"][$ordercolumn]['data'] : '' ; 

	$output = array();
	$where = $sLimit = "";

	if($searchValue != ""){
		$where .= "
			AND (
				basic_tel LIKE '%$searchValue%'
				OR basic_sabun LIKE '%$searchValue%'
				OR basic_name LIKE '%$searchValue%'
				OR part_code2_name LIKE '%$searchValue%'
			)
		";
	}

	// 페이징
	if ( $lengthnum >= 0 ){
		$sLimit .= " LIMIT $startnum,$lengthnum ";
	}

	$query["list"] = "
		SELECT 
			basic_sabun, part_code2_name, basic_name, basic_duty_name, basic_email1, basic_tel
		FROM 
			erpconn.insa_basic
		WHERE 1
			AND basic_hold_div = '재직'
			$where
		$sLimit
	";
	$result = mysqli_query($db_main, $query["list"]);
	$data = array();
	while($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}

	// 전체 데이터
	$_query['total_sql'] = "
		SELECT COUNT(*) AS totalCnt 
		FROM erpconn.insa_basic
		WHERE 1
			AND basic_hold_div = '재직'
			$where
	";
	$total_result = mysqli_query($db_main, $_query['total_sql']);
	$filtered_data = $total_data = mysqli_fetch_array($total_result); 

	$output['query'] = $query;
	$output['data'] = $data;
	$output["recordsTotal"] = $total_data['totalCnt'];
	$output["recordsFiltered"] = $filtered_data['totalCnt'];

	mysqli_close($db_main);
	print json_encode($output);
	exit;
?>