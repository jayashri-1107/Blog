<?php
require('connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER-LOG IN & REG</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- <h3>TREND</h3>
        <nav>
            <a href="#">HOME</a> 
            <a href="blog">BLOG</a>
            <a href="#">CONTACT</a>
             <a href="#">ABOUT US</a> 
        </nav> -->
        <?php
        
        if(isset($_SESSION['logged_in'])&& $_SESSION['logged_in']==true)
        {
            // echo"
            // <div class='user'>
            // $_SESSION[username] - <a href='logout.php'>LOGOUT</a>
            // </div>";
            header("location: home.php");

        }
        else{
            echo"
            <div class='sign-in-up'>
            <button type='button' onclick=\"popup('login-popup')\">LOG-IN</button>
            <button type='button' onclick=\"popup('sign-popup')\">SIGN-UP</button>
        </div>";
      }


       ?>
        
</header>




<div class="popup-container" id="login-popup">
    <div class="popup">
        <form action="log_reg.php" method="POST">
    <h2>
        <span>USER LOGIN</span>
        <button type="reset" onclick="popup('login-popup')">X</button>
    </h2>
    <input type="text" placeholder="E-mail or Username" name="email_username">
    <input type="password" placeholder="Password" name="password">
    <button type="submit" class="login-btn" name="login">LOGIN</button>
        </form>
        <div class="forgot-btn">
            <button type="button" onclick="forgotPopup()">Forgot Password ?</button>
        </div>
    </div>
</div>
<div class="popup-container" id="sign-popup">
    <div class="sign popup">
        <form action="log_reg.php" method="POST" >
    <h2>
        <span>USER SIGN-UP</span>
        <button type="reset" onclick="popup('sign-popup')">X</button>
    </h2>
    <input type="text" placeholder="Full Name" name="fullname">
    <input type="text" placeholder="Username" name="username">
    <input type="email" placeholder="E-mail" name="email">


    <input type="password" placeholder="Password" name="password">
    <button type="submit" class="sign-btn" name="sign">Sign</button>
        </form>
    </div>
</div>
 
<div class="popup-container" id="forgot-popup">
    <div class="forgot popup">
        <form action="forgotpass.php" method="POST">
    <h2>
        <span>RESET PASSWORD</span>
        <button type="reset" onclick="popup('forgot-popup')">X</button>
    </h2>
    <input type="email" placeholder="E-mail" name="email">
 
    <button type="submit" class="reset-btn" name="send-reset-link">SEND LINK</button>
        </form>
        
    </div>
</div>




<script>
    function popup(popup_name)
    {
 get_popup=document.getElementById(popup_name);
 if(get_popup.style.display=="flex")
 {
    get_popup.style.display="none";
 }
 else{

    get_popup.style.display="flex";
}
    }
    function forgotPopup(){
        document.getElementById('login-popup').style.display="none"; 
        document.getElementById('forgot-popup').style.display="flex";  
    }
</script>
</body>
</html>