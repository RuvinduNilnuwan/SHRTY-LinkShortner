<?php 
require_once 'control/authenticationcontrol.php';

if (isset($_GET['token'])){
  $token = $_GET['token'];
  verifyUser($token);
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">      

    <title>Veryfi-SHRTY</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
               <div class="alert alert-success">
                   you are logged in
               </div> 
               <h2>Welcome</h2>
               <div class="alert alert-warning">
                   To continue Please Verify your account<br>
                   by clicking on the link we have sended to your email
               </div>
               <button class="btn btn-block btn-lg btn-primary"> proceed to login

               </button>
            </div>
        </div>
    </div>
</body>
</html>