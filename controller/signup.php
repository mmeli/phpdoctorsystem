<?php

require_once('../model/database.php');
require_once('../model/client.php');

$database = new Database();
$db = $database->connect();

//Instantiate clients
$client = new Client($db);
echo $client->insert();

?>