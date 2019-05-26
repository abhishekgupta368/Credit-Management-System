<?php

function transfer_money($from_amt,$to_amt,$pay_amt)
{
  require 'db_info.php';
  // $from_amt = $_POST['from'];
  // $to_amt = $_POST['to'];
  // $pay_amt = $_POST['amt'];
  $msg = "";
  $sql_to = "SELECT * FROM credits WHERE name= '$to_amt'";
  $sql_from = "SELECT * FROM credits WHERE name='$from_amt'";

  $res_to =mysqli_query($conn, $sql_to);
  $res_from =mysqli_query($conn,$sql_from);
  $a = "";
  $b = "";
  $name_a = "";
  $name_b = "";
  $flag=1;
  if($res_to && $res_from){
    while ($row2 = mysqli_fetch_array($res_from)) {
      $b=(int)$row2['credit'];
      $name_b=$row2['name'];
      if($b<$pay_amt){
        $msg='Insufficent amount in account';
        $flag=0;
      }
    }
    while ($row1 = mysqli_fetch_array($res_to)) {
      $a=(int)$row1['credit'];
      $name_a=$row1['name'];
    }
  }
  if($name_a != $name_b){
    if($flag==1){
      $val1 = $a+$pay_amt;
      $sql_update_cred_a = "UPDATE credits SET credit= '$val1'  WHERE name= '$name_a'";

      $val2 = $b-$pay_amt;
      $sql_update_cred_b = "UPDATE credits SET credit= '$val2'  WHERE name= '$name_b'";

      $r1 = mysqli_query($conn,$sql_update_cred_a);
      $r2 = mysqli_query($conn,$sql_update_cred_b);

      if($r1&&$r2){
        $msg = $pay_amt.' credits are transfered from '.$name_b.' to '.$name_a;
      }
      else{
        $msg="Something went worang";
      }
    }
  }
  else{
    $msg="can\"t transfer credit, name of both column are same";
  }
  return $msg;
}
 ?>
