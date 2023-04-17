<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>


        <br><br>

        <?php

            //chk whether id is set or not

            if(isset($_GET['id']))
            {
                //get the id and all other details

                //echo "getting data";

                $id=$_GET['id'];

                //create sql query

                $sql="SELECT * FROM tbl_category WHERE id=$id";

                //execute the query

                $res=mysqli_query($conn,$sql);

                //count the rows to chk whether id is valid or not

                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //get the data

                    $row=mysqli_fetch_assoc($res);

                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                }
                else{

                    //redirect to manage-category

                    $_SESSION['no-category-found']="<div class='error'>Category Not Found.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');
                }


            }
            else{

                //redirect to manage category

                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-thirty">
            <tr>

                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>

            </tr>

            <tr>
                <td>Current Image: </td>

                <td>
                    <?php

                        if($current_image!=""){

                            ?>

                            <img scr="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">

                            <?php

                        }
                        else{

                            echo "<div class='error'>Image Not Added.</div>";

                        }
                    
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>

                <td>Featured: </td>

                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>

            </tr>

            <tr>

                <td>Active: </td>

                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No

                </td>

            </tr>

            <tr>

                <td>

                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        
        </table>

        </form>

        <?php

            if(isset($_POST['submit'])){

                //echo "clicked";

                //get all the values from form
                $id=$_POST['id'];

                $title=$_POST['title'];

                $current_image=$_POST['current_image'];

                $featured=$_POST['featured'];

                $active=$_POST['active'];

                //update new image

                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];

                    //chk whether is available or not

                    if($image_name!=""){

                        //available

                        //upload the new image

                        $ext=end(explode('.',$image_name));  //get extension of image


                         //rename the image

                        $image_name="Food_Category_".rand(000,999).'.'.$ext; 

 
                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        $upload= move_uploaded_file($source_path,$destination_path);

                        //chk whether image is uploaded or not

                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";

                            header('location:'.SITEURL.'admin/manage-category.php');

                            //stop the process

                            die();
                        }
                       

                        //remove current image

                        if($current_image!=""){

                            $remove_path="../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //chk whether img is remove or not

                            if($remove==false)
                            {
                                //failed to remove img

                                $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image.</div>";

                                header('location:'.SITEURL.'admin/manage-category.php');

                                die();
                            }
                        }

                         
                    }
                    else{

                        $image_name=$current_image;
                    }
                }
                else{

                    $image_name=$current_image;
                }

                //update database

                $sql2="UPDATE tbl_category SET
                
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";

                //execute the query

                $res2=mysqli_query($conn,$sql2);



                //redirect to manage category

                if($res2==true){

                    //category updated
                    $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{

                    //failed

                    $_SESSION['update']="<div class='error'>Failed to Update Category.</div>";

                    header('location:'.SITEURL.'admin/manage-category.php');


                }

            }

        ?>
    </div>
</div>    

<?php
    include('partials/footer.php');
?>