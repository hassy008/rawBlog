<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>Inbox</h2>
<!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<SEEN OPTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
<?php
	if (isset($_GET['seenid'])) {
		$seenid = $_GET['seenid'];
		 $query="UPDATE tbl_contact 
		 SET 
		 status='1' 
		 WHERE id='$seenid'";

        $update_row = $db->update($query);
        if ($update_row) {
            echo "<span class='success'><b>Message Sent to the seen box</b></span>";
        }else{
            echo "<span class='error'><b> Not Inserted</b></span>";
        }
	}
?>

    <div class="block">        
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>

	<?php
		$query = "SELECT *FROM tbl_contact WHERE status='0' ORDER BY id DESC";
		$msg = $db->select($query);
		if ($msg) {
			$i=0;
			while ($result = $msg->fetch_assoc()){
				$i++;
	?>		
			<tr class="odd gradeX">
				<td><?php echo $i;?></td>
				<td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
				<td><?php echo $result['email'];?></td>
				<td><?php echo $fm->textShorten($result['body'], 30);?></td>
				<td><?php echo $fm->formatDate($result['date']);?></td>
				<td><a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || 
					<a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
					<a 
					onclick="return confirm('Are You Confirm To Move');" href="?seenid=<?php echo $result['id'];?>">Seen</a>
				</td>
			</tr>
	<?php } } ?>		
		</tbody>
	</table>
   </div>
</div>


<div class="box round first grid">
    <h2>Seen Message</h2>
<!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<DELETE OPTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
<?php
	if (isset($_GET['delid'])) {
		$delid= $_GET['delid'];
		$delquery = "DELETE FROM tbl_contact WHERE id='$delid'";
		$deldata = $db->delete($delquery);
		if ($deldata) {
				echo "<span class='success'>Email Deleted Successfully</span>";
			}else{
				echo "<span class='error'>Wrong Wrong!!!</span>";
			}
		}
?><!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<DELETE OPTION END>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->


<!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<UNSEEN OPTION>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->
<?php
    if (isset($_GET['unseen'])) {
        $unseen= $_GET['unseen'];
        $usquery = "UPDATE tbl_contact
                    SET 
                    status='0'  
                    WHERE id='$unseen'";
        $usdata = $db->update($usquery);
        if ($usdata) {
                echo "<span class='success'>Email Send to Inbox Again </span>";
            }else{
                echo "<span class='error'>Wrong Wrong!!!</span>";
            }
        }
?><!--<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<UNSEEN OPTION END>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>-->


    <div class="block">        
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>

	<?php
		$query = "SELECT *FROM tbl_contact WHERE status='1' ORDER BY id DESC";
		$msg = $db->select($query);
		if ($msg) {
			$i=0;
			while ($result = $msg->fetch_assoc()){
				$i++;
	?>		
			<tr class="odd gradeX">
				<td><?php echo $i;?></td>
				<td><?php echo $result['firstname'].' '.$result['lastname'];?></td>
				<td><?php echo $result['email'];?></td>
				<td><?php echo $fm->textShorten($result['body'], 30);?></td>
				<td><?php echo $fm->formatDate($result['date']);?></td>
				<td>
					<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> ||
					<a onclick="return confirm('Are You Confirm To Delete Message');" href="?delid=<?php echo $result['id'];?>">Delete</a> ||
					<a onclick="return confirm('Are You Confirm To Unseen Message');" href="?unseen=<?php echo $result['id'];?>">Unseen</a>
				</td>
			</tr>
	<?php } } ?>		
		</tbody>
	</table>
   </div>
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
