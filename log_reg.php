<?php
$con=mysqli_connect('localhost','root','','task');
session_start();



#for log in
if(isset($_POST['login']))
{
    $query="SELECT * FROM reg WHERE email='$_POST[email_username]' OR username='$_POST[email_username]'";
    $result=mysqli_query($con,$query);

    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
           $result_fetch=mysqli_fetch_assoc($result);
           

           
           if(password_verify($_POST['password'],$result_fetch['password']))
           {
             $_SESSION['logged_in']=true;
             $_SESSION['username']=$result_fetch['username'];
             header("location:home.php");
           }
           else
           {
            echo"
            <script>
            alert('incorrect password');
        window.location.href='index.php';
        </script>
        "; 
           }

        }
        else{
            echo"
                        <script>
                        alert('Email or username not registred');
                    window.location.href='index.php';
                    </script>
                    "; 
        }

        
    }
    else{
        echo"
                    <script>
                    alert('can not run query....');
                window.location.href='index.php';
                </script>
                "; 
    }

    }
    


#for sign in
if(isset($_POST['sign']))
{
    
    $sql="SELECT * FROM reg WHERE username='$_POST[username]' OR email='$_POST[email]'";
    $result=mysqli_query($con,$sql);

    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['username']==$_POST['username'])
            {
                echo"
                <script>
                alert('$result_fetch[username] - Username already taken');
                    window.location.href='index.php';
                    </script>
                    ";
            }

            else   
            {
                echo"
                <script>
                alert('$result_fetch[email] E-mail already registred');
                window.location.href='index.php';
                </script>
                ";

            }
        }
    
            else
            {
                $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
                
                
                $query="INSERT INTO reg(fullname, username, email, password) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";
                if(mysqli_query($con,$query))
                {
                    echo"
                    <script>
                    alert('sign-in Successfuly');
                    window.location.href='index.php';
                    </script>
                    "; 
                }
                else
                {

                    echo"
                    <script>
                    alert('Server Down !');
                window.location.href='index.php';
                </script>
                "; 
                }
            }
    
    }
    else
    {

            echo "
            <script>
            alert('not run query.....');
           window.location.href='index.php';
           </script>
           "; 
    }
}
?>