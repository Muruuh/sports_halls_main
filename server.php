<?php
  include('db.php');
  function isLoggedIn()
  {
    if (isset($_SESSION['user'])) {
      return true;
    }else{
      return false;
    }
  }

  function isAdmin()
  {
    if (isset($_SESSION['user']) && $_SESSION['user']['user_role'] == 'admin' || isset($_SESSION['user']) && $_SESSION['user']['user_role'] == 'god' ) {
      return true;
    }else{
      return false;
    }
  }
  function isGOD()
  {
    if (isset($_SESSION['user']) && $_SESSION['user']['user_role'] == 'god' ) {
      return true;
    }else{
      return false;
    }
  }
  function rand_number($length) {
			return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
	}
  function rand_text($length) {
			return substr(str_shuffle(str_repeat($x='0123456789QWERTYUIOPLKJHGFDSAZXCVBNM', ceil($length/strlen($x)) )),1,$length);
	}
  function zaal_location($id) {
    global $db;
    $query = "SELECT khoroo.khoroo_name,city.city_name,district.district_name FROM khoroo
              JOIN city ON khoroo.khoroo_grand_parent = city.city_code
              JOIN district ON khoroo.khoroo_parent = district.district_code and city.city_code = district.district_parent
              where khoroo.khoroo_id='$id'";
    $results = mysqli_query($db, $query);
    return mysqli_fetch_assoc($results);
	}
  if(isset($_GET['delete_zaal'])){
    $delete_zaal=$_GET['delete_zaal'];
    $results = mysqli_query($db, "DELETE FROM `zaal` WHERE (`zaal_id` = '$delete_zaal')");
  }
?>
