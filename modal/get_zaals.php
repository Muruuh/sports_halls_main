<?php
include('../server.php');
$results = mysqli_query($db, "SELECT * FROM zaal");

if(isset($_POST['text'])){
  $text=$_POST['text'];
  $results = mysqli_query($db, "SELECT * FROM zaal where zaal_name LIKE '%$text%'");
}

if(isset($_POST['city'])){
  $city=$_POST['city'];
  $district=$_POST['district'];
  $khoroo=$_POST['khoroo'];

  if($city=='null'){
    $results = mysqli_query($db, "SELECT * FROM zaal");
  }else{
    if($district=='null'){
      $results = mysqli_query($db, "SELECT * FROM zaal where zaal_city = '$city'");
    }else{
      if($khoroo=='null'){
        $results = mysqli_query($db, "SELECT * FROM zaal where zaal_city = '$city' and zaal_district = '$district'");
      }else{
        $results = mysqli_query($db, "SELECT * FROM zaal where zaal_khoroo  = '$khoroo'");
      }
    }
  }
}

$count = 0;
while ($row = mysqli_fetch_array($results)) {
  $count++;
?>
 <div class="col">
   <a href="./zaal.php?id=<?php echo $row['zaal_id']; ?>">
   <div class="card shadow-sm">
     <img src="<?php echo $row['zaal_image']; ?>" alt="" class="bd-placeholder-img card-img-top" width="100%" height="225">
     <div class="card-body">
       <p class="card-text"><?php echo $row['zaal_name']; ?></p>
       <div class="d-flex justify-content-between align-items-center">
         <div class="btn-group">
           <?php 
             // Check if zaal_location() returns null before accessing array offsets
             $zaal_location = zaal_location($row['zaal_khoroo']);
             if ($zaal_location !== null) {
           ?>
           <button type="button" class="btn btn-sm btn-outline-secondary">
             <?php echo $zaal_location['city_name'] . ' / ' . $zaal_location['district_name'] . ' / ' . $zaal_location['khoroo_name']; ?>
           </button>
           <?php } ?>
         </div>
       </div>
     </div>
   </div>
   </a>
 </div>
<?php } ?>

<?php if($count==0){ ?>
  <div class="col-12 row">
    Илэрц алга
  </div>
<?php } ?>
