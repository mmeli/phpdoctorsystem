<?php
session_start();
include 'model/database.php';
require_once "model/supplements.php";
$database = new Database();
$db = $database->connect();
$supplements = new Supplements($db);

//get form data
$supplement_id  = $_POST['item_description'];
$quantity       = $_POST['item_quantity'];
$date           = $_POST['item_date'];
$today = date("Y-m-d");
$id = $supplements->last_inserted_id();
$prefix = substr($id,0,3);
$num = substr($id,3)+1;
$invNum = $prefix.$num;

$supplements->invoice($invNum,$_SESSION['client_ID'],$today);
for($count = 0; $count < count($supplement_id); $count++){
   if(isset($_SESSION['client_ID'])){
      $supplements->minus_item($supplement_id[$count],$quantity[$count]);
      $supplements->add_to_cart($_SESSION['client_ID'],$supplement_id[$count],$quantity[$count],$date[$count] );
      
   }else{
      echo '<script>window.location="signin.php"</script>';
   }
   $supplements->invoice_item($invNum,$supplement_id[$count],$supplements->get_price($supplement_id[$count]),$quantity[$count]);
     
}





?>