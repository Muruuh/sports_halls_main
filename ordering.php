<!DOCTYPE html>
<?php
	include('server.php');
	// if (!isLoggedIn()) {
	// 	header('location: login.php');
	// }
 ?>
 <?php
 if(isset($_GET['id'])){
	$id=$_GET['id'];
	$results = mysqli_query($db, "SELECT * FROM zaal_days JOIN zaal ON zaal.zaal_id = zaal_days.zaal_id where zaal_days.zday_id = '$id' ");
	$data = mysqli_fetch_assoc( $results);
 }else{
	header('location: ./index.php');
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
		<h1><?php echo $data['zaal_name']; ?></h1>
		<div class="row">
			<div class="col-xl-6">
				<img src="<?php echo $data['zaal_image']; ?>" class="img-fluid rounded img-thumbnail" alt="...">
			</div>
			<div class="col-xl-6">
				<div class="card p-2">
					<table class="table table-bordered border-primary">
						<tbody>
							<tr>
								<th scope="row">Байрлал</th>
								<td><?php echo (zaal_location($data['zaal_khoroo'])['city_name']); ?> / <?php echo (zaal_location($data['zaal_khoroo'])['district_name']); ?> / <?php echo (zaal_location($data['zaal_khoroo'])['khoroo_name']); ?></td>
							</tr>
							<tr>
								<th scope="row">Өдөр</th>
								<td><?php echo $data['zday_day']; ?></td>
							</tr>
							<tr>
								<th scope="row">Цаг</th>
								<td><?php echo $data['zday_hour']; ?></td>
							</tr>
							<tr>
								<th scope="row">Үнэ</th>
								<td><?php echo $data['zday_amount']; ?>₮</td>
							</tr>
						</tbody>
					</table>
					<p>Төлөх</p>
					<ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
					  <li class="nav-item " role="presentation">
					    <button class="nav-link  active btn-" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Дансаар</button>
					  </li>
					  <li class="nav-item " role="presentation">
					    <button class="nav-link " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"
							>Qpay</button>
					  </li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
							<table class="table table-bordered border-primary">
								<tbody>
									<tr>
										<th scope="row">Шилжүүлэх дүн</th>
										<td><?php echo $data['zday_amount']; ?>₮</td>
									</tr>
									<tr>
										<th scope="row">Гүйлгээний утга</th>
										<td><?php echo $data['zday_id']; ?></td>
									</tr>
									<tr>
										<th scope="row">Шилжүүлэх данс/ХААНБАНК</th>
										<td>540000000</td>
									</tr>
								</tbody>
							</table>

						</div>
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
							<div class="row">
								<div class="">
									<img data-v-7378164f="" lazy="eager" src="data:image/png;base64,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">
								</div>
							</div>
								<a  href="orders.php?id=<?php echo $id; ?>" class="btn btn-outline-primary">Төлөлт шалгах</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	</main>
	</body>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</html>
