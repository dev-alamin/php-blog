<?php include 'inc/header.php'; ?>
<?php

if (!isset($_GET['search']) || $_GET['search'] == NULL) {
    echo '<h4>' . ' Result Not found' . '</h4>';
} else {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";

$post = $db->select($sql);

?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php if ($post) :
            while ($result = $post->fetch_assoc()) : ?>
                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                    <h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a></h4>
                    <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="<?php echo $result['title']; ?>" /></a>
                    <?php echo $fm->shortenText($result['body']); ?>
                    <div class="readmore clear">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>
            <?php
            endwhile; ?>
        <?php else :
          echo '<h4>' . ' Result Not found' . '</h4>';
        endif; ?>
    </div>

    <!-- sidebar  -->
    <?php include 'inc/sidebar.php'; ?>
    <!-- footer -->
    <?php include 'inc/footer.php'; ?>