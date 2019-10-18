<?php 
	
	session_start();
	$username2 = $email = $division = $present_address = $permanent_address = "";
	$edit_display = "none";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> 
User Informations
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
input
{
padding: 5px;
font-family : "Comic Sans MS", cursive, sans-serif;
border: 2px solid;
border-radius : 5px;
border-color : #b4ccce #b3c0c8 #9eb9c2;
}
button
{
padding: 5px;
font-family : "Comic Sans MS", cursive, sans-serif;
border: 2px solid;
border-radius : 5px;
border-color : #b4ccce #b3c0c8 #9eb9c2;
}
</style>
<script>
			
			function edit_clicked(){
				document.getElementById("edit").style.display = "block";
			}
			
			
</script>
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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrosoft";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$nid = "";
$sql = "";
// sql to delete a record
if( isset($_POST['submit']) )
{
    //be sure to validate and clean your variables
    $nid = htmlentities($_POST['nid']);
	$sql = "DELETE FROM userrecord WHERE nid=$nid";
	if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "";
}

$conn->close();
}
if(isset($_POST['edit']))
{
   $nid = htmlentities($_POST['nid']);
   $username2 = htmlentities($_POST['username2']);
   $email = htmlentities($_POST['email']);
   $division = htmlentities($_POST['division']);
   $present_address = htmlentities($_POST['present_address']);
   $permanent_address = htmlentities($_POST['permanent_address']);
   $sql = "UPDATE userrecord SET username = '$username2', email = '$email', posting = '$division', present_address = '$present_address', permanent_address = '$permanent_address' WHERE nid=$nid";
   if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "";
}

$conn->close();
}
?>

<?php
include("php_functions.php");
$dbhost = "localhost";
$dbuser = "root";
$dbpass = ""; // should same password root
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
<p>
Please type the NID to delete the user
<form method = "post" action = "userinfo.php">	
<input type = "integer" name = "nid" id = "nid" value = "" placeholder="National ID Number">
</p>
<p><input type = "submit" name = "submit" value = "Delete">		
<button type="button"  name="edit" value="" onclick="edit_clicked();" >Edit</button> </p>
</form>
<div id="edit" style="display:<?php echo $edit_display ?>">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<p>National ID Number:</p> 
                    <p><input type = "text" name = "nid" value = "" placeholder="National ID Number"></p> 					
					<p>Username</p>
					<p><input type="text" name="username2" value="" placeholder="Username"></p>
					<p>Email:<p/>
					<p><input type="text" name="email" value="" placeholder="Email Address"></p>
					<p>Division:</p>
					<p><input type="text" name="division" value="" placeholder="Division"></p>
					<p>Present Address:</p>
					<p><input type="text" name="present_address" value="" placeholder="Present Address"></p>
					<p>Permanent Address:</p>
					<p><input type="text" name="permanent_address" value="" placeholder="Permanent Address"></p>
					<p><input type="submit" name="edit" value="Edit"></p>
					
				</form>
				
			</div>

<h2>User Informations : </h2>
<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
<th class = "th_1">User Name</th>
<th class = "th_1">National ID No</th>
<th class = "th_1">Email Address</th>
<th class = "th_1">Posting</th>
<th class = "th_1">Present Address</th>
<?php
$sql = "SELECT username, nid, email, posting,present_address FROM userrecord ORDER BY username";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo 
		
		"<tr>
         <td>".$row["username"]."</td>
		 <td>".$row["nid"]."</td>
		 <td>".$row["email"]."</td>
		 <td>".$row["posting"]."</td>
		 <td>".$row["present_address"]."</td>
	    </tr>";
		
    }
	
	
} else {
    echo "0 results";
}
?>
</table>

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