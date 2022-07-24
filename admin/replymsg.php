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
    $to = $fm->validation( $_POST['toemail'] );
    $from = $fm->validation( $_POST['fromemail'] );
    $subject = $fm->validation( $_POST['subject'] );
    $message = $fm->validation( $_POST['message'] );

    $send_mail = mail($to, $subject, $message, $from);

    if( $send_mail ){
        echo '<span style="color:green; font-size:18px;"> Message has been sent successfully</span>';
    }else{
        echo '<span style="color:green; font-size:18px;"> Something went wrong! </span>';
    }
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
                                    <input readonly value="<?php echo $row['fname'] . " " . $row['lname']; ?>" type="text" name="toemail" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="fromemail" placeholder="Your email" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Subject</label>
                                </td>
                                <td>
                                    <input type="text" name="subject" placeholder="Mail subject" class="medium">
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Message</label>
                                </td>
                                <td>
                                    <textarea name="message" id="" cols="30" rows="10">

                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Send" />
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