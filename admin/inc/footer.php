<div class="clear">
</div>
</div>
<div class="clear">
</div>
<div id="site_info">
<?php
$sql = "SELECT copyright FROM blog_options";

$result = $db->select($sql);
?>

<?php
    if ($result) :
        while ($row = $result->fetch_assoc()) :
    ?>
            <p><?php echo $row['copyright']; ?></p>

    <?php
        endwhile;
    endif; ?>
</div>
</body>

</html>