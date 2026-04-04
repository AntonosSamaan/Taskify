<?php 
require_once '../inc/conn.php';
require_once '../inc/functions.php';
require_login();

if (isset($_POST['submit']) && isset($_GET['id'])) {

    $id = $_GET['id']; 
    $title = clean($_POST['title']);
    $description = clean($_POST['description']);
    $errors = [];

    if (empty($title)) {
        $errors[] = "title is require";
    }

    if (empty($description)) {
        $errors[] = "description is require";
    }

    // user_id
    $user_id = $_SESSION['user_id'];

    if (empty($errors)) {

        // select one
        $query = "SELECT * FROM tasks WHERE id=$id AND user_id=$user_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $query = "UPDATE tasks SET title='$title',description='$description',updated_at = NOW()WHERE 
            id=$id AND user_id=$user_id";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['success'] = "Task Updated";
                redirect("index.php");
            } else {
                $_SESSION['errors'] = ['error while update task'];
                redirect("index.php");
            }

        } else {
            $_SESSION['errors'] = ['task not found'];
            redirect("index.php");
        }

    } else {
        $_SESSION['errors'] = $errors;
        redirect("edit.php?id=$id");
    }
}
?>
