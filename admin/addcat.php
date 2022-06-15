<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <?php
            if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);

              if(!empty($name)){
                $sql = "INSERT INTO category (name) VALUES('$name')";

                $catinsert = $db->insert($sql);

                if ($catinsert) {
                    echo '<span style="color:blue;">Category inserted successfully!</span>';
                }else{
                    echo '<span style="color:red;">Category cannot be inserted!</span>';
                }
              }else{
                  echo 'Field must not be empty!';
              }
            }
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input name="name" type="text" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
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
<?php include 'inc/footer.php'; ?>