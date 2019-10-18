<?php 
	
	session_start();
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
About Us
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
.end 
{
position : absolute;
top : 100%;
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
			<li>	<a>
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