<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>view</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
	<input id="mongo_btn" type="button" value="몽고 데이터 가져오기">

	<script>
		$("#mongo_btn").on("click", function(){
			$.ajax({
				url:"mongodb.php",
				method:"post",
				data:{"pMode":"mongo_view"},
				success:function(data){
					jData = JSON.parse(data);
					console.log(jData);
				}
			});
		});
	</script>
</body>
</html>