<?php
require_once 'control/authenticationcontrol.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">      
    <link rel="stylesheet" href="about.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>login-SHRTY</title>
</head>
<body>
<header class="header border-bottom">
    <div class="navbar">
        <h1><a href="index.html">SHRTY</a></h1>
    </div>
</header>
   <div class="container">
       <div class="row">
           <div class="col-md-6">
               <div class="imgare"></div>
               <img src="./assets/comu.svg"></img>

           </div>
           <div class="col-md-6">
               <form action="login.php" method="post">
                   <h3 class="text-center">Login & Work the Magic</h3>
                   <?php if(count($errors)>0): ?>
                   <div class="alert alert-danger">
                       <?php foreach($errors as $error): ?>
                       <li><?php echo $error;  ?></li>
                       <?php endforeach; ?>
                   </div>
                  <?php endif; ?>

                   <div class="form-group"> 
                       <label for="username">Username Or Email</label>
                       <input type="text" name="username"  class="form-control form-control-lg">
                   </div>
                  
                <div class="form-group">
                    <label for="username">Password</label>
                    <input type="password" name="password"  class="form-control form-control-lg">
                </div>
               
                <div class="form-group">
                    <button type="submit" name="login-btn" class="btn-primary btn-block btn-lg">Login</button>
                </div>
                <p class="text-center">Not yet a Member <a href="register.php">sign up</a></p>
               </form>

           </div>
       </div>
   </div>
   <div class="footer-dark">
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-sm-6 col-md-3 item">
                  <h3>Services</h3>
                  <ul>
                      <li><a href="#">Web development</a></li>
                      <li><a href="#">Software Development</a></li>
                      <li><a href="#">Android Development</a></li>
                  </ul>
              </div>
              <div class="col-sm-6 col-md-3 item">
                  <h3>About</h3>
                  <ul>
                      <li><a href="#">Portfolio</a></li>
                      
                  </ul>
              </div>
              <div class="col-md-6 item text">
                  <h3>Shrty</h3>
                  <p>SHRTY!! is a link shortner website which provide all their services for free!</p>
              </div>
              <div class="col item social"><a href="https://www.linkedin.com/in/ruvindu-nilnuwan"><i class="fab fa-linkedin"></i></a><a href="https://github.com/RuvinduNilnuwan"><i class="fab fa-github"></i></a><a href="#"><i class="fas fa-link"></i></a><a href="#"><i class="fab fa-twitter"></i></a></div>
          </div>
          <p class="copyright">Shrty Made with <i class="fas fa-heart"></i> In <img
src="https://flagcdn.com/16x12/lk.png"
srcset="https://flagcdn.com/32x24/lk.png 2x,
https://flagcdn.com/48x36/lk.png 3x"
width="16"
height="12"
alt="Sri Lanka"> © 2022</p> 
      </div>
  </footer>
</div>
    









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>