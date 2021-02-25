<?php

require_once('../model/database.php');
require_once('../model/suppliers.php');

$database = new Database();
$db = $database->connect();

//Instantiate clients
$supplier = new Suppliers($db);
echo $supplier->add_supplier($_POST['supplier_id'],$_POST['contact_person'],$_POST['supplier_tel'],$_POST['supplier_email'],$_POST['bank'],$_POST['bank_code'],$_POST['supplier_BankNum'],$_POST['supplier_type_bank_acc']);

?>