<?php

?>

<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jquery.form.min.js"></script>

<script>
	
	function upload(){
		$("#frm").ajaxForm({
			url : "./upload.php",
			enctype : "multipart/form-data",
			//dataType : "json",
			error : function(result){
				console.log("에러", result) ;
			},
			success : function(result){
				console.log("성공", result) ;
			}
		});

		$("#frm").submit() ;
	}

</script>


<form name="frm" id="frm" method="post" enctype="multipart/form-data">
	<input type="file" name="upfile" id="upfile">
</form>


<a href="javascript:upload();">등록</a>