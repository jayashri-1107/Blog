<?php

$con=mysqli_connect('localhost','root','','task');

if(mysqli_connect_error()){
    echo "<script>alert('can not connect to data base');</script>";
    exit();
}

?>