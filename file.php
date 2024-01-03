<?php
	function tt($data){
		echo "<xmp>";
		print_r($data);
		echo "</xmp>";
	}

	$json_data = [
		[
			"name"=>"노인균",
			"age"=>"33",
			"address"=>["a","b","c"]
		],
		[
			"name"=>"노인균",
			"age"=>"33",
			"address"=>["a","b","c"]
		]
	];
	$json_data = json_encode($json_data);
	//tt($json_data);

	// 파일 작성
	$file = fopen("json.txt","w");
	fwrite($file, $json_data);
	fclose($file);


	// 파일 쓰기(수정)
	//$fp = fopen("json.txt", 'a');
	//fwrite($fp,"\n"."추가할 내용");
	//fclose($fp);


	//// 파일 읽기
	//$f_data = fopen("json.txt","r");
	//$f_data = fread($f_data, filesize("json.txt"));
	//$f_data = json_decode($f_data, true);
	//tt($f_data);
?>