
<?php
include_once 'model/database.php';
include_once 'model/client.php';

$database = new Database();
$db = $database->connect();

//Instantiate clients
$client = new Client($db);
$reference = $client->reference();

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/logo2.jpg" type="image/png">
	<title>Althealth|signup</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
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
							<a href="#">
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
										<a class="nav-link" href="index.html">Home</a>
									</li>
									
									<li class="nav-item submenu dropdown">
										<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign in</a>
										<ul class="dropdown-menu">
											<li class="nav-item">
												<a class="nav-link" href="signup.php">Sign up</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="signin.php">Signin</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-item ">
										<a class="nav-link" href="hcp-signin.php">HCP</a>
									</li>
									
									<li class="nav-item">
										<a class="nav-link" href="contact.html">Contact</a>
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
					<h2>Sign Up</h2>
					<div class="page_link">
						<a href="index.html">Home</a>
						<a href="about.html">Signup</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Banner Area =================-->

	<!-- Start Appointment Area -->
	<section>
		
		<div class="container">
			<div class="row ">
				<div class="col-lg-12">
				<h1 class="text-muted">Sign up here</h1>
				<hr>
					<form action="" method="post">
						<div class="form-group">
							<label for="c_name">First Name</label>
							<input type="text" class="form-control" name="c_name" id="c_name" value="<?php echo isset($_POST['c_name'])? $_POST['c_name']:'' ?>"  placeholder="Enter first name" >
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">Last Name</label>
							<input type="text" class="form-control" name="c_surname" id="c_surname" value="<?php echo isset($_POST['c_surname'])? $_POST['c_surname']:'' ?>" aria-describedby="c_surname" placeholder="Enter last name" >
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">ID Number</label>
							<input type="number" class="form-control" name="client_ID" id="client_ID" value="<?php echo isset($_POST['client_ID'])? $_POST['client_ID']:'' ?>" aria-describedby="client_ID" placeholder="Enter ID Number">
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">Address</label>
							<input type="text" class="form-control" name="address" id="address" value="<?php echo isset($_POST['address'])? $_POST['address']:'' ?>" aria-describedby="address" placeholder="Enter address">
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">Code</label>
							<input type="text" class="form-control" name="code" id="code" value="<?php echo isset($_POST['code'])? $_POST['code']:'' ?>" aria-describedby="code" placeholder="Enter code">
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">Home</label>
							<input type="text" class="form-control" value="<?php echo isset($_POST['c_tel_h'])? $_POST['c_tel_h']:'' ?>" name="c_tel_h" id="c_tel_h" aria-describedby="address" placeholder="Enter home tel">
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">Work</label>
							<input type="text" class="form-control" name="c_tel_w" id="c_tel_w" value="<?php echo isset($_POST['c_tel_w'])? $_POST['c_tel_w']:'' ?>" aria-describedby="c_tel_w" placeholder="Enter work tel">
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="c_surname">Cell</label>
							<input type="text" class="form-control" name="c_tel_cell" id="c_tel_cell" value="<?php echo isset($_POST['c_tel_cell'])? $_POST['c_tel_cell']:'' ?>" aria-describedby="c_tel_cell" placeholder="Enter Cell No">
							<!-- <small id="c_name" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" name="c_email" id="c_email" value="<?php echo isset($_POST['c_email'])? $_POST['c_email']:'' ?>" aria-describedby="c_email" placeholder="Enter email address">
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="reference">Select Reference</label>
								<br>
								<select name="reference_id"  id="reference_id">
									<?php foreach($reference as $ref): ?>
										<option value="<?php echo $ref['reference_ID'] ?>"><?php echo $ref['description'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<hr>
						<div class="col-lg-12">
							<button  id="btnSignup" name="btnSignup" class="btn btn-primary btn-block">Submit</button>
						</div>
						<hr>
						</form>	
					
				</div>
				
				
				<div class="col-lg-12">
					<span id="empty_fields"></span>					
				</div>
				<?php
					if(isset($_POST['btnSignup'])){
						$client_ID = $_POST['client_ID'];
						$c_name = $_POST['c_name'];
						$c_surname = $_POST['c_surname'];
						$address = $_POST['address'];
						$code = $_POST['code'];
						$c_tel_h = $_POST['c_tel_h'];
						$c_tel_w = $_POST['c_tel_w'];
						$c_tel_cell = $_POST['c_tel_cell'];
						$c_email = $_POST['c_email'];
						$reference = $_POST['reference_id'];
						$client->id_validation($client_ID, '');
						$client->email_validation($c_email);
						if(!empty($c_name) || !empty($c_surname) || !empty($client_ID) || !empty($c_email) || !empty($address) || !empty($code) || !empty($c_tel_cell) || !empty($c_tel_w)){
							$client->insert();
							
						}else{
							echo "<div  style='color: red; align:center'>"."No field must be empty!"."</div>";
						}
					}
                ?>		
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
							<li>
								<a href="#">Manage Reputation</a>
							</li>
							<li>
								<a href="#">Power Tools</a>
							</li>
							<li>
								<a href="#">Marketing Service</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4  col-md-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Contact Us</h6>
						<p id="hcp_address">
							
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
	<script src="js/jquery.maskedinput.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
	<script src="js/mail-script.js"></script>
	<script src="js/custom.js"></script>
	<script src="api/hcp.js"></script>
	<script src="api/signup.js"></script>

	
</body>

</html>