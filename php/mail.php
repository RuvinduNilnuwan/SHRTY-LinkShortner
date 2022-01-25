<?php 
$name = $_POST['name'];
$email = $_POST['mail'];
$sub = $_POST['subject'];
$mes = $_POST['message'];


$mailheader = "From:".$name."<".$email.">\r\n";

$recepient = "noellvta@gmail.com";

mail($recepient, $sub, $mes, $mailheader)
or die("error");

echo'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background: #1b1c1e;
        text-align: center;
    }
    
    h1 {
        
        font-size: 59px;
        color: white;
        font-weight: 600;
        padding-bottom: 20px;
    }
    
    p {
        color: #d2d2d2;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank you for contacting me. I will get back to you as soon as possible!</h1>
        <p class="back">Go back to the <a href="index.html">homepage</a>.</p>
        
    </div>
</body>
</html>
';










?>