<?php
    session_start();
    include '../model/database.php';
    require_once "../model/supplements.php";
    $database = new Database();
    $db = $database->connect();
    $supplements = new Supplements($db);
    //fetch data
    if($_POST['get_data'] == 'load'){
        echo $supplements->fetch_cart($_SESSION['client_ID']);
    }else{
        echo "Error sending the request";
    }
    

?>



