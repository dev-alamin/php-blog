<?php include 'inc/header.php'; ?>
<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
	header('Location:404.php');
} else {
	$id = $_GET['id'];
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">

			<?php
			$sql = "SELECT * FROM post WHERE id = $id";

			$result = $db->select($sql);
			?>
			<?php if ($result) :

				while ($row = $result->fetch_assoc()) : ?>
					<h2><?php echo $row['title']; ?></h2>
					<h4><?php echo $fm->formatDate($row['date']); ?> <a href="#"><?php echo $row['author']; ?></a></h4>
					<img src="admin/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" />
					<?php echo $row['body']; ?>


					<div class="relatedpost clear">
						<h2>Related articles</h2>
						<?php
						$cat = $row['cat'];

						$sql = "SELECT * FROM post WHERE cat = '$cat' LIMIT 6";
						$rresult = $db->select($sql);
						if ($rresult) :
							while ($row = $rresult->fetch_assoc()) :
						?>

								<a href="post.php?id=<?php echo $row['id']; ?>"><img src="admin/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" /></a>

						<?php
							endwhile;
						endif; ?>
					</div>

			<?php
				endwhile;
			else :
				header('Location: index.php');
			endif;
			?>
		</div>

	</div>

	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>