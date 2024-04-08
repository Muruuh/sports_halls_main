<?php
include('../db.php');
if($_POST['id'])
{
$id=$_POST['id'];
$response = mysqli_query($db, "SELECT * FROM district WHERE district_parent=$id order by district_name");
while ($row = mysqli_fetch_array($response)) { ?>
  <option value="<?php echo $row['district_code']; ?>"><?php echo $row['district_name']; ?></option>
<?php }	}?>
