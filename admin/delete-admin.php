<?php
    
    include('../config/constants.php');

    //get the id of admin to be deleted

    $id = $_GET['id']; 

    //create sql query to delete admin

    $sql="DELETE FROM tbl_admin WHERE id=$id";

    //execute the query

    $res=mysqli_query($conn,$sql);

    if($res==TRUE)
    {
        //echo "Admin Deleted Successfully"; 

        $_SESSION['delete']="<div class='Success'>Admin Deleted Successfully.</div>";

        //redirect to manage admin page

        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to Delete Admin";

        $_SESSION['delete']="<div class='error'>Failed to delete admin.</div>";

        //redirect to manage admin page

        header('location:'.SITEURL.'admin/manage-admin.php');


    }

    
    //redirect to manage admin page with message(success/error)



?>