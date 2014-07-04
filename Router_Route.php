<?php
	include_once 'Route.php';
	class RouterRoute{
		public function __construct(){}
		
		public function getURLParams($url){
			if (isset($url)){
				return new Route('testC', 'testA', new array('test', 1));
			}
		}
	}
?>