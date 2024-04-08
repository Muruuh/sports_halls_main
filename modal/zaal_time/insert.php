<?php
include('../../server.php');
$rand_id=rand_text(10);
$sql = "INSERT INTO zaal_days(zday_id,zaal_id,zday_day,zday_amount,zday_hour,zday_created_date,zday_type,zday_user)
 VALUES('$rand_id','".$_POST["zaal_id"]."', '".$_POST["zday_day"]."', '".$_POST["zday_amount"]."', '".$_POST["zday_hour"]."', '$time', 'show','$user_id')";
if(mysqli_query($db, $sql))
{
     echo 'Өгөгдөл оруулсан';
}
 ?>
