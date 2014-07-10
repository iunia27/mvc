<?php
	include_once 'ITest.php';
	
	class Test2 implements ITest{
		function show(){
			return 'show';
		}
		
		function hide(){
			return 'hide';
		}
	}
?>