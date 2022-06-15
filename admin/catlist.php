<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php';

$db = new Database();
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

        <?php
        if (isset($_GET['delcat'])) {
            $id = $_GET['delcat'];

            $sql = "DELETE FROM category WHERE id = $id";
            $delcat = $db->delete($sql);

            if ($delcat) {
                echo 'Category deleted successfully!';
            } else {
                echo 'Category cannot be deleted!';
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM category";
                    $result = $db->select($sql);
                    $sn = 0;
                    ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <?php $sn++; ?>
                        <tr class="odd gradeX">
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><a href="editcat.php?catid=<?php echo $row['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?');" href="?delcat=<?php echo $row['id']; ?>">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>

<script>
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>
<?php include 'inc/footer.php'; ?>