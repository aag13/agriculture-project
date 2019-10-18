<?php
	
	session_start();
	if(isset($_SESSION["username"])){
		header("Location: index.php");
		exit;
	}
	
	include("database_function.php");
	include("php_functions.php");
	
	$form_confirmation_message = "";
	
	$connection = database();
	
	$username_error = $password_error = $email_error = $nid_error = $present_address_error = $permanent_address_error = $posting_error = "";
	$username = $password = $email = $nid = $present_address = $permanent_address = "";
	$posting = "dhaka";
	
	if (isset($_POST["submit"])) {
		$username = check_data($_POST["username"]);
		$password = "";
		$password1 = check_data($_POST["password1"]);
		$password2 = check_data($_POST["password2"]);
		$email = check_data($_POST["email"]);
		$nid = check_data($_POST["nid"]);
		$present_address = check_data($_POST["present_address"]);
		$permanent_address = check_data($_POST["permanent_address"]);
		$posting = check_data($_POST["posting"]);
		
		$temp_posting = "";
		
		
		/* echo "<pre>";
			print_r($_POST);
			echo "</pre>";
		die(); */
		
		//username
		//username has to be unique, check the database whether one already exists
		//show some text on hover....like, no space allowed
		if ($username == "") {
			$username_error = "Username is required";
			$username = "";
			
		}else {
			if (preg_match('/^[A-Za-z]{1}[A-Za-z0-9]*$/', $username)){
				//the username is valid in pattern
				$query = "select * from userrecord where username='{$username}';";
				$result = mysqli_query($connection,$query);
				$row_number = mysqli_num_rows($result);
				if($row_number  == 1){
					// username already exists
					$username_error = "Username already exists";
					$username = "";
				}else{
					
					}	
			}else{
				//username NOT valid in pattern
				$username_error = "Username Pattern NOT Valid";
				$username = "";
				
			}
			
		}
		
		//password
		//for password  whether password 1 and 2 match
		if ($password1 == "" || $password2 == "") {
			$password_error = "Password is required";
			$password = "";
		} else {
				if($password1 != $password2){
				// password does NOT match
				$password_error = "Passwords did NOT match";
				$password = "";
				}else{
				// both passwords match
				$password = password_hash($password1, PASSWORD_DEFAULT);
			}
		}
		
		
		//email
		//valid email address NOW CHECKS ONLY PATTERN, NOT WHETHER THE MAIL ACTUALLY EXISTS
		if ($email == "") {
			$email_error = "Email is required";
			$email = "";
		} else {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
			}else{
				$email_error = "Email is NOT valid";
				$email = "";
				}
		}
		
		//nid
		//nid has to exist in agriculture database, but can not exist in agrosoft database(same nid can NOT be used twice
		//to create users)
		if ($nid == "") {
			$nid_error = "NID is required";
			$nid = "";
			
			}else {
			$query = "select * from userrecord where nid='{$nid}';";
			$result = mysqli_query($connection,$query);
			$row_number = mysqli_num_rows ($result);
			if($row_number  == 1){
				// nid already exists
				$nid_error = "NID already exists";
				$nid = "";
				}else{
				//this nid does not exist in agrosoft database, now check whether it exists in agri. database;
				$dbhost1 = "localhost";
				$dbuser1 = "root";
				$dbpass1 = "root";
				$dbname1 = "agriculturedatabase";
				$connection1 = mysqli_connect($dbhost1 , $dbuser1, $dbpass1, $dbname1);
				$query1 = "select * from employeerecord where nid='{$nid}';";
				$result1 = mysqli_query($connection1,$query1);
				$row_number1 = mysqli_num_rows ($result1);
				if($row_number1 == 0){
					//this NID does not exist in agri. database....so NOT Valid
					$nid_error = "NID is NOT IN agriculture database";
					$nid = "";
				}else{
					$row1 =  mysqli_fetch_assoc($result1);
					$temp_posting = $row1["posting"];
					
				}
				mysqli_close($connection1);
			}
		}
		
		//present_address
		//bothe the present and permanent address field filled up
		if ($present_address == "") {
			$present_address_error = "Present Address is required";
			$present_address = "";
			} else {
		}
		
		//permanent_address
		if ($permanent_address == "") {
			$permanent_address_error = "Permanent Address is required";
			$permanent_address = "";
			} else {
		}
		
		//posting
		if($posting == $temp_posting){
			//both postings match, no error
			$posting_error = "";
		}else{
			$posting_error = "posting has to match with agriculture database";
			
		}
		
		if($username_error == "" && $password_error == "" && $email_error == "" && $nid_error == "" &&
		$present_address_error == "" && $permanent_address_error == "" && $posting_error == "")
		{
			// NO errors caught
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "root";
			$dbname = "agrosoft";
			$connection = mysqli_connect($dbhost , $dbuser, $dbpass, $dbname);
			$query = "insert into userrecord (nid, name,username, password, email, posting, present_address, permanent_address) 
			values ('{$nid}', '', '{$username}' , '{$password}', '{$email}', '{$posting}', '{$present_address}', 
			'{$permanent_address}');";
			$result = mysqli_query($connection,$query);
			
			if($result){
				$form_confirmation_message = "new user created successfully";
			}else{
				die("ERROR: connection to database failed");
				//should not show to the USERS
			}
			
			}else{
			// there were ERRORS
			$form_confirmation_message = "fix the errors and submit the form again";
		}
		
		
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
Registration
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href = "dropdown_for_all.css" rel = "stylesheet" type = "text/css">
<link href = "dropdown_for_index.css" rel = "stylesheet" type = "text/css">
<style type = "text/css">
			
