<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>
<div class="grid_10">
<div class="box round first grid">
    <h2>Add New Page</h2>
 <!--Here Only Admin can Add Page--> 
<?php if (Session::get('userRole')=='0') { ?>  


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//realescapestring to protect code from malicious script
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
     

    if ($name == "" ||  $body == "" ) {
   //here file_name indicate image file & if you blank any one of them then you'll get this below message      
     echo"<span class='error'> FIELD MUST NOT BE EMPTY!!</span>";
    }else{
        $query = "INSERT INTO tbl_page(name, body) VALUES('$name','$body')";
        $inserted_rows = $db->insert($query);
    if ($inserted_rows) {
     echo "<span class='success'>Post Created Successfully.</span>";
    }else {
     echo "<span class='error'>Post Not Created !</span>";
            }
        }
    } 
?>

    <div class="block">  
     <form action="" method="post" >
        <table class="form">  



            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>
         
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
   <!-- we make textare like body     -->
                    <textarea class="tinymce" name="body"></textarea>                
                </td>
            </tr>

			<tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Create" />
                </td>
            </tr>


        </table>
    </form>
<!--///////////////////////////////////////////////////////////////////////////////-->

    </div>


</div>
</div>

<?php }?>
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
