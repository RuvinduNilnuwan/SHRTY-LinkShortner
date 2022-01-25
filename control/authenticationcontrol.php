<?php

session_start();

require 'php/config.php';
require_once 'emailcontrol.php';


$errors = array();
$username = "";
$email = "";

//click signup button
if (isset($_POST['signup-btn'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordcon = $_POST['passwordcon'];

    if (empty($username)) {
        $errors['username'] = "username required"; 
    }
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $errors['email'] = "Enter a valid E-Mail"; 
    }
    if (empty($email)) {
        $errors['email'] = "email required"; 
    }
    if (empty($password)) {
        $errors['password'] = "password required"; 
    }
    if (empty($passwordcon)) {
        $errors['passwordcon'] = "password required"; 
    }
    if ($password !== $passwordcon){
        $errors['password'] = "Passwords do not match";
    }

 $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
 $stmt = $conn->prepare($emailQuery);
 $stmt->bind_param('s', $email);
 $stmt->execute();
 $result = $stmt->get_result();
 $userCount = $result->num_rows;
 $stmt->close();

 if ($userCount > 0){
    $errors['email'] = "email alredy registerd";
 }
 if (count($errors) == 0){
     $password = password_hash($password, PASSWORD_DEFAULT);
     $token = bin2hex(random_bytes(50));
     $verified = false;

     $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?, ?, ?, ?, ?)";

     $stmt = $conn->prepare($sql);
     $stmt->bind_param('ssbss', $username, $email, $verified, $token, $password);
     if ($stmt->execute()) {
         //login user
         $user_id = $conn->insert_id;
         $_SESSION['id'] = $user_id;
         $_SESSION['username'] = $username;
         $_SESSION['email'] = $email;
         $_SESSION['verified'] = $verified;

         sendVerificationEmail($email,$token);

         //success msg
         $_SESSION['message'] = "loged in";
         $_SESSION['alert-class'] = "alert-success";
         header('location: veryfi.php');
         
         exit();


     }else{
         $errors['db-error'] = "Attempt Failed Please Try Again";
     }
 }



}

//login
if (isset($_POST['login-btn'])){
    $username = $_POST['username'];
    
    $password = $_POST['password'];
   

    if (empty($username)) {
        $errors['username'] = "username required"; 
    }
    
    if (empty($password)) {
        $errors['password'] = "password required"; 
    }
    if (count($errors) === 0){  
      $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
      $stmt = $conn->prepare($sql);
       $stmt->bind_param('ss', $username, $username);
       $stmt->execute();
       $result = $stmt->get_result();
       $user = $result->fetch_assoc();

       if(password_verify($password, $user['password'])){
    
         $_SESSION['id'] = $user['id'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['email'] = $user['email'];
         $_SESSION['verified'] = $user['verified'];

         //success msg
         $_SESSION['message'] = "loged in";
         $_SESSION['alert-class'] = "alert-success";
         header('location: dashboard.php');
         exit();

      }else{
     $errors['login_fail'] = "Username or Password incorrect";
        }
 


    }
}

if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    header('location: login.php');
    exit();
}


 function verifyUser($token)
 {
     global $conn;

     $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) > 0){
         $user = mysqli_fetch_assoc($result);
         $update_query = "UPDATE users SET verified=1 WHERE token='$token'";

         if(mysqli_query($conn, $update_query)) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = 1;

            header('location: index.php');

         }
     }

     
 }




?>