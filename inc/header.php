<!-- include db  -->
<?php include 'config/config.php';
include 'lib/Database.php';
include 'helpers/Format.php';

$db = new Database();
$fm = new Format();
?>

<!DOCTYPE html>
<html>

<head>
	<?php

	if (isset($_GET['pageid']) && $_GET['pageid'] !== NULL) :
		$id = $_GET['pageid'];
		$sql = "SELECT * FROM pages WHERE id = $id";
		$result = $db->select($sql);

		if ($result) :
			while ($row = $result->fetch_assoc()) : ?>
				<title><?php echo $row['title'] . ' - ' . TITLE; ?></title>
		<?php endwhile;
		endif;
	elseif (isset($_GET['id']) && $_GET['id'] !== NULL) : ?>
		<?php
		$id = $_GET['id'];
		$sql = "SELECT * FROM post WHERE id = $id";
		$result = $db->select($sql);

		if ($result) :
			while ($row = $result->fetch_assoc()) : ?>
				<title><?php echo $row['title'] . ' - ' . TITLE; ?></title>
		<?php endwhile;
		endif;
	else : ?>
		<title> <?php $fm->title(); ?> <?php echo TITLE; ?></title>
	<?php
	endif;
	?>


	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
	if (isset($_GET['id']) && $_GET['id'] !== NULL) :
		$keywords = $_GET['id'];
		$sql = "SELECT * FROM post WHERE id = $keywords";
		$result = $db->select($sql);

		if ($result) :
			while ($row = $result->fetch_assoc()) : ?>
				<meta name="keywords" content="<?php echo $row['tags'] . ' - ' . TITLE; ?>">
			<?php endwhile;
		else : ?>
			<meta name="keywords" content="<?php echo KEYWORDS; ?>">
	<?php
		endif;
	endif;
	?>

	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider({
				effect: 'random',
				slices: 10,
				animSpeed: 500,
				pauseTime: 5000,
				startSlide: 0, //Set starting Slide (0 index)
				directionNav: false,
				directionNavHide: false, //Only show on hover
				controlNav: false, //1,2,3...
				controlNavThumbs: false, //Use thumbnails for Control Nav
				pauseOnHover: true, //Stop animation while hovering
				manualAdvance: false, //Force manual transitions
				captionOpacity: 0.8, //Universal caption opacity
				beforeChange: function() {},
				afterChange: function() {},
				slideshowEnd: function() {} //Triggers after all slides have been shown
			});
		});
	</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
				<img src="images/logo.png" alt="Logo" />
				<h2><?php echo TITLE; ?></h2>
				<p>Our website description</p>
			</div>
		</a>
		<div class="social clear">
			<?php
			$sql = "SELECT * FROM social";
			$result = $db->select($sql);

			if ($result) :
			?>
				<div class="icon clear">
					<?php while ($row = $result->fetch_assoc()) : ?>
						<a href="<?php echo $row['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="<?php echo $row['tt']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="<?php echo $row['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						<a href="<?php echo $row['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<div class="searchbtn clear">
				<form action="search.php" method="GET">
					<input type="text" name="search" placeholder="Search keyword..." />
					<input type="submit" name="submit" value="Search" />
				</form>
			</div>
		</div>
	</div>
	<div class="navsection templete">
		<?php
		$path = $_SERVER['SCRIPT_FILENAME'];
		$current_page = basename($path, '.php');
		?>
		<ul>
			<li><a <?php echo $current_page == 'index'  ? "id='active'" : 'id="#"' ?> href="index.php">Home</a></li>
			<?php
			$sql = "SELECT * FROM pages";
			$result = $db->select($sql);

			if ($result) :
				while ($row = $result->fetch_assoc()) :	?>
					<li><a <?php
							if (isset($_GET['pageid']) && $_GET['pageid'] == $row['id']) :
								echo 'id="active"';
							endif;
							?> href="page.php?pageid=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></li>
			<?php endwhile;
			endif; ?>
			<li><a <?php echo $current_page == 'contact'  ? "id='active'" : 'id="#"' ?> href="contact.php">Contact</a></li>
		</ul>
	</div>