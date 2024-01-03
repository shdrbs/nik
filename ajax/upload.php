<?php
	$uploadfile = './' . basename($_FILES['upfile']['name']);

	// move_uploaded_file은 임시 저장되어 있는 파일을 ./ 디렉토리로 이동합니다. 
	if(move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) { 
		 echo "성공적으로 업로드 되었습니다.\n"; 
	}else{ 
		 echo "파일 업로드 실패입니다.\n"; 
	}

	print json_encode($_FILES);
	exit;
?>