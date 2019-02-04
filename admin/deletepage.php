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
    if (!isset($_GET['delpage']) || $_GET['delpage']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='index.php';</script>";
       // header("Location:catlist.php");
    } else{
        $pageid = $_GET['delpage'];
        $delquery = "DELETE FROM tbl_page WHERE id = '$pageid'";
        $delData = $db->delete($delquery);
        if ($delData) {
        	echo "<script>alert('Page Deleted Successfully');</script>";
        	echo "<script>window.location = 'index.php';</script>";
        }else{
        	echo "<script>alert('Page Deleted Not Deleted');</script>";
        	echo "<script>window.location = 'index.php';</script>";
        }
    }
?>
 