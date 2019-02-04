<!-- UPDATE & DELETE PAGES FROM THIS PAGE-->
<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location ='index.php';</script>";
} ?>

<?php
    if (!isset($_GET['pageid']) || $_GET['pageid']== NULL) {
// here we can use (echo script/header) and this option redirect you if you enter wrong url....        
         echo "<script> window.location ='index.php';</script>";
       // header("Location:catlist.php");

    } else{
        $id = $_GET['pageid'];
    }
?>


<div class="grid_10">
<div class="box round first grid">
    <h2>Page</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//realescapestring to protect code from malicious script
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
     

    if ($name == "" ||  $body == "" ) {
   //here file_name indicate image file & if you blank any one of them then you'll get this below message      
     echo"<span class='error'> FIELD MUST NOT BE EMPTY!!</span>";
    }else{
        $query = "UPDATE tbl_page
                    SET
                    name ='$name',
                    body ='$body'
                    Where id = '$id'";
        $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Post Updated Successfully.</span>";
    }else {
     echo "<span class='error'>Post Not Updated !</span>";
            }
        }
    } 
?>
    <div class="block">      

<?php
    $pagequery = "SELECT * FROM tbl_page WHERE id='$id'";
    $pagedetails = $db->select($pagequery);
    if ($pagedetails) {
        while ($result = $pagedetails->fetch_assoc()) {   
?>              
     <form action="" method="post" >
        <table class="form">   
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                </td>
            </tr>
         
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
   <!-- we make textare like body     -->
                    <textarea class="tinymce" name="body">
                        <?php echo $result['body'];?>
                    </textarea>                
                </td>
            </tr>

			<tr>
                <td></td>
                <td>
                    <input type="submit"  Value="Ok" />

<!--get("userId") & $result['userid'] = define which user create this task...
get('userRole')=='0' indicate only admin can access any of these [view/edit/delete]
-->
<?php
    if (Session::get('userRole')=='0') { ?>
                    <input type="submit" name="submit" Value="Update" />
                    <span class="actiondel">
                        <a onclick="return confirm('Do you want to Delete?');" href="deletepage.php?delpage=<?php echo $result['id'];?>">Delete </a>
                    </span>
<?php } ?>                   
                </td>
            </tr>

        </table>
    </form>

<?php   }  } ?>  

<!--///////////////////////////////////////////////////////////////////////////////-->
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
