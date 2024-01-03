<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<iframe name="iframe1" style="display:none"></iframe>
	<form id="form_test" action="form_non_redirect2.php" method="post" target="iframe1">
		<input type="hidden" name="suid" value="1">
		<input type="hidden" name="name" value="노인균">
		<input type="hidden" name="age" value="33">
		<input type="hidden" name="phone" value="">
		<button>form테스트</button>
	</form>
</body>
</html>
