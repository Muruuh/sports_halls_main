<?php
include('../../server.php');
 $output = '';
 $zaal_id = $_POST["zaal_id"];
 $sql = "SELECT * FROM zaal_days where zday_day>='$time_short' and zaal_id='$zaal_id' ORDER BY zday_day DESC";
 $result = mysqli_query($db, $sql);
 $output .= '
      <div class="table-responsive">
           <table class="table table-bordered">
                <tr>
                     <th width="10%">Өдөр</th>
                     <th width="40%">Цаг</th>
                     <th width="40%">Үнэ</th>
                     <th width="10%">Delete</th>
                </tr>';
 $rows = mysqli_num_rows($result);
 if($rows > 0)
 {
      while($row = mysqli_fetch_array($result))
      {
           $output .= '
                <tr>
                     <td class="zday_day" data-id="'.$row["zday_id"].'" contenteditable>'.$row["zday_day"].'</td>
                     <td class="zday_hour" data-id="'.$row["zday_id"].'" contenteditable>'.$row["zday_hour"].'</td>
                     <td class="zday_amount" data-id="'.$row["zday_id"].'" contenteditable>'.$row["zday_amount"].'</td>
                     <td><button type="button" name="delete_btn" data-id="'.$row["zday_id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>
                </tr>
           ';
      }
      $output .= '
      <tr>
           <td  ><input name="date" type="date" id="zday_day"/></td>
           <td id="zday_hour" contenteditable></td>
           <td id="zday_amount" contenteditable></td>
           <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
      </tr>
      ';
 }
 else
 {
      $output .= '
      <tr>
           <td  ><input name="date" type="date" id="zday_day"/></td>
           <td id="zday_hour" contenteditable></td>
           <td id="zday_amount" contenteditable></td>
           <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
      </tr>';
 }
 $output .= '</table>
      </div>';
 echo $output;
 ?>
