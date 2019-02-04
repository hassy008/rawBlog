<div class="clear">
</div>

<div class="grid_2">
<div class="box sidemenu">
    <div class="block" id="section-menu">
        <ul class="section menu">
           <li><a class="menuitem">Site Option</a>
     <!--Here Only Admin can Add Category-->               
    <?php if (Session::get('userRole')=='0') { ?>             

                <ul class="submenu">
                   
                    <li><a href="titleslogan.php">Title & Slogan</a></li>
                    <li><a href="social.php">Social Media</a></li>
                    <li><a href="copyright.php">Copyright</a></li>
                </ul>

     <?php } ?>                            
            </li>
			
            <li><a class="menuitem">  Pages</a>
                <ul class="submenu">
 <!--Here Only Admin can Add Page--> 
<?php if (Session::get('userRole')=='0') { ?>                     
                    <li><a href="addpage.php">Add New Page</a></li>
<?php    }  ?>   <!--End-->                   
    
    <?php
        $query = "SELECT * FROM tbl_page ";
        $pages = $db->select($query);
        if ($pages) {
            while ($result = $pages->fetch_assoc()) {   
    ?>        
            <li><a href="page.php?pageid=<?php echo $result['id'] ;?>"><?php echo $result['name'] ;?></a></li>
    <?php   }  } ?>  
                </ul>
            </li>
           
            <li><a class="menuitem">Category Option</a>
                <ul class="submenu">
    <!--Here Only Admin can Add Category-->               
    <?php if (Session::get('userRole')=='0') { ?> 
                    <li><a href="addcat.php">Add Category</a> </li>
    <?php }?>      <!--END-->                

                     <li><a href="catlist.php">Category List</a> </li>
                </ul>
            </li>
            

            <li><a class="menuitem">Post Option</a>
                <ul class="submenu">
                    <li><a href="addpost.php">Add Post</a> </li>
                    <li><a href="postlist.php">Post List</a> </li>
                </ul>
            </li>


             <li><a class="menuitem">Slider Option</a>
                <ul class="submenu">
                    <li><a href="addslider.php">Add Slider</a> </li>
                    <li><a href="sliderlist.php">Slider List</a> </li>
                </ul>
            </li>
            <li><a class="menuitem">Gallery Option</a>
                <ul class="submenu">
                    <li><a href="addphoto.php">Add Photo</a> </li>
                    <li><a href="photolist.php">Photo List</a> </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
</div>