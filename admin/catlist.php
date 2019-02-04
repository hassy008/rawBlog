<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>


<div class="grid_10">
<div class="box round first grid">
    <h2>Category List</h2>
<!-- CREATE DELETE CATEGORY OPTION -->
<?php
	if (isset($_GET['delcat'])) {
		$delid = $_GET['delcat'];

		// Create query & then use delete method
	$delquery = "DELETE FROM tbl_category WHERE id='$delid'";
	$deldata = $db->delete($delquery);	
        if ($deldata) {
            echo "<span class='success'><b>Category Deleted Successfully</b></span>";
        }else{
            echo "<span class='error'><b>Category Not Deleted </b></span>";
        }
	}
?>

    <div class="block">        
	    <table class="data display datatable" id="example">
	<thead>
		<tr>
			<th>Serial No.</th>
			<th>Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php
	$query = "SELECT * FROM  tbl_category ORDER BY id ASC";
	$category = $db->select($query);
	if ($category) {
//i used for declare ID value
		$i=0;		
		while ($result = $category->fetch_assoc()) {
		    $i++;
?>		
		<tr class="odd gradeX">
			<td><?php echo $i;?></td>
			<td><?php echo $result['name'];?></td>
			<td>

				
<!--define ROLE-->
<?php
	if (Session::get('userRole')=='0') { ?>
				<a href="editcat.php?catid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Do you want to Delete?');" href="?delcat=<?php echo $result['id'];?>">Delete</a>
<?php } else{ ?>
			List Our Category
<?php }?>
			</td>
		</tr>

	<?php } } ?>
	<!--END WHILE LOOP-->	
	</tbody>
	</table>
   </div>
</div>

<!--this script to get table/search box in your page-->
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	}); 
</script>

<?php include "inc/footer.php";?>        
