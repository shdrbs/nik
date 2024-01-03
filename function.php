<?php
	function tt($data1, $data2 = array()){
		if( $data2 ){
			echo "<br>";
			echo "<h3>[".$data1."]</h3>";
			echo "<xmp style='margin:10px 0 50px 0;'>";
			print_r($data2);
			echo "</xmp>";
			echo "<br>";
		}else{
			echo "<br>";
			echo "<xmp style='margin:10px 0 50px 0;'>";
			print_r($data1);
			echo "</xmp>";
			echo "<br>";
		}
	}

	// . .. 파일 폴더
	function get_myfiles($dirname){
		$myfiles = scandir($dirname);
		$myfiles = array_diff(scandir($dirname), array('..')); 
		return $myfiles;
	}

	// 파일 리스트 
	function get_file_list($dirname, $path){
		$fileList = glob($dirname);
		$filename_list = array();
		foreach($fileList as $filename){
			if(is_file($filename)){
				$filename_list[] = str_replace($_SERVER['DOCUMENT_ROOT'].$path,"",$filename);
				//$filename_list[] = $filename;
			}
		}
		return $filename_list;
	}

	// 폴더 리스트
	function get_dir_list($dirname){
		$result_array = array();

		$handle = opendir($dirname);
		while ($file = readdir($handle)) {
			if($file == '.'||$file == '..') continue;
			if (is_dir($dirname.$file)) $result_array[$file] = $file;
		}
		closedir($handle);
		sort($result_array);
		return $result_array;
	}
?>