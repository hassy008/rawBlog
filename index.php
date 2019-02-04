<?php
include "inc/header.php";
include "inc/slider.php";
?>

	<div class="contentsection contemplete clear">
	<div class="maincontent clear">

<!--PaGINATION-->
	<?php 
		$per_page = 4;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		}else{
			$page=1;
		}
//START for every page
		$start_from = ($page-1) * $per_page;
	?>

<!--PaGINATION-->


<?php
	$query="SELECT * FROM tbl_post LIMIT $start_from, $per_page";// startfrom(where to start) & perpage(total how many pages)
	$post=$db->select($query);
		if($post){
			while($result=$post->fetch_assoc()){
?>			
<!--------------------------samepost clear------------------------------->
	<div class="samepost clear">
		<h2><a href="post.php?id=<?php echo $result ['id'] ;?>"><?php echo $result['title']; ?></a>
		</h2>
		
		<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a>
		</h4>
		 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/>
		 </a>
<!-- shorten out text -->		
<?php echo $fm->textShorten($result['body']);?>
		
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $result ['id'] ;?>">Read More</a>
		</div>
	</div>	
<?php } ?>		<!--end WHILE LOOP-->


<!--PaGINATION after end of the WHILE LOOP-->
	<?php 
		$query = "SELECT * FROM tbl_post";
		$result = $db->select($query);
		$total_rows = mysqli_num_rows($result);
//find out total pages
	$total_pages = ceil ($total_rows/$per_page);	

	echo "<span class='paginationn'><a href='index.php?page=1'>".'First Page'."</a>";
	for ($i = 1; $i <= $total_pages; $i++) {
		echo "<a href='index.php?page=".$i."'>".$i."</a>";
	};

	echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>"?>
<!--PaGINATION-->


	<?php } else{header("Location:404.php");}?>	
		</div>

<?php include "inc/sidebar.php";?>	
<?php include "inc/footer.php";?>
