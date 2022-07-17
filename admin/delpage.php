<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
if(isset($_GET['id']) && $_GET['id'] !== NULL){
    $id = $_GET['id'];

    $sql = "DELETE FROM pages WHERE id = $id";

    $delpage = $db->delete( $sql );

    if($delpage){
        echo 'Page deleted successfully!';
    }else{
        echo '<script> alert("Page cannot be deleted")</script>';
    }
}else{
    header('Location:index.php');
}

?>
<?php include 'inc/footer.php'; ?>