<!DOCTYPE html>
<?php include('server.php'); ?>
<?php
   if (isLoggedIn()) {
   	header('location: ./index.php');
   }
   ?>
   <!DOCTYPE html>
   <html lang="en" dir="ltr">
     <head>
       <meta charset="utf-8" />
       <title>Нэвтрэх</title>
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
         <div class="row">
           <div class="col-xl-3"></div>
           <div class="col-xl-6 mt-5 card p-3">
             <form class="" id="form">
               <div class="mb-3 text-center">
                 <label for="exampleInputEmail1" class="form-label h3"
                   >Нэвтрэх</label
                 >
               </div>
               <div class="mb-3">
                 <label class="form-label">Цахим хаяг</label>
                 <input
                   type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   placeholder="your_email@gmail.com"
                 />
               </div>
               <div class="mb-3">
                 <label class="form-label">Нууц үг</label>
                 <input
                   type="password"
                   id="password"
                   name="password"
                   class="form-control"
                   placeholder="Ab12345678"
                 />
                 <span id="change_type" class="field-icon"><img src="https://www.svgrepo.com/show/309610/eye-show.svg" alt="" id="change_img" width="20"></span>
               </div>
               <div class="mb-3">
                 <label class="form-check-label" for="exampleCheck1">
                   <a href="register.php">Бүртгүүлэх</a>
                 </label>
               </div>
               <button type="submit" name="login" id="submitBtn" class="btn btn-success">
                 Нэвтрэх
               </button>
               <?php if(!isset($_SESSION['access_token'])){ ?>
                <button type="button" class="btn btn-outline-primary mt-4 mb-4 btn-block fb_login">
                <i class="ri-facebook-circle-line"></i>
                  Facebook ээр үргэлжилүүлэх
                </button>
               <?php } ?>
             </form>
           </div>
           <div class="col-xl-3"></div>
         </div>
       </div>
     </body>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <script type="text/javascript">
     $('.fb_login').click(function() {

      });
    $('.fb_logout').click(function() {
      var new_window = window.open('logout.php', 'facebook-popup', 'height=350,width=600')
      var timer = setInterval(function() {
          if(new_window.closed) {
            location.reload()
              clearInterval(timer);
          }
      }, 1000);
    });
       $("#submitBtn").prop("disabled", true);
       $("#change_type").click(function() {
         if($("#password").attr('type')=="password"){
           $('#change_img').attr('src', 'https://www.svgrepo.com/show/309609/eye-hide.svg');
           $("#password").attr('type','text');
         }else{
           $('#change_img').attr('src', 'https://www.svgrepo.com/show/309610/eye-show.svg');
           $("#password").attr('type','password');
         }
       });
       function alert_center(utga, type, url) {
         Swal.fire({
           text: utga,
           icon: type,
           buttonsStyling: false,
           confirmButtonText: "Ойлголоо!",
           customClass: {
             confirmButton: "btn font-weight-bold btn-light-primary",
           },
         }).then(function () {
           if (url != null) {
             location.href = url;
           }
           KTUtil.scrollTop();
         });
       }
       // $("#password").keyup(function () {
       //   if ($(this).val() === "") {
       //     $(this).removeClass("is-valid");
       //     $(this).addClass("is-invalid");
       //   } else {
       //     $(this).removeClass("is-invalid");
       //     $(this).addClass("is-valid");
       //   }
       // });
       $("#email").keyup(function () {
         var regex =
           /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
         if (!regex.test($(this).val())) {
           $(this).removeClass("is-valid");
           $(this).addClass("is-invalid");
           $("#submitBtn").prop("disabled", true);
         } else {
           $(this).removeClass("is-invalid");
           $(this).addClass("is-valid");
           $("#submitBtn").prop("disabled", false);
         }
       });
       $("#form").on("submit", function (e) {
         e.preventDefault();
         $.ajax({
           type: "POST",
           url: "api/?login",
           data: new FormData(this),
           dataType: "json",
           contentType: false,
           cache: false,
           processData: false,
           beforeSend: function () {
             $("#submitBtn").html(
               '<span class="spinner-border spinner-border-sm pr-1" role="status" aria-hidden="true"></span> Түр хүлээнэ үү'
             );
             $("#submitBtn").prop("disabled", true);
             $("#form").css("opacity", ".5");
           },
           success: function (response) {
             $("#submitBtn").prop("disabled", false);
             $("#submitBtn").text("Нэвтрэх");
             $("#form").css("opacity", "");
             if (response.success) {
               alert_center("Нэвтэрлээ", "success", response.callback);
             } else {
               alert_center(response.error, "warning");
             }
           },
         });
       });
     </script>
   </html>
</script>
   </html>
