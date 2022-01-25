<?php 
require_once 'control/authenticationcontrol.php';

if (isset($_GET['token'])){
  $token = $_GET['token'];
  verifyUser( );
}



if (!isset($_SESSION['id'])){
  header('location: login.php');
  exit();
}


  
  include "php/config.php";
  $new_url = "";
  if(isset($_GET)){
    foreach($_GET as $key=>$val){
      $u = mysqli_real_escape_string($conn, $key);
      $new_url = str_replace('/', '', $u);
    }
      $sql5 = mysqli_query($conn, "SELECT full_url FROM allurl WHERE shorten_url = '{$new_url}'");
      if(mysqli_num_rows($sql5) > 0){
        $sql6 = mysqli_query($conn, "UPDATE allurl SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}'");
        if($sql6){
            $full_url = mysqli_fetch_assoc($sql5);
            header("Location:".$full_url['full_url']);
          }
      }
  }

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $_SESSION['username']; ?> Dashboard</title>
  
  <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">      
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

  <div class="dash">
  <h1>SHRTY</h1>
  <h3>Your Favorite Link Shortner</h3>
  <div class="usnam">
    Welcome<h4><?php echo $_SESSION['username']; ?></h4>
    
  </div>
  
  </div>  

<?php $sname = $_SESSION['username']; ?>

  <div class="wrapper">
    <form action="#" autocomplete="off">
    
      <input type="text" spellcheck="false" name="fulurl" placeholder="Enter you URL " required>
      <div class="row">
      <div class="uid">
  <input type="text" spellcheck="false" name="ur" value="<?php echo $_SESSION['username'] ?>" placeholder="Enter or paste a long url" required>

  </div>
      </div> 
  
      <i class="url-icon uil uil-link"></i>
      <button>Shorten</button>
    </form>

</div>
    <?php
      $sql6 = mysqli_query($conn, "SELECT id, shorten_url, full_url, clicks FROM allurl WHERE uid = '$sname' ORDER BY id DESC");
      if(mysqli_num_rows($sql6) > 0){;
        ?>
          <div class="statistics">
            <?php
              $sql7 = mysqli_query($conn, "SELECT COUNT(*) FROM allurl WHERE uid = '$sname'");
              $res = mysqli_fetch_assoc($sql7);

              $sql4 = mysqli_query($conn, "SELECT clicks FROM allurl WHERE uid = '$sname'");
              $total = 0;
              while($count = mysqli_fetch_assoc($sql4)){
                $total = $count['clicks'] + $total;
              }
            ?>
             <section class="content">
    <div class=" container-fluid">
    <h3 class= "text text-success">Analytics Dashboard</h3>
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
         <h3> <?php echo end($res) ?> </h3>
          <p>Total Links</p>
          </div>
          <div class="icon">
          <i class="fas fa-link"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
         <h3> <?php echo ($total) ?></h3>
          <p>Total Clicks</p>
          </div>
          <div class="icon">
          <i class="fas fa-mouse"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
          <h3><a href="php/delete.php?delete=all">Clear All</a></h3>
          <p>Delete All the Links</p>
          </div>
          <div class="icon">
          <i class="fas fa-trash-alt"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
          <div class="inner">
         <h3> <a href="index.php?logout=1" class="logout">logut</a> </h3>
          <p>Exit From Dashboard</P>
          </div>
          <div class="icon">
          <i class="fas fa-sign-out-alt"></i>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
            </section>
        </div>
        <div class="urls-area">
          <div class="title">
            <li>Shorten URL</li>
            <li>Original URL</li>
            <li>Clicks</li>
            <li>Action</li>
          </div>
          <?php
            while($row = mysqli_fetch_assoc($sql6)){
              ?>
                <div class="data">
                <li>
                  <a href="<?php echo $row['shorten_url'] ?>" target="_blank">
                  <?php
                    if($domain.strlen($row['shorten_url']) > 50){
                      echo $domain.substr($row['shorten_url'], 0, 50) . '...';
                    }else{
                      echo $row['shorten_url'];
                    }
                  ?>
                  </a>
                </li> 
                <li>
                  <?php
                    if(strlen($row['full_url']) > 60){
                      echo substr($row['full_url'], 0, 60) . '...';
                    }else{
                      echo $row['full_url'];
                    }
                  ?>
                </li> 
              </li>
                <li><?php echo $row['clicks'] ?></li>
                <li><a href="php/delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
              </div>
              <?php
            }
          ?>
      </div>
        <?php
      }
    ?>
  </div>

  
  <div class="popup-box">
  <div class="info-box">link is ready. Customize the link as you want then save or save it as it is.</div>
  <form action="#" autocomplete="off">
    <label>Edit your shorten url</label>
    <input type="text" class="shorten-urll" spellcheck="false" required>
    <i class="copy-icon uil uil-copy-alt"></i>
    <button>Save</button>
  </form>
  </div>
<a href="index.php?logout=1" class="logout">logut</a>
  <script>
    <?php require_once("./scscript.js");?>
</script>

</body>
</html>

