<?php
	$val = "";

	foreach($val as $v){
	
	}
?>

<script>
	
	//뷰앤디 업체 상품가격
	//document.getElementById('totalProducts').getElementsByTagName('table')[0].getElementsByTagName('tbody')[2].getElementsByTagName('tr')[0].getElementsByTagName('p')
	//document.getElementById('totalProducts').getElementsByTagName('table')[0].getElementsByTagName('tbody')[2].getElementsByTagName('tr')[0].getElementsByTagName('td')[0].getElementsByTagName('input')[0].value

	//const string = '<p class="product">뷰앤디 앤모드<br> - <span>앤모드 1+1할인<br><b>149.900원</b><span>(제품당 74.950원)</span>(+60,000원)</span></p>';
	//const string = '<p class="product">뷰앤디 앤모드<br> - <span>앤모드 단품<br><b>89.900원</b></span></p>';
	const string = '<p class="product">뷰앤디 눈썹 잔털 지우개<br> - <span>뷰앤디 1+1 (파우치 2개 무료증정)49.900원(제품당 24.950원) (+45,200원)</span></p>';
	//const string = '<p class="product">뷰앤디 눈썹 잔털 지우개<br> - <span>미니 파우치3.900원 (-57,100원)</span></p>';
	//const string = '<p class="product">뷰앤디 눈썹 잔털 지우개<br> - <span>뷰앤디 단품29.600원</span></p>';

	const regex = /(\d+[.,]?\d+)/; // 숫자를 추출하기 위한 정규식
	const match = string.match(regex); // 정규식과 문자열 매칭
	console.o

	if (match) {
	  const price = match[0].replace(/[^\d]+/g, ''); // 숫자 이외의 문자 제거
	  console.log(price); // 49900 출력
	} else {
	  console.log('숫자를 찾을 수 없습니다.');
	}

</script>

