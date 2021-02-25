<?php

require_once('../model/database.php');
require_once('../model/hcp.php');

$database = new Database();
$db = $database->connect();

//Instantiate clients
$hcp = new HCP($db);
echo json_encode($hcp->select_hcp());

?>