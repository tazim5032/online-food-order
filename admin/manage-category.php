<?php include('partials/menu.php'); ?> 

<div class="main-content">

    <div class="wrapper">

        <h1>Manage Category</h1>


        <br/>
        <br/>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }


        ?>

        <br><br>

        <!--Button to Add Admin-->

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class ="btn-primary">Add Category</a>
 
        <br/> 
        <br/>  

        <table class="tbl-full">

            <tr>

                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>


            </tr>

            <?php

                $sql="SELECT * FROM tbl_category";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                //create serial no

                $sn=1;

                //chhk whether datbase exist or not

                if($count>0){

                    //yes

                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];

                       // echo $image_name;
                        
                      //  echo SITEURL;

                        ?>

                        <tr>

                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php

                                if($image_name!=""){

                                    ?>   
                                        <img scr="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="image">
                                        
                                    <?php
                                    
                                }
                                else{

                                    echo "<div class='error'>Image not Added.</div>";
                                }

                            ?>


                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>

                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                        </tr>

                        <?php
                    }
                }
                else{

                    //no
                    ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>

                        </tr>



                    <?php

                }
            ?>    
          
        </table>

    </div>

</div>


<?php include('partials/footer.php'); ?>