<!DOCTYPE html>
<html>

<head>
	<!--CDN으로 사용함-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>

<style>
	/* 리스트 css */
	.column {
		border: 1px solid #cecece;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.container-fluid {
		margin-top: 20px;
	}

	.container-fluid .card {
		margin-left: auto;
		margin-right: auto;
	}

	/* 이동 타켓 */
	.card-placeholder {
		border: 1px dotted rgb(255, 0, 0);
		margin: 0 10px 10px 0;
		height: 20px;
		margin-left: auto;
		margin-right: auto;
		background-color: rgb(231, 136, 107);
	}

	/* 마우스 포인터를 손가락으로 변경 */
	.card:not(.no-move) .card-header {
		cursor: grab;
	}
</style>

<body>
	<div class="container-fluid">
		<label class="createBox"> [추가]</label>
		<div class="row">
			<!-- 세로 리스트 박스 -->
			<div class="col-3 column">
				<!-- 각 카드 리스트 박스 -->
				<div class="card text-white mb-3 no-move" style="background-color: rgb(255, 143, 143); width:100px; margin:0;">
					<div class="card-header">Header</div>
					<div class="card-body">
						<h5 class="card-title">card 1</h5>
						<p class="card-text">안움직여야함</p>
					</div>
				</div>
				<div id="dept2">
						<div class="card text-black mb-3 no-move" style="background-color: rgb(255, 254, 168); width:100px;">
							<div class="card-header">Header</div>
							<div class="card-body">
								<h5 class="card-title">card 3</h5>
								<p class="card-text">안움직여야함</p>
							</div>
						</div>
						<div class="card text-black mb-3 no-move" style="background-color: rgb(255, 254, 168); width:100px;">
							<div class="card-header">Header</div>
							<div class="card-body">
								<h5 class="card-title">card 3</h5>
								<p class="card-text">안움직여야함</p>
							</div>
						</div>
				</div>
				<div id="dept3">
					<div class="card text-white mb-3" style="background-color: rgb(253, 196, 130); width:100px; float:right;">
						<div class="card-header">Header
							<label class="deleteBox"> [삭제]</label>
						</div>
						<div class="card-body">
							<h5 class="card-title">card 2</h5>
							<p class="card-text">card 2</p>
						</div>
					</div>
				</div>
			</div>
			
			<!-- 세로 리스트 박스 -->
			<div class="col-3 column">
				<!-- 각 카드 리스트 박스 -->
				<div class="card text-white mb-3 no-move" style="background-color: rgb(98, 179, 98);">
					<div class="card-header">Header</div>
					<div class="card-body">
						<h5 class="card-title">card 4</h5>
						<p class="card-text">안움직여야함</p>
					</div>
				</div>
				<!-- 각 카드 리스트 박스 -->
				<div class="card text-white mb-3" style="background-color: rgb(76, 94, 153);">
					<div class="card-header">Header
						<label class="deleteBox"> [삭제]</label>
					</div>
					<div class="card-body">
						<h5 class="card-title">card 5</h5>
						<p class="card-text">card 5</p>
					</div>
				</div>
				<!-- 각 카드 리스트 박스 -->
				<div class="card text-white mb-3" style="background-color: rgb(98, 58, 104);">
					<div class="card-header">Header
						<label class="deleteBox"> [삭제]</label>
					</div>
					<div class="card-body">
						<h5 class="card-title">card 6</h5>
						<p class="card-text">card 6</p>
					</div>
				</div>
			</div>
			<!-- 세로 리스트 박스 -->
			<div class="col-3 column box">
				<!-- 각 카드 리스트 박스 -->
				<div class="card mb-3 text-white" style="background-color: rgb(106,118,134);">
					<div class="card-header">Header
						<label class="deleteBox"> [삭제]</label>
					</div>
					<div class="card-body">
						<h5 class="card-title">card 7</h5>
						<p class="card-text">card 7</p>
					</div>
				</div>
				<!-- 각 카드 리스트 박스 -->
				<div class="card text-white mb-3" style="background-color: rgb(85, 73, 3);">
					<div class="card-header">Header
						<label class="deleteBox"> [삭제]</label>
					</div>
					<div class="card-body">
						<h5 class="card-title">card 8</h5>
						<p class="card-text">card 8</p>
					</div>
				</div>
			</div>
		</div>


	</div>
	<script>
		$(function () {
			$(".column").sortable({
				// 드래그 앤 드롭 단위 css 선택자
				connectWith: ".column",
				// 움직이는 css 선택자
				handle: ".card-header",
				// 움직이지 못하는 css 선택자
				cancel: ".no-move",
				// 이동하려는 location에 추가 되는 클래스
				placeholder: "card-placeholder",
				// 요소를 잡는 순간 실행
				start : function(event, ui){
					$(this).css('background-color', 'rgb(213,222,232)');
				},
				// 모든 이동이 끝난 후에 마지막으로 실행
				stop : function(event, ui){
					$(this).css('background-color', 'transparent');
				},
				drag : function(event, ui){
					console.log("a");
				}
			});
			// 해당 클래스 하위의 텍스트 드래그를 막는다.
			$(".column .card").disableSelection();
		});

		// 삭제 라벨
		$(document).on('click', ".deleteBox", function(){
			$(this).parent().parent().remove();
		});

		// 추가 라벨
		$(document).on('click', '.createBox', function(){
			innerHtml = ""
			innerHtml += `
				<div class="card text-white mb-3" style="background-color: rgb(246, 175, 255);">
					<div class="card-header">Header
						<label class="deleteBox"> [삭제]</label>
					</div>
					<div class="card-body">
						<h5 class="card-title">card</h5>
						<p class="card-text">plus</p>
					</div>
				</div>
			`;
			$(".box").append(innerHtml);
		});
	</script>
</body>
</html>