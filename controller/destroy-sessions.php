<?php


require_once '../model/database.php';
// Four steps to closing a session
// (i.e. logging out)

// 1. Find the session
@session_start();

// 2. Unset all the session variables
unset( $_SESSION['c_email'] );
unset( $_SESSION['client_ID'] );

// 4. Destroy the session

// session_destroy();
echo'<script>window.location="../signin.php"</script>';
 


?>