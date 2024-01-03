<!-- jsTree theme -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
<!-- jsTree -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<button onclick="demo_create();">생성</button>
<input type="text" id="demo_q">
<div id="jstree_demo"></div>

<script>

	$(function () {
		
		// 노드 검색
		var to = false;
		$('#demo_q').keyup(function () {
			if(to) { clearTimeout(to); }
			to = setTimeout(function () {
				var v = $('#demo_q').val();
				$('#jstree_demo').jstree(true).search(v);
			}, 250);
		});

		$('#jstree_demo').jstree({
			"core" : {
				"animation" : 0,
				"check_callback" : true,
				'force_text' : true,
				"themes" : { "stripes" : true },
				'data' : [
					{ "id" : "dept1_1", "parent" : "#", "text" : "대분류1" },
					{ "id" : "dept1_2", "parent" : "#", "text" : "대분류2" },
					{ "id" : "dept2_3", "parent" : "dept1_1", "text" : "중분류1-1" },
					{ "id" : "dept2_2", "parent" : "dept1_2", "text" : "중분류2-2" },
					{ "id" : "dept2_1", "parent" : "dept1_2", "text" : "중분류2-1" },
					{ "id" : "dept3_1", "parent" : "dept2_1", "text" : "소분류2-1-1" },
				]
			},
			"types" : {
				"#" : { "max_children" : 1, "max_depth" : 4, "valid_children" : ["root"] },
				"root" : { "icon" : "/static/3.3.15/assets/images/tree_icon.png", "valid_children" : ["default"] },
				"default" : { "valid_children" : ["default","file"] },
				"file" : { "icon" : "glyphicon glyphicon-file", "valid_children" : [] }
			},
			"plugins" : [ 
				//"checkbox",				// 각 노드 앞에 체크박스 생성
				//"contextmenu",			// 마우스 오른쪽 클릭 시 구성 가능한 작업 목록 출력
				//"dnd",					// 노드 이동 가능
				//"massload",				// 단일 요청으로 노드를 로드할 수 있음
				//"sort",					// 정렬
				"types",				// 노드 그룹에 대해 미리 정의된 유형을 추가할 수 있으므로 각 그룹에 대한 중첩 규칙 및 아이콘을 쉽게 제어할 수 있음
				"search",				// 검색
				"state",				// 이전 상태로 복원
				"unique",				// 형제 노드의 이름 중복 불가
				"wholerow",				// 노드 선택 시 블록형태로 표시
				"changed",				// 노드 선택 시 이전 노드, 현재 노드 정보를 제공
				//"conditionalselect"		// ??
			]
		}).bind('select_node.jstree', function(event, data){
			console.log("select",data);
		}).bind('changed.jstree', function(event, data){
			console.log("changed",data);
		})
	});

	// 노드 생성
	function demo_create() {
		var ref = $('#jstree_demo').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		sel = sel[0];
		sel = ref.create_node(sel, {"type":"file"});
		if(sel) {
			ref.edit(sel);
		}
	};

	// 노드 이름 수정
	function demo_rename() {
		var ref = $('#jstree_demo').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		sel = sel[0];
		ref.edit(sel);
	};

	// 노드 삭제
	function demo_delete() {
		var ref = $('#jstree_demo').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		ref.delete_node(sel);
	};

</script>