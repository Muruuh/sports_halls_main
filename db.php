<?php
  session_start();
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
  require_once __DIR__.'/vendor/phpmailer/index.php';

 
  $db = mysqli_connect("hostname", "username", "Password", "db_name");
  $db->set_charset("utf8");
  $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  date_default_timezone_set("Asia/Ulaanbaatar");
  $time=(new DateTime())->format("Y-m-d G:i:s");
  $time_short=(new DateTime())->format("Y-m-d");
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
  $host_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header('location: '.$host_url);
  }
  $head_form ='<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">';
    
  if(isset($_SESSION['user'])){
    $user_id =$_SESSION['user']['user_id'];
      $user_SESSION = array(
        'logged' => true,
        'user_data'=>$_SESSION['user'],
       );
    }else {
      $user_SESSION = array(
        'logged' => false,
        'user_data'=>'',
       );
    }
 ?>
