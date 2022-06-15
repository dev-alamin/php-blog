<?php
$sql = "SELECT * FROM category";
$result = $db->select($sql);
?>

<div class="sidebar clear">
    <?php if ($result) : ?>
        <div class="samesidebar clear">
            <h2>Categories</h2>
            <ul>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <li><a href="posts.php?category=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php else : ?>
        <h2>There is no category</h2>
    <?php endif; ?>

    <?php
    $sql = "SELECT * FROM post LIMIT 5";
    $result = $db->select($sql);
    ?>

    <?php if ($result) : ?>
        <div class="samesidebar clear">

            <h2>Latest articles</h2>

            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="popular clear">
                    <h3><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
                    <a href="#"><img src="admin/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" /></a>
                    <?php echo $fm->shortenText($row['body'], 80); ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</div>