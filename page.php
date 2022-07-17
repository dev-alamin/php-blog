<?php include 'inc/header.php'; ?>
<?php
if (isset($_GET['pageid']) && $_GET['pageid'] !== NULL) {
	$id = $_GET['pageid'];

	$sql = "SELECT * FROM pages WHERE id = $id";
	$result = $db->select($sql);
} else {
	header('Location:404.php');
}

?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php if ($result) :
			while ($row = $result->fetch_assoc()) :
		?>
				<div class="about">
					<h2><?php echo $row['title']; ?></h2>
					<?php echo $row['content']; ?>
				</div>
		<?php endwhile;
		endif; ?>
	</div>

	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>