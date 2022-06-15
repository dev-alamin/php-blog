<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    header('Location:index.php');
} else {
    $id = $_GET['id'];

    $sql = "SELECT * FROM post WHERE id = $id";
    $edit_post = $db->select($sql);
}
?>
<?php include 'inc/sidebar.php'; ?>


<?php


if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $content = mysqli_real_escape_string($db->link, $_POST['content']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $category = mysqli_real_escape_string($db->link, $_POST['select']);

    // Image processing
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    // Add post to db
    if (!empty($file_name)) {
        move_uploaded_file($file_temp, $uploaded_image);

        $sql = "
                UPDATE post
                SET
                cat = '$category',
                title = '$title',
                body = '$content' ,
                image = '$uploaded_image' ,
                author = '$author',
                tags = '$tags'
                WHERE id = $id
                ";

        $add_post = $db->update($sql);

        if ($add_post) {
            echo '<span style="color:blue;">Post updated successfully!</span>';
        } else {
            echo '<span style="color:red;">Post cannot be updated!</span>';
        }
    } else {
        $sql = "
        UPDATE post
        SET
        cat = '$category',
        title = '$title',
        body = '$content' ,
        author = '$author',
        tags = '$tags'
        WHERE id = $id
        ";

        $add_post = $db->update($sql);
    }
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <div class="block">
            <?php if (isset($edit_post) && !$edit_post == FALSE) : ?>
                <?php while ($row = $edit_post->fetch_assoc()) : ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input name="title" type="text" value="<?php echo $row['title']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <?php
                                    $sql = "SELECT * FROM category";
                                    $result = $db->select($sql);
                                    ?>
                                    <select id="select" name="select">
                                        <?php while ($category = $result->fetch_assoc()) : ?>
                                            <option <?php if ($category['id'] == $row['cat']) : ?> selected="selected" <?php endif; ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $row['image']; ?>" alt="" width="80px" height="50px">
                                    <br>
                                    <input name="image" type="file" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea name="content" class="tinymce">
                                   <?php echo $row['body']; ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input value="<?php echo $row['tags']; ?>" name="tags" type="text" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input value="<?php echo $row['author']; ?>" name="author" type="text" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>