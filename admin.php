<!DOCTYPE html>
<?php
	include('server.php');
	if (!isAdmin()) {
		header('location: login.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style.css">
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
            <li><a href="#" class="text-white">Захиалга ууд</a></li>
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
      <a href="./index.php" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
        <strong>Нүүр</strong>
      </a>
			<a href="#" class="navbar-brand d-flex align-items-center">
					<strong>Admin</strong>
			</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
	</header>
	<main>
    <section class="py-5  container">
		<ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
	  <li class="nav-item" role="presentation">
	    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Заалууд</button>
	  </li>
	  <li class="nav-item" role="presentation">
	    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Заал нэмэх</button>
	  </li>
	  <li class="nav-item" role="presentation">
	    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Захиалга ууд</button>
	  </li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
			<table class="table table-bordered border-primar">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Нэр</th>
      <th scope="col">Хаяг</th>
      <th scope="col">Үйлдэл</th>
    </tr>
  </thead>
  <tbody>
		<?php
			$response = mysqli_query($db, "SELECT * FROM  zaal ");
			while ($row = mysqli_fetch_array($response)) {
		?>
		<tr>
      <th scope="row"><?php echo $row['zaal_id']; ?></th>
      <td><?php echo $row['zaal_name']; ?></td>
      <td><?php echo (zaal_location($row['zaal_khoroo'])['city_name']); ?> / <?php echo (zaal_location($row['zaal_khoroo'])['district_name']); ?> / <?php echo (zaal_location($row['zaal_khoroo'])['khoroo_name']); ?></td>
      <td class="text-center">
				<a href="./edit.php?id=<?php echo $row['zaal_id']; ?>"><img src="https://img.icons8.com/nolan/64/edit--v1.png" width="30"/></a>
				<a href="?delete_zaal=<?php echo $row['zaal_id']; ?>"><img src="https://img.icons8.com/dusk/64/000000/filled-trash.png" width="30"/></a>
			</td>
    </tr>
		<?php }	?>
  </tbody>
</table>
		</div>
	  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
			<form class="row g-3" action="api/insert.php"  method="post"  enctype="multipart/form-data">
				<div class="col-12">
			    <label for="inputAddress" class="form-label">Заалны нэр</label>
			    <input type="text" class="form-control" name="zaal_name"  placeholder="Заалны нэр" id="zaal_name_in">
			  </div>
			  <div class="col-4">
			    <label for="inputEmail4" class="form-label">Хотоо сонгоно уу</label>
					<select class="form-select" id="city" name="zaal_city">
					 <option value="null" selected>--Хотоо сонгоно уу--</option>
					 <?php
						 $response = mysqli_query($db, "SELECT * FROM city order by city_name");
						 while ($row = mysqli_fetch_array($response)) {
					 ?>
									 <option value="<?php echo $row['city_code']; ?>"><?php echo $row['city_name']; ?></option>
					 <?php }	?>
				 </select>
			  </div>
			  <div class="col-4">
			    <label for="inputPassword4" class="form-label">Дүүрэг</label>
					<select class="form-select" id="district" name="zaal_district">
						<option value="null" selected>--Дүүрэг--</option>
					</select>
			  </div>
				<div class="col-4">
			    <label for="inputPassword4" class="form-label">Баг/хороо</label>
					<select class="form-select" id="khoroo"  name="zaal_khoroo">
						<option value="null" selected>--Баг/хороо--</option>
					</select>
			  </div>
			  <div class="col-6">
			    <label for="inputCity" class="form-label">Зураг</label>
			    <input type="file" class="form-control" name="zaal_image" id="imageFile_img">
			  </div>
			  <div class="col-6">
			    <label for="inputZip" class="form-label">Youtube video id</label>
			    <input type="text" class="form-control" name="zaal_video" id="imageFile" >
			  </div>
			  <div class="col-12">
			    <button type="submit" class="btn btn-primary ">Оруулах</button>
			  </div>
			</form>
			<div class="row ">
				<div class="col-3">

				</div>
				<div class="col-6">
					<div class="card shadow-sm">
						<img src="" alt="" class="bd-placeholder-img card-img-top" width="100%" height="225" id="preview_img">
						<div class="card-body">
							<div class="text-center">
								<p class="card-text" id="zaal_name"></p>
									<iframe width="420" height="315" class=" mt-4 mb-4 " src="https://www.youtube.com/embed/" id="preview"></iframe>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3">

				</div>
			</div>
		</div>
	  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
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
			JOIN zaal ON zaal_days.zaal_id = zaal.zaal_id ");
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
	  <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
	</div>
	  </section>
	</main>
	</body>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script type="text/javascript">
	$.ajax
	({
		type: "POST",
		url: "modal/get_zaals.php",
		cache: false,
		success: function(html)
		{
			$("#zaals").html(html);
		}
	});
	$("#city").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
		$.ajax
		({
			type: "POST",
			url: "modal/get_district.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#district").html('<option value="null" selected>--Дүүрэг--</option>'+html);
				$("#khoroo").html('<option value="null" selected>--Баг/хороо--</option>');
				zaal_filter();
			}
		});
	});
	$("#district").change(function()
	{
		var id=$(this).val();
		var id2=$("#city").val();
		var dataString = 'khoroo_parent='+ id+"&"+"khoroo_grand_parent="+id2;
		$.ajax
		({
			type: "POST",
			url: "modal/get_khoroo.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#khoroo").html('<option value="null" selected>--Баг/хороо--</option>'+html);
				zaal_filter();
			}
		});
	});
	$("#khoroo").change(function()
	{
		zaal_filter();
	});
	$('#search_text').keyup(function(){
			if($(this).val()!=''){
				var dataString = 'text='+$(this).val();
				$.ajax
				({
					type: "POST",
					url: "modal/get_zaals.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#zaals").html(html);
					}
				});
			}else{
				$.ajax
				({
					type: "POST",
					url: "modal/get_zaals.php",
					cache: false,
					success: function(html)
					{
						$("#zaals").html(html);
					}
				});
			}
	});
	$('#zaal_name_in').keyup(function(){
			$('#zaal_name').text($(this).val());
	});
	function zaal_filter(){
		var city=$("#city").val();
		var district=$("#district").val();
		var khoroo=$("#khoroo").val();
		var text = $('#search_text').val();
		var dataString = 'city='+ city+"&"+"district="+district+"&"+"khoroo="+khoroo;
		$.ajax
		({
			type: "POST",
			url: "modal/get_zaals.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#zaals").html(html);
			}
		});
	}
	$( '#imageFile' ).keyup(function() {
			$('#preview').attr('src','https://www.youtube.com/embed/'+$(this).val());
	});
	$('#imageFile_img').change(function(evt) {
			var files = evt.target.files;
			var file = files[0];
			if (file) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#preview_img').attr('src',e.target.result)
					};
					reader.readAsDataURL(file);
			}
	});
	</script>
</html>
