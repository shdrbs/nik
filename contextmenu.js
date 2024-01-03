/*
부모 요소					|	요소 생성											|	스타일 추가
parentElement				|	var newElement = document.createElement('div');		|	element.style.color = 'red';
							|														|	
자식 요소					|	요소 추가											|	스타일 한번에 여러개 추가하기
children					|	after												|	element.style.cssText = 'width:50px; padding:10px; background-color:black;';
firstElementChild			|	before												|	
lastElementChild			|	append() : 선택 요소 내부 끝 부분에 추가			|	id, class 추가
							|	prepend() : 선택 요소 내부 시작 부분에 추가			|	newElement.id = 'id';
형제 요소					|	element.insertBefore(a,b)							|	newElement.className = 'class1';
previousElementSibling		|	element.insertAfter(a,b)							|	newElement.classList.add = 'class2';
nextElementSibling			|														|	
							|	요소 삭제											|	텍스트 추가
							|	element.remove()									|	newElement.textContent = 'hello';
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------
속성 추가										속성 접근
newElement.setAttribute('속성명', '속성값');	newElement.getAttribute('속성명');
*/

function handleCreateContextMenu(event){
	event.preventDefault();							// 기본 Context Menu가 나오지 않게 차단
	var select_tag_name = event.target.tagName;		// 마우스 오른쪽 클릭한 태그 ex)DIV, A, TD

	// 초기화 (contextmenu 요소가 있으면 지운다)
	$(".active").remove();
	var id_element = document.getElementById("contextmenu");
	if(id_element !== null) id_element.remove();

	// newElement 생성
	var newElement = document.createElement('div');
	newElement.id = 'contextmenu';
	newElement.style.cssText = 'position:absolute; width:200px; height:100px; border:0.2mm solid gray; background:white; padding:10px; box-shadow: 3px 3px 7px rgb(0,0,0,0.6);';

	// 노출 설정
	newElement.style.display = 'block';

	// 위치 설정
	newElement.style.top = event.pageY+'px';
	newElement.style.left = event.pageX+'px';

	if( select_tag_name == "A" ){
		var ctxMenu = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
		var ctxText = event.target.text;
		var div_text = "";
		var div_text2 = "";

		if( ctxMenu.getAttribute("id") == "folder_box" ){
			div_text = "폴더명 변경";
			div_text2 = "폴더 삭제";
		}else if( ctxMenu.getAttribute("id") == "file_box" ){
			div_text = "파일명 변경";
			div_text2 = "파일 삭제";
		}else{
			return;
		}

		event.target.className = "active";

		newElement.innerHTML = "<span class='nonclick' onclick='_update(\""+ctxText+"\", \""+event.target+"\");' style='cursor:pointer;'>"+div_text+"</span><br>";
		newElement.innerHTML += "<span class='nonclick' onclick='_delete(\""+ctxText+"\", \""+event.target+"\");' style='cursor:pointer;'>"+div_text2+"</span>";

		// 요소 추가
		document.querySelector("body").append(newElement);

	}else{
		var ctxMenu = event.target;
		var div_text = "";
		var f_data = "";

		if( ctxMenu.getAttribute("id") == "folder_box" ){
			div_text = "폴더 생성";
			f_data = "folder";
		}else if( ctxMenu.getAttribute("id") == "file_box" ){
			div_text = "파일 생성";
			f_data = "file";
		}else{
			return;
		}

		newElement.innerHTML = "<div id='create' class='nonclick' onclick='_create(\""+f_data+"\");' style='cursor:pointer;'>"+div_text+"</div>";

		// 요소 추가
		document.querySelector("body").append(newElement);
	}
}

function click_fn(event){
	if( event.target.className != "nonclick" ){
		var id_element = document.getElementById("contextmenu");
		if(id_element !== null){
			id_element.remove();
		}
	}
}

function _create(f_data){
	var id_element = document.getElementById("contextmenu");
	id_element.innerHTML = "파일명을 입력해주세요.<input id='f_name' class='nonclick' type='text' onkeyup='if(window.event.keyCode==13){create2(\""+f_data+"\", this.value)}'>";
	var id_element = document.getElementById("f_name").focus();
}

function create2(f_data, f_name){
	$.ajax({
		url : "./f_create.php",
		method : "post",
		async : false,
		//dataType : "json",
		data : {
			f_data : f_data,
			f_name : f_name
		},
		success : function(json){
			var id_element = document.getElementById("contextmenu");
			if(id_element !== null){
				id_element.remove();
			}
			location.reload();
		},
		error: function(x, o, e){
			alert(x.status + " : "+ o +" : "+e);
		}
	});
}

function _update(txt_name, path){
	var class_element = document.getElementsByClassName("active")[0];
	var parent = class_element.parentElement;
	class_element.remove();
	
	$(parent).append("<input type='text' value='"+txt_name+"'>");
	$("#contextmenu").remove();
}

function _delete(txt_name, path){

}

document.addEventListener('contextmenu', handleCreateContextMenu, false);
document.addEventListener("click", click_fn, false);
