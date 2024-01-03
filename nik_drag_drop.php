<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마우스 드래그 앤 드롭</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body{
			width: 100vw;
			height: 100vh;
			display: flex;
			justify-content: center; 
			align-items: center;
		}

		.area{
			width: 70%;
			height: 70%;
			background-color: rgba(0, 0, 0, 0.2);
			position: relative;
		}

		.area__box{
			position: absolute;
			top: 0;
			left: 0;
			width: 200px;
			height: 200px;
			background-color: red;
			cursor: pointer;
		}
	</style>
</head>
<body>
    <div class="area">
        <div class="area__box"></div>
    </div>

	<script>
		const container = document.querySelector(".area");
		const box = container.querySelector(".area__box");

		const {width:containerWidth, height:containerHeight} = container.getBoundingClientRect();
		const {width:boxWidth, height:boxHeight} = box.getBoundingClientRect();
		
		let isDragging = null;
		let originLeft = null;
		let originTop = null;
		let originX = null;
		let originY = null;

		box.addEventListener("mousedown", (e) => {
			isDragging = true; // 마우스 이동 시작을 전역으로 알림
			originX = e.clientX; //브라우저를 기준으로 한 마우스 x축 포인터
			originY = e.clientY; //브라우저를 기주능로 한 마우스 y축 포인터
			originLeft = box.offsetLeft; //container를 기준으로 한 bx좌표
			originTop = box.offsetTop; //container를 기준으로 한 by좌표
		});

		//document.addEventListener("mousemove", (e) => {
			//if(isDragging){ //마우스 이동 시작을 전역으로 알렸을 경우에만 적용
				//const diffX = e.clientX - originX; // 이동한 거리(x)
				//const diffY = e.clientY - originY; // 이동한 거리(y)
				//// 컨테이너 기준 처음 박스 좌표 + 이동한 거리(x, y)
				//box.style.left = originLeft + diffX + "px"; 
				//box.style.top = originTop + diffY + "px";
			//}
		//});

		document.addEventListener("mousemove", (e) => {
			if(isDragging){
				const diffX = e.clientX - originX;
				const diffY = e.clientY - originY;
				
				// containerWidth는 container.getBoundingClientRect().width
				// containerHeight는 container.getBoundingClientRect().height
				// boxWidth는 box.getBoundingClientRect().width
				// boxHeight는 box.getBoundingClientRect().height
				const endOfXPoint = containerWidth - boxWidth;
				const endOfYPoint = containerHeight - boxHeight;

				console.log(endOfXPoint);
				console.log(endOfYPoint);
				
				// left가 -값이 되면 0이 최댓 값이 되므로 박스는 경계선을 벗어날 수 없음.
				// top이 -값이 되면 0이 최댓 값이 되므로 박스는 경계선을 벗어날 수 없음.
				box.style.left = `${Math.min(Math.max(0, originLeft+ diffX), endOfXPoint)}px`;
				box.style.top = `${Math.min(Math.max(0, originTop + diffY), endOfYPoint)}px`;
			}
		});

		document.addEventListener("mouseup", (e) => {
			isDragging = false;
		});
	</script>
</body>
</html>