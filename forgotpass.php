<?php
require('connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$reset_token)
{
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    
try {
                         
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jayashripatil658@gmail.com';                     //SMTP username
    $mail->Password   = 'lhbl cybx tils swxe';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

   
    $mail->setFrom('jayashripatil658@gmail.com', 'J-WEB');
    $mail->addAddress($email);    
    


   
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password reset link from J-WEB';
    $mail->Body    = "We got a request from you to reset your password<br>  
    Click the link below <br><a href='http://localhost/task/updatepass.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
    

    $mail->send();
    return true;
   } catch (Exception $e) {
   return false;
    }
}


if(isset($_POST['send-reset-link']))
{
    $query="SELECT * FROM reg WHERE email='$_POST[email]'";
    $result=mysqli_query($con,$query);
    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
          $reset_token=bin2hex(random_bytes(16));
          date_default_timezone_set('Asia/kolkata');
          $date=date("Y-m-d");
          $query="UPDATE reg SET resettoken='$reset_token',resettokenexpire='$date' WHERE email='$_POST[email]'";
          if(mysqli_query($con,$query)&& sendMail($_POST['email'],$reset_token))
          {
            echo"<script>alert('Password reset link send to mail');
            window.localhost.href='index.php';</script>";
          }
          else
          {
            echo"<script>alert('Server down...!');
            window.localhost.href='index.php';</script>";
          }

        }
        else
        {
            echo"<script>alert('email not found');
        window.localhost.href='index.php';</script>";
        }
    }
    else{
        echo"<script>alert('can not run query');
        window.localhost.href='index.php';</script>";
    }
}


?>