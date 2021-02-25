<?php
header('Access-Control-Allow-Origin: *');
session_start();
if(empty($_SESSION['client_ID']) ){	
    echo'<script>window.location="../pages/login.php"</script>';
}
//header('Content-Type: application/json');
include_once 'model/database.php';
require_once "model/supplements.php";
require_once "model/invoices.php";
require_once "model/hcp.php";

//instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate clients
$supplements = new Supplements($db);
$all_supplements = $supplements->get_supplements();
$invoices = new Invoices($db);
$hcp = new HCP($db);
$inv_num = $_GET['inv_num'];
$invoice = $invoices->view_invoice($inv_num);



foreach ($invoice as $row) {
    extract($row);
}
$client_details = $invoices->client_info($client_ID);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="icon" href="img/logo2.jpg" type="image/png">
	<title>Althealth|INVOICE</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="vendors/animate-css/animate.css">
	<link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css">
	<!-- main css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
    <style>
           

            .padding {
                padding: 2rem !important
            }

            .card {
                margin-bottom: 30px;
                border: none;
                -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
                box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
            }

            .card-header {
                background-color: #fff;
                border-bottom: 1px solid #e6e6f2
            }

            h3 {
                font-size: 20px
            }

            h5 {
                font-size: 15px;
                line-height: 26px;
                color: #3d405c;
                margin: 0px 0px 15px 0px;
                font-family: 'Circular Std Medium'
            }

            .text-dark {
                color: #3d405c !important
            }
    
    
    </style>
</head>
<body>
<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
<div class="icon float-center"><a href="#" id="print"><i class="fa fa-print" aria-hidden="true"></a></i></div>
     <div class="card">
         <div class="card-header p-4 text-right">
             <div class="float-right">
                 <h3 class="mb-0">Invoice #<?php echo $inv_num ?></h3>
                 Date: <?php echo $inv_date ?>
             </div>
         </div>
         <div class="card-body">
             <div class="row mb-4">
                 <?php
                        $hcp_details = $hcp->select_hcp();
                        foreach($hcp_details as $hd){
                            extract($hd);
                        
                 ?>
                 <div class="col-sm-6">
                     <h5 class="mb-3">From:</h5>
                     <h3 class="text-dark mb-1"><?php echo $name ?></h3>
                     <div>Address: <?php echo $address ?></div>
                     <div>Email: <?php echo $email ?></div>
                     <div>Phone:<?php echo $tel ?></div>
                 </div>

                 <?php } ?>
                 <?php 
                        foreach($client_details as $client){
                            extract($client);
                        
                 ?>
                 <div class="col-sm-6 ">
                     <h5 class="mb-3">To:</h5>
                     <h3 class="text-dark mb-1"><?php echo $c_name ?></h3>
                     <div><?php echo $address ?></div>
                     <div>Email: <?php echo $c_email ?></div>
                     <div>Phone: <?php echo $c_tel_cell ?></div>
                 </div>
             </div>
             <?php } ?>
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th class="center">#</th>
                             <th>Item</th>
                             <th>Description</th>
                             <th class="right">Price</th>
                             <th class="center">Qty</th>
                             <th class="right">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                         
                            <?php $price = 0; $totalPrice = 0; $item = 1; ?>
                            <?php foreach($invoice as $items): extract($items);  ?>
                            
                            <tr>
                            <td class="left"><?php echo $item ?></td>
                                <td class="left"><?php echo $supplements->get_description($supplement_id) ?></td>
                                <td class="left"><?php echo $supplements->get_description($supplement_id) ?></td>
                                <td class="right"><?php echo "R ".$item_price  ?></td>
                                <td class="center"><?php echo $item_quantity ?></td>
                                <td class="right"><?php echo "R ".number_format(($item_price * $item_quantity),2) ?></td>
                            </tr>
                            <?php $item = $item + 1; ?>
                            <?php $totalPrice+=($item_price * $item_quantity); endforeach; ?>    
                         
                         
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-5">
                 </div>
                 <div class="col-lg-4 col-sm-5 ml-auto">
                     <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Subtotal</strong>
                                 </td>
                                 <td class="right"><?php echo "R ".number_format($totalPrice,2) ?></td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Discount (0%)</strong>
                                 </td>
                                 <td class="right">-</td>
                             </tr>
                             
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark"><?php echo "R".number_format($totalPrice,2) ?></strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="card-footer bg-white">
             <p class="mb-0"><span id="hcp_email"></span>, <span id="hcp_address"></span></p>
         </div>
     </div>
 </div>
</body>
</html>
<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
	<script src="js/mail-script.js"></script>
	<script src="js/custom.js"></script>
	<script src="api/hcp.js"></script>

    <script>
    $(document).ready(function(){
        $(document).on("click","#print", function(){
            window.print();
        });
    });
    </script>