.error {color: #FF0000;}
			
/*Divider class*/
.divider
{
	position : absolute;
	top : 90px;
	width : 1320px;
}
/*End of divider class*/

/*Start of login class*/			
.login
{
  background-color : white;
  position : absolute;
  left : 200px;
  top : 110px;
  width : 600px;
  padding-left : 15px;
  padding-top : 20px;
  border-radius : 20px;
  border : 3px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  box-shadow : 10px 10px 5px #aaa;
}
input[type=submit] {
  padding: 0 18px;
  height: 29px;
  font-size: 12px;
  font-weight: bold;
  color: #527881;
  text-shadow: 0 1px #e3f1f1;
  background: white;
  border: 2px solid;
  border-color: #b4ccce #b3c0c8 #9eb9c2;
  border-radius: 16px;
}
input
{
padding: 5px;
font-family : "Comic Sans MS", cursive, sans-serif;
border: 2px solid;
border-radius : 5px;
border-color : #b4ccce #b3c0c8 #9eb9c2;
}
/*End of Login class*/
</style>
</head>

<body class = "bodyboxing">
<a href="index.php" class = "sitename">agroSOFT</a>
<ul id="drop-nav"  class = "dropdown">
  <li><a href = "about.php">About Us</a></li>
  <li><a href = "contact.php">Contact Us</a></li>
</ul>

<!--------------------------------------Divider-------------------------------------------->
<img src = "divider.jpg" class = "divider">
<!----------------------------------------------------------------------------------------->

<!---------------------------------Registration Form-------------------------------------->
		<div class = "login">
		
		<?php //the value of each field is going to come from $variables , so that valid fields are not gone if
			// submission fails....?>
		
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<?php echo $form_confirmation_message; ?><br />
				Username : 
				<input type = "text" name = "username" value="<?php echo $username ?>" placeholder="Username" maxlength="60" size = "60px" >
				<span class="error">* <?php echo $username_error;?></span>
				<br /><br />
				Password : 
				<input type = "password" name = "password1" value="" placeholder="Password" maxlength="20" size = "60px">
				<span class="error">* <?php echo $password_error;?></span>
				<br /><br />
				Confirm Password : 
				<input type = "password" name = "password2" value="" placeholder="Confirm Password" maxlength="20" size = "60px">
				<span class="error">* <?php echo $password_error;?></span>
				<br /><br />
				Email Address : 
				<input type = "text" name = "email" value="<?php echo $email ?>" placeholder="Email Address" maxlength="30" size = "60px">
				<span class="error">* <?php echo $email_error;?></span>
				<br /><br />
				Voter ID Number : 
				<input type = "text" name = "nid" value="<?php echo $nid ?>" placeholder="Voter Id Number" size = "60px">
				<span class="error">* <?php echo $nid_error;?></span>
				<br /><br />
				Present Address : 
				<input type = "text" name = "present_address" value="<?php echo $present_address ?>" placeholder="Present Address" maxlength="50" size = "60px">
				<span class="error">* <?php echo $present_address_error;?></span>
				<br /><br />
				Permanent Address : 
				<input type = "text" name = "permanent_address" value="<?php echo $permanent_address ?>" placeholder="Permanent Address" maxlength="50" size = "60px">
				<span class="error">* <?php echo $permanent_address_error;?></span>
				<br /><br />
				Posting : 
				<select name="posting"> <span class="error">* <?php echo $posting_error;?></span>
					<option value="dhaka" <?php if($posting == "dhaka") {echo " selected='selected'"; } ?> >Dhaka</option>
					<option value="khulna" <?php if($posting == "khulna") {echo " selected='selected'"; } ?> > Khulna</option>
					<option value="rajshahi" <?php if($posting == "rajshahi") {echo " selected='selected'"; } ?> > Rajshahi</option>
					<option value="chittagong" <?php if($posting == "chittagong") {echo " selected='selected'"; } ?> > Chittagong</option>
					<option value="barisal" <?php if($posting == "barisal") {echo " selected='selected'"; } ?> > Barisal </option>
					<option value="mymensingh" <?php if($posting == "mymensingh") {echo " selected='selected'"; } ?> > Mymensingh</option>
					<option value="rangpur" <?php if($posting == "rangpur") {echo " selected='selected'"; } ?> > Rangpur </option>
					<option value="sylhet" <?php if($posting == "sylhet") {echo " selected='selected'"; } ?> >Sylhet</option>
				</select>
				<br /><br />
				
				<input type ="submit" name="submit" value="submit">
			</form>
		</div>
		<!---------------------------------------------------------------------------------------->

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