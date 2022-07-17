<?php include 'inc/header.php'; ?>
<?php
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$fname = $fm->validation($_POST['firstname']);
	$lname = $fm->validation($_POST['lastname']);
	$email = $fm->validation($_POST['email']);
	$body = $fm->validation($_POST['body']);

	$fname = mysqli_real_escape_string($db->link, $fname);
	$lname = mysqli_real_escape_string($db->link, $lname);
	$email = mysqli_real_escape_string($db->link, $email);
	$body = mysqli_real_escape_string($db->link, $body);

	$error = "";
	if (empty($fname)) {
		$error = 'First Name Cannot be Empty';
	} elseif (empty($email)) {
		$error = 'Email Cannot be Empty';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = 'Email id invalid';
	} else {


		$sql = "INSERT INTO contact(
		fname,
		lname,
		email,
		body
		)
		VALUES('$fname', '$lname', '$email', '$body')
		";

		$insert_contact = $db->insert($sql);
		if ($insert_contact) {
			$msg = "Message has been sent successfully!";
		} else {
			$msg = "Message cannot be sent, please try again!";
		}
	}
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<?php
			if (isset($error)) {
				echo '<span style="color:red;">' . $error . '</span';
			}

			if (isset($msg)) {
				echo '<span style="color:green;">' . $msg . '</span';
			}
			?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name" />
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit" />
						</td>
					</tr>
				</table>
				<form>
		</div>

	</div>

	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>