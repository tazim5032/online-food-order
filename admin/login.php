<?php include('../config/constants.php'); ?>

<html>

    <head>
        <title>Login - Food order System</title>
        <link rel="stylesheet" href="../css/admin.css">

    </head>

    <body>

        <div class="login">

            <h1 class="text-center">Login</h1>
            <br><br>

            <?php

                if(isset($_SESSION['login'])){

                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){

                    echo  $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>

            <br><br>

            <!-- login start here-->

            <form action=""method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br> 

                <input type="submit" name="submit" value="login" class="btn-primary">

                <br><br>

            </form>

            <!--login ends here-->

            <p class="text-center">Created By - <a href="https://www.facebook.com/tazimulislam.salam/">Md Fakhrul Islam</a></p>
        </div>    
    </body>
</html>

<?php

//chk whether sumit button is clicked or not

    if(isset($_POST['submit'])){

        //process for login

        //1.get the data from login form

        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //sql for whether username or password exist or not

        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //execute the query

        $res=mysqli_query($conn,$sql);

        //count the rows whether user exist or not

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //user available

            $_SESSION['login']="<div class='success'>Login successful.</div>";


            $_SESSION['user']=$username;

            //redirect

            header('location:'.SITEURL.'admin/');
        }
        else{

            //not available

            $_SESSION['login']="<div class='error text-center'>Username or password didn't match.</div>";

            //redirect

            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>