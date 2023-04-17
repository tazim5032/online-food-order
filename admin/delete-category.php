<?php

    //include constant file

    include('../config/constants.php');

    //echo "Delete page"

    //chk whether id & image_name value is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name'])){

        //get the value
       // echo 'get the value'; 
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the physical img file

        if($image_name!=""){

            //image available

            $path="../images/category/".$image_name;

            $remove=unlink($path);

            if($remove==false)
            {
                $_SESSION['remove']="<div class='error'>Failed to remove category image.</div>";

                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }

        }

        //delete data from database

        $sql="DELETE FROM tbl_category WHERE id=$id";

        //execute the query

        $res = mysqli_query($conn,$sql);

        //chk whether data is deleted from database or not

        if($res==true)
        {
            //success & redirect

            $_SESSION['delete']="<div class='success'>Category deleted succesfully</div>";

            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else{

            //failed & redirect

            $_SESSION['delete']="<div class='error'>Failed to delete category</div>";


            header('location:'.SITEURL.'admin/manage-category.php');

        }

        //redirect to manage category page


    }
    else{

        //redirect to manage category page

        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>