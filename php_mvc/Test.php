<?php
	include_once 'ITest.php';
	
	class Test implements ITest{
		function show(){
			return 'show';
		}
		
		function hide(){
			return 'hide';
		}
	}
?>