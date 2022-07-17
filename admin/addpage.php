<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $content = mysqli_real_escape_string($db->link, $_POST['content']);
    // Add post to db
    if (!empty($title)) {

        $sql = "
                INSERT INTO pages
                (title, content) 
                VALUES('$title', '$content')";

        $add_post = $db->insert($sql);

        if ($add_post) {
            echo '<span style="color:blue;">Post added successfully!</span>';
        } else {
            echo '<span style="color:red;">Post cannot be added!</span>';
        }
    } else {
        echo 'Title must not be empty!';
    }
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Page</h2>
        <div class="block">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input name="title" type="text" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="content" class="tinymce">
                            </textarea>
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