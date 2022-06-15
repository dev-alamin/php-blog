<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (isset($_GET['delid'])) {
	$delid = $_GET['delid'];

	/**
	 * Get the image first and unlink it from folder
	 */

	$sql = "SELECT * FROM post WHERE id = $delid";
	$result = $db->select($sql);

	if ($result) {
		while ($row = $result->fetch_assoc()) {
			$delete_image = $row['image'];
			unlink($delete_image);
		}
	}

	/**
	 * Delete from db 
	 */

	$sql = "DELETE FROM post WHERE id = $delid";
	$del_post = $db->delete($sql);

	if ($del_post == true) {
		echo 'Post deleted!';
	} else {
		echo 'Sorry, there is an issue in the code and post cannot be deleted!';
	}
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">No. </th>
						<th width="15%">Post Title</th>
						<th width="20%">Content</th>
						<th width="10%">Category</th>
						<th width="10%">Image </th>
						<th width="10%">Author</th>
						<th width="10%">Tags</th>
						<th width="10%">Date</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT post.*, category.name FROM post
					INNER JOIN category
					ON post.cat = category.id
					ORDER BY post.title DESC";
					$result = $db->select($sql);
					?>
					<?php
					if ($result) {
						$sn = 1;
						while ($row = $result->fetch_assoc()) : ?>
							<tr class="odd gradeX">
								<td><?php echo $sn++; ?></td>
								<td><a href="editpost.php?id=<?php echo $row['id']; ?>"><?php echo $row['title'] ?></a></td>
								<td><?php echo $fm->shortenText($row['body'], 30); ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><img width="50px" height="30px;" src="<?php echo $row['image']; ?>" alt=""></td>
								<td><?php echo $row['author']; ?></td>
								<td><?php echo $row['tags']; ?></td>
								<td><?php echo $row['date']; ?></td>
								<td><a href="editpost.php?id=<?php echo $row['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $row['id']; ?>">Delete</a></td>
							</tr>
					<?php endwhile;
					}

					?>
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

		$('.datatable').dataTable({
			pagination: true
		});
		setSidebarHeight();


	});
</script>
<?php include 'inc/footer.php'; ?>