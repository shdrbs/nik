<?
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/top.php"; 
?>


<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #board-loader -->
	<div id="board-loader" class="fade in hide"><span class="spinner"></span></div>
	<!-- end #board-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
		<?
		require_once $_SERVER["DOCUMENT_ROOT"]."/include/header.php"; 
		?>		
	
		<?
		require_once $_SERVER["DOCUMENT_ROOT"]."/include/leftMenu.php"; 
		?>
		<?
		require_once $_SERVER["DOCUMENT_ROOT"]."/include/topMenu.php"; 
		?>	
		<!-- begin #content -->
		<div id="content" class="content">
			<?
			require_once $_SERVER["DOCUMENT_ROOT"]."/include/navigation.php"; 
			?>

			<div class="col-md-12">
				<div class="panel panel-inverse">
					<div class="panel-heading">
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							<a id="accountReload" href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h4 class="panel-title">검색</h4>
					</div>
					<div class="panel-body" >
						<table width="100%" id="data-table1" class="table table-striped table-bordered display nowrap "> <!--responsive-->
							<thead>
								<tr>
									<th>사번</th>
									<th>부서</th>
									<th>이름</th>
									<th>직급</th>
									<th>이메일</th>
									<th>전화번호</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end #content -->

		<?
		require_once $_SERVER["DOCUMENT_ROOT"]."/include/footer.php"; 
		?>

		<?
		require_once $_SERVER["DOCUMENT_ROOT"]."/include/admin_widget.php"; 
		?>


		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- start modal area -->
	<div class="modal fade" id="modal-dialog">
		<div class="modal-dialog">
			<div class="modal-content">

			</div>
		</div>
	</div>
	<!-- end modal area -->

	<?
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/bottomForJS.php"; 
	?>

	<!-- ================== BEGIN PAGE Include LEVEL JS & CSS ================== -->
	<script src="/contents/assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="/contents/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
	<!-- ================== BEGIN parsley JS ================== -->
	<script src="/contents/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/contents/assets/plugins/jquery-form/jquery.form.min.js"></script>
	<!-- ================== END parsley JS ================== -->
	<!-- ================== END PAGE Include JS & CSS================== -->



	<!-- ================== BEGIN Develop JS ================== -->
	<script type="text/javascript">

		$(document).ready(function(){
			CallBackLoadMain();
		});

		function CallBackLoadMain(){
		
			if( $.fn.DataTable.isDataTable( '#data-table1' ) ) {
				$('#data-table1').DataTable().destroy();
			}
			
			dt1 = $('#data-table1').DataTable({
				"serverSide"	: true,
				"paging"		: true,
				"searching"		: true,
				"searchDelay"	: 1000,
				"scrollY"		: false,
				"scrollX"		: true,
				"scrollCollapse": true,
				"fixedColumns"	: false,
				"ordering"		: false,
				"language": {
					"lengthMenu": "_MENU_ 개씩 보여줍니다",
					"zeroRecords": "Nothing found - sorry",
					"info": "Showing page _PAGE_ of _PAGES_ (총 _MAX_ 개의 데이터)",
					"infoEmpty": "데이터가 없습니다.",
					"infoFiltered": "(총 _MAX_ 개의 데이터 중 검색된 결과입니다.)",
					"search": "검색 :",
					"paginate": {
						previous: "이전",
						next: "다음"
					}
				},
				"dom" :'<"topToolbar">frtip',
				//"lengthMenu": [15],
				//"order" : [[ 2, "desc" ]],
				"columns": [
					{"data": "basic_sabun", "class":"text-center"},
					{"data": "part_code2_name", "class":"text-center"},
					{"data": "basic_name", "class":"text-center"},
					{"data": "basic_duty_name", "class":"text-center"},
					{"data": "basic_email1", "class":"text-center"},
					{"data": "basic_tel", "class":"text-center"},
				],
				"columnDefs": [
					{
						"targets": [0],
						//"sClass": "alignCenter",
						//"visible": false,
						//"searchable": false,
						//"orderable": false,
						"render": function ( data, type, row ) {
							var rtndata = row.basic_sabun;
							return rtndata;
						} 
					},
				],
				"ajax": {
					"url" : "./dao.php",
					"type": "POST",
					"beforeSend": function (request) {
						showLoading();
					},
					"data": function(senddata){
						senddata.pMode = 'list';
					},
					"dataSrc": function ( json ) {
						var _data = json.data;
						console.log(json);
		
						for( var keys in _data ){
							var kData = _data[keys];
						}
		
						$("#datadraw").val(json.draw);
						hideLoading();
						return json.data;
					}
				},
				"drawCallback" : function(settings){},
				"initComplete": function(settings, json) {
					// 검색폼으로 마우스 포커스 이동
					$("input[type=search]").focus();
				}
			});
		
			if(!(jQuery.browser.msie)){
				$('#data-table1_filter input').unbind();
				$('#data-table1_filter input').bind('keyup', function(e) {
					if(e.keyCode == 13) {
						dt1.search(this.value).draw();
					}
				});
			}
		}

	</script>
	<!-- ================== END Develop JS ================== -->

</body>
</html>
