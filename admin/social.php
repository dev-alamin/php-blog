<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php

/**
 * Update query
 */
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $fb = $fm->validation($_POST['facebook']);
    $tt = $fm->validation($_POST['twitter']);
    $ln = $fm->validation($_POST['linkedin']);
    $gp = $fm->validation($_POST['googleplus']);

    $sql = "
    UPDATE social
    SET 
    fb = '$fb',
    tt = '$tt',
    ln = '$ln',
    gp = '$gp'
    WHERE id = 1
 ";

    $updated = $db->update($sql);

    if ($updated) {
        echo 'Data updated';
    } else {
        echo 'Data could not be updated!';
    }
}



?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">
            <form method="POST" action="">
                <table class="form">
                    <?php
                    $sql = "SELECT * FROM social";
                    $result = $db->select($sql);
                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" placeholder="Facebook link.." class="medium" value="<?php echo $row['fb']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" placeholder="Twitter link.." class="medium" value="<?php echo $row['tt']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" placeholder="LinkedIn link.." class="medium" value="<?php echo $row['ln']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" placeholder="Google Plus link.." class="medium" value="<?php echo $row['gp']; ?>" />
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<?php include 'inc/footer.php'; ?>