<?php
include('../db.php');
if($_POST['khoroo_parent'])
{
$khoroo_parent=$_POST['khoroo_parent'];
$khoroo_grand_parent=$_POST['khoroo_grand_parent'];
$response = mysqli_query($db, "SELECT * FROM khoroo where khoroo_grand_parent = $khoroo_grand_parent and khoroo_parent = $khoroo_parent  order by khoroo_name");
while ($row = mysqli_fetch_array($response)) { ?>
  <option value="<?php echo $row['khoroo_id']; ?>"><?php echo $row['khoroo_name']; ?></option>
<?php }	}?>
