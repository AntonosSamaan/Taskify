<?php 
require_once '../inc/conn.php';
require_once '../inc/functions.php';

if (isset($_POST['submit'])) {

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
        $query = "INSERT INTO tasks (`title`,`description`,`user_id`) VALUES ('$title','$description',$user_id)";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['success'] = "created task";
            redirect("index.php");
        } else {
            $_SESSION['errors'] = ['error while creating task'];
            redirect("index.php");
        }
    } else {
        $_SESSION['errors'] = $errors;
        redirect("index.php");
    }

}
?>
