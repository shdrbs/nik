<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/function/common_function.php";
	session_start();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

	<title>미래AI</title>

	<link href="/nik/chatGPT/contents/assets/css/index.css?a=1" rel="stylesheet" />
	<link href="/contents/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/contents/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato&display=swap">

	<script src="/contents/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/contents/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</head>


<body>
	<!-- START 로딩바 -->
	<div class="loading_bar hide"></div>
	<!-- END 로딩바 -->

	<!-- START 상단 네비게이션 -->
	<div class="h_navbar">
		<div class="icon">
			<i class="fa fa-2x fa-bars"></i>
		</div>
		<img src="./contents/assets/img/navbar_img.png" alt="#">
		<a href="#">bin1</a>
		<a href="#">bin2</a>
		<a href="#">bin3</a>
		<div class="user_box" onclick="dropdown(this);">
			<span><?=$_SESSION['member_name']?> <i class="fa fa-chevron-down"></i></span>
		</div>
	</div>
	<!-- END 상단 네비게이션 -->

	<!-- START 왼쪽 사이드 메뉴 -->
	<div class="sidenav">
		<i class="side_close fa fa-2x fa-times" style="cursor:pointer; position:absolute; top:3px; right:3px;"></i>
		<div class="dummy_node"></div>
		<div class="new_chat_btn" onclick="new_chat_room();">
			<i class="fa fa-lg fa-plus-square"></i>
			<span>새 채팅 시작</span>
		</div>
		<hr class="chat_room_hr">
		<span class="chat_room_span">목록</span>
		<div class="chat_room_update update">
			<button class="btn btn-xs btn-default" onclick="room_update();">수정</button>
		</div>
		<div class="chat_room_update cancel hide">
			<button class="btn btn-xs btn-danger" onclick="room_delete();">삭제</button>
			<button class="btn btn-xs btn-default" onclick="room_cancel();">취소</button>
		</div>
		<div class="chat_room"></div>
	</div>

	<div class="noneclick_bg hide"></div>
	<!-- END 왼쪽 사이드 메뉴 -->

	<!-- START 메인 -->
	<div class="wrap">
		<div class="container2">
			<div id="chat_main" class="chat_main"></div>

			<div class="prompt_box">
				<textarea id="prompt_textarea" class="prompt_textarea" placeholder="미래AI에게 무엇이든 물어보세요." rows=1></textarea>
				<i class="prompt_submit fa fa-2x fa-toggle-up"></i>
				<!-- <button class="prompt_submit btn btn-primary btn-xs">ENTER</button> -->
			</div>
		</div>
	</div>
	<!-- END 메인 -->

	
	

	<!-- START script -->
	<script>

		$(document).ready(function(){
			var _height = $(window).height();
			var _width = $(window).width();
			$(".chat_main").css("height", (_height-160));

			chat_room_list(); // 채팅방 리스트 호출

			// 키보드 enter 입력 시
			$(".prompt_textarea").keyup(function(e){
				var target = $(this);
				//console.log(target.val());

				if( target.val() != "" ){
					$(".prompt_submit").css("color","#2f8dff");
				}else{
					$(".prompt_submit").css("color","#e0eeff");
				}


				// shift + enter로 줄바꿈하기
				if(e.shiftKey && e.keyCode == 13){
					return;
				}

				// enter 누르면 발생
				if(e.keyCode == 13){
					e.preventDefault();
					prompt_func(target);
				}

				this.style.height = "1px";
				this.style.height = (this.scrollHeight)+"px";
			});

			// enter 버튼 클릭 시
			$(".prompt_submit").on("click", function(){
				//console.log($(this).prev().val());
				var target = $(this).prev();
				prompt_func(target);

				var textarea_element = document.getElementById("prompt_textarea");
				if(textarea_element.scrollHeight <= 174){
					textarea_element.style.height = "1px";
					textarea_element.style.height = (textarea_element.scrollHeight)+"px";
				}
			});

			// 프롬프트 포커스 인
			$(".prompt_textarea").focus(function(){
				//box-shadow: 1px 2px 5px 0px #888888;
				$(".prompt_box").css("box-shadow", "1px 1px 5px 0px #888888");
			});
			// 프롬프트 포커스 아웃
			$(".prompt_textarea").focusout(function(){
				//box-shadow: 1px 2px 5px 0px #888888;
				$(".prompt_box").css("box-shadow", "");
			});
		});

		// 프롬프트 입력
		function prompt_func(target, _this){
			// 사용자 질문
			var q = target.val().replaceAll("\n","<br>");
			if(q == "<br>") q = "";
			//var q = target.val();
			// 채팅번호
			var chat_num = $(".user").length + 1;
			// 채팅방 번호
			var room_num = $(".chat_room_child.active").attr("room_num");

			// textarea 초기화
			target.val("");
			$(".prompt_submit").css("color","#C8EBFA");
			
			// 로딩바 보이게
			$(".loading_bar").removeClass("hide");

			$.ajax({
				url : "./dto/chatDataDto.php",
				method : "post",
				async : true,
				dataType : "json",
				data : {
					"pMode":"save",			// 구분값
					"room_num":room_num,	// 채팅방 번호
					"chat_num":chat_num,	// 채팅 번호
					"question":q,			// 사용자 질문
				},
				success : function(json){
					console.log("키보드 enter 입력 시", json);

					$(".chat_room_child.active .room_main_title").text("채팅");
					$(".chat_room_child.active .room_sub_title").text(json.data.answer.replaceAll("<br>", ""));

					// 화면에 질문 말풍선 append
					var html = "";
					html += "<div class='chat user user_num_"+chat_num+"'>";
					html += "	<div class='textbox'>"+json.data.question+"</div>";
					html += "</div>";

					// chatGPT 답변 말풍선 append
					html += "<div class='chat chat_ai ai_num_"+chat_num+"'>";
					html += "	<div class='textbox'>";
					html += "		<div style='font-size:15px; font-weight:bold; margin-bottom:7px;'>미래AI</div>";
					html +=			"<p>"+json.data.answer+"</p>";
					html += "		<div class='textbox2'><i class='fa fa-clipboard' onclick='clipboard(this);'></i></div>";
					html += "	</div>";
					html += "</div>";
					$(".chat_main").append(html);

					// 로딩바 숨기기
					$(".loading_bar").addClass("hide");

					// 스크롤 생기면 제일 아래로 시점 이동
					var offset = $('.chat_main')[0].scrollHeight // 해당 위치 반환
					$('.chat_main').animate({scrollTop:offset}, 100);
				},
				error: function(x, o, e){
					alert(x.status + " : "+ o +" : "+e);
				}
			});
		}

		// 채팅방 리스트 목록 그리기
		function chat_room_list(){

			$.ajax({
				url : "./dao/chatDataDao.php",
				method : "post",
				async : true,
				dataType : "json",
				data : {
					"pMode":"room_list",
				},
				success : function(json){
					console.log("채팅방 리스트", json);

					// 채팅방이 없으면
					if(json.room_list.length == 0){
						var main_title = "새 채팅";
						var sub_title = "대화를 시작해 보세요.";

						var html = "";
						html += "<div class='chat_room_child active new' room_num='1' onclick='room_click(1);'>";
						html += "	<span class='room_main_title'>"+main_title+"</span>";
						html += "	<span class='room_date'>오늘</span><br>";
						html += "	<div class='room_sub_title'>"+sub_title+"</div>";
						html += "</div>";
						$(".chat_room").prepend(html);

					// 채팅방이 있으면
					}else{
						$.each(json.room_list, function(k,v){
							var html = "";
							html += "<div class='chat_room_child' room_num='"+v.room_num+"' onclick='room_click("+v.room_num+");'>";
							html += "	<span class='room_main_title'>"+v.main_title+"</span>";
							html += "	<span class='room_date'>"+v.regdate+"</span><br>";
							html += "	<div class='room_sub_title'>"+v.sub_title+"</div>";
							html += "</div>";
							$(".chat_room").prepend(html);
						});

						// 마지막 채팅방 active
						var max_room_num = Math.max($(".chat_room_child").attr("room_num"));
						$(".chat_room_child[room_num="+max_room_num+"]").addClass("active");

						chat_list(max_room_num);
						
					}
				},
				error: function(x, o, e){
					alert(x.status + " : "+ o +" : "+e);
				}
			});
		}

		// 채팅 리스트 목록 그리기
		function chat_list(room_num){
			//var room_num = $(".chat_room_child.active").attr("room_num");

			// 로딩바 보이게
			$(".loading_bar").removeClass("hide");

			$.ajax({
				url : "./dao/chatDataDao.php",
				method : "post",
				async : true,
				dataType : "json",
				data : {
					"pMode":"chat_list",
					"room_num":room_num,
				},
				success : function(json){
					console.log("채팅 리스트", json);

					var html = "";
					$.each(json.chat_list, function(k,v){
						// 화면에 질문 말풍선 append
						html += "<div class='chat user user_num_"+v.chat_num+"'>";
						html += "	<div class='textbox'>";
						//html += "		<div style='font-size:15px; font-weight:bold; margin-bottom:7px; text-align:right;'>사용자</div>";
						html +=	"		<p>"+v.question+"</p>";
						html += "	</div>";
						html += "</div>";

						// chatGPT 답변 말풍선 append
						html += "<div class='chat chat_ai ai_num_"+v.chat_num+"'>";
						html += "	<div class='textbox'>";
						html += "		<div style='font-size:15px; font-weight:bold; margin-bottom:7px;'>미래AI</div>";
						html +=	"		<p>"+v.answer+"</p>";
						html += "		<div class='textbox2'><i class='fa fa-clipboard' onclick='clipboard(this);'></i></div>";
						html += "	</div>";
						html += "</div>";
					});
					$(".chat_main").html(html);

					// 스크롤 생기면 제일 아래로 시점 이동
					var offset = $('.chat_main')[0].scrollHeight // 해당 위치 반환
					$('.chat_main').animate({scrollTop:offset}, 100);

					// 로딩바 숨기기
					$(".loading_bar").addClass("hide");
				},
				error: function(x, o, e){
					alert(x.status + " : "+ o +" : "+e);
				}
			});
		}

		// 새 채팅 시작 버튼
		function new_chat_room(){
			var main_title = "새 채팅";					// 메인 제목
			var sub_title = "대화를 시작해 보세요.";	// 서브 제목
			var room_num = Math.max($(".chat_room_child").attr("room_num")) + 1;

			$(".chat_main").empty();
			$(".chat_room_child").removeClass("active");

			var html = "";
			html += "<div class='chat_room_child active new' room_num='"+room_num+"' onclick='room_click("+room_num+");'>";
			html += "	<span class='room_main_title'>"+main_title+"</span>";
			html += "	<span class='room_date'>오늘</span><br>";
			html += "	<div class='room_sub_title'>"+sub_title+"</div>";
			html += "</div>";
			$(".chat_room").prepend(html);
		}

		// 채팅방 클릭 시
		function room_click(room_num){
			$(".chat_main").empty();
			chat_list(room_num); // 채팅 리스트 호출
			
			// active 초기화 및 설정
			$(".chat_room_child").removeClass("active");
			$(".chat_room_child[room_num="+room_num+"]").addClass("active");
		}

		// 상단 user정보 드롭다운
		function dropdown(target){
			if( $(target).hasClass("top") ){
				$(target).removeClass("top");
				$(".fa-chevron-down").animate({rotate:'0deg'});
			}else{
				$(target).addClass("top");
				$(".fa-chevron-down").animate({rotate:'180deg'});
			}
		}


		// 사이드바 보임
		$(".h_navbar .icon").on("click", function(){
			$(".noneclick_bg").removeClass("hide");
			$(".sidenav").css("z-index","100");
			$(".sidenav").animate({left:"0"}, 100);
		});

		// 사이드바 숨김
		$(".noneclick_bg").on("click", side_action);
		$(".side_close").on("click", side_action);
		function side_action(){
			$(".sidenav").animate({left:"-250px"}, 100); 
			setTimeout(function() {
				var class_element = document.getElementsByClassName("sidenav")[0];
				class_element.style = "";
				$(".noneclick_bg").addClass("hide");
			}, 500);
		}

		// 클립보드 복사
		function clipboard(target){
			var textToCopy = $(target).parent().prev().html();
			console.log(textToCopy);

			// 텍스트를 복사하기 위한 임시 엘리먼트 생성
			var copyElement = $('<textarea>').appendTo('body').val(textToCopy).select();
			document.execCommand('copy'); // 클립보드에 복사
			copyElement.remove(); // 임시 엘리먼트 제거

			alert("텍스트가 복사되었습니다.");
		};

		// 사이드바메뉴에 수정버튼 클릭 시
		function room_update(){
			console.log();
			//$(".chat_room_child").css("padding-left", "50px");
			$(".chat_room_update.update").addClass("hide");
			$(".chat_room_update.cancel").removeClass("hide");
			$(".chat_room_child").before("<input class='room_checkbox' type='checkbox' style='float:left; margin:28px 15px;'>");
		}

		// 사이드메뉴에 삭제버튼 클릭 시
		function room_delete(){
			var room_arr = [];
			var room_val = 0;
			$(".room_checkbox").each(function(k,v){
				//console.log( $(v).is(":checked") );

				if( $(v).is(":checked") ){
					room_val = $(v).next().attr("room_num");
					room_arr.push(room_val);
				}
			});

			$.ajax({
				url : "./dto/chatDataDto.php",
				method : "post",
				async : true,
				dataType : "json",
				data : {
					"pMode":"delete",
					"room_arr":room_arr,
				},
				success : function(json){
					$(".chat_room_update.update").removeClass("hide");
					$(".chat_room_update.cancel").addClass("hide");

					$(".chat_room, .chat_main").empty();
					chat_room_list();
				},
				error: function(x, o, e){
					alert(x.status + " : "+ o +" : "+e);
				}
			});
		}

		// 사이드 메뉴에 취소버튼 클릭 시
		function room_cancel(){
			$(".chat_room_update.update").removeClass("hide");
			$(".chat_room_update.cancel").addClass("hide");
			$(".room_checkbox").remove();
		}

	</script>
	<!-- END script -->
	
</body>
</html>