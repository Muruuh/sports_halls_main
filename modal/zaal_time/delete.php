<?php
		include('../../server.php');
	$sql = "DELETE FROM zaal_days WHERE zday_id = '".$_POST["id"]."'";
	if(mysqli_query($db, $sql))
	{
		echo 'Өгөгдлийг устгасан';
	}
 ?>
