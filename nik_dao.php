<?php
	$dbconn = new mysqli("10.41.88.48", "dbconn", "alfo#dkdldpsTl", "erpconn"); 
	$dbconn->set_charset("utf8");

	$startnum = $_REQUEST['start'];
	$lengthnum = $_REQUEST['length'];

	$output = array(
		  "data" => array()
		, "recordsTotal"	=> 0
		, "recordsFiltered"	=> 0
	);

	$sql = "
		select * 
		from yk.nik_board
	";

	// 전체 개수
	$_query['total_sql'] = "
		select count(1) as totalCnt
		from yk.nik_board
	";
	$total_result=mysqli_query($dbconn, $_query['total_sql']);
	$filtered_data = $total_data = mysqli_fetch_array($total_result);

	// 페이징
	$sLimit  = " LIMIT $startnum, $lengthnum ";

	$sql .= $sLimit ;

	$result = mysqli_query($dbconn, $sql);
	$output = array();
	while( $rows = mysqli_fetch_assoc($result) ){
		$output['data'][] = $rows;
	}
	
	$output["recordsTotal"] = $total_data['totalCnt'];
	$output["recordsFiltered"] = $filtered_data['totalCnt'];

	mysqli_close($dbconn);
	print json_encode($output);
?>