<?php 
	
	session_start();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> 
Crops Informations
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
left : 800px;
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
padding-bottom : 200%;
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
</style>
</head>

<body class = "bodyboxing">
<a href="index.php" class = "sitename">agroSOFT</a>
<ul id="drop-nav"  class = "dropdown">
  <li><a href = "adminprofile.php">Profile</a></li>
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
$dbpass = "root"; // should same password root
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

<!------------------------------Dhaka---------------------------------->
<h2>Crops Informations : </h2>
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Dhaka</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 1 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Dhaka Table---------------------------------->
<br/>
<!------------------------------Rajshahi Table---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Rajshahi</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 2 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Rajshahi Table---------------------------------->
<br/>
<!------------------------------Khulna Table---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Khulna</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 3 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Khulna Table---------------------------------->
<br/>
<!------------------------------Chittagong---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Chittagong</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 4 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Chittagong Table---------------------------------->
<br/>
<!------------------------------Barisal Table---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Barisal</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 5 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Barisal Table---------------------------------->
<br/>
<!------------------------------Rangpur Table---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Rangpur</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 6 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Rangpur Table---------------------------------->
<br/>
<!------------------------------Mymensingh Table---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Mymensingh</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 7 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Mymensingh Table---------------------------------->
<br/>
<!------------------------------Sylhet Table---------------------------------->
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<caption class = "th_1">Sylhet</caption>
<th class = "th_1">Crops Name</th>
<th class = "th_1">Year</th>
<th class = "th_1">Price</th>
<th class = "th_1">Cultivable Land</th>
<th class = "th_1">Estimated Production</th>
<?php	
$sql = "SELECT name, division_id, price, year, cultivated_land, estimated_production FROM crop WHERE division_id = 8 ORDER BY year";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 			
		"<tr> 
         <td>".$row["name"]."</td>
		 <td>".$row["year"]."</td>
		 <td>".$row["price"]."</td>
		 <td>".$row["cultivated_land"]."</td>
		 <td>".$row["estimated_production"]."</td>
	    </tr>";		
    }		
} 
else {
    echo "0 results";
}
//mysqli_close($conn);
?>
</table>
<!------------------------------End Of Sylhet Table---------------------------------->

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