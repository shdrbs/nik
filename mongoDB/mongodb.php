<?php
	function tt($data){
		echo "<xmp>";
		print_r($data);
		echo "</xmp>";
	}

	$pMode = $_REQUEST['pMode'] ? $_REQUEST['pMode'] : "";

	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

	///////////////////////////////////////////////////////////////////////// Command ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$filter = [ 'Name' => 'CDH' ]; // 조건 (완전 일치)
	//$filter = [ 'Name' => array('$regex' => 'C') ]; // 조건 (포함)
	//$query = new MongoDB\Driver\Query($filter);
	$query = new MongoDB\Driver\Query([]); // 조건 없이 전체 조회
	$rows = $manager->executeQuery("test.test", $query);
	foreach ($rows as $row) { // 데이터가 있는대로 반복해서 가져온다.
		echo "이름은 $row->Name 이고, 도시는 $row->City 입니다.";
	}

	//$nosql_command = new MongoDB\Driver\Command([
		//'aggregate' => 'test', // DataBase이름
		//'pipeline' => [
			//[
				//'$match'=>['name'=>['$ne'=>'']] // where 검색조건
			//],
			//[
				//'$addFields'=>['add'=>'adsfsf'] // 도큐먼트에 컬럼을 추가해서 출력
			//],
			////[
				////'$group'=>[
					////'_id'=>'$arr',
					////'count'=>['$sum'=> 1]
				////]
			////],
			//[
				//'$sort'=>['_id'=>-1] // 정렬 (-1, 1)
			//],
		//],
		//'allowDiskUse' => true, // 100mb의 제약 사항을 해제?
		//'cursor' => new stdClass,
	//]);

	//$rows = $manager->executeCommand("test", $nosql_command)->toArray(); 

	//$bson = \MongoDB\BSON\fromPHP($rows);
	//$json = \MongoDB\BSON\toJSON($bson);
	//$data = json_decode($json, true);

	//tt($data[0]['_id']['$oid']);
	//tt($data);

	///////////////////////////////////////////////////////////////////////// query ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//$filter = [];
	//$options = [
		//'projection' => ['_id' => 0],
		//'sort' => ['x' => -1],
	//];

	//$query = new MongoDB\Driver\Query($filter, $options);
	//$cursor = $manager->executeQuery('test.test', $query);

	//foreach ($cursor as $document) {
		//$je = json_encode($document);
		//$jd = json_decode($je,true);
		//tt($jd);
	//}

	///////////////////////////////////////////////////////////////////////// BulkWrite insert ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$bulk = new MongoDB\Driver\BulkWrite;
	//$bulk->insert(['name' => '조용화', 'arr' => ['aa','bb'], 'email'=>'abcd@abcd.com']);
	//$manager->executeBulkWrite('test.test', $bulk);

	///////////////////////////////////////////////////////////////////////// BulkWrite update ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$bulk = new MongoDB\Driver\BulkWrite;
	//$bulk->update(
		//['name' => '조용화'],
		//[
			//'$set' => ['arr.0' => 'aa', 'email' => 'cc'], // arr컬럼의 0번째 값을 'll'로 변경
		//], 
		//['multi' => true, 'upsert' => false]
	//);
	//$result = $manager->executeBulkWrite('test.test', $bulk);

	///////////////////////////////////////////////////////////////////////// BulkWrite unset ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$bulk = new MongoDB\Driver\BulkWrite;
	//$bulk->update(
		//['name' => '조용화'],
		//[
			//'$unset' => ['arr[0]'=>true],
		//], 
		//['multi' => true, 'upsert' => false]
	//);
	//$result = $manager->executeBulkWrite('test.test', $bulk);

	///////////////////////////////////////////////////////////////////////// BulkWrite delete ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$bulk = new MongoDB\Driver\BulkWrite;
	//$bulk->delete(['name' => 'test'], ['limit' => 0]);
	////$bulk->delete(['x' => 2], ['limit' => 0]);
	//$result = $manager->executeBulkWrite('test.test', $bulk);

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//if( $pMode == "mongo_view" ){
		//$nosql_command = new MongoDB\Driver\Command([
			//'aggregate' => 'test', // DataBase이름
			//'pipeline' => [
				//[
					//'$match'=>['name'=>['$ne'=>'']] // where 검색조건
				//],
				//[
					//'$addFields'=>['add'=>'adsfsf'] // 도큐먼트에 컬럼을 추가해서 출력
				//],
				////[
					////'$group'=>[
						////'_id'=>'$arr',
						////'count'=>['$sum'=> 1]
					////]
				////],
				//[
					//'$sort'=>['_id'=>-1] // 정렬 (-1, 1)
				//],
			//],
			//'allowDiskUse' => true, // 100mb의 제약 사항을 해제?
			//'cursor' => new stdClass,
		//]);

		//$rows = $manager->executeCommand("test", $nosql_command)->toArray(); 

		//$bson = \MongoDB\BSON\fromPHP($rows);
		//$json = \MongoDB\BSON\toJSON($bson);
		//$data = json_decode($json, true);
	
		//print $json;
	//}
?>
