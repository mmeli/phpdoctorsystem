<?php
session_start();
if(empty($_SESSION['client_ID']) ){	
	echo'<script>window.location="signin.php"</script>';
	//echo '<script>alert("Opps no sessions")</script>';
}


//header('Content-Type: application/json');
include_once 'model/database.php';
//include_once '../model/clients.php';
require_once "model/supplements.php";

//instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate clients
$supplement_obj = new Supplements($db);
$supplements = $supplement_obj->get_supplements();




?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/logo2.jpg" type="image/png">
	<title>Althealth|supplements</title>
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
</head>

<body>

	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="top_menu row m0">
			<div class="container">
				<div class="float-left">
					<ul class="left_side">
						<li>
							<a href="login.html">
								<i class="fa fa-facebook-f"></i>
							</a>
						</li>
						<li>
							<a href="login.html">
								<i class="fa fa-twitter"></i>
							</a>
						</li>
						<li>
							<a href="login.html">
								<i class="fa fa-dribbble"></i>
							</a>
						</li>
						<li>
							<a href="login.html">
								<i class="fa fa-behance"></i>
							</a>
						</li>
					</ul>
				</div>
				<div class="float-right">
					<ul class="right_side">
						<li>
							<a href="login.html">
								<i class="lnr lnr-phone-handset"></i>
								<span id="hcp_tel"></span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="lnr lnr-envelope"></i>
								<span id="hcp_email"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html">
						<img src="img/logo2.jpg" alt="" height="100px" width="100px">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					 aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
					<div class="row ml-0 w-100">
							<div class="col-lg-12 pr-0">
								<ul class="nav navbar-nav center_nav pull-right">
									<li class="nav-item active">
										<a class="nav-link" href="#">Home</a>
									</li>
									
									<li class="nav-item">
										<a class="nav-link" href="invoices.php">Invoices</a>
									</li>
									
									<li class="nav-item">
										<a class="nav-link" href="#">Contact</a>
										&nbsp;&nbsp;&nbsp;
										<a href="controller/destroy-sessions.php"><i  class="fa fa-power-off" aria-hidden="true"></i>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->

	<!--================ Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-left">
					<h2>Buy Supplements</h2>
					<div class="page_link">
						<a href="controller/destroy-sessions.php">Log out</a>
						<a href="all-supplements.php">All supplements</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section >
		<div class="col-lg12">
			<div class="container">
				<h2 class="text-muted text-center">Supplements</h2>
					<div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Supplement ID</th>
                                    <th>Supplier ID</th>
                                    <th>Supplement Description</th>
                                    <th>Cost Incl</th>
                                    <th>Colst Incl</th>
                                    <th>Min Levels</th>
                                    <th>Current Stock Level</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($supplements as $row) {
                                extract($row);
                                # code...
                                echo '<tr><td>';
                                echo $supplement_id;
                                echo '</td><td>';
                                echo $supplier_id;
                                echo '</td><td>';
                                echo $supplement_description;
                                echo '</td><td>';
                                echo $cost_excl;
                                echo '</td><td>';
                                echo $cost_incl;
                                echo '</td><td>';
                                echo $min_levels;
                                echo '</td><td>';
                                echo $current_stock_levels;
                                echo '</td></tr>';
                                
                            		}
                        
                            ?>
                			</tbody>
                    	</table>
                  	</div>
			</div>
		</div>
	</section>


	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-2  col-md-6">
					<div class="single-footer-widget">
						<h6>Top Products</h6>
						<ul class="footer-nav">
							<li>
								<a href="#">Managed Website</a>
							</li>
						
						</ul>
					</div>
				</div>
				<div class="col-lg-4  col-md-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Contact Us</h6>
						<p>
							<span id="hcp_addess"></span>
						</p>
						<h3 id="hcp_tel"></h3>
					</div>
				</div>
				<div class="col-lg-6  col-md-12">
					<div class="single-footer-widget newsletter">
						<h6>Newsletter</h6>
						<p>You can trust us. we only send promo offers, not a single spam.</p>
						<div id="mc_embed_signup">
							<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="form-group row">
									<div class="col-lg-7 col-md-6 col-sm-12">
										<input name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"
										 required="" type="email">
									</div>

									<div class="col-lg-5 col-md-12">
										<button class="nw-btn main_btn circle">get started
											<span class="lnr lnr-arrow-right"></span>
										</button>
									</div>
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="row footer-bottom d-flex justify-content-between">
				<p class="col-lg-8 col-sm-12 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
				<div class="col-lg-4 col-sm-12 footer-social">
					<a href="#">
						<i class="fa fa-facebook"></i>
					</a>
					<a href="#">
						<i class="fa fa-twitter"></i>
					</a>
					<a href="#">
						<i class="fa fa-dribbble"></i>
					</a>
					<a href="#">
						<i class="fa fa-behance"></i>
					</a>
				</div>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
</body>

</html>