<?php 
	
	session_start();
	include("database_function.php");
	include("php_functions.php");
	
	$contact_message = "";
	$contact_message_display = "none";
	
	if(isset($_POST["submit"])){
		
		$flag = 1;
		$email = trim($_POST["email"]);
		$subject = trim($_POST["subject"]);
		$comment = trim($_POST["comment"]);
		if ($email == "") {
			$contact_message = "Valid Email is Required<br />";
			$contact_message_display = "block";
			$flag = 0;
			} else {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
				}else{
				$contact_message = "Valid Email is Required<br />";
				$contact_message_display = "block";
				$flag = 0;
			}
		}
		
		if ($subject == "") {
			$contact_message = $contact_message."Subject is Required<br />";
			$contact_message_display = "block";
			$flag = 0;
		}
		
		if ($comment == "") {
			$contact_message = $contact_message."How can we help you if you do not provide comment???<br />";
			$contact_message_display = "block";
			$flag = 0;
		}else{
			$comment = $email."\n".$comment;
		}
		
		if($flag == 1){
			// no error, so send mail
			$comment = wordwrap($comment,70);
			mail("admin@agrosoft.com",$subject,$comment);
			$contact_message = "Your Comment was sent successfully. The Admin will get back to you soon";
			$contact_message_display = "block";
		}
		
		
	}
	
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			Contact Us
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href = "dropdown_for_all.css" rel = "stylesheet" type = "text/css">
		<link href = "dropdown_for_index.css" rel = "stylesheet" type = "text/css">
		<style type = "text/css">
			/*Divider class*/
			.divider
			{
			position : absolute;
			top : 90px;
			width : 1320px;
			}
			/*End of divider class*/
			
			/*for bodycenter*/
			.bodycenter
			{
			position : absolute;
			top : 120px;
			left : 200px;
			}
			/*end of body center*/
			
			/*for log out*/
			.logout
			{
			position : absolute;
			top : 100px;
			left : 1000px;
			}
			/*end of log out*/
			/*for Drop down*/
			.dropdown
			{
			left : 900px;
			}
			.user
			{
			position : absolute;
			left : 730px;
			top : 30px;
			font-family : "Comic Sans MS", cursive, sans-serif;
			}
			
			/*end of drop down*/
			.th_1
			{
			background-color : #00796B;
			text-align : center;
			font-family : tahoma;
			color : white
			}
			.end 
			{
			position : absolute;
			top : 1300px;
			background-color : #263238;
			width : 1330px;
			padding-bottom : 300px; 
			color : #CFD8DC;
			text-align : center;
			}
		</style>
	</head>
	
	<body class = "bodyboxing">
		<a href="index.php" class = "sitename">agroSOFT</a>
		<ul id="drop-nav"  class = "dropdown">
			
			<li><?php 
				if(isset($_SESSION["username"])){
					
					echo $_SESSION["message"]; //check how it is viewed in diff. page
					echo "	"."<a href=\"logout_process.php\">Log Out</a>";
				}
			?></li>
			<li><a href = "about.php">About Us</a></li>
			<li><a href = "contact.php">Contact Us</a></li>
		</ul>
		<!--------------------------------------Divider-------------------------------------------->
		<img src = "divider.jpg" class = "divider">
		<!----------------------------------------------------------------------------------------->
		
		<div class = "bodycenter">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				
				<div id="contact_message" style="display:<?php echo $contact_message_display ; ?>">
					
					<?php echo $contact_message;
					?>
					
				</div>
				
				<br />
				
				Email:
				<input type="text" name="email" value="">
				<br /><br />
				
				Subject:
				<input type="text" name="subject" value="">
				<br /><br />
				
				Comment:
				<textarea name="comment" value="" rows="4" cols="50">
					
				</textarea> 
				<br /><br />
				
				<input type="submit" name="submit" value="Submit" >
				
				
			</form>
			
		</div><!--end of bodycenter-->
		
		
		<!--------------------------------Container Class----------------------------------------->
		<div class="container">
			<nav>
				<ul class="mcd-menu">
					<li>
						<a href="index.php" class="active">
							<strong>Home</strong>
							<small>agroSOFT</small>
						</a>
					</li>
					<li>
						<a>
							<strong>Division</strong>
							<small>Select division</small>
						</a>
						<ul>
							<li><a href="dhaka.php">Dhaka</a></li>
							<li><a href="chittagong.php">Chittagong</a></li>
							<li><a href="rajshahi.php">Rajshahi</a></li>
							<li><a href="khulna.php">Khulna</a></li>
							<li><a href="barisal.php">Barisal</a></li>
							<li><a href="rangpur.php">Rangpur</a></li>
							<li><a href="sylhet.php">Sylhet</a></li>
							<li><a href="mymensingh.php">Mymensingh</a></li>
						</ul>
					</li>
					<li>
						<a href="bangladesh.php">
							<strong>Bangladesh</strong>
							<small>Total production</small>
						</a>
					</li>
					
					<li>
						<a href="explore.php">
							<strong>Explore Database</strong>
						</a>
					</li>
					
					<?php 
						if(isset($_SESSION["username"])){
							echo "<li> <a href=\"update.php\"><strong>Update Database</strong></a> </li>";
							
							echo "<li> <a href=\"which_crop_to_plant.php\"><strong>Which Crop To Plant</strong></a> </li>";
							echo "<li> <a href=\"view_graph.php\"><strong>View Graph</strong></a> </li>";
							}else{
							
							echo "<li> <a href=\"registration.php\"><strong>Registration</strong><small>To become a member</small></a> </li>";
						}
						
					?>
				</ul>
			</nav>
		</div>
		<!---------------------------------------------------------------------------------------->
		
	</body>
</html>