<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    header('Location:catlist.php');
} else {
    $id = $_GET['catid'];
    $sql = "SELECT * FROM category WHERE id = $id order by id desc";
    $result = $db->select($sql);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <?php
            if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);

                if (!empty($name)) {
                    $sql = "UPDATE category SET name = '$name' WHERE id = $id";

                    $update_cat = $db->update($sql);

                    if ($update_cat) {
                        echo '<span style="color:blue;">Category updated successfully!</span>';
                    } else {
                        echo '<span style="color:red;">Category cannot be updated!</span>';
                    }
                } else {
                    echo 'Field must not be empty!';
                }
            }
            ?>
            <!-- show previous value into input field  -->
            <?php while ($row = $result->fetch_assoc()) : ?>
                <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <input name="name" type="text" value="<?php echo $row['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'; ?>