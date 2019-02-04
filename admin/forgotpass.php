<?php 
	include "../lib/session.php";
	Session::checkLogin();
?>
<?php  
include "../config/config.php";
include "../lib/database.php";
include "../helpers/format.php";
?>

<?php
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<?php
	if ($_SERVER['REQUEST_METHOD']=="POST") {
		$email = $fm->validation(md5($_POST['email']));
//realescapestring to protect code from malicious script
		$email = mysqli_real_escape_string($db->link,$email);
		

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		  	echo "<span style='color:red;font-size:18px;'>Invalid email format</span>"; 

		}


		else{
//check input is available or not in our DATABASE
		$mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
        $mailcheck = $db->select($mailquery);
        if ($mailcheck != false) {
        	while ($value = $mailcheck->fetch_assoc()) {
        	    $userid   = $value['id'];
        	    $username = $value['username'];
        	} //now we generate password
        	$text = substr($email, 0, 3);
        	$rand = rand(1000,99999);
        	$newpass = "$text$rand";
        	$password = md5($newpass);
//update database
        	$updatequery = "UPDATE tbl_user
        			SET
        			password = '$password'
        			WHERE id = '$userid'";
        	$updated_row = $db->update($updatequery);	
/*//https://www.w3schools.com/php/func_mail_mail.asp ()-------Syntax-----
mail(to,subject,message,headers,parameters);*/        			
			$to 	   = "$email";
			$from  	   = "hasnathrumman1234@gmail.com";
			$headers   = "From:$form\n";
// To send HTML mail, the Content-type header must be set
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			$subject   = "Your Password";
			$message   = "Your Username is ".$username." and Password is ".$newpass." Please Visit Website To Login. ";

			$sendmail  = mail($to, $subject, $message, $headers);
				if ($sendmail) {
					echo "<span style='color:green;font-size:18px;'>Please Check Your Email </span> ";
				}else {
					echo "<span style='color:red;font-size:18px;'>Email NOT Sent</span>";
				}

        } else{
			echo "<span style='color:red;font-size:18px;'>Email NOT Exist</span>";
		}
	}
}	
?>		
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Sent Email" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login !!!</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Login Your Profile</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>