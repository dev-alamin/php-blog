<?php include 'inc/header.php'; ?>
<?php

if (!isset($_GET['category']) || $_GET['category'] == NULL) {
    header('Location:404.php');
} else {
    $category = $_GET['category'];
}

$sql = "
		SELECT * FROM
		post 
        WHERE cat = $category";
$post = $db->select($sql);

// Query for category 
$csql = "SELECT * FROM category WHERE id = $category";
$cat = $db->select($csql);
?>

<h2 style="text-align: center; margin:15px auto; padding-top:25px;font-size:35px;text-transform:uppercase;">
    <?php
    if ($cat) :
        while ($row = $cat->fetch_assoc()) :
            echo 'Category: ' . $row['name'];
        endwhile;
    endif;
    ?>
</h2>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
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
        <?php else :
            header('Location: 404.php');
        endif; ?>
    </div>

    <!-- sidebar  -->
    <?php include 'inc/sidebar.php'; ?>
    <!-- footer -->
    <?php include 'inc/footer.php'; ?>