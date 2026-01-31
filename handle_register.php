<?php
//connect
require_once '../inc/conn.php';
require_once '../inc/functions.php';
//chack
if (isset($_POST['submit'])) {
//catch=> trim html
$name =clean($_POST['name']);
$email =clean($_POST['email']);
$password =clean($_POST['password']);
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
//vaoied
$errors=[];
if(empty($name)){
  $errors[]="name is require";
}
  elseif(is_numeric($name)){
$errors[]="name must be  string";
  }
if(empty($email)){
  $errors[]="email is require";
}
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
$errors[]="email must be email";
  }
  if(empty($password)){
  $errors[]="password is require";
}
  elseif(strlen($password)<6){
$errors[]="password must be more than 6 char";
  }
  if(empty($errors)){
//UNIQUE
$query="select * from users where email ='$email' limit 1";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1){
    $_SESSION['errors']=["Email Elready Exists"];
    redirect("register.php");
}
// hash passwrd
$password=password_hash($password,PASSWORD_DEFAULT);
$query="insert into users (`name`,`email`,`password`) values ('$name','$email','$password');";
$result=mysqli_query($conn,$query);
if($result){
 $_SESSION['success']="Registar success,please login";
 redirect("login.php");
}else{
 $_SESSION['errors']=['error while registar'];
 redirect("register.php");
}
  }else{
    $_SESSION['errors']=$errors;
    redirect("register.php");
  }
}else{
  redirect("../errors/404.php");
}
?>