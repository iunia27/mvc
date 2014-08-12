<?php

	require_once 'Models/IDBConnector.php';

	class DBConnector implements IDBConnector {
		
		public function __construct(){}
	
		public function show(){
			return 'DBConnector implementation level 2<br/><br/><br/>';
		}
		
		public function hide(){
			return 'hide';
		}
	}
?>