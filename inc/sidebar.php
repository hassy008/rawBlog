	<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
		<?php
			$query="SELECT * FROM tbl_category ";// startfrom(where to start) & perpage(total how many pages)
			$category=$db->select($query);
			if($category){
				while($result=$category->fetch_assoc()){
		?>			
			<li><a href="posts.php?category=<?php echo $result['id'];?>"><?php echo $result['name'];?></a></li>
	<!-- here we engage our database [TBL_CATEGORY].....id & name from this db table 		 -->
		<?php } } else { ?>
<!-- Now we want to show some content inside LI			 -->
			<li>NO Category Created</li>
		<?php }?>

			</ul>
	</div>
						<!--<<<<<<<<<< Latest articles >>>>>>>>>>>-->
	<div class="samesidebar clear">
		<h2>Latest articles</h2>
	<?php 
		$query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 5";
		$post = $db->select($query);
		if ($post) {
			while ($result = $post->fetch_assoc()) {
	?>	

			<div class="popular clear">
				<h3><a href="post.php?id=<?php echo $result ['id'] ;?>"><?php echo $result['title'];?></a>
				</h3>
				
				<a href="post.php?id=<?php echo $result ['id'] ;?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
	
	<?php echo $fm->textShorten($result['body'],120);?>
			</div>			
	<?php } } else { header("Location:404.php");}?>	

	</div>
</div>