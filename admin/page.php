<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<style>
    a.delpage {
        display: inline-block;
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        padding: 2px 10px;
    }
</style>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
    header('Location:index.php');
} else {
    $id = $_GET['pageid'];

    $sql = "SELECT * FROM pages WHERE id = $id";
    $edit_page = $db->select($sql);
}


if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $content = mysqli_real_escape_string($db->link, $_POST['content']);
    // Add post to db
    if (!empty($title)) {

        $sql = "
        UPDATE pages
        SET
        title = '$title',
        content = '$content' 
        WHERE id = '$id' ";

        $updated_page = $db->update($sql);

        if ($updated_page) {
            echo '<span style="color:blue;">Page updated successfully!</span>';
        } else {
            echo '<span style="color:red;">Page cannot be updated!</span>';
        }
    } else {
        echo 'Title must not be empty!';
    }
}



/**
 * Show added valu 
 * 
 */

$sql = "SELECT * FROM pages WHERE id = $id";
$edit_page = $db->select($sql);

?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
        <div class="block">
            <?php if ($edit_page) : ?>
                <?php while ($row = $edit_page->fetch_assoc()) : ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input value="<?php echo $row['title'] ?>" name="title" type="text" placeholder="Enter Post Title..." class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea name="content" class="tinymce">
                             <?php echo $row['content'] ?>
                            </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                    <a class="delpage" href="delpage.php?id=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php endwhile;
            endif;
            ?>
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