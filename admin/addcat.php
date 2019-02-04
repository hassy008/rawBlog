<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

 <?php
    if (!Session::get('userRole')=='0') { 
        echo "<script>window.location='index.php'</script>"; 
    }
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>Add New Category</h2>
   <div class="block copyblock"> 


<?php
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $name = $fm->validation($_POST['name']);
    //$name = $_POST['name'];
//realescapestring to protect code from malicious script
    $name = mysqli_real_escape_string($db->link,$name);
    if (empty($name)) {
        echo "<span class='error'><b>Field Must NOT Empty !!</b></span>";
    }else {
        $query="INSERT INTO tbl_category(name) VALUES('$name')";
        $catinsert=$db->insert($query);
        if ($catinsert) {
            echo "<span class='success'><b>Category Inserted Successfully</b></span>";
        }else{
            echo "<span class='error'><b>Category Not Inserted </b></span>";
        }
    }
}
?>

     <form action="" method="post">
        <table class="form">			
<?php
    if (Session::get('userRole')=='0') { 
?>
            <tr>
                <td>
                   
                    <input type="text" name="name" placeholder="Enter Category Name..." class="medium" /> 
                    <!-- here (name=name) from our DB -->
                
        
                </td>
            </tr>
			<tr> 
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>

<?php   }  ?>

        </table>
        </form>
    </div>
</div>
</div>
 <?php include "inc/footer.php";?>        