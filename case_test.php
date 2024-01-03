<?php
	$dd = 2;
	switch($dd){
		case(1):
		case(3):
			echo "1";
			break;
		case(2):
			echo "2";
			break;
		default:
			echo "3";
	}

	
	$query = "
		SELECT 
			suid
			, num
			, sabun
			, w_name
			, title
			, content
			, CASE 
				WHEN is_yn = 'Y'
				THEN '사용'
				WHEN is_yn = 'N'
				THEN '미사용'
				ELSE '빈값'
			END AS is_yn
			
		FROM yk.nik_board
	";
?>

<script>
	function switchOfStuff(val) {
		var answer = "";
		switch (val){
			case("a"):
			case("d"):
				answer = "apple";
				break;
			case "b":
				answer ="bird";
				break;
			case "c":
				answer ="cat";
				break;
			default:
				answer ="stuff"; 
				break;
		}
		return answer;
	}

	var dd = switchOfStuff("d")
	console.log(dd);
</script>