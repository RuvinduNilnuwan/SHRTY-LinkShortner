<?php 

require_once 'vendor/autoload.php';
require_once 'php/config.php';

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
      ->setUsername('youremail')
      ->setPassword('password');

       // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
    
    
    

function sendVerificationEmail($useremail,$token)
{
    global $mailer;
   
    
    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
            <p>
                wlcome onboard
            </p>
            <a href="http://localhost/urlsh/veryfi.php?token=' . $token . '"> Veryfy Email</a>
        </div>
    </body>
    </html>';

    // Create a message
    $message = (new Swift_Message('Please Veryfy your Email'))
    ->setFrom(['email' => 'name'])
      ->setTo($useremail)
      ->setBody($body, 'text/html')
      ;
    
    // Send the message
    $result = $mailer->send($message);




}


?>