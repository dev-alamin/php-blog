<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
    header('Location:inbox.php');
} else {
    $id = $_GET['msgid'];
    $sql = "SELECT * FROM
    category 
    WHERE id = $id
    ORDER BY id DESC";

    $result = $db->select($sql);
}

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    echo "<script> window.location = 'inbox.php'; </script>";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
        <div class="block">
            <form action="" method="POST" enctype="multipart/form-data">
                <?php
                $sql = "SELECT * FROM contact WHERE id = $id";
                $result = $db->select($sql);
                $sn = 0;
                ?>
                <?php
                if ($result) :
                    while ($row = $result->fetch_assoc()) : ?>
                        <?php $sn++; ?>
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $row['fname'] . " " . $row['lname']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $row['email']; ?>" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Date</label>
                                </td>
                                <td>
                                    <input readonly value="<?php echo $fm->formatDate($row['date']); ?>" type="text" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message</label>
                                </td>
                                <td>
                                    <textarea name="content" id="" cols="30" rows="10">
                                        <?php echo $row['email']; ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                <?php
                    endwhile;
                endif;
                ?>
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



