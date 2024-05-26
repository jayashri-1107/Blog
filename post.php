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
    <title>POST</title>
    <link rel="stylesheet" href="style.css">
    <style>
        input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}


button[type=submit] {
  background-color: black;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


button[type=submit]:hover {
  background-color: #45a049;
}


.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
    </style>
</head>
<body>
<header1>
        <h3>BLOGGER</h3>
        <nav>
            <a href="home.php">POST'S</a> 
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
    
<div class="container">
  <form method="POST" enctype="multipart/form-data">

    <label for="fname">Enter Title</label>
    <input type="text" name="title" placeholder="Title">


    <label>Category</label>
    <select name="category">
      <option value="Sport">Sports</option>
      <!-- <option value="Tech">Tech</option> -->
      <option value="Trend">Trend</option>
    </select>

    <label>Content</label>
    <textarea name="content" placeholder="Write content.." style="height:200px"></textarea>

    <label>Select An Image</label><br><br>
    <input type="file" name="profile"><br><br><br>

    <button type="submit" name="upload">UPLOAD</button>

  </form>
</div>

<?php

if(isset($_POST['upload']))
{
   $img_loc=$_FILES['profile']['tmp_name'];
   $img_name=$_FILES['profile']['name'];
   $title=$_POST['title'];
   $category=$_POST['category'];
   $content=$_POST['content'];
   $img_ext=pathinfo($img_name,PATHINFO_EXTENSION);

   
   $img_des="uploadimg/".$img_name;

   if(($img_ext!='jpg')&&($img_ext!='png')&&($img_ext!='jpeg')&&($img_ext!='webp'))
   {
    echo"<script>alert('Invalid image extention !');</script>";
    exit();
   }


   $query="INSERT INTO blog(title,category,content, profile) VALUES ('$title','$category','$content','$img_des')";
   if(mysqli_query($con,$query))
   {
    move_uploaded_file($img_loc,$img_des);
    echo"<script>alert('Successful');</script>";
    header("location:home.php");
   }
   else
   {
    echo"<script>alert('Un-successful');</script>";
   }
}

?>
</body>
</html>