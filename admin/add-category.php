<?php include('partials/menu.php'); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>


        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>

        <!--Add category form starts here-->


        <form action=""method="POST" enctype="multipart/form-data">

            <table class="tbl-thirty">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>

                </tr>

                <tr>

                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">

                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td>Active: </td>

                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No

                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>    

                </tr>
            </table>


        </form>


        <!--Add category form ends here-->


        <?php

            //whether submit button is clicked or not

            if(isset($_POST['submit'])){

                //echo "Clicked";

                //get the value from category form

                $title=$_POST['title'];
            
                //for radio input type we need to chk whether the button is selected or not

                if(isset($_POST['featured']))
                {
                    //get the value

                    $featured=$_POST['featured'];
                }
                else{

                    //set the default value
                    $featured="No";
                }

                if(isset($_POST['active']))
                {

                    $active=$_POST['active'];
                }
                else{

                    $active="No";
                }

                //chk whether the image is selected or not

               // print_r($_FILES['image']); 

               // die(); //brk the code here

               if(isset($_FILES['image']['name']))
               {
                    //upload the image

                    $image_name=$_FILES['image']['name'];

                      

                    if($image_name!=""){


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

                            header('location:'.SITEURL.'admin/add-category.php');

                            //stop the process

                            die();
                        }
                    }
               }
               else
               {
                    //don't upload the image

                    $image_name="";
               }

                //create sql query to insert the category in database

                $sql="INSERT INTO tbl_category SET 
                    title='$title', 
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //execute the query

                $res=mysqli_query($conn,$sql);

                //chk whether query is executed or not

                if($res==true){

                    //executed

                    $_SESSION['add']="<div class='success'>Category Added Successfully.</div>";

                    //redirect

                    header('location:'.SITEURL.'admin/manage-category.php');


                }
                else{

                    //not executed

                    $_SESSION['add']="<div class='error'>Failed to add category.</div>";

                    //redirect

                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }

        ?>



    </div>

</div>

<?php include('partials/footer.php'); ?>