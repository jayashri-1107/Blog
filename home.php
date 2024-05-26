<?php
require('connection.php');
// require('connection2.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
    <style>
    
*{
    font-family:poppins;
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    background-color:white;
}
div.data{
    padding:30px 60px;
}
div.data table{
    width: 100%;
    border:2px solid black;
    text-align:center;

}
table,table td,table tr,table th{
    border:2px solid black;
    padding:10px 20px;
    border-collapse:collapse;
}
table thead{
    background-color:yellow;
}
    </style>
</head>
<body>
    <header1>
        <h3>BLOGGER</h3>
        <nav>
            <a href="#">POST'S</a> 
            <a href="post.php">NEW-ADD</a>
           
            
        </nav> 
        <?php
        
        if(isset($_SESSION['logged_in'])&& $_SESSION['logged_in']==true)
        {
            echo"
            <div class='user'>
            $_SESSION[username] - <a href='logout.php'>LOGOUT</a>
            </div>";
        }
    ?>
        
</header1>

<div class="data">

    <table>
    <thead>
        <th>Srno</th>
        <th>Title</th>
        <th>Category</th>
        <th>Content</th>
        <th>Profile</th>
        </thead>
        <tbody>
        <?php
        $query="SELECT * FROM blog";
        $result=mysqli_query($con,$query);
        while($row_fetch=mysqli_fetch_assoc($result))
        {
            echo"
            <tr>
            <td>$row_fetch[srno]</td>
            <td>$row_fetch[title]</td>
            <td>$row_fetch[category]</td>
            <td>$row_fetch[content]</td>
            <td><img src='$row_fetch[profile]' width='150px'></td>
            
            
            </tr>
            ";
        }
        
        
        ?>
        
        </tbody>
    </table>
    </div>
</body>
</html>