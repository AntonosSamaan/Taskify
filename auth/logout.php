<?php
session_start();
require_once '../inc/functions.php';
require_login();
session_destroy();
session_start();
$_SESSION['success']="User loguot success";
redirect('login.php');
?>