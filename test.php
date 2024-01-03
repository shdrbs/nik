<?
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/top.php"; 
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/dbconnect_main.php"; 
?>

<style>
	* {box-sizing: border-box;}

	body {margin: 0;}

	.container2 {display: flex; flex-direction: row; border: 5px solid red;}
	.item {color: white; font-size: 48px; padding: .5em; text-align: center;}
	.orange {background: orange;}
	.green {background: green;}
	.blue {background: blue;}
</style>

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
						<h4 class="panel-title"><?=$pageSubMenuName?></h4>
					</div>
					<div class="panel-body" >
						<div class="container2">
							<div class="item orange" style="flex:2;">A</div>
							<div class="item green" style="flex:9;">B</div>
							<div class="item blue" style="flex:1;">C</div>
						</div>

						<div class="form-group has-success has-feedback">
							<input id="input_test" type="text" class="form-control">
							<span class="fa fa-check form-control-feedback"></span>
							<!-- <span class="fa fa-warning form-control-feedback"></span> -->
							<!-- <span class="fa fa-times form-control-feedback"></span> -->
						</div>

						<?php
							//tt($_SESSION);
							//$team_gubun = substr($_SESSION["part_code_name"], 0, 2);
							//tt($team_gubun);

							tt($_SESSION);
							tt( $_SERVER );

							$query = "
								SELECT COMPANY , SUBJECT , CONTENT FROM toup.TOUP_COUNSEL 
								WHERE IDX IN(4601, 4600, 4598)
							";
							$result = mysqli_query($db_main, $query);
							$data = array();
							while( $row = mysqli_fetch_assoc($result) ){
								$data[] = $row;
							}

							//tt($data);

							$company = $data[1]['COMPANY'];
							$subject = $data[1]['SUBJECT'];
							$content = $data[1]['CONTENT'];
							$korean_flag = false;

							foreach ( array($company , $subject , $content ) as $str ) {
								//$replace_search = array("’", "…");
								//$str = str_replace($replace_search , "" , $str);
								//if(preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $str)) $korean_flag = true;
								if(preg_match("/[\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u", $str)) $korean_flag = true;
							}

							if( !$korean_flag ){
								echo "실패";
							}else{
								echo "성공";
							}

							$data_list = array(
								array(
									"name"=>"노인균",
									"id"=>"noin"
								),
								array(
									"name"=>"조용화",
									"id"=>"cho"
								),
							);

						?>
					</div>
					<div id="dataset" data-list='{"sabun":"B220607","name":"노인균"}'></div>
					<div id="dataset2" data-list2='<?=json_encode($data_list)?>'></div>

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
			var data_list = $("#dataset2").data("list2");
			console.log(data_list);
		});

		var map = new Map();
		map.set("a","b");
		console.log(map);

		var obj = new Object();
		obj["a"] = "b";
		console.log(obj);

	</script>
	<!-- ================== END Develop JS ================== -->

</body>
</html>
