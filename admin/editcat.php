<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (!isset($_GET['catid']) || $_GET['catid']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='catlist.php';</script>";
       // header("Location:catlist.php");

    } else{
        $id = $_GET['catid'];
    }
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>Add New Category</h2>
   <div class="block copyblock"> 

<?php
    if ($_SERVER['REQUEST_METHOD']=="POST") {
    $name = $_POST['name'];
//realescapestring to protect code from malicious script
    $name = mysqli_real_escape_string($db->link,$name);
    if (empty($name)) {
        echo "<span class='error'><b>Field Must NOT Empty !!</b></span>";
    }else {
       //here UPDATE methoda can use to UPDATE data      
        $query="UPDATE tbl_category SET name='$name' WHERE id='$id'";
        $update_row = $db->update($query);
        if ($update_row) {
            echo "<span class='success'><b>Updated Successfully</b></span>";
        }else{
            echo "<span class='error'><b>Updated Not Inserted</b></span>";
        }
    }
}
?>

<?php
//here SELECT methoda can use to get data from DB
    $query = "SELECT * FROM tbl_category WHERE id='$id' ORDER BY id DESC"; 
    $category = $db->select($query);
   while ($result = $category->fetch_assoc()){

?>
     <form action="" method="post">
        <table class="form">			
            <tr>
                <td>
                    <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" /> <!-- here (name=name) from our DB -->
                </td>
            </tr>
			<tr> 
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
        </form>
<?php } ?><!--End While-->

    </div>
</div>
</div>
 <?php include "inc/footer.php";?>        