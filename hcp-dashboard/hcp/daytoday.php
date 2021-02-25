<?php
session_start();
// if(empty($_SESSION['fullNameAdmin']) ){	
//     echo'<script>window.location="controller/destroy-sessions.php"</script>';
// }
include_once 'model/database.php';
require_once "model/supplements.php";
require_once "model/suppliers.php";
require_once "model/Invoices.php";
require_once "../../model/client.php";


//instantiate db and connect
$database = new Database();
$db = $database->connect();


$suppliers = new Suppliers($db);
$invoices = new Invoices($db);
$supplements = new Supplements($db);
$clients = new Client($db);
//$validation = $clients->validation()



//$all_supplements = $supplements->get_supplements();
$all_suppliers = $suppliers->get_suppliers();


$todaysBirthDay = $invoices->birthdays();

//Clients
 $all_clients = $clients->selectAll();
 $num_client = count($all_clients);


//Day to day reports
$todaysApp = $invoices->birthdays(); //today's birthdays
$num_today = count($todaysApp);
$belowmin = $invoices->below_level(); //Below level stock
$unpaid= $invoices->unpaid_invoices(); //unpaid invoices


//MIS reports
$top_client = $invoices->top_10(); //Top ten clients bought supplements
$purchases= $invoices->frequency(); //Purchases statistics
$client_contact= $invoices->client_contact(); //clients with empty fields

//all suppplements
$all_supplements = $supplements->get_supplements();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Monsterlite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Monster admin lite design, Monster admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Althealth|HCP</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo2.jpg">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
 
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo2.jpg" alt="homepage" class="dark-logo" height="100px" width="100px" />

                        </b>
                        
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <li class="nav-item hidden-sm-down">
                            <form class="app-search pl-3">
                                <input type="text" class="form-control" placeholder="Search for..."> <a
                                    class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img src="../assets/images/rethabile.PNG"
                                    alt="user" class="profile-pic mr-2"><span id="hcp_name"></span></a>
                                    <a href="controller/destroy-sessions.php"><i  class="fa fa-power-off" aria-hidden="true"></i>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
 
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.php" aria-expanded="false"><i class="mr-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="pages-profile.html" aria-expanded="false">
                                <i class="mr-3 fa fa-user" aria-hidden="true"></i><span
                                    class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="daytoday.php?report=birthdays" aria-expanded="false"><i class="mr-3 fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Today's birthdays</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="daytoday.php?report=unpaid" aria-expanded="false"><i class="mr-3 fa fa-table"
                                aria-hidden="true"></i><span class="hide-menu">Unpaid invoices</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="daytoday.php?report=minimumstock" aria-expanded="false"><i class="mr-3 fa fa-table"
                                aria-hidden="true"></i><span class="hide-menu">Minimum Stock Level</span></a>
                        </li>
                        
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Day-to-day Reports</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DAY-TO-DAY Reports</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">day to day report</h4>
                                <?php
                                    $report = isset($_GET['report'])? $_GET['report']:'';
                                    if($report == 'birthdays'){
                                        
                                        echo '<table id="table_id" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Client ID </th>
                                                        <th>Client Name </th>
                                                    </tr>
                                                </thead>  
                                            ';
                                            if(!empty($todaysBirthDay)){
                  
                                            
                                                ?>
                                                
                                                <?php foreach ($todaysBirthDay as $rows):  ?>
                                                <tbody>
                                                <tr>
                                                    <td class=""><?php echo $rows['CLIENT ID']; ?></td>
                                                    <td><?php echo $rows['CLIENT NAME']; ?></td>
                                                          
                                                
                                                    
                                                </tr>
                                                </tbody>
                                            <?php endforeach;
                                            }else{
                                                echo '
                                                <tr>
                                                <td colspan="6" align="center" ><span style="color: red" >No Birthdays for today</span></td>
                                                </tr>
                                                ';
                                            }
                                            
                                                echo '</table>'
                                            ?>
                                        <?php
                                    }elseif($report == 'unpaid'){
                                        echo '<table id="table_id" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>CLIENT ID</th>
                                            <th>CLIENT</th>
                                            <th>INVOICE NUMBER</th>
                                            <th>INVOICE DATE</th>
                                        </tr>
                                        </thead>
                                        ';
                  
                                        if(!empty($unpaid)){
                  
                                            
                                            ?>
                                            
                                            <?php foreach ($unpaid as $rows):  ?>
                                            <tbody>
                                            <tr>
                                                <td class=""><?php echo $rows['CLIENT ID'] ?></td>
                                                <td><?php echo $rows['CLIENT']; ?></td>
                                                <td><?php echo $rows['INVOICE NUMBER']; ?></td>
                                                <td><?php echo $rows['INVOICE DATE']; ?></td> 
                                            </tr>
                                            </tbody>
                                        <?php endforeach;
                                        }else{
                                            echo '
                                            <tr>
                                            <td colspan="6" align="center" ><span style="color: red" >The stock is up to date</span></td>
                                            </tr>
                                            ';
                                        }
                                        
                                            echo '</table>';
                                            ?>
                                        <?php
                                      }elseif($report == 'minimumstock'){
                                        echo '<table id="table_id" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>SUPPLEMENTS</th>
                                            <th>SUPPLIER INFORMATION</th>
                                            <th>MIN LEVELS</th>
                                            <th>CURRENT STOCK</th>
                                        </tr>
                                        </thead>
                                        ';
                  
                                        if(!empty($belowmin)){
                  
                                            
                                            ?>
                                            
                                            <?php foreach ($belowmin as $rows):  ?>
                                            <tbody>
                                            <tr>
                                                <td class=""><?php echo $rows['SUPPLEMENT'] ?></td>
                                                <td><?php echo $rows['SUPPLIER INFORMATION']; ?></td>
                                                <td><?php echo $rows['MIN LEVELS']; ?></td>
                                                <td><?php echo $rows['CURRENT STOCK']; ?></td>
                                                     
                                            
                                                
                                            </tr>
                                            </tbody>
                                        <?php endforeach;
                                        }else{
                                            echo '
                                            <tr>
                                            <td colspan="6" align="center" ><span style="color: red" >The stock is up to date</span></td>
                                            </tr>
                                            ';
                                        }
                                        
                                            echo '</table>';
                                        
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2020 Altheath, designed by <?php echo $_SESSION['hcp_name'] ?>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <script src="api/hcp.js"></script>
</body>

</html>