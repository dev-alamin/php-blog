<!-- include db  -->
<?php

include '../lib/class.session.php';
// call the session init method 
Session::CheckLogin();

include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';

$fm = new Format();
$db = new Database();

?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">

			<?php
			if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $fm->validation($_POST['username']);
				$password = $fm->validation(md5($_POST['password']));

				$username = mysqli_real_escape_string($db->link, $username);
				$password = mysqli_real_escape_string($db->link, $password);

				$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
				$result = $db->select($sql);
				if ($result !== false) {
					$value = mysqli_fetch_array($result);
					$row = mysqli_num_rows($result);

					if ($row > 0) {
						Session::set('login', true);
						Session::set('userName', $value['username']);
						Session::set('displayName', $value['name']);
						Session::set('userID', $value['id']);
						Session::set('userRole', $value['role']);
						header('Location: index.php');
					} else {
						echo '<span style="color:red;">No result found</span>';
					}
				} else {
					echo '<span style="color:red;"> Username or password not match </span>';
				}
			}
			?>

			<form action="" method="post">
				<h1>Admin Login</h1>
				<div>
					<input type="text" placeholder="Username" required="" name="username" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input name="submit" type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>