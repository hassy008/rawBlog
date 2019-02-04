<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>



 <style>
     .leftside{float: left; width: 70%}
     .rightside{float: left; width: 20%}
     .rightside img{height:160px;width:170px;}
 </style>

 <?php
    if (Session::get('userRole')=='0') { ?>

<div class="grid_10">

<div class="box round first grid">
    <h2>Update Site Title and Description</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//here we validate our content....no space/malicious script not working
  $title=$fm->validation($_POST['title']);
  $slogan=$fm->validation($_POST['slogan']);  

//realescapestring to protect code from malicious script
    $title = mysqli_real_escape_string($db->link,$title );
    $slogan = mysqli_real_escape_string($db->link, $slogan);

//all this code for image Validation
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $same_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$same_image;

    if ($slogan == "" || $title == "" ) {
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
        $query = "UPDATE tbl_slogan
                   SET
                   title='$title',
                   slogan='$slogan',
                   logo='$uploaded_image'
                   WHERE id = '1'";
        $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Data Updated  Successfully.</span>";
    }else {
     echo "<span class='error'>Data Not Updated Successfully !</span>";
            }
        }
    } else{    
        $query = "UPDATE tbl_slogan
                   SET
                   title='$title',
                   slogan='$slogan'
                   WHERE id = '1'";
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
        <?php
        $query = "SELECT * FROM tbl_slogan WHERE id='1'";
        $blog_title=$db->select($query);
        if ($blog_title) {
            while ($result = $blog_title->fetch_assoc()) {
        ?>
    <div class="block sloginblock"> 

    <div class="leftside">              
     <form action="" method="post" enctype="multipart/form-data">
        <table class="form">			
            <tr>
                <td>
                    <label>Website Title</label>
                </td>
                <td>
                    <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                </td>
            </tr>
			 <tr>
                <td>
                    <label>Website Slogan</label>
                </td>
                <td>
                    <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                </td>
            </tr>
                 <tr>
                <td>
                    <label>Upload Logo</label>
                </td>
                <td>
                    <input type="file"  name="logo" />
                </td>
            </tr>
			 
			 <tr>
                <td>
                </td>
                <td>
                    <input type="submit" name="submit" Value="Update" />
                </td>
            </tr>
        </table>
        </form>
      </div>

      <div class="rightside">
           <img src="<?php echo $result['logo'];?>" alt="logo"/> 
      </div>  
    </div>

         <?php  }  }?>
</div>
</div>

<?php } else {
   echo "<script> window.location ='index.php';</script>";;
}
?>

<?php include "inc/footer.php";?>        

