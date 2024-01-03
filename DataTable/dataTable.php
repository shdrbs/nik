<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script
	  src="https://code.jquery.com/jquery-3.6.0.js"
	  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	  crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

</head>
<body>
	<table width="100%" id="data-table1" class="table table-striped table-bordered table-hover display nowrap"> <!--responsive-->
		<thead>
			<tr>
				<th>id</th>		<!--보이지 않음(suid)-->
				<th>이름</th>
				<th>지역</th>
			</tr>
		</thead>
	</table>




	<script>
	
		$("#data-table1").DataTable({
			ajax : { url: "data.json", dataSrc: '' },
			//dom :'<"topToolbar">frtip',
			columns : [
				{ data: "id" },
				{ data: "name" },
				{ data: "location" }
			]
		});

	</script>
</body>
</html>