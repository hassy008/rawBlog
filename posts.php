 <?php
include "inc/header.php";
include "inc/slider.php";
?>

<?php 
	if (!isset($_GET['category']) || $_GET['category'] == NULL) {
		header("Location: 404.php");
	} else {
		$category=$_GET['category'];
	}
?>

 <div class="contentsection contemplete clear">
<div class="maincontent clear">
	<?php
		$query="SELECT * FROM tbl_post WHERE cat=$category";// startfrom(where to start) & perpage(total how many pages)
		$post=$db->select($query);
		if($post){
			while($result=$post->fetch_assoc()){
	?>


	<div class="samepost clear">
		<h2><a href="post.php?id=<?php echo $result ['id'] ;?>"><?php echo $result['title']; ?></a>
		</h2>
		
		<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a>
		</h4>
		
		 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/>
		 </a>
<!-- shorten out text	
 -->		<?php echo $fm->textShorten($result['body']);?>
		
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $result ['id'] ;?>">Read More</a>
		</div>
	
	</div>

<?php } } else{header("Location:404.php");}?>	

</div>	

<?php include "inc/sidebar.php";?>	
<?php include "inc/footer.php";?>