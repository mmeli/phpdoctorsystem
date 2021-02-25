<?php
session_start();
if(empty($_SESSION['hcp_name']) ){	
   echo'<script>window.location="controller/destroy-sessions.php"</script>';
 }
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
    <title>Althealth | HCP</title>
    <!--<link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" /> -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo2.jpg">
    <!-- Custom CSS -->
    <link href="../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
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
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
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
                    <a class="navbar-brand justify-content-center" href="index.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo2.jpg" alt="homepage" class="dark-logo" height="100px" width="100px" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            
                        </span>
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
                                    alt="user" class="profile-pic mr-2"><span id="hcp_name"></span>
                                    
                                </a> 
                                <a href="controller/destroy-sessions.php"><i  class="fa fa-power-off" aria-hidden="true"></i>
                        </li>
                        <li class="nav-item dropdown">
                        <i class="glyphicon glyphicon-off"></i>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
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
                                href="pages-profile.php" aria-expanded="false">
                                <i class="mr-3 fa fa-user" aria-hidden="true"></i><span
                                    class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="daytoday.php" aria-expanded="false"><i class=" fas fa-envelope"
                                    aria-hidden="true"></i><span class="hide-menu">Day-to-day report</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="mis.php" aria-expanded="false"><i class=" fas fa-envelope"
                                aria-hidden="true"></i><span class="hide-menu">MIS report</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="index.php?report=supplements" aria-expanded="false"><i class="fas fa-caret-right"
                                aria-hidden="true"></i><span class="hide-menu">Supplements</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="index.php?report=suppliers" aria-expanded="false"><i class="fas fa-caret-right"
                                aria-hidden="true"></i><span class="hide-menu">Suppliers</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="index.php?report=addSupplements" aria-expanded="false"><i class="fas fa-caret-right"
                                aria-hidden="true"></i><span class="hide-menu">Add Supplements</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="index.php?report=addSuppliers" aria-expanded="false"><i class="fas fa-caret-right"
                                aria-hidden="true"></i><span class="hide-menu">Add Suppliers</span></a>
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
                        <h3 class="page-title mb-0 p-0">Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
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
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daily Updates</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><?php echo count($todaysBirthDay) ?></h2>
                                    <span class="text-muted">Todays birthdays</span>
                                </div>
                                
                                <!-- <span class="text-success">80%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daily updates</h4>
                                <div class="text-right">
                                    <h2 class="font-light m-b-0"><?php echo count($unpaid) ?></h2>
                                    <span class="text-muted">Unpaid invoices</span>
                                </div>
                                <!-- <span class="text-info">30%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                
                <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                        </div>
                <!-- end modal -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    $report = isset($_GET['report'])? $_GET['report']:'';
                                    //geting supplement_id from the url
                                    $supplement_edit = isset($_GET['supplement_id'])? $_GET['supplement_id']:'';
                                      //geting suppleir_id from the url
                                    $supplier_edit = isset($_GET['supplier_id'])? $_GET['supplier_id']:'';
                                    //extracting the current_stock_levels and min stock per supplement_id
                                    $each_supplement = $supplements->supplement_per_selection($supplement_edit);
                                    //extracting supplier per supplier_id
                                    $each_supplier = $suppliers->per_supplier($supplier_edit);

                                    if(isset($_GET['supplement_id'])){
                                        //print_r($each_supplement);
                                        foreach($each_supplement as $supps){
                                            extract($supps);
                                        echo "<h5>Update the supplement: </h5>";
                                        echo "<form method='post'>
                                        Minimum Stock:<br><input type='text' name='min_levels' value='$min_levels'><br>
                                                Current Stock: <br><input type='text' name='current_stock_levels' value='$current_stock_levels'><br><br>
                                                <input type='submit' name='btnSupplementUpdate' id='btnSupplementUpdate' value='Update' class='btn btn-sm btn-primary'><br>
                                                </form>
                                                ";
                                        }

                                        if(isset($_POST['btnSupplementUpdate'])){
                                            $min_levels = $_POST['min_levels'];
                                            $current_stock_levels = $_POST['current_stock_levels'];
                                            $supplements->update_to_supplements($supplement_edit,$min_levels,$current_stock_levels);
                                        }
                                    }
                                    if(isset($_GET['supplier_id'])){
                                        print_r($each_supplier);
                                        foreach($each_supplier as $suppl){
                                            extract($suppl);
                                        echo "<h5>Update the supplier: </h5>";
                                        echo "<form method='post'>
                                                Contact Person:<br><input type='text' name='contact_person' value='$contact_person'><br>
                                                Supplier Tel: <br><input type='text' name='supplier_tel' id='supplier_tel' value='$supplier_tel'><br><br>
                                                Supplier TelSupplier Email: <br><input type='text' name='supplier_email' value='$supplier_email'><br><br>
                                                Bank: <br><input type='text' name='bank' value='$bank'><br><br>
                                                Bank Code: <br><input type='text' name='bank_code' value='$bank_code'><br><br>
                                                Supplier Bank Num: <br><input type='text' name='supplier_BankNum' value='$supplier_BankNum'><br><br>
                                                Supplier Type bank Account: <br><input type='text' name='supplier_type_bank_acc' value='$supplier_type_bank_acc'><br><br>
                                                <input type='submit' name='btnSupplierUpdate' id='btnSupplierUpdate' value='Update' class='btn btn-sm btn-primary'><br>
                                                </form>
                                                ";
                                        }

                                        if(isset($_POST['btnSupplierUpdate'])){
                                            $contact_person = $_POST['contact_person'];
                                            $supplier_tel = $_POST['supplier_tel'];
                                            $supplier_email = $_POST['supplier_email'];
                                            $bank = $_POST['bank'];
                                            $bank_code = $_POST['bank_code'];
                                            $supplier_BankNum = $_POST['supplier_BankNum'];
                                            $supplier_type_bank_acc = $_POST['supplier_type_bank_acc'];
                                            $suppliers->update_to_suppliers($supplier_id,$contact_person,$supplier_tel,$supplier_email,$bank,$bank_code,$supplier_BankNum,$supplier_type_bank_acc);
                                        }
                                    }



                                    if($report == 'suppliers'){
                                        ?>
                                            <h1 class="text-muted">Suppliers</h1>
                                                <div class="table-responsive">
                                                <table id="table_id"  class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Supplier ID</th>
                                                            <th>Contact Person</th>
                                                            <th>Supplier Tel</th>
                                                            <th>Supplier Email</th>
                                                            <th>Bank</th>
                                                            <th>Bank Code</th>
                                                            <th>Supplier Bank Num</th>
                                                            <th>Supplier Type bank Account</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($all_suppliers as $row) {
                                                            extract($row);
                                                            # code...
                                                            echo '</td><td>';
                                                            echo $supplier_id;
                                                            echo '</td><td>';
                                                            echo $contact_person;
                                                            echo '</td><td>';
                                                            echo $supplier_tel;
                                                            echo '</td><td>';
                                                            echo $supplier_email;
                                                            echo '</td><td>';
                                                            echo $bank;
                                                            echo '</td><td>';
                                                            echo $bank_code;
                                                            echo '</td><td>';
                                                            echo $supplier_BankNum;
                                                            echo '</td><td>';
                                                            echo $supplier_type_bank_acc;
                                                            echo '</td><td>';
                                                            echo '<a href=index.php?supplier_id='.urlencode($supplier_id).'><button class="btn btn-sm btn-success" type="submit" name="btnUpdateSupplier" id="btnUpdateSupplier" >Update</button></a>';
                                                            echo '</td></tr>';
                                                            
                                                        }
                                                    
                                                        ?>
        
        
                                                        </tbody>             
                                                    </table>  
                                        <?php
                                    }elseif($report == 'supplements'){
                                        ?>
          
                                        <h1 class="text-muted">Supplements</h1>
                                    <div class="table-responsive">
                                        <table id="table_id"  class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Supplement ID</th>
                                                    <th>Supplier ID</th>
                                                    <th>supplement_description</th>
                                                    <th>cost_excl</th>
                                                    <th>cost_incl</th>
                                                    <th>min_levels</th>
                                                    <th>current_stock_levels</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($all_supplements as $row) {
                                                    extract($row);
                                                    # code...
                                                    echo '</tr><td>';
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
                                                    echo '</td><td>';
                                                    echo '<a href=index.php?supplement_id='.$supplement_id.'><button class="btn btn-sm btn-success" type="submit" name="btnUpdate" id="btnUpdate" >Update</button></a>';
                                                    echo '</td></tr>';
                                                    
                                                }
                                            
                                                ?>
                                        
                                            
                                            </tbody>             
                                        </table>  
                                    </div>            
                                    <?php
                                    }elseif($report == 'addSuppliers'){
                                        echo "<h1 class='text-muted'>Add Suppliers</h1>";
                                        ?>
                                        <div class="toast" data-autohide="false">
                                            <div class="toast-header">
                                                <strong class="mr-auto text-primary">Alert</strong>
                                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                                            </div>
                                            <div class="toast-body">
                                                Please complete all the fields
                                            </div>
                                        </div>
                                        
                                        <div class="addSupplierForm">
                                            <input type="hidden" name="action" value="register_user" />
      
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Supplier id:</label>
                                                    <input type="text" class="form-control" id="supplier_id" name="supplier_id" value="<?php echo isset($_POST['supplier_id'])? $_POST['supplier_id']:'' ?>">
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Contact Person:</label>
                                                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo isset($_POST['contact_person'])? $_POST['contact_person']:'' ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Supplier Tel:</label>
                                                    <input type="text" class="form-control" id="supplier_tel" id="supplier_tel" name="supplier_tel" value="<?php echo isset($_POST['supplier_tel'])? $_POST['supplier_tel']:'' ?>">
                                                </div>
                                            </div>
      
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Supplier Email:</label>
                                                    <input type="text" class="form-control" id="supplier_email" name="supplier_email" value="<?php echo isset($_POST['supplier_email'])? $_POST['supplier_email']:'' ?>">
                                                </div>
                                            </div>
                                
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Bank:</label>
                                                    <input type="text" class="form-control" id="bank" name="bank" value="<?php echo isset($_POST['bank'])? $_POST['bank']:'' ?>" >
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Bank Code:</label>
                                                    <input type="text" class="form-control" id="bank_code" name="bank_code" value="<?php echo isset($_POST['bank_code'])? $_POST['bank_code']:'' ?>" >
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Supplier Bank Number:</label>
                                                    <input type="number" class="form-control" id="supplier_BankNum" name="supplier_BankNum" value="<?php echo isset($_POST['supplier_BankNum'])? $_POST['supplier_BankNum']:'' ?>">
                                                </div>
                                            </div>
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label>Supplier Type Bank Account:</label>
                                                    <input type="text" class="form-control" id="supplier_type_bank_acc" name="supplier_type_bank_acc" value="<?php echo isset($_POST['supplier_type_bank_acc'])? $_POST['supplier_type_bank_acc']:'' ?>">
                                                </div>
                                            </div>
                                            
                                            
                                        
                                            
                                            <button type="submit" name="btnAddSupplier" id="btnAddSupplier" class="btn btn-primary">Add Supplier</button>
                                        </div>
                                        
                                        <div id="empty_fields"></div>
                                        <?php
                                                
      
                                                
      
                                            ?>
                                        <?php
                                    }elseif($report == 'addSupplements'){
                                        ?>
                                        <h1>Add Supplements</h1>
                                            <form  method="POST">
                                                    
                                              <input type="hidden" name="action" value="register_user" />
            
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Supplement id:</label>
                                                      <input type="text" class="form-control" name="supplement_id" value="<?php echo isset($_POST['supplement_id'])? $_POST['supplement_id']:'' ?>">
                                                  </div>
                                              </div>
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Supplier id</label>
                                                      <select name="supplier_id" class="form-control" id="supplier_id">
                                                      <?php foreach($all_suppliers as $supplier): ?>
                                                      <option value="<?php echo $supplier['supplier_id'] ?>"><?php echo $supplier['supplier_id'] ?></option>
                                                      <?php endforeach; ?>
                                                      </select> 
                                                  </div>
                                              </div>
                                              
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Supplement Description:</label>
                                                      <input type="text" class="form-control" name="supplement_description" value="<?php echo isset($_POST['supplement_description'])? $_POST['supplement_description']:'' ?>">
                                                  </div>
                                              </div>
            
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Cost Excl:</label>
                                                      <input type="text" class="form-control" id="cost_excl" name="cost_excl" value="<?php echo isset($_POST['cost_excl'])? $_POST['cost_excl']:'' ?>">
                                                  </div>
                                              </div>
                                  
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Cost Incl:</label>
                                                      <input type="text" class="form-control" id="cost_incl" name="cost_incl" value="<?php echo isset($_POST['cost_incl'])? $_POST['cost_incl']:'' ?>" readonly="readonly">
                                                  </div>
                                              </div>
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Min Levels:</label>
                                                      <input type="number" class="form-control" name="min_levels" value="<?php echo isset($_POST['min_levels'])? $_POST['min_levels']:'' ?>">
                                                  </div>
                                              </div>
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Current Stocl Levels:</label>
                                                      <input type="number" class="form-control" name="current_stock_levels" value="<?php echo isset($_POST['current_stock_levels'])? $_POST['current_stock_levels']:'' ?>">
                                                  </div>
                                              </div>
                                              <div class="control-group form-group">
                                                  <div class="controls">
                                                      <label>Nappi code:</label>
                                                      <input type="number" class="form-control" name="nappi_code" value="<?php echo isset($_POST['nappi_code'])? $_POST['nappi_code']:'' ?>">
                                                  </div>
                                              </div>
                                              
                                          
                                              
                                              <button type="submit" name="btnAddSupp" class="btn btn-primary">Add</button>
                                              
                                          </form>
                                          <?php
                                            if(isset($_POST['btnAddSupp'])){
                                            $supplement_id = isset($_POST['supplement_id'])? $_POST['supplement_id']:'';
                                            $supplier_id = isset($_POST['supplier_id']) ? $_POST['supplier_id'] : '';
                                            $supplement_description = isset($_POST['supplement_description'])? $_POST['supplement_description']:'';
                                            $cost_excl = isset($_POST['cost_excl'])? $_POST['cost_excl']:'';
                                            $cost_incl = isset($_POST['cost_incl'])? $_POST['cost_incl']:'';
                                            $min_levels = isset($_POST['min_levels'])? $_POST['min_levels']:'';
                                            $current_stock_levels = isset($_POST['current_stock_levels'])? $_POST['current_stock_levels']:'';
                                            $nappi_code = isset($_POST['nappi_code'])? $_POST['nappi_code']:'';
                                            
                                            if(!empty($supplement_id) && !empty($supplement_description) && !empty($cost_excl) && !empty($cost_incl) && !empty($current_stock_levels) ){
                                                $supplements->add_suppliments($supplement_id,$supplier_id,$supplement_description,$cost_excl,$cost_incl,$min_levels,$current_stock_levels,$nappi_code);
                                                echo "<script>alert('added successfully')</script>";
                                                echo '<script>window.location="index.php?report=supplements"</script>';
                                            }else{
                                                die();
                                                echo "<div  style='color: red; align:center'>"."No field must be empty!"."</div>";
                                            }
                                            }
            
                                                  
            
                                              ?>
                                          <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ============================================================== -->
                <!-- Recent blogss -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2020 Althealth, Designed by <?php echo $_SESSION['hcp_name'] ?>
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
    <script src="../assets/plugins/jquery/dist/jquery.maskedinput.js"></script>
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
    <!--This page JavaScript -->
    <!--flot chart-->
    <script src="../assets/plugins/flot/jquery.flot.js"></script>
    <script src="../assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
    <script src="api/hcp.js"></script>
    <script src="api/add-supplier.js"></script>
</body>

</html>
<script>
    $(document).ready(function(){
        
    $("#supplier_tel").mask("(999)-(999)-(9999)");
    let cost_incl;
    $("#cost_excl").blur(function(){
        let cost_excl = $("#cost_excl").val();
        cost_incl = cost_excl * 1.14;
        //let total = cost_incl + cost_excl;
        $("#cost_incl").val(cost_incl);
        console.log(cost_incl);
        return cost_incl;
    
    });

    // $(document).on('click','#btnAddSupplier', function(){
    //     alert("Im here to do the job");
    // });
});
</script>