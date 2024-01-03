<?php
	class test{
		
		protected $api = null;

		function __construct($d1){
			$this->api = $d1;
		}

		public function aa($data){
			return $this->api;
		}
	}


	$test = new test("999");

	$v = $test->aa(123);
	print_r($v);

	
?>