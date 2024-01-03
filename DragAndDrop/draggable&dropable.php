<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<div class="move_div" style="width:100px; height:100px; background:gray;"></div>

<script>
	//Move Distance
	var topDis=0;
	var leftDis=0;
	//boolean to revert check
	var isRevert = true;
	//final object loc
	var fTop=0;
	var fLeft=0;
	//droppable target 
	$contain=$(".contain");
	//draggable target
	$object = $(".move_div");

	//움직일 객체
    $object.draggable({
		//드래그가 끝난뒤 제자리로 돌아오게 하는 속성값
		revert:function(event,ui){
			//droppable 객체가 아닌곳에 드래그 됫을때
			if(event==false){
				isRevert=false;
				return true;
			//droppable 객체에 들어갓을때
			}else{
				isRevert=true;
			}
		},
		//드래그되는 객체가 본인 자체일지 아니면 그외 다른것일지
		//해당 함수의 return 값이 드래그되어서 움직임
		helper:function(){
			$helper=$(this).clone();
			return $helper; 
		},
		//드래그가 시작됬을때 발생
		start:function(event,ui){
			//최종 더해질 객체
			$final=$(this).clone();
			//잠시 더해져서 에니메이션을 보여줄 객체
			$clone=$(this).clone();
		},
		//드래그 도중 발생
		drag:function(event,ui){
		},
		//드래그가 중지됬을때 발생
		stop:function(event,ui){
			//console.log(event.target); 
			//이벤트 중인 타깃 객체 helper객체가아닌
			//original 객체
			//console.log(ui.offset); 최종 좌표
			//제대로 droppable 객체 안에 들어갔을때
			if(isRevert){
				//최종 객체를 더해주고
				$contain.append($final);
				//최종 객체의 위치를 지정 후 거리 계산
				//visibility 속성은 해당위치에 존재함으로 밑의 과정이 
				//display 속성은 해당위치에 존재하지 않기때문에 필요함
				$finalTop=$final.offset().top;
				$finalLeft=$final.offset().left;
				//객체를 숨기고
				$final.css("visibility","hidden");
				//이동할 객체를 생성
				$clone.css("position","absolute");
				$contain.append($clone);
				//drop 위치에 객체 배정
				$clone.offset({
					top:ui.offset.top,
					left:ui.offset.left
				})
				//거리 계산
				topDis=$finalTop-ui.offset.top;
				leftDis=$finalLeft-ui.offset.left;
				$clone.animate({left:"+="+leftDis},function(){
					//이동한 객체는 에니메이션 종료 후 삭제
					$(this).remove();
					//완료될시 모든 객체를 보여줌
					$contain.children().css("visibility","visible");        
				});
				$clone.animate(
						{top:"+="+topDis},
						{queue:false}
				);   
			}
			//$(this).animate({marginLeft:"+="+leftDis});
		}
	});

	$contain.droppable({
        accept:".test01",
        drop:function(event,ui){
            //drop 펑션
            //draggable의 stop function이 종료된 후에
            //발생
        }
    })
</script>