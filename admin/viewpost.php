<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<?php
    if (!isset($_GET['viewpostid']) || $_GET['viewpostid']==NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='postlist.php';</script>";
       // header("Location:catlist.php");
    } else{
        $postid = $_GET['viewpostid'];
    }
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>View Post</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location ='postlist.php';</script>";
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
            <input type="text" readonly value="<?php echo $postresult['title'];?>" class="medium" />
        </td>
    </tr>
 
    <tr>
        <td>
            <label>Category</label>
        </td>
        <td>
            <select id="select" readonly>
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
            <img src=" <?php echo $postresult['image'];?>" height="120px" width="300px"/><br>
            <input type="file" name="image" />
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
<!-- we make textarea like body     -->
            <textarea class="tinymce" readonly>
             <?php echo $postresult['body'];?>
            </textarea>                
        </td>
    </tr>
    <tr>
        <td>
            <label>Author</label>
        </td>
        <td>
            <input type="text" readonly value="<?php echo $postresult['author'];?>" class="medium"/>

<!-- WE add userid option to control role based access-->    
            <input type="hidden" name="userid" value="<?php echo Session::get('userId');?>" class="medium"/>
        </td>
    </tr>
    <tr>
        <td>
            <label>Tags</label>
        </td>
        <td>
            <input type="text" readonly value="<?php echo $postresult['tags'];?>" class="medium" />
        </td>
    </tr>
	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Ok" />
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
