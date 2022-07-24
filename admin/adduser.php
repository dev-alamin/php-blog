<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
            <?php
            if ( isset( $_POST['submit'] ) && $_SERVER['REQUEST_METHOD'] == "POST" ) {
                $username = $fm->validation( $_POST['username']);
                $password = $fm->validation( md5( $_POST['password'] ) );
                $role = $fm->validation( $_POST['role'] );

                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);
                $role = mysqli_real_escape_string($db->link, $role);

                if (!empty( $username ) && !empty( $password ) ) {
                    $sql = "INSERT INTO user (username, password, role) VALUES('$username', '$password', '$role')";

                    $user = $db->insert($sql);

                    if ( $user ) {
                        echo '<span style="color:blue;">User created successfully!</span>';
                    } else {
                        echo '<span style="color:red;">User created be inserted!</span>';
                    }

                } else {
                    echo 'Username & password must not be empty!';
                }
            }
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label for="">Username</label>
                        </td>
                        <td>
                            <input name="username" type="text" placeholder="Enter Username" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" type="text" placeholder="Enter User Password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Role</label>
                        </td>
                        <td>
                            <select name="role" id="role">
                                <option disabled selected>Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create User" />
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