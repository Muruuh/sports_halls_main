<!DOCTYPE html>
<?php
	include('server.php');
	if (isLoggedIn()) {
		header('location: index.php');
	}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Бүртгүүлэх</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 		 <style media="screen">
 		 .field-icon {
 				float: right;
 				margin-left: -35px;
 				margin-top: -35px;
 				margin-right: 10px;
 				position: relative;
 				z-index: 2;
 			}
 		 </style>
  </head>
  <body>
    <div class="container">
      <div class="row ">
				<div class="col-xl-3">
				</div>
				<div class="col-xl-6 mt-5 card p-3">
					<form class="" id="form">
						<div class="mb-3 text-center">
							<label for="exampleInputEmail1" class="form-label h3">Бүртгүүлэх</label>
						</div>
						<div class="mb-3">
							<label class="form-label">Нэр</label>
							<input type="text" id="username" name="username"  class="form-control"placeholder="Болд****" >
						</div>
						<div class="mb-3">
							<label class="form-label">Цахим хаяг</label>
							<input type="email" id="email" name="email"  class="form-control"placeholder="your_email@gmail.com" >
						</div>
						<div class="mb-3">
							<label class="form-label">Холбоо барих дугаар</label>
							<input type="number" id="phone" name="phone"  class="form-control"placeholder="9911****" >
						</div>
						<div class="mb-3">
							<label class="form-label">Нууц үг</label>
							<input type="password" id="password" name="password"  class="form-control" placeholder="Ab12345678">
							<div class="" id="cheke_console" style=" display: none;">
								<div id="check0">
									<i class="far fa-check-circle"></i>  <span> Урт нь 5-аас их.</span>
								</div>
								<div id="check1">
									<i class="far fa-check-circle"></i>  <span> Урт нь 15-аас бага.</span>
								</div>
								<div id="check2">
									<i class="far fa-check-circle"></i>  <span> Тоон тэмдэгт агуулдаг.</span>
								</div>
								<div id="check3">
									<i class="far fa-check-circle"></i>   <span>Тусгай тэмдэгт агуулдаг.</span>
								</div>
								<div id="check4">
									<i class="far fa-check-circle"></i>  <span>Хоосон байж болохгүй.</span>
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Нууц үг давтаж</label>
							<input type="password" id="c_password"  class="form-control" placeholder="Ab12345678">
							<span id="c_password_error" class="text-danger"></span>
						</div>
						<div class="mb-3 ">
							<label class="form-check-label" for="exampleCheck1"> <a href="login.php">Нэвтрэх</a> </label>
						</div>
						<button type="submit" id="submitBtn"  class="btn btn-success">Бүртгүүлэх</button>
					</form>
				</div>
				<div class="col-xl-3">
				</div>
      </div>
    </div>
  </body>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script type="text/javascript">
	$('#submitBtn').prop('disabled', true);
	function alert_center(utga,type,url){
	  Swal.fire({
	            text: utga,
	            icon: type,
	            buttonsStyling: false,
	    confirmButtonText: "Ойлголоо!",
	    customClass: {
	      confirmButton: "btn font-weight-bold btn-light-primary"
	    }
	        }).then(function() {
	          if(url!=null){
	            location.href = url;
	          }
	    KTUtil.scrollTop();
	  });
	}
	var pass_cheke =false;
	var c_pass_cheke =false;
	$( "#password" ).keyup( function() {
		if($(this).val()===''){
			$("#cheke_console").hide();
		}else{
			$("#cheke_console").show();
		}
		var s1 = false;
		var s2 = false;
		var s3 = false;
		var s4 = false;
		var s5 = false;
		var s6 = false;
		var input = $( this ).val();
		if(input.length>=5){ s1 =true; $("#check0").css("color", "green");
		}else{ s1 =false; $("#check0").css("color", "tomato");}

			if(input.length<=15){s2 =true; $("#check1").css("color", "green");
		}  else{ s2 =false; $("#check1").css("color", "tomato");}

			if(input.match(/[0-9]/i)){s3 =true; $("#check2").css("color", "green");
		}else{  s3 =false;  $("#check2").css("color", "tomato");  }

			if(input.match(/[^A-Za-z0-9-' ']/i)){  s4 =true; $("#check3").css("color", "green");
		}  else{ s4 =false; $("#check3").css("color", "tomato"); }

			if(!input.match(' '))  {     s5 =true;  $("#check4").css("color", "green");
		}else{  s5 =false;   $("#check4").css("color", "tomato");};
		if(s1 && s2 && s3 && s4 && s5){
			$("#cheke_console").hide();
			pass_cheke = true;
			$("#password").removeClass('is-invalid');
			$("#password").addClass('is-valid');
		} else{
			pass_cheke = false;
			$("#password").removeClass('is-valid');
			$("#password").addClass('is-invalid');
		}
		});
	$( "#c_password" ).on('input', function() {
		var input1 = $( "#c_password" ).val();
		var input2 = $( "#password" ).val();
		if(input1 === input2){
			c_pass_cheke =true;
			$("#c_password_error").text("");
			$("#c_password").removeClass('is-invalid');
			$("#c_password").addClass('is-valid');
		}else{
			$("#c_password_error").text("Нууц үгээ дахиж оруулна уу.");
			$("#c_password").removeClass('is-valid');
			$("#c_password").addClass('is-invalid');
			c_pass_cheke =false;
		}
	});
	$('#email').keyup(function(){
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test($(this).val())) {
			$(this).removeClass('is-valid');
			$(this).addClass('is-invalid');
			$('#submitBtn').prop('disabled', true);
		}else{
			$(this).removeClass('is-invalid');
			$(this).addClass('is-valid');
			$('#submitBtn').prop('disabled', false);
		}

	});
	$('#username').keyup(function(){
		if($(this).val()==='') {
			$(this).removeClass('is-valid');
			$(this).addClass('is-invalid');
		}else{
			$(this).removeClass('is-invalid');
			$(this).addClass('is-valid');
		}
	});
	$("#form").on('submit', function(e){
		 e.preventDefault();
		if($("#username").val() != '' && $("#email").val() !='' && pass_cheke && c_pass_cheke){
			$.ajax({
					type: 'POST',
					url: 'api/?register',
					data: new FormData(this),
					dataType: 'json',
					contentType: false,
					cache: false,
					processData:false,
					beforeSend: function(){
						$('#submitBtn').html('<span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> Түр хүлээнэ үү');
					  $('#submitBtn').prop('disabled', true);
						$('#form').css("opacity",".5");
					},
					success: function(response){
						$('#submitBtn').prop('disabled', false);
						$('#submitBtn').text('Бүртгүүлэх');
						$('#form').css("opacity","");
						if(response.success){
							alert_center("Бүргэл үүслээ","success",response.callback);
						}else{
							alert_center(response.error,"warning");
						}
					}
			});
		} else{
			 alert_center("Та зарим зүйлсийг орхигдуулсан байна","warning");
		}
	});
	</script>
</html>
