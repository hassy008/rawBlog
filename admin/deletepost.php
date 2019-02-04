<!-- we check here that our pages is logged in or not -->
<?php 
    include "../lib/session.php";
    Session::checkSession();
?>

<?php  
include "../config/config.php";
include "../lib/database.php";
?>

<?php
    $db = new Database();
?>

<?php
    if (!isset($_GET['delpostid']) || $_GET['delpostid']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='postlist.php';</script>";
       // header("Location:catlist.php");
    } else{
        $postid = $_GET['delpostid'];
        $query = "SELECT * FROM tbl_post WHERE id='$postid'";
        $getData=$db->select($query);
        if ($getData) {
        	while ($delimg = $getData->fetch_assoc()) {
        	    $dellink = $delimg['image'];
        	    unlink($dellink);
        	    // unlink(filename) used to delete data from store
        	}
        }

        $delquery = "DELETE FROM tbl_post WHERE id = '$postid'";
        $delData = $db->delete($delquery);
        if ($delData) {
        	echo "<script>alert('Data Deleted Successfully');</script>";
        	echo "<script>window.location = 'postlist.php';</script>";
        }else{
        	echo "<script>alert('Data Deleted Not Deleted');</script>";
        	echo "<script>window.location = 'postlist.php';</script>";
        }

    }
?>
