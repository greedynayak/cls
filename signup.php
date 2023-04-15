<?php
    require_once("connection.php");

    if(isset($_POST['sub']))
    {
        if(empty($_POST['name']) || empty($_POST['password']) || empty($_POST['email']))
        {
            echo ' Please Fill in the Blanks ';
        }
        else
        {
            $UserName = $_POST['name'];
            $UserEmail = $_POST['email'];
            $password = $_POST['password'];

            $query = " insert into users (user_name,user_password,user_email) values('$UserName','$password','$UserEmail')";
            $result = mysqli_query($con,$query);

            if($result)
            {
                header("location:signup.php");
            }
            else
            {
                echo '  Please Check Your details ';
            }
        }
    }
    else
    {
        header("location:index.php");
    }



?>

