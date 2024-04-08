<?php
  include('../server.php');
  $inputJSON = file_get_contents('php://input');
	$input = json_decode($inputJSON, TRUE);
  if(count($_POST)==0){
    $_POST = $input;
  }
  if(isset($_GET['login'])){
    login($_POST['email'],$_POST['password']);
  }
  if(isset($_GET['register'])){
    register($_POST['email'],$_POST['username'],$_POST['password'],$_POST['phone']);
  }
  function login($email_in,$password_in){
    global $db;
    $email =  strtolower(@$email_in);
    $password = md5(@$password_in);
    $success= false;
    $errors   = array();
    $callback='';
    $query = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);
		if (@mysqli_num_rows(@$results) == 1){
      $success= true;
      $logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_role'] != 'user') {
				$_SESSION['user'] = $logged_in_user;
        $callback='admin.php';
			}else{
				$_SESSION['user'] = $logged_in_user;
        $callback='index.php';
			}
    }else {
			array_push($errors, "Хэрэглэгчийн нэр / нууц үгийн хослол буруу");
		}
    $back = array(
      'success' => $success ,
      'error' => $errors ,
      'callback' => $callback ,
    );
     echo json_encode($back);
  }
  function register($email_in,$username_in,$password_in,$phone){
    global $db,$time;
    $email = strtolower(@$email_in);
    $username = @$username_in;
    $password = md5(@$password_in);
    $success= false;
    $errors   = array();
    $callback='';
    $query = "SELECT * FROM users WHERE user_email='$email'  LIMIT 1";
		$results = mysqli_query($db, $query);
		if (@mysqli_num_rows(@$results) != 1){
      $success= true;
      $id=rand_text(10);
      $query_q = "INSERT INTO users (user_id,user_name, user_email, user_role, user_password,user_created_date,user_phone) VALUES('$id','$username', '$email', 'user', '$password','$time','$phone')";
      mysqli_query($db, $query_q);
      $callback='login.php';
    }else {
			array_push($errors, "Цахим хаяг аль хэдийн бүртгэлтэй байна");
		}
    $back = array(
      'success' => $success ,
      'error' => $errors ,
      'callback' => $callback ,
    );
     echo json_encode($back);
  }

 ?>
