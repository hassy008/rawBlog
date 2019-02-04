<?php
    include "inc/header.php";
    include "inc/sidebar.php";
?>

<div class="grid_10">
<div class="box round first grid">
<h2>Slider List</h2>
<div class="block">  
    <table class="data display datatable" id="example">
    <thead>
        <tr>
            <th>No.</th>
            <th>Slider Title</th>
            <th>Slider Image</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>

    <?php
//here we need to join 2table caz category name is needed here. 
        $query = "SELECT * FROM tbl_slider";
        $slider=$db->select($query);
        if ($slider) {
            $i=0;
            while ($result = $slider->fetch_assoc()) {
                $i++;
    ?>  
        <tr class="odd gradeX">
            <td><?php echo $i; ?></td>
            <td><?php echo $fm->textShorten($result['title'],120);?></td>
            <td><img src="<?php echo $result['image'];?>" height="60px" width="80px"/></td>     
    <td>
<!--get("userId") & $result['userid'] = define which user create this task...
get('userRole')=='0' indicate only admin can access any of these [view/edit/delete]
-->
<?php
    if (Session::get('userRole')=='0') { ?>
    
<a href="editslider.php?sliderid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Do you want to Delete?');" href="deleteslider.php?delsliderid= <?php echo $result['id'];?>">Delete</a>

<?php   } ?>
        
    </td>
        </tr>
    
    <?php   }   }   ?>
    
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

