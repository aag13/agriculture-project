<?php 
	
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: index.php");
		exit;
	}
	
	include("database_function.php");
	include("php_functions.php");
	
	$update_confirmation_message = "Noting to show now";
	$update_confirmation_message_display = "none";
	
	$old_price = $old_cultivated_land = $old_estimated_production = "Previous Amount";
	
	$flag = "disabled"; // disable true
	$year = $posting = $crop_name = "";
	
	$new_price = $new_cultivated_land = $new_estimated_production = "New Amount";
	$new_price_message = $new_land_production_message = "";
	
	$new_price_message_display = "none";
	$new_land_production_message_display = "none";
	
	// show_previous_amount
	if(isset($_POST["show_previous_amount"])){
		
		$year = $_POST["year"];
		$posting = $_SESSION["posting"];
		$crop_name = $_POST["crop_name"];
		
		$flag = ""; // disable false
		$update_confirmation_message_display = "block";
		$new_price_message_display = "none";
		$new_land_production_message_display = "none";
		
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
			}else{
			//successful connection
			$query = "select price,cultivated_land,estimated_production from crop where 
			name='{$crop_name}' and year='{$year}' and division_id = (select division_id from division 
			where division_name = '{$posting}');";
			
			$result = mysqli_query($connection,$query);
			
			
			if($row = mysqli_fetch_assoc($result)){
				$update_confirmation_message = "Showing Previous Amount";
				$old_price = $row["price"];
				$old_cultivated_land = $row["cultivated_land"];
				$old_estimated_production = $row["estimated_production"];
				}else{
				$update_confirmation_message = "No data To show for this Crop in this Year";
				//print_r($result);
				//no amount for that crop
				$old_price = "00";
				$old_cultivated_land = "00";
				$old_estimated_production = "00";
				
			}
			
		}
		
		mysqli_close($connection);
	}
	
	
	// update_price
	if(isset($_POST["update_price"])){
		
		$year = $_POST["year"];
		$posting = $_SESSION["posting"];
		$crop_name = $_POST["crop_name"];
		$new_price = $_POST["new_price"];
		$old_price = $_POST["old_price"];
		
		$new_cultivated_land = $_POST["cultivated_land"];
		$old_cultivated_land = $_POST["old_cultivated_land"];
		
		$new_estimated_production = $_POST["estimated_production"];
		$old_estimated_production = $_POST["old_estimated_production"];
		
		$flag = ""; // disable false
		
		$update_confirmation_message_display = "block";
		$new_price_message_display = "block";
		
		if(!is_numeric($new_price) || floatval($new_price) < 0){
			$update_confirmation_message = "Must Put valid Positive number in New Amount Field To update";
			
			}else{
			
			$new_price_message = "Updated current price is <strong>{$new_price}</strong>";
			
			$flag = ""; // disable false
			
			$connection = database();
			if(!$connection){
				//error
				die("error while connecting to database!!!");
				
				}else{
				//successful connection
				
				//first select the info to see if it exists, if it doesn't then create with INSERT
				
				$query = "select price from crop where year='{$year}' and name='{$crop_name}' and division_id=(select division_id from division 
				where division_name = '{$posting}');";
				
				$result = mysqli_query($connection,$query);
				if($result){
					
					if(mysqli_fetch_row($result)){
						//this row exists, so Update
						$query = "update crop set price='{$new_price}' 
						where year='{$year}' and name='{$crop_name}' and division_id=(select division_id from division 
						where division_name = '{$posting}');";
						
						$result = mysqli_query($connection,$query);
						if($result){
							$update_confirmation_message = "Information was updated successfully.";
							}else{
							$update_confirmation_message = "Something wrong with the Query!!!!!";
						}
						
						
						}else{
						// row does not exist, so insert row with updated data
						$query = "select division_id from division where division_name = '{$posting}';";
						$result = mysqli_query($connection,$query);
						$row = mysqli_fetch_assoc($result);
						$d_id = $row["division_id"];
						
						$query = "insert into crop(name, division_id, year, price, cultivated_land, estimated_production) values('{$crop_name}', '{$d_id}', '{$year}', '{$new_price}', '00', '00');";
						$result = mysqli_query($connection,$query);
						
						if($result){
							$update_confirmation_message = "Information was updated successfully.";
							}else{
							echo $d_id; echo "<br />";
							
							print_r($result);
							die("row does not exists");
							$update_confirmation_message = "Something wrong with the Query!!!!!";
						}	
						
					}
					
					}else{
					
					$update_confirmation_message = "ERROR ERROR!!!!!";
				}
				
				
				
				
				mysqli_close($connection);
			}
			
			
		}
		
		
	}
	
	// update_land_production
	if(isset($_POST["update_land_production"])){
		
		$year = $_POST["year"];
		$posting = $_SESSION["posting"];
		$crop_name = $_POST["crop_name"];
		
		$new_price = $_POST["new_price"];
		$old_price = $_POST["old_price"];
		
		$new_cultivated_land = $_POST["cultivated_land"];
		$old_cultivated_land = $_POST["old_cultivated_land"];
		
		$new_estimated_production = $_POST["estimated_production"];
		$old_estimated_production = $_POST["old_estimated_production"];
		
		$flag = ""; // disable false
		$update_confirmation_message_display = "block";
		$new_price_message_display = "none";
		$new_land_production_message_display = "none";
		
		/* if($old_cultivated_land == "Previous Amount" || $old_estimated_production == "Previous Amount"){
			
		} */
		
		$connection = database();
			if(!$connection){
				//error
				die("error while connecting to database!!!");
				
				}else{
				//successful connection
				$query = "select price,cultivated_land,estimated_production from crop where 
				name='{$crop_name}' and year='{$year}' and division_id = (select division_id from division 
				where division_name = '{$posting}');";
				
				$result = mysqli_query($connection,$query);
				
				if($row = mysqli_fetch_assoc($result)){
					$update_confirmation_message = "Showing Previous Amount";
					$old_price = $row["price"];
					$old_cultivated_land = $row["cultivated_land"];
					$old_estimated_production = $row["estimated_production"];
				}else{
					$update_confirmation_message = "No data To show for this Crop in this Year";
					//print_r($result);
					//no amount for that crop
					$old_price = "00";
					$old_cultivated_land = "00";
					$old_estimated_production = "00";
					
				}
				
			}
			
			mysqli_close($connection);
			
		
		if(!is_numeric($new_cultivated_land) || !is_numeric($new_estimated_production) || floatval($new_cultivated_land) < 0  || floatval($new_estimated_production) < 0){
			$update_confirmation_message = "Must Put Valid Number Value in New Amount Field To Update";
			
			}else{
			
			$cl_op = $_POST["cultivated_land_op"]; //cultivated land op
			$ep_op = $_POST["estimated_production_op"]; //estimated production op
			
			$total_cultivated_land = "";
			$total_estimated_production = "";
			
			if($cl_op == "+"){
				$total_cultivated_land = (int) $old_cultivated_land + (int) $new_cultivated_land;
				}else if($cl_op == "-"){
				$total_cultivated_land = (int) $old_cultivated_land - (int) $new_cultivated_land;
			}
			
			if($ep_op == "+"){
				$total_estimated_production = (int) $old_estimated_production + (int) $new_estimated_production;
				}else if($ep_op == "-"){
				$total_estimated_production = (int) $old_estimated_production - (int) $new_estimated_production;
			}
			
			
			
			$new_land_production_message = "Updated current Land is <strong>{$total_cultivated_land}</strong>
			<br /> Updated current Production is <strong>{$total_estimated_production}</strong>"; 
			
			$flag = ""; // disable false
			
			$connection = database();
			if(!$connection){
				//error
				die("error while connecting to database!!!");
				
				}else{
				//successful connection
				//first select the info to see if it exists, if it doesn't then create with INSERT
				
				$query = "select * from crop where year='{$year}' and name='{$crop_name}' and division_id=(select division_id from division 
				where division_name = '{$posting}');";
				
				$result = mysqli_query($connection,$query);
				if($result){
					
					if(mysqli_fetch_row($result)){
						//this row exists, so Update
						
						$query1 = "update crop set cultivated_land='{$total_cultivated_land}' 
						where year='{$year}' and name='{$crop_name}' and division_id=(select division_id from division 
						where division_name = '{$posting}');";
						
						$query2 = "update crop set estimated_production='{$total_estimated_production}' 
						where year='{$year}' and name='{$crop_name}' and division_id=(select division_id from division 
						where division_name = '{$posting}');";
						
						
						$result1 = mysqli_query($connection,$query1);
						$result2 = mysqli_query($connection,$query2);
						
						if($result1 && $result2){
							$update_confirmation_message = "Information was updated successfully.";
							}else{
							$update_confirmation_message = "ERROR ERROR in The Queries!!!!!";
						}
						
						
						
						}else{
						// row does not exist, so insert row with updated data
						$query = "select division_id from division where division_name = '{$posting}';";
						$result = mysqli_query($connection,$query);
						$row = mysqli_fetch_assoc($result);
						$d_id = $row["division_id"];
						
						
						$query = "INSERT INTO crop (name, division_id, year,price, cultivated_land, estimated_production) VALUES('{$crop_name}', 
						{$d_id}', '{$year}', '00' ,'{$total_cultivated_land}','{$total_estimated_production}');";
						
						$result = mysqli_query($connection,$query);
						
						if($result){
							$update_confirmation_message = "Information was updated successfully.";
							}else{
							
							$update_confirmation_message = "Something wrong with the Query!!!!!";
						}	
						
					}
					
					}else{
					
					$update_confirmation_message = "ERROR ERROR!!!!!";
				}
				
				
				//=========================================
				
				mysqli_close($connection);
			}
			
			
		}
		
		
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			Update Database
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
		
		
		<script>
			
			function enableFields(){
				
				var c = "Previous Amount";
				var n= "New Amount";
				
				if (document.getElementById("crop_name").value == "none"){
					
					document.getElementById("old_price").disabled = true;
					document.getElementById("old_price").value = c;
					
					document.getElementById("new_price").value = n;
					document.getElementById("new_price").disabled = true;
					
					document.getElementById("old_cultivated_land").disabled = true;
					document.getElementById("old_cultivated_land").value = c;
					
					document.getElementById("new_cultivated_land").disabled = true;
					document.getElementById("new_cultivated_land").value = n;
					
					document.getElementById("old_estimated_production").disabled = true;
					document.getElementById("old_estimated_production").value = c;
					
					document.getElementById("new_estimated_production").disabled = true;
					document.getElementById("new_estimated_production").value = n;
					
					document.getElementById("show_previous_amount").disabled = true;
					
					document.getElementById("update_price").disabled = true;
					document.getElementById("update_land_production").disabled = true;
					
					document.getElementById("update_confirmation_message").style.display = "none";
					document.getElementById("new_price_message").style.display = "none";
					document.getElementById("new_land_production_message").style.display = "none";
					
					}else{
					
					document.getElementById("old_price").disabled = false;
					document.getElementById("old_price").value = c;
					document.getElementById("old_cultivated_land").disabled = false;
					document.getElementById("old_cultivated_land").value = c;
					document.getElementById("old_estimated_production").disabled = false;
					document.getElementById("old_estimated_production").value = c;
					
					
					document.getElementById("new_price").disabled = false;
					document.getElementById("new_price").value = n;
					document.getElementById("new_cultivated_land").disabled = false;
					document.getElementById("new_cultivated_land").value = n;
					document.getElementById("new_estimated_production").disabled = false;
					document.getElementById("new_estimated_production").value = n;
					
					document.getElementById("show_previous_amount").disabled = false;
					
					document.getElementById("update_price").disabled = false;
					document.getElementById("update_land_production").disabled = false;
					
					document.getElementById("update_confirmation_message").style.display = "none";
					document.getElementById("new_price_message").style.display = "none";
					document.getElementById("new_land_production_message").style.display = "none";
					
				}
				
			}
			
		</script>
		
		
		
	</head>
	
	<body class = "bodyboxing">
		<a href="index.php" class = "sitename">agroSOFT</a>
		<ul id="drop-nav"  class = "dropdown">
			
			<li><?php 
				if(isset($_SESSION["username"])){
					
					//echo $_SESSION["message"]; //check how it is viewed in diff. page
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
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				
				<div id="update_confirmation_message" style="display:<?php echo $update_confirmation_message_display ; ?>">
					
					<?php echo $update_confirmation_message;
					?>
					
				</div>
				
				
				
				<br />
				
				<!-- 
					onchange=showPassword()
					put radio buttons here
				-->
				
				Year:
				<select name="year" >
					<option value="2016" selected="selected" > 2016 </option>
					
				</select>
				<br /><br />
				
				Division:
				<select name="division" >
					<option value="" selected="selected" > <?php echo ucfirst($_SESSION["posting"]) ?> </option>
					
				</select>
				<br /><br />
				
				<?php 
					/*  to check the username and division_id
						echo $_SESSION["username"];
						echo "\n";
						echo $_SESSION["posting"];
						echo "<br />";
					*/
				?> 
				
				<!-- crop name drop down list-->
				Crop:
				<select name="crop_name" id="crop_name" onchange="enableFields()" >
					<option value="none" <?php if($crop_name == "") {echo " selected='selected'"; } ?> > --- </option>
					
					<?php 
						
						$connection = database();
						if(!$connection){
							//error
							die("error while connecting to database!!!");
							
							}else{
							//successful connection
							$posting1 = $_SESSION["posting"];
							$query1 = "select distinct name from crop where 
							division_id = (select division_id from division 
							where division_name = '{$posting1}');";
							$result1 = mysqli_query($connection,$query1);
							while($row1 = mysqli_fetch_assoc($result1)){
								$crop_name1 = $row1["name"];
								if($crop_name == $crop_name1){
									echo "<option value=\"$crop_name1\""." ". "selected=\"selected\">". ucfirst($crop_name1) ."</option>";
									
									}else{
									echo "<option value=\"$crop_name1\" >". ucfirst($crop_name1) ."</option>";
									
								}
								
								
							}
						}
						mysqli_close($connection);
					?>
				</select>
				
				
				
				
				<input type ="submit" name="show_previous_amount" id="show_previous_amount" value="Show All Previous Amount" <?php echo $flag ?> >
				
				<br /><br /><br />
				
				
				<!-- crop attributes 
					
					previous amounts will be dynamically generated
					
					
				-->
				
				Price:
				<input type="text" name="old_price" id="old_price" value="<?php echo $old_price; ?>" <?php echo $flag ?> readonly>
				
				<input type="text" onfocus="this.select();" name="new_price" id="new_price" value="<?php echo $new_price; ?>" <?php echo $flag ?> >
				
				<input type ="submit" name="update_price" id="update_price" value="Update" <?php echo $flag ?> >
				
				<div id="new_price_message" style="display:<?php echo $new_price_message_display ; ?>">
					<?php echo $new_price_message;
					?>
				</div>
				
				<br /><br />
				Cultivated Land:
				<input type="text" name="old_cultivated_land" id="old_cultivated_land" value="<?php echo $old_cultivated_land; ?>" <?php echo $flag ?> readonly>
				<select name="cultivated_land_op">
					<option value="+" selected="selected"> + </option>
					<option value="-" > - </option>
				</select>
				<input type="text" onfocus="this.select();" name="cultivated_land" id="new_cultivated_land" value="<?php echo $new_cultivated_land; ?>" <?php echo $flag ?> >
				
				
				<br /><br />
				Estimated Production:
				<input type="text" name="old_estimated_production" id="old_estimated_production" value="<?php echo $old_estimated_production; ?>" <?php echo $flag ?> readonly>
				<select name="estimated_production_op">
					<option value="+" selected="selected"> + </option>
					<option value="-" > - </option>
				</select>
				<input type="text" onfocus="this.select();" name="estimated_production" id="new_estimated_production" value="<?php echo $new_estimated_production; ?>" <?php echo $flag ?> >
				<br />
				
				<input type ="submit" name="update_land_production" id="update_land_production" value="Update Land & Production" <?php echo $flag ?> >
				<br />
				
				<div id="new_land_production_message" style="display:<?php echo $new_land_production_message ; ?>">
					<?php echo $new_land_production_message;
					?>
				</div>
				
				<br /><br />
				
			</form>
			
			
			<!-- <h1>User Informations : </h1>
				<table class = "table_1" width = "1050px" cellpadding = "5px" border = ".1px">
				<th class = "th_1">User Name</th>
				<th class = "th_1">National ID No</th>
				<th class = "th_1">Email Address</th>
				<th class = "th_1">Posting</th>
				<th class = "th_1">Present Address</th>
				
				</table>
			-->
			
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
						}
					?>
					
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