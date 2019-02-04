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
    if (!isset($_GET['delphoto']) || $_GET['delphoto']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='photolist.php';</script>";
       // header("Location:catlist.php");
    } else{
        $delphoto = $_GET['delphoto'];
       
        $query = "SELECT * FROM tbl_gallery WHERE id='$delphoto'";
        $getData=$db->select($query);
        if ($getData) {
            while ($delimg = $getData->fetch_assoc()) {
                $dellink = $delimg['image'];
                unlink($dellink);
                // unlink(filename) used to delete data from store
            }
        }

        $delquery = "DELETE FROM tbl_gallery WHERE id = '$delphoto'";
        $delData = $db->delete($delquery);
        if ($delData) {
            echo "<script>alert('Slider Deleted Successfully');</script>";
            echo "<script>window.location = 'photolist.php';</script>";
        }else{
            echo "<script>alert('Slider Deleted Not Deleted');</script>";
            echo "<script>window.location = 'photolist.php';</script>";
        }

    }
?>




