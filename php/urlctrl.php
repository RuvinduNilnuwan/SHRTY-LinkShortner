<?php

    include "config.php";
    
        
        $full_url = mysqli_real_escape_string($conn, $_POST['fulurl']);
        $userid =   mysqli_real_escape_string($conn, $_POST['ur']);
        
        if(!empty($full_url) && filter_var($full_url, FILTER_VALIDATE_URL)){
            $ran_url = substr(md5(microtime()), rand(0, 26), 5);
            $sql5 = mysqli_query($conn, "SELECT * FROM allurl WHERE shorten_url = '{$ran_url}'");
            if(mysqli_num_rows($sql5) > 0){
                echo "Something went wrong. Please generate again!";
            }else{
                
                $sql6 = mysqli_query($conn, "INSERT INTO allurl (uid, full_url, shorten_url, clicks) 
                                             VALUES ('{$userid}','{$full_url}', '{$ran_url}', '0')");
                if($sql6){
                    $sql7 = mysqli_query($conn, "SELECT shorten_url FROM allurl WHERE shorten_url = '{$ran_url}'");
                    if(mysqli_num_rows($sql7) > 0){
                        $shorten_url = mysqli_fetch_assoc($sql7);
                        echo $shorten_url['shorten_url'];
                    }
                }
            }
        }else{
            echo "$full_url - This is not a valid URL!";
            
        }

    
   
?>