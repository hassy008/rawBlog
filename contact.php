<?php include "inc/header.php";?>
<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		$fname = $fm->validation($_POST['firstname']);
		$lname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body = $fm->validation($_POST['body']);

		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$body = mysqli_real_escape_string($db->link, $body);

		$errorf="";
		$errorl="";
		$errorb="";
		$errore="";
		if (empty($fname)) {
			$errorf ="First Name Must Not Empty";
		}if (empty($lname)) {
			$errorl ="First Name Must Not Empty";
		}if (empty($email)) {
			$errorb ="First Name Must Not Empty";
		}if (empty($body)) {
			$errore ="First Name Must Not Empty";
		}

/*	this is another way to write code	
	$error="";
		if (empty($fname)) {
			$error = "First Name Must Not Empty";
		}elseif (empty($lname)) {
			$error = "Last Name Must Not Empty";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid Email";
		}elseif (empty($body)) {
			$error = "Body Name Must Not Empty";		
		}*/


		else{
			$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$fname','$lname','$email','$body')";
			$inserted_row = $db->insert($query);
			if ($inserted_row) {
				$msg = "Message Sent Successfully";
			}else{
				$error = "Message Not Send";
			}

		}	

	}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact Us</h2>
<!--this is another way to show code on our blog page -->

	
	<?php 
	if (isset($error)) {
		echo "<span style='color:red'><b>$error</b></span>";
	}
	if (isset($msg)) {
		echo "<span style='color:green'><b>$msg</b></span>";
	}
?> 
		<form action="" method="post">
			<table>
			<tr>
				<td>Your First Name:</td>
				<td>
					<?php
					if (isset($errorf)) {
						echo "<span class='customerror'>$errorf</span>";	
						}	
					?>
				<input type="text" name="firstname" placeholder="Enter first name" />
				</td>
			</tr>
			<tr>
				<td>Your Last Name:</td>
				<td>
					<?php
					if (isset($errorl)) {
						echo "<span class='customerror'>$errorl</span>";	
						}	
					?>
				<input type="text" name="lastname" placeholder="Enter Last name" />
				</td>
			</tr>
			
			<tr>
				<td>Your Email Address:</td>
				<td>
					<?php
					if (isset($errore)) {
						echo "<span class='customerror'>$errore</span>";	
						}	
					?>
				<input type="email" name="email" placeholder="Enter Email Address" />
				</td>
			</tr>
			<tr>
				<td>Your Message:</td>
				<td>
					<?php
					if (isset($errorb)) {
						echo "<span class='customerror'>$errorb</span>";	
						}	
					?>
				<textarea name="body"></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
				<input type="submit" name="submit" value="Send"/>
				</td>
			</tr>
	</table>
<form>				
</div>


<div class="googlemap">
	<h2>Our Location</h2>
	  <div id="map"></div>

</div> 

</div>


<?php include "inc/sidebar.php";?>	
<?php include "inc/footer.php";?>	
	