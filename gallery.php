<?php include "inc/header.php";?>
<style type="text/css">
  .cont{
  	width: 960px;
  	min-height: 500px;
  	background: white;
  	/* border: 1px solid black; */
  	margin: 0px auto;
  	display: flex;
  	flex-direction: row;
  	flex-wrap: wrap;
  }	

  .cont .box{
  	position: relative;
  	width: 300px;
  	height: 300px;
  	background: #ff0;
  	margin: 10px;
  	box-sizing: border-box;
  	display: inline-block;
  }
  .cont .box .imgbox{
  	position: relative;
  	overflow: hidden;
  }

   .cont .box .imgbox img{
   	  max-width: 100%;
       height: 300px;
   	  transition: transform 2s;
  }
    .cont .box:hover .imgbox img{
   	  transform: scale(1.2); 
  }
  .cont .box .detail{
  	position: absolute;
  	top:10px ;
  	bottom: 10px;
  	left: 10px;
  	right: 10px;
  	background: rgba(0, 0, 0, .5);
  	transform: scaleY(0);
  	transition: transform .5s;
  }
  .cont .box:hover .detail{
	transform: scaleY(1);
  }
  .cont .box .detail .contain{
  	position: absolute;
  	top: 50%;
  	transition: translateY(-50%);
  	text-align: center;
  	padding: 10px;
  	color: #fff;
  }
   .cont .box .detail .contain h2{
   	  margin: 0px;
   	  padding: 0px;
   	  font-size: 20px;
   	  color: #ff0;
   }
    .cont .box .detail .contain p{
 	  margin: 0px;
   	  padding: 0px;
   	  font-size: 20px;
   	  color: #fff;
   }
</style>


<div class="cont">

<?php
	$query  = "SELECT * FROM tbl_gallery ORDER BY id ";
	$gallery = $db->select($query); 
		if ($gallery) {
			while($result = $gallery->fetch_assoc()){
?>	
	<div class="box">
		<div class="imgbox">
			<img src="admin/<?php echo $result['image'];?>" alt="">
		</div>
		<div class="detail">
		  <div class="contain">
		  	<p><?php echo $result['title'];?></p>
		  </div>	
			
		</div>
	</div>
<?php } } ?>	

</div>

<!-- <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="<?php echo $result['title'];?>" title="<?php echo $result['title'];?>" />
	    </a> -->


<?php include "inc/footer.php"?>