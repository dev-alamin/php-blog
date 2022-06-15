<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>


<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<!-- pagination  -->
		<?php
		$posts_per_page = 3;

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$start_for_from = ($page - 1) * $posts_per_page;

		?>
		<!-- pagination  -->

		<?php
		$sql = "
		SELECT * FROM
		post 
		LIMIT $start_for_from, $posts_per_page";
		$post = $db->select($sql); ?>

		<?php if ($post) :
			while ($result = $post->fetch_assoc()) : ?>
				<div class="samepost clear">
					<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
					<h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a></h4>
					<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" /></a>
					<?php echo $fm->shortenText($result['body']); ?>
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
					</div>
				</div>
			<?php
			endwhile; ?>
			<!-- Pagination  -->
			<?php
			$sql = "SELECT * FROM post";
			$result = $db->select($sql);
			$total_rows = mysqli_num_rows($result);
			$total_pages = ceil($total_rows / $posts_per_page);
			?>

			<div class="pagination">
				<?php echo '<a href="index.php?page=1">' . 'First Page'  . '</a>'; ?>
				<?php
				$fm->blogPagination($total_pages);
				?>
				<?php echo '<a href="index.php?page=' . $total_pages . '">' . 'Last Page' . '</a>'; ?>
			</div>
			<!-- Pagination  -->
		<?php else :
			header('Location: index.php');
		endif; ?>
	</div>

	<!-- sidebar  -->
	<?php include 'inc/sidebar.php'; ?>
	<!-- footer -->
	<?php include 'inc/footer.php'; ?>