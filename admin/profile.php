<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$user_id = Session::get('userID');
$user_role = Session::get('userRole');
$user_name = Session::get('userName');
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>View or Update Profile</h2>
        <div class="block copyblock">
            <?php
            if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                $name = $fm->validation($_POST['name']);
                $username = $fm->validation($_POST['username']);
                $email = $fm->validation($_POST['email']);
                $details = $fm->validation($_POST['details']);

                $name = mysqli_real_escape_string($db->link, $name);
                $username = mysqli_real_escape_string($db->link, $username);
                $email = mysqli_real_escape_string($db->link, $email);
                $details = mysqli_real_escape_string($db->link, $details);

                if ( ! empty( $username ) ) {
                    $sql = "UPDATE user 
                    SET 
                    name = '$name',
                    username = '$username',
                    email = '$email',
                    details = '$details'

                    WHERE id = $user_id";

                    $update_profile = $db->update($sql);

                    if ($update_profile) {
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
            <?php
            $sql = "SELECT * FROM user WHERE id = $user_id AND role = $user_role";
            $result = $db->select($sql);
            ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td><label for="">Name</label></td>
                            <td>
                                <input name="name" type="text" value="<?php echo $row['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Username</label></td>
                            <td>
                                <input name="username" type="text" value="<?php echo $row['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Email</label></td>
                            <td>
                                <input name="email" type="text" value="<?php echo $row['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="">Details</label></td>
                            <td>
                                <textarea name="details" id="" cols="30" rows="10">
                                     <?php echo $row['details']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Information" />
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