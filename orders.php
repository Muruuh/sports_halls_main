<!DOCTYPE html>
<?php
	include('server.php');
	if (!isLoggedIn()) {
		header('location: login.php');
	}
 ?>
 <?php
 if(isset($_GET['id'])){
	$id=$_GET['id'];
	mysqli_query($db, 	"UPDATE `zaal_days` SET `zday_type` = 'not' WHERE (`zday_id` = '$id');");
	$rand = rand_text(10);
	mysqli_query($db, 	"INSERT INTO orders (`order_id`, `order_user`, `order_date`, `order_zaal_id`, `orderscol`) VALUES ('$rand', '$user_id', '$time', '$id', '');");
	header('location: ./orders.php');
}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Нүүр</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css">
		<style media="screen">
		</style>
  </head>
	<body>
	<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
			<?php if(isset($user_id)){ ?>
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white"><?php print_r($_SESSION['user']['user_name']); ?></h4>
          <p class="text-muted"><?php print_r($_SESSION['user']['user_email']); ?></p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Цэс</h4>
          <ul class="list-unstyled">
            <li><a href="./orders.php" class="text-white">Захиалга ууд</a></li>
						<?php if(isAdmin()){ ?>
							<li><a href="./admin.php" class="text-white">Админ</a></li>
						<?php } ?>
						<li><a href="?logout" class="text-white">Гарах</a></li>
          </ul>
        </div>
      </div>
		<?php }else{ ?>
			<div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">Заал түрээс</h4>
          <p class="text-muted">Нэвтэрээд захиалаарай</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Цэс</h4>
          <ul class="list-unstyled">
            <li><a href="./login.php" class="text-white">Нэвтрэх</a></li>
						<li><a href="./register.php" class="text-white">Бүртгүүлэх</a></li>
          </ul>
        </div>
      </div>
  	<?php } ?>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="./" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
        <strong>Заал</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
	</header>
	<main>
  <section class="py-5 text-center container">
		<h1>Захиалга</h1>
		<div class="container col-11">
			<table class="table table-bordered border-primary">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Өдөр</th>
						<th scope="col">Цаг</th>
						<th scope="col">Хана</th>
						<th scope="col">Төлсөн</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$response = mysqli_query($db, "SELECT * FROM zaal.orders
JOIN zaal_days ON zaal_days.zday_id = orders.order_zaal_id
JOIN zaal ON zaal_days.zaal_id = zaal.zaal_id
where orders.order_user = '$user_id'");
						while ($row = mysqli_fetch_array($response)) {
					?>
					<tr>
						<th scope="row"><?php echo $row['zday_id']; ?></th>
						<td><?php echo $row['zday_day']; ?></td>
						<td><?php echo $row['zday_hour']; ?></td>
						<td><?php echo (zaal_location($row['zaal_khoroo'])['city_name']); ?> / <?php echo (zaal_location($row['zaal_khoroo'])['district_name']); ?> / <?php echo (zaal_location($row['zaal_khoroo'])['khoroo_name']); ?></td>
						<td><?php echo $row['order_date']; ?></td>
					</tr>
					<?php }	?>
				</tbody>
			</table>
		</div>
  </section>
	</main>
	</body>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</html>
