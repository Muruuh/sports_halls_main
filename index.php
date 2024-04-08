<!DOCTYPE html>
<?php
	include('server.php');
	// if (!isLoggedIn()) {
	// 	header('location: login.php');
	// }
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
  </head>
	<body style="background-image: url('https://www.buzznews.mn/upload/images/thumb/buzzpgimg_620d92e6cedb1.jpg'); background-repeat: no-repeat; background-size: 100%; ">
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
      <a href="#" class="navbar-brand d-flex align-items-center">
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
  <section class="py-5 text-center container " >
    <div class="row py-lg-5 ">
      <div class="col-lg-6 col-md-8 mx-auto card p-5 ">
        <!-- <h1 class="fw-light"></h1>
        <p class="lead text-muted"></p> -->
				<div class="row g-3">
				  <div class="col">
						<select class="form-select" id="city">
					   <option value="null" selected>--Хотоо сонгоно уу--</option>
						 <?php
							 $response = mysqli_query($db, "SELECT * FROM city order by city_name");
							 while ($row = mysqli_fetch_array($response)) {
						 ?>
										 <option value="<?php echo $row['city_code']; ?>"><?php echo $row['city_name']; ?></option>
						 <?php }	?>
					 </select>
				  </div>
				  <div class="col">
						<select class="form-select" id="district" >
						  <option value="null" selected>--Дүүрэг--</option>
						</select>
				  </div>
					<div class="col">
						<select class="form-select" id="khoroo" >
						  <option value="null" selected>--Баг/хороо--</option>
						</select>
				  </div>
				</div>
				<div class="row g-3">
					<div class="pt-2">
					  <input type="text" class="form-control" id="search_text" placeholder="Хайх...">
					</div>
				</div>
      </div>
    </div>
  </section>
  <div class="album py-5 " >
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="zaals">
     </div>
    </div>
  </div>
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
	</script>
</html>
