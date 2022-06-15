<?php include 'inc/header.php'; ?>

<?php
$fm = new Format();



if (isset($_POST['submit'])) {
    $title = $fm->validation($_POST['title']);
    $slogan = $fm->validation($_POST['slogan']);

    // Image processing
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if(!empty($file_name)){
        move_uploaded_file($file_temp, $uploaded_image);

        $sql = "UPDATE blog_options
        SET
        title = '$title',
        slogan = '$slogan',
        logo = '$uploaded_image'
        WHERE id = 1;
        ";
    
        $result = $db->update($sql);
        if($result){
            echo 'Post updated';
        }else{
            echo 'Post cannot be udated!';
        }
    }else{
        $sql = "UPDATE blog_options
        SET
        title = '$title',
        slogan = '$slogan'
        WHERE id = 1;
        ";
    
        $result = $db->update($sql);
        if($result){
            echo 'Post updated';
        }else{
            echo 'Post cannot be udated!';
        }
    }

   
}


?>
<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
                <li><a class="menuitem">Site Option</a>
                    <ul class="submenu">
                        <li><a href="titleslogan.php">Title & Slogan</a></li>
                        <li><a href="social.php">Social Media</a></li>
                        <li><a href="copyright.php">Copyright</a></li>

                    </ul>
                </li>

                <li><a class="menuitem">Update Pages</a>
                    <ul class="submenu">
                        <li><a>About Us</a></li>
                        <li><a>Contact Us</a></li>
                    </ul>
                </li>
                <li><a class="menuitem">Category Option</a>
                    <ul class="submenu">
                        <li><a href="addcat.php">Add Category</a> </li>
                        <li><a href="catlist.php">Category List</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Post Option</a>
                    <ul class="submenu">
                        <li><a href="addpost.php">Add Post</a> </li>
                        <li><a href="postlist.php">Post List</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
            <?php
            $sql = "SELECT * FROM blog_options";
            $result = $db->select($sql);

            if ($result) : while ($row = $result->fetch_assoc()) : ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $row['title']; ?>" name="title" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $row['slogan']; ?>" name="slogan" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Logo</label>
                                </td>
                                <td>
                                    <img width="100px" height="70px" src="<?php echo $row['logo']; ?>" alt="upload your logo">
                                    <br>
                                    <input name="image" type="file" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                </td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                endwhile;
            endif; ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'; ?>