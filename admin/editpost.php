<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (!isset($_GET['editpostid']) || $_GET['editpostid']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='postlist.php';</script>";
       // header("Location:catlist.php");
    } else{
        $postid = $_GET['editpostid'];
    }
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>Update Post</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//realescapestring to protect code from malicious script
    $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
    $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

//all this code for image Validation
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if ($cat == "" || $title == "" ||  $body == "" || $author == "" ||  $tags == "") {
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
        $query = "UPDATE tbl_post
                   SET
                   cat   ='$cat',
                   title ='$title',
                   body  ='$body',
                   image ='$uploaded_image',
                   author='$author',
                   tags  ='$tags',
                   userid='$userid'
                   WHERE id = '$postid'";
        $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Data Updated  Successfully.</span>";
    }else {
     echo "<span class='error'>Data Not Updated Successfully !</span>";
            }
        }
    } else{    
        $query = "UPDATE tbl_post
                   SET
                   cat     ='$cat',
                   title   ='$title',
                   body    ='$body',
                   author  ='$author',
                   tags    ='$tags',
                   userid  ='$userid'
                   WHERE id = '$postid'";
        $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Data Updated  Successfully.</span>";
    }else {
     echo "<span class='error'>Data Not Updated Successfully !</span>";
            } 
        }
    }    
} 
?>
    <div class="block">   
<!--Here we write EDIT CODE-->
<?php
    $query="SELECT * FROM tbl_post WHERE id='$postid' ORDER BY id DESC";
    $getpost=$db->select($query);
        while ($postresult=$getpost->fetch_assoc()) { 
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="form">   
    <tr>
        <td>
            <label>Title</label>
        </td>
        <td>
            <input type="text" name="title" value="<?php echo $postresult['title'];?>" class="medium" />
        </td>
    </tr>
 
    <tr>
        <td>
            <label>Category</label>
        </td>
        <td>
            <select id="select" name="cat">
                <option>Select Category</option>

    <?php 
        $query = "SELECT * FROM tbl_category ";
        $category=$db->select($query);
        if ($category) {
            while ($result = $category->fetch_assoc()) {
    ?>

    <!--here we get category name....so we need [CAT] from [tbl_post] & [ID] from [tbl_category]  -->
                <option             
                    <?php 
                        if ($postresult['cat'] == $result['id']) { ?>
                        selected="selected"    
                    <?php  } ?> value="<?php echo $result['id'];?>"><?php echo $result['name'];?>      
                </option>
    <?php  } } ?><!--ENDING Query-->
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <label>Upload Image</label>
        </td>
        <td>
            <img src=" <?php echo $postresult['image'];?>" height="80px" width="200px"/><br>
            <input type="file" name="image" />
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
<!-- we make textarea like body     -->
            <textarea class="tinymce" name="body">
             <?php echo $postresult['body'];?>
            </textarea>                
        </td>
    </tr>
    <tr>
        <td>
            <label>Author</label>
        </td>
        <td>
            <input type="text" name="author" value="<?php echo $postresult['author'];?>" class="medium"/>

<!-- WE add userid option to control role based access-->    
            <input type="hidden" name="userid" value="<?php echo Session::get('userId');?>" class="medium"/>
        </td>
    </tr>
    <tr>
        <td>
            <label>Tags</label>
        </td>
        <td>
            <input type="text" name="tags" value="<?php echo $postresult['tags'];?>" class="medium" />
        </td>
    </tr>
	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Save" />
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
