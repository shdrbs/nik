<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/function/common_function.php"; 

	session_start();

	$db_main = new mysqli("10.41.88.48", "dbconn", "alfo#dkdldpsTl", "erpconn"); 
	$db_main->set_charset("utf8"); 

	$pMode			= $_REQUEST['pMode']		? $_REQUEST['pMode']		: "";
	$chat_num		= $_REQUEST['chat_num']		? $_REQUEST['chat_num']		: 0;
	$room_num		= $_REQUEST['room_num']		? $_REQUEST['room_num']		: 0;
	$room_arr		= $_REQUEST['room_arr']		? $_REQUEST['room_arr']		: "";
	$question		= $_REQUEST['question']		? $_REQUEST['question']		: "";

	//$patterns = array("!", "&", "<", ">", "(", ")", ";");
	//$replacements = array("\!", "\&", "\<", "\>", "\(", "\)", "\;");
	//$question = str_replace($patterns, $replacements, addslashes($question));
	$question = addslashes($question);
	$question = '"' . $question . '"';

	$member_id = $_SESSION['member_id'];

	$output = array();

	$output['aaa'] = $question;

	// 채팅, 채팅방 저장 및 chatGPT api 호출
	if($pMode == "save"){
		// chatGPT 파이썬파일 호출
		// $data : python 리턴값
		exec("cd /data/web/erpnew/nik/chatGPT/api && python chatGPT.py $question", $data);

		// 파이썬 리턴값을 객체배열로 가공
		$result = array();
		foreach ($data as $line) {
			$split = explode(':', $line, 2);
			if (count($split) === 2) {
				$key = trim($split[0]);
				$value = trim($split[1]);
				$result[$key] = $value;
			}
		}
		$question = $result['question'];
		$answer = $result['answer'];
		$question2 = str_replace("<br>", "\n", $question);
		$answer2 = str_replace("<br>", "\n", $answer);

		/////////////////////////////////////////////////////////////// DB 저장 ///////////////////////////////////////////////////////////////////////////////////////////
		// 첫번째 채팅일 경우에만 저장
		if($chat_num == 1){
			// 채팅방 저장
			$query['room'] = "
				INSERT INTO erpconn.miraeAI_room(
					basic_sabun				# 사번
					, basic_name			# 사원명
					, part_name				# 부서명
					, duty_name				# 직급
					, room_num				# 채팅방 번호
					, main_title			# 메인 제목
					, sub_title				# 서브 제목
					, regdate				# 등록날짜
				)
				(
					SELECT 
						basic_sabun											# 사번
						, basic_name										# 사원명
						, part_code2_name									# 부서명
						, basic_duty_name									# 직급
						, $room_num											# 채팅방 번호
						, '채팅'											# 메인 제목
						, '".$db_main->real_escape_string($answer)."'		# 서브 제목
						, now()												# 등록날짜
					FROM erpconn.insa_basic 
					WHERE 1
					AND basic_sabun = '$member_id'
				)
			";
			$result_room = mysqli_query($db_main, $query['room']);
		}


		// 채팅 저장
		$query['chat'] = "
			INSERT INTO erpconn.miraeAI_chat(
				basic_sabun				# 사번
				, basic_name			# 사원명
				, part_name				# 부서명
				, duty_name				# 직급
				, room_num				# 채팅방 번호
				, chat_num				# 채팅 번호
				, question				# 질문 내용
				, answer				# 답변 내용
				, regdate				# 등록날짜
			)
			(
				SELECT 
					basic_sabun											# 사번
					, basic_name										# 사원명
					, part_code2_name									# 부서명
					, basic_duty_name									# 직급
					, $room_num											# 채팅방 번호
					, $chat_num											# 채팅 번호
					, '".$db_main->real_escape_string($question2)."'	# 질문 내용
					, '".$db_main->real_escape_string($answer2)."'		# 답변 내용
					, now()												# 등록날짜
				FROM erpconn.insa_basic 
				WHERE 1
				AND basic_sabun = '$member_id'
			)
		";
		$result_chat = mysqli_query($db_main, $query['chat']);

		$output['data']['question'] = custom_htmlspecialchars($question2);
		$output['data']['answer'] = custom_htmlspecialchars($answer2);
		$output['query'] = $query;
		$output['result'] = array("chat"=>$result_chat, "room"=>$result_room);
	}

	// 채팅, 채팅방 삭제
	else if($pMode == "delete"){
		$room_nums = implode(", ", $room_arr);	// 채팅방 번호 ex) 1,2,3

		$query['room'] = "
			DELETE FROM erpconn.miraeAI_room
			WHERE 1
				AND basic_sabun = '$member_id'
				AND room_num IN($room_nums)
		";
		$result = mysqli_query($db_main, $query['room']);

		$query['chat'] = "
			DELETE FROM erpconn.miraeAI_chat
			WHERE 1
				AND basic_sabun = '$member_id'
				AND room_num IN($room_nums)
		";
		$result = mysqli_query($db_main, $query['chat']);

		$output['query'] = $query;
		$output['result'] = $result;
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