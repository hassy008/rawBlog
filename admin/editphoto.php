<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (!isset($_GET['photoid']) || $_GET['photoid']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='photolist.php';</script>";
       // header("Location:catlist.php");
    } else{
        $photoid = $_GET['photoid'];
    }
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>Update Photo</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//realescapestring to protect code from malicious script
    $title = mysqli_real_escape_string($db->link, $_POST['title']);

//all this code for image Validation
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if ($title == "" ) {
   //here file_name indicate image file & if you blank any one of them then you'll get this below message      
     echo"<span class='error'> FIELD MUST NOT BE EMPTY!!</span>";
    }   else{
 //here we start [EDITING CODE]   
    if (!empty($file_name)) {

    if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
       echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    } 

    else{
        move_uploaded_file($file_temp, $uploaded_image);      
        $query = "UPDATE tbl_gallery
                   SET
                   title ='$title',
                   image ='$uploaded_image'
                   WHERE id = '$photoid'";
        $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Data Updated  Successfully.</span>";
    }else {
     echo "<span class='error'>Data Not Updated Successfully !</span>";
            }
        }
    } else{    
        $query = "UPDATE tbl_gallery
                   SET
                   title    ='$title'
                   WHERE id = '$photoid'";
        $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Slider Updated  Successfully.</span>";
    }else {
     echo "<span class='error'>Slider Not Updated Successfully !</span>";
            } 
        }
    }    
} 
?>
    <div class="block">   
<!--Here we write EDIT CODE-->
<?php
    $query="SELECT * FROM tbl_gallery WHERE id='$photoid'";
    $getslider=$db->select($query);
        while ($sliderresult=$getslider->fetch_assoc()) { 
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="form">   
    <tr>
        <td>
            <label>Title</label>
        </td>
        <td>
            <input type="text" name="title" value="<?php echo $sliderresult['title'];?>" class="medium" />
        </td>
    </tr>
 

    <tr>
        <td>
            <label>Upload Image</label>
        </td>
        <td>
            <img src=" <?php echo $sliderresult['image'];?>" height="80px" width="200px"/><br>
            <input type="file" name="image" />
        </td>
    </tr>
    
	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Update" />
        </td>
    </tr>
</table>
</form>
<?php  } ?>

    </div>
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
  <!-- Load TinyMCE -->
<?php include "inc/footer.php";?>        
