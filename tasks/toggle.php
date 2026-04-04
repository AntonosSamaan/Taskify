<?php 
require_once '../inc/conn.php';
require_once '../inc/functions.php';
//require_login();
if (isset($_GET['id'])) {

    $id =  $_GET['id']; 

    // user_id
    $user_id = $_SESSION['user_id'];

    // select one
    $query  = "SELECT * FROM tasks WHERE id=$id AND user_id=$user_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $task = mysqli_fetch_assoc($result);
        $old_status = $task['status'];

        if ($old_status == "done") {
            $new_status = "pending";
        } else {
            $new_status = "done";
            
        }

        $query = "UPDATE tasks SET status='$new_status', updated_at = NOW() 
                  WHERE id=$id AND user_id=$user_id";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['success'] = "Task Status Updated";
            redirect("index.php");
        } else {
            $_SESSION['errors'] = ['error while update Status task'];
            redirect("index.php");
        }

    } else {
        $_SESSION['errors'] = ['task status not found'];
        redirect("index.php");
    }

} else {
    $_SESSION['errors'] = ['task status not found'];
    redirect("index.php");
}
?>