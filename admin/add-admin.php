<?php include('partials/menu.php'); ?>


<div class="main-content">

    <div class="wrapper">

        <h1>Add Admin</h1>

        <br/><br/>

        <?php

            if(isset($_SESSION['add'])){

                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-thirty">

                <tr>
                    
                    <br/>
                    <td>Full Name: </td>

                    <td> 

                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>

                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>

                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>


                <tr>

                    <td colspan="2">

                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>            
    </div>    


</div>

<?php include('partials/footer.php'); ?>

<?php

    //process the value from Form and save it in database

    //check wheather submit button is clicked or not

    if(isset($_POST['submit'])){

            //button clicked

            // echo "Button Clicked";

            //get the data from Form

            $full_name = $_POST['full_name'];
            $username = $_POST['username']; 
            $password = md5($_POST['password']); //md5 is used for password Encryption


            //SQL query to save the data in database

            $sql = "INSERT INTO tbl_admin SET
            
                full_name='$full_name',
                username='$username',
                password='$password'

            
            ";

           // echo $sql;

    
            //execute query and saving data into database
            $res = mysqli_query($conn,$sql) or die(mysqli_error());


            //check wheather the data is inserted or not and display the feedback

            if($res==TRUE){

                //data inserted

                //echo "Inserted";

                $_SESSION['add'] = "Admin Added Successfully";

                //Redirect page to manage admin

                header("location:".SITEURL.'admin/manage-admin.php');
            }
            else{

                //insertion failed

                //echo "Failed";

                $_SESSION['add'] = "Failed to Add Admin";

                //Redirect page to add admin

                header("location:".SITEURL.'admin/add-admin.php');
            }


    }


?>