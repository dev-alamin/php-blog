<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM contact WHERE status = '0'";
                    $result = $db->select($sql);
                    $sn = 0;
                    ?>
                    <?php
                    if ($result) :
                        while ($row = $result->fetch_assoc()) : ?>
                            <?php $sn++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $fm->shortenText($row['body'], 80); ?></td>
                                <td><?php echo $fm->formatDate($row['date']); ?></td>
                                <td><a href="viewmsg.php?msgid=<?php echo $row['id']; ?>">View</a> ||
                                    <a href="replymsg.php?msgid=<?php echo $row['id']; ?>">Reply</a> ||
                                    <a href="?seenid=<?php echo $row['id']; ?>">Seen</a>
                                </td>
                            </tr>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="box round first grid">
        <h2>Seen Message</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['seenid']) && $_GET['seenid'] !== NULL) {
                        $seenid = $_GET['seenid'];

                        $seen_sql = "UPDATE contact
                        SET
                        status  = '1'
                        WHERE id = $seenid
                        ";

                        $update_status = $db->update( $seen_sql );

                        if($update_status){
                            echo '<span style="color:green;">Message sent to seen section</span>';
                           echo '<script> window.location = "inbox.php"</script>';
                        }else{
                            echo '<span style="color:green;">Message sent to seen section</span>';
                        }
                    }


                    if (isset($_GET['unseen']) && $_GET['unseen'] !== NULL) {
                        $unseenid = $_GET['unseen'];

                        $unseen_sql = "UPDATE contact
                        SET
                        status  = '0'
                        WHERE id = $unseenid
                        ";

                        $unseen = $db->update( $unseen_sql );

                        if($unseen){
                            echo '<span style="color:green;">Message sent to unseen section</span>';
                            echo '<script> window.location = "inbox.php"</script>';
                        }else{
                            echo '<span style="color:green;">Message sent to unseen section</span>';
                        }
                    }

                    if (isset($_GET['delid']) && $_GET['delid'] !== NULL) {
                        $delete_id = $_GET['delid'];

                        $delete_msg = "DELETE FROM contact WHERE id = $delete_id";

                        $delete = $db->delete( $delete_msg );

                        if($delete){
                            echo '<span style="color:green;">Message deleted</span>';
                        }else{
                            echo '<span style="color:green;">Message could not be deleted</span>';
                        }
                    }

                    $sql = "SELECT * FROM contact WHERE status = '1'";
                    $result = $db->select($sql);
                    $sn = 0;
                    ?>
                    <?php
                    if ($result) :
                        while ($row = $result->fetch_assoc()) : ?>
                            <?php $sn++; ?>
                            <tr class="odd gradeX">
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $fm->shortenText($row['body'], 80); ?></td>
                                <td><?php echo $fm->formatDate($row['date']); ?></td>
                                <td><a href="viewmsg.php?msgid=<?php echo $row['id']; ?>">View</a> ||
                                <td><a href="?unseen=<?php echo $row['id']; ?>">Unseen</a> ||
                                    <a onclick="return confirm('Are you sure to delete this message');" href="?delid=<?php echo $row['id']; ?>">Delete</a>
                                </td>
                            </tr>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'; ?>