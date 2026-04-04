<?php

function redirect($path){
    header("Location: $path");
}

function clean($value){
    return trim(htmlspecialchars($value));
}
function require_login(){
    if (!isset($_SESSION['user_id'])){
        redirect("../auth/login.php");
    }
}