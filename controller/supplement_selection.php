<?php

require_once('../model/database.php');
require_once('../model/supplements.php');

$database = new Database();
$db = $database->connect();

//Instantiate clients
$supplements = new Supplements($db);
echo $supplements->get_supplements_selection();

?>