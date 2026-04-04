<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
// session_start(); // لو مش متفعلة في مكان تاني

if (isset($_POST['submit']) && isset($_GET['id'])) {

    $userid =  $_SESSION['user_id'];
    $id = $_GET['id'];

    
    $query = "SELECT * FROM tasks WHERE id = $id AND user_id = $userid";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $query = "DELETE FROM tasks WHERE id = $id AND user_id = $userid";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['success'] = "Task deleted successfully";
            redirect("index.php");
        } else {
            $_SESSION['errors'] = ['Error while deleting task'];
            redirect("index.php");
        }

    } else {
        $_SESSION['errors'] = ['Error while deleting task'];
        redirect("index.php");
    }

} else {
    redirect("../errors/404.php");
}
