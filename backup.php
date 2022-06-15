<?php 
function wpb_hook_javascript()
{
    if (is_page(3839)) {
?>
        <script type="text/javascript">
            document.addEventListener('wpcf7mailsent', function(event) {
                location = '/tour-registration-confirmation/';
            }, false);
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            document.addEventListener('wpcf7mailsent', function(event) {
                location = '/thank-you/';
            }, false);
        </script>
<?php
    }
}
add_action('wp_footer', 'wpb_hook_javascript');

// rad: phone: +880 1914609153, +880 1776728953
// Footer address: House- 12/2/KHA, Road-02, Shyamoli, Dhaka-1207