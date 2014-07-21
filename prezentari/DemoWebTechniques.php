<?php
	/*Server info demo
	*
	echo '<p>Server Information list of entries</p>';
	foreach($_SERVER as $key => $value){
		echo "Entry key: $key, Entry value: $value <br/><br/>";
	}
	*/

	
	/*processing form using self processing page.
	*
	if (isset($_POST['submit'])){
		$name = $_POST['username'];
		echo "The form was been processed for $name, applying self process method.";		
	}
	*/
	
	/*processing form using self processing page.
	*/
	if (isset($_POST['submit'])){
		if (is_uploaded_file($_FILES['filetoprocess']['tmp_name'])) {
			$test = $_FILES["filetoprocess"]["name"];;
			move_uploaded_file($_FILES['filetoprocess']['tmp_name'], "C:/wamp/www/MVCRamp-upProject/prezentari/{$test}");
			echo "The file has been successfully moved!";
		}		
	}
	
?>

<!--<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post"> 
<form action="FormProcessParameters.php" method="post">
	<fieldset>
		<p>
			<span> Please enter your name: </span>
			<input type="text" placeholder = "Write your name here" name = "username"/>
		</p>
	</fieldset>
	<input type="submit" value="Submit" name="submit"/>

</form> -->

<!--<form action = "<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype = "multipart/form-data">
	<fieldset>
		<input type = "file" name = "filetoprocess" />
	</fieldset>
	<input type = "submit" value = "Submit" name = "submit" />
</form> -->











