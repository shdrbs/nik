<?php
	include $_SERVER['DOCUMENT_ROOT'] . "/nik/function.php";

	$url = $_SERVER['REQUEST_URI'];
	$parsed_url = parse_url($url, PHP_URL_QUERY);
	parse_str($parsed_url, $params);
	$requst_uri = $params['dir'] ? "/nik/".$params['dir']."/" : $_SERVER['REQUEST_URI'];

	$file_list = get_file_list($_SERVER['DOCUMENT_ROOT'] . $requst_uri . '*', $requst_uri);
	$dir_list = get_dir_list($_SERVER['DOCUMENT_ROOT'] . $requst_uri);
	$myfiles = get_myfiles($_SERVER['DOCUMENT_ROOT'] . $requst_uri);

	//tt("file_list",$file_list);
	//tt("dir_list",$_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']);
	//tt("server",$_SERVER);
	//tt($_SERVER['DOCUMENT_ROOT'] . $requst_uri);

	$dir_html = "<table id='dir_table'>";
	foreach($myfiles as $v){
		if( $v == "." && $requst_uri != "/nik/" ){
			$dir_html .= "<tr>";
			$dir_html .= "<td><a href='/nik/'>뒤로가기</a></td>";
			$dir_html .= "</tr>";
		}
	}
	foreach($dir_list as $v){
		$dir_html .= "<tr>";
		$dir_html .= "<td><i class='fa fa-lg fa-folder-open' style='color:#707478;'></i>&nbsp;<a href='/nik/?dir=".$v."'>".$v."</a></td>";
		$dir_html .= "</tr>";
	}
	$dir_html .= "</table>";

	usort($file_list, 'strcasecmp'); // 대소문자 구분없이 정렬
	$file_html = "<table id='file_table'>";
	foreach($file_list as $v){
		$file_html .= "<tr>";
		$file_html .= "<td><i class='fa fa-lg fa-file' style='color:#707478;'></i>&nbsp;<a href='".$requst_uri.$v."'>".$v."</a></td>";
		$file_html .= "</tr>";
	}
	
	$file_html .= "</table>";

?>



<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>nik</title>

	<link rel="icon" href="./favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<link href="/contents/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="/nik/contextmenu.js?b=2"></script>

	<style>
		body{
			padding:10px;
		}

		#dir_table tr td, #file_table tr td{
			padding:5px;
		}

		#folder_box, #file_box{
			width:400px; height:600px; padding:20px; border:solid 1px gray; overflow:auto;
		}

		#folder_title, #file_title{
			font-weight:bold; font-size:20px;
		}
	</style>

</head>
<body>
	<div style="display:flex;">
		<div class="">
			<span id="folder_title">폴더</span>
			<div id="folder_box" style="margin-right:15px">
				<?php echo $dir_html?>
			</div>
		</div>

		<div class="">
			<span id="file_title">파일</span>
			<div id="file_box">
				<?php echo $file_html?>
			</div>
		</div>
	</div>
</body>
</html>






