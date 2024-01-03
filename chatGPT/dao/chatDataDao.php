<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/function/common_function.php"; 

	session_start();

	$db_main = new mysqli("10.41.88.48", "dbconn", "alfo#dkdldpsTl", "erpconn"); 
	$db_main->set_charset("utf8");

	$pMode			= $_REQUEST['pMode']		? $_REQUEST['pMode']		: "";
	$room_num		= $_REQUEST['room_num']		? $_REQUEST['room_num']		: "";

	$member_id = $_SESSION['member_id'];

	$output = array();

	// 채팅방 데이터
	if($pMode == "room_list"){
		
		$query['room_list'] = "
			SELECT
				basic_sabun										# 사번
				, basic_name									# 사원명
				, part_name										# 부서명
				, duty_name										# 직급
				, room_num										# 채팅방 번호
				, main_title									# 메인 제목
				, sub_title										# 서브 제목
				, DATE_FORMAT(regdate,'%Y-%m-%d') as regdate	# 등록날짜
			FROM erpconn.miraeAI_room
			WHERE 1
				AND basic_sabun = '$member_id'
			ORDER BY regdate
		";
		$result = mysqli_query($db_main, $query['room_list']);
		$data = array();
		$i = 0;
		while($row = mysqli_fetch_assoc($result)){
			$data[$i]['basic_sabun'] = $row['basic_sabun'];
			$data[$i]['basic_name'] = $row['basic_name'];
			$data[$i]['part_name'] = $row['part_name'];
			$data[$i]['duty_name'] = $row['duty_name'];
			$data[$i]['room_num'] = $row['room_num'];
			$data[$i]['main_title'] = $row['main_title'];
			$data[$i]['sub_title'] = str_replace("<br>", "", $row['sub_title']);

			// 오늘, 어제 날짜 체크
			$checkDate = strtotime($row['regdate']);	// 체크할 날짜 설정 (특정 날짜를 strtotime을 이용해 timestamp로 변환)
			$today = strtotime('today');				// 오늘 날짜의 timestamp
			$yesterday = strtotime('yesterday');		// 어제 날짜의 timestamp
			if ($checkDate === $today) {
				$data[$i]['regdate'] = "오늘";
			}else if($checkDate === $yesterday){
				$data[$i]['regdate'] = "어제";
			}else{
				$data[$i]['regdate'] = $row['regdate'];
			}

			$i++;
		}

		$output['room_list'] = $data;
		$output['query'] = $query;

	// 채팅 데이터
	}else if($pMode == "chat_list"){

		$query['chat_list'] = "
			SELECT
				basic_sabun										# 사번
				, basic_name									# 사원명
				, part_name										# 부서명
				, duty_name										# 직급
				, room_num										# 채팅방 번호
				, chat_num										# 채팅 번호
				, question										# 질문
				, answer										# 답변
				, DATE_FORMAT(regdate,'%Y-%m-%d') as regdate	# 등록날짜
			FROM erpconn.miraeAI_chat
			WHERE 1
				AND basic_sabun = '$member_id'
				AND room_num = $room_num
			ORDER BY regdate
		";
		$result = mysqli_query($db_main, $query['chat_list']);
		$data = array();
		$i = 0;
		while($row = mysqli_fetch_assoc($result)){
			$data[$i]['basic_sabun'] = $row['basic_sabun'];
			$data[$i]['basic_name'] = $row['basic_name'];
			$data[$i]['part_name'] = $row['part_name'];
			$data[$i]['duty_name'] = $row['duty_name'];
			$data[$i]['room_num'] = $row['room_num'];
			$data[$i]['chat_num'] = $row['chat_num'];
			$data[$i]['question'] = custom_htmlspecialchars($row['question']);
			$data[$i]['answer'] = custom_htmlspecialchars($row['answer']);
			$data[$i]['regdate'] = $row['regdate'];

			$i++;
		}

		$output['chat_list'] = $data;
		$output['query'] = $query;

	}

	
	function custom_htmlspecialchars($string) {
		// 역슬래시 제거
		$string = stripslashes($string);

		// <br> 태그 예외 처리
		$string = str_replace('<br>', '__BR_TAG__', $string);
		
		// 모든 HTML 태그 이스케이프
		$string = htmlspecialchars($string);

		// <br> 태그 복원
		$string = str_replace('__BR_TAG__', '<br>', $string);

		return $string;
	}

	mysqli_close($db_main);
	print json_encode($output);
	exit;
?>