<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>js</title>
</head>
<body>
	<ul>
		<li>a</li>
		<li>b</li>
		<li>c</li>
	</ul>
	<div class="test" style="width:100px; height:100px; background:gray;"></div>
	<input id="trigger" type="button" value="trigger" onclick="">

	<script>
		/*
		document.addEventListener("DOMContentLoaded", function(){
			var element = document.querySelector(".test");
			element.addEventListener("click", function(){
				element.setAttribute("id","id_test");
				element.className += " add_class";
			});
			
			var li_elements = document.querySelectorAll("li");
			li_elements.forEach(function(v,k,i) {
				v.style.color = "red";
				// cssText를 사용하면 css style을 여러개 작성할 수 있다.
				v.style.cssText = "font-size:20px; color:red; background:gray;";
				console.log(v.style.color);
				console.log(getComputedStyle(v).backgroundColor);
			});

			var arr = ["a","b","c"];
			arr.forEach(function(v,k){
				console.log(v);
			});

			console.dir(document.body.children);
			console.dir( document.querySelector(".test") );

		});
		*/

		// element 생성
		const elementDiv = document.createElement('div');
		elementDiv.style.cssText = "width:50px; height:50px; background:blue; position:absolute; bottom:10px; right:10px;";

		// element 추가
		document.body.append(elementDiv);
	</script>

</body>
</html>


