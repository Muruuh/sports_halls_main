<?php
  include('../server.php');
  function user_id_rand($length) {
			return substr(str_shuffle(str_repeat($x='0123456789qwertyuiopasdfghjklzxcvbnm', ceil($length/strlen($x)) )),1,$length);
	}
  $inputJSON = file_get_contents('php://input');
	$input = json_decode($inputJSON, TRUE);
  if(count($_POST)==0){
    $_POST = $input;
  }
  if (isset($_POST['zaal_name'])) {
    $rand_id= user_id_rand(10);
		if($_FILES["zaal_image"]['tmp_name']){
			$target_dir = "../uploads/";
			$target_file = $target_dir . basename($_FILES["zaal_image"]["name"]);
			$zaal_image=$host_url."/uploads/" . basename($_FILES["zaal_image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$check = getimagesize($_FILES["zaal_image"]["tmp_name"]);
			move_uploaded_file($_FILES["zaal_image"]["tmp_name"], $target_file);
		}else{
			$zaal_image = '';
		}
		$zaal_name=$_POST['zaal_name'];
		$zaal_city=$_POST['zaal_city'];
		$zaal_district=$_POST['zaal_district'];
		$zaal_khoroo=$_POST['zaal_khoroo'];
    if($zaal_city=='' ||$zaal_district==''||$zaal_khoroo==''||$zaal_image=='' ){
      	header('location: ../admin.php');
    }
	//	$class_about=htmlentities($_POST['zaal_video']);
		$zaal_video=$_POST['zaal_video'];
		$query = "INSERT INTO `zaal` (`zaal_id`, `zaal_name`, `zaal_image`, `zaal_video`, `zaal_user`, `zaal_city`, `zaal_district`, `zaal_khoroo`, `zaal_about`)
    VALUES ('$rand_id', '$zaal_name', '$zaal_image', '$zaal_video', '$user_id', '$zaal_city', '$zaal_district', '$zaal_khoroo', '$zaal_about');";
		if(mysqli_query($db, $query)){
			header('location: ../edit.php?id='.$rand_id);
		}else{
			header('location: ../admin.php');
		}
	}
 ?>
