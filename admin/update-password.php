<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php

            if(isset($_GET['id']))
            {
                $id=$_GET['id']; 
            }
        ?>

        <form action=""method="POST">

            <table class="tbl-thirty">

                <tr>

                    <td>Current Password:</td>

                    <td>

                        <input type="password" name="current_password" placeholder="Current Password">

                    </td>
                </tr>

                <tr>
                    <td> New Password:</td>

                    <td>

                        <input type="password" name="new_password" placeholder="New Password">

                    </td>
                </tr>

                <tr>

                    <td>Confirm Password:</td>

                    <td>

                    <input type="password" name="confirm_password" placeholder="Confirm Password">

                    </td>

                </tr>

                <tr>

                    <td colspan="2">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">

                    </td>
                    

                </tr>

            </table>

        </form>    

    </div>
</div>        

<?php

//chk ther whether submit button is clicked or not

if(isset($_POST['submit'])){

 //echo "ok";

 //get data form

    $_id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']); 

 //chk whether user is availabe or not
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //exuxute the query

    $res=mysqli_query($conn,$sql);

    if($res==true){

        $count=mysqli_num_rows($res);

        if($count==1){
           
            //user exist and password can be changed

           // echo "user found";

            //chk pass

            if($new_password==$confirm_password){
                
                //update password

                //echo "matched";

                $sql2="UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                
                ";

                $res2=mysqli_query($conn,$sql2);

                if($res==true){
                    
                    $_SESSION['change-pwd']="<div class='success'>Password changed successfully. </div>";

                    //redirect
        
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    

                }
                else{

                    $_SESSION['change-pwd']="<div class='success'>failed to change password. </div>";

                    //redirect
        
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }


            }
            else{

                //redirect to manage admin

                
            $_SESSION['pwd-not-match']="<div class='error'>Password did not matched. </div>";

            //redirect

            header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }
        else{

            $_SESSION['user-not-found']="<div class='error'>User Not Found. </div>";

            //redirect

            header('location:'.SITEURL.'admin/manage-admin.php');

             
        }
    }


 //chk whether new pass and confirm pass mathched or not
}


?>

<?php include('partials/footer.php');?>
