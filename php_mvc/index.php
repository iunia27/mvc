<?php
	include_once './System/Controllers/FrontController.php';
	
	//the entry point in the application
	$frontController = FrontController :: getInstance();
	$frontController -> run();
?>
