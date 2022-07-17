</div>
<?php
$sql = "SELECT copyright FROM blog_options";

$result = $db->select($sql);
?>
<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
    </div>

    <?php
    if ($result) :
        while ($row = $result->fetch_assoc()) :
    ?>
            <p><?php echo $row['copyright']; ?></p>

    <?php
        endwhile;
    endif; ?>
</div>
<div class="fixedicon clear">
    <a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook" /></a>
    <a href="http://www.twitter.com"><img src="images/tw.png" alt="Twitter" /></a>
    <a href="http://www.linkedin.com"><img src="images/in.png" alt="LinkedIn" /></a>
    <a href="http://www.google.com"><img src="images/gl.png" alt="GooglePlus" /></a>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>

</html>