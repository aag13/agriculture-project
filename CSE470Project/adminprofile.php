<?php 
	
	session_start();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> 
Admin Login
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href = "dropdown_for_all.css" rel = "stylesheet" type = "text/css">
<link href = "dropdown_for_index.css" rel = "stylesheet" type = "text/css">
<link href = "textimage.css" rel = "stylesheet" type = "text/css">
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
/*end of drop down*/
.th_1
{
background-color : #00796B;
text-align : center;
font-family : tahoma;
color : white
}
.bodyboxing
{
padding-bottom : 100%;
}
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


.food
{
 position : absolute;
 top : 50px;
 left : 0px;
 width : 250px;
 text-align : center;
}
.food:hover
{
background-color : #F5F6FC;
}

.crops
{
 position : absolute;
 top : 50px;
 left : 250px;
 width : 250px;
 text-align : center;
}
.crops:hover
{
background-color : #F5F6FC;
}

.dhaka
{
 position : absolute;
 top : 350px;
 left : 0px;
 width : 250px;
 text-align : center;
}
.dhaka:hover
{
background-color : #F5F6FC;
}

.chittagong
{
 position : absolute;
 top : 350px;
 left : 250px;
 width : 250px;
 text-align : center;
}
.chittagong:hover
{
background-color : #F5F6FC;
}

.rajshahi
{
 position : absolute;
 top : 350px;
 left : 500px;
 width : 250px;
 text-align : center;
}
.rajshahi:hover
{
background-color : #F5F6FC;
}

.khulna
{
 position : absolute;
 top : 350px;
 left : 750px;
 width : 250px;
 text-align : center;
}
.khulna:hover
{
background-color : #F5F6FC;
}

.barisal
{
 position : absolute;
 top : 650px;
 left : 0px;
 width : 250px;
 text-align : center;
}
.barisal:hover
{
background-color : #F5F6FC;
}

.rangpur
{
 position : absolute;
 top : 650px;
 left : 250px;
 width : 250px;
 text-align : center;
}
.rangpur:hover
{
background-color : #F5F6FC;
}

.sylhet
{
 position : absolute;
 top : 650px;
 left : 500px;
 width : 250px;
 text-align : center;
}
.sylhet:hover
{
background-color : #F5F6FC;
}

.mymensingh
{
 position : absolute;
 top : 650px;
 left : 750px;
 width : 250px;
 text-align : center;
}
.mymensingh:hover
{
background-color : #F5F6FC;
}
</style>
</head>

<body class = "bodyboxing">
<a href="index.php" class = "sitename">agroSOFT</a>
<ul id="drop-nav"  class = "dropdown">
  <li><a href = "about.php">About Us</a></li>
  <li><a href = "contact.php">Contact Us</a></li>
  <li>
	<?php 
	echo "	"."<a href=\"logout_process.php\">Log Out</a>";
	?>
  </li>
</ul>

<!--------------------------------------Divider-------------------------------------------->
<img src = "divider.jpg" class = "divider">
<!----------------------------------------------------------------------------------------->

<div class = "bodycenter">
<?php 
	if(isset($_SESSION["username"])){
	$display = "none";
	//echo $_SESSION["message"];
	//echo "1";	
	}else{
	$display = "block";
	echo "2";
	}
?>


<?php
include("php_functions.php");
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "agrosoft";
$conn = mysqli_connect($dbhost , $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	
	// this should not be shown to USERS......
}

$un = $_SESSION["username"];

$sql = "SELECT fullname, admin_id, mobile_no FROM admin_info WHERE username = '$un'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Welcome " . $row["fullname"]. "<br/>";//" ID: " . $row["admin_id"]. " Mobile No : " . $row["mobile_no"]. "<br />";
    }
	
	
} else {
    echo "0 results";
}
//mysqli_close($conn);
?>
<div class = "food">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="user1.png" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="userinfo.php">User Info</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">User Informations</div>
	</div>
</div>
<p>Users</p>
<p>Click here to see all the users information that are available in the database</p>
</div><!--end of food-->

<div class = "crops">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="crops.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="crops.php">Crops</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Crops</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->


<div class = "dhaka">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="dhaka.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="dhaka.php">Dhaka</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Dhaka Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->


<div class = "chittagong">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="chittagong.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="chittagong.php">Chittagong</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Chittagong Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->

<div class = "rajshahi">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="rajshahi.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="rajshahi.php">Rajshahi</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Rajshahi Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->

<div class = "khulna">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="khulna.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="khulna.php">Khulna</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Khulna Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->

<div class = "barisal">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="barisal.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="barisal.php">Barisal</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Barisal Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->

<div class = "rangpur">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="rangpur.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="rangpur.php">Rangpur</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Rangpur Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->

<div class = "sylhet">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="sylhet.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="sylhet.php">Sylhet</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Sylhet Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->

<div class = "mymensingh">
<div class="jm-item second">
	<div class="jm-item-wrapper">
		<div class="jm-item-image">
			<img src="mymensingh.jpg" width="155" height="120" alt="Pizza Ristorante" />
			  <div class="jm-item-description">
			   <div class="jm-item-button">
			     <a href="mymensingh.php">Mymensingh</a>
			   </div>
			  </div>
		</div>
		<div class="jm-item-title">Crops Information</div>
	</div>
</div>
<p>Mymensingh Division</p>
<p>Click here to see all the crops information that are available in the database</p>
</div><!--end of food-->
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
			
			<li>
				<a href="registration.php">
					<strong>Registration</strong>
					<small>To become a member</small>
				</a>
			</li>
		</ul>
	</nav>
</div>
<!---------------------------------------------------------------------------------------->


<div class = "end">
<p>type something to fill up this section </p>
</div><!--end of end-->
</body>
</html>