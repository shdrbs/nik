<?php
	$f_data = $_REQUEST['f_data'] ? $_REQUEST['f_data'] : "";
	$f_name = $_REQUEST['f_name'] ? $_REQUEST['f_name'] : "";

	if( $f_data == "folder" ){
		mkdir($f_name, 777);
	}else{
		fopen($f_name, "w");
	}

	print "";
?>