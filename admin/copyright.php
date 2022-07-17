<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php

        /**
         * Update query
         */
        if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

            $cr = $fm->validation($_POST['copyright']);

            $sql = "
                            UPDATE blog_options
                            SET 
                            copyright = '$cr'
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
        <div class="block copyblock">
            <form method="POST" action="">
                <table class="form">
                    <tr>
                        <td>

                            <?php
                            $sql = "SELECT copyright FROM blog_options";
                            $result = $db->select($sql);
                            ?>
                            <?php
                            if ($result) :
                                while ($row = $result->fetch_assoc()) :
                            ?>

                                    <input type="text" value="<?php echo $row['copyright']; ?>" placeholder="Enter Copyright Text..." name="copyright" class="large" />

                            <?php
                                endwhile;
                            endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
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
<div class="clear">
</div>
<div id="site_info">
    <p>
        &copy; Copyright <a href="http://trainingwithliveproject.com">Training with live project</a>. All Rights Reserved.
    </p>
</div>
</body>

</html>