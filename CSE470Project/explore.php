<?php 
	
	session_start();
	
	include("database_function.php");
	include("php_functions.php");
	
	$year_color = array("59b300","99994d","c68c53","d27979","a3a3c2","94b8b8","5cd6d6");
	
	$crop_color = array("dbdbda","919191","cf9494","ff7770","efbe62","e7d8bd","a28d67",
	"88da79","13cfad","9dded2","bcc4ec","7e86ab","bf8c95","867276");
	
	
	$message = "";
	$message_display = "none";
	$year_array = $division_array = $crop_attribute_array =  array();
	$crop_name = "a Crop";
	
	$year_array_count = $division_array_count = $crop_attribute_array_count =  0;
	
	$query = "";
	$query_array = array();
	
	if(isset($_POST["submit"])){
		
		$crop_name = $_POST["crop_name"];
		
		if($crop_name ==  ""){
			$message = "Must Select a Crop";
			$message_display = "block";
		}else{
			if(isset($_POST["year"])){
				$year_array = $_POST["year"];
				$year_array_count = count($year_array);
			}else{
				// no year selected, so get all the years in the database;
				$year_array = get_year();
				$year_array_count = count($year_array);
			}
			
			if(isset($_POST["division"])){
				$division_array = $_POST["division"];
				$division_array_count = count($division_array);
			}else{
				// no division selected, so get all the division in the database;
				$division_array = get_division();
				$division_array_count = count($division_array);
			}
			
			if(isset($_POST["crop_attribute"])){
				$crop_attribute_array = $_POST["crop_attribute"];
				$crop_attribute_array_count = count($crop_attribute_array);
			}else{
				// no attribute selected, so get all the attributes;
				$crop_attribute_array = get_attribute();
				$crop_attribute_array_count = count($crop_attribute_array);
			}
			
			
		foreach($year_array as $yr){
			$query_array = explore_query_generator($query_array, $yr, $division_array, $crop_name, $crop_attribute_array);
		}
		
			
		}
		
		
		//query is being generated correctly
			/* echo "<pre>";
			print_r($query_array);
			echo "</pre>";
			
			echo "<br />";
			
			echo "<pre>";
			print_r($year_array);
			echo "</pre>";
			echo $year_array_count;
			echo "<br />";
			
			echo "<pre>";
			print_r($division_array);
			echo "</pre>";
			echo $division_array_count;
			echo "<br />";
			
			echo "<pre>";
			print_r($crop_attribute_array);
			echo "</pre>";
			echo $crop_attribute_array_count;
			echo "<br />";
			
		die("whazzzz up"); */
		
		
	}
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			Explore Database
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
			.bodyboxing
			{
		     padding-bottom : 100%;
			}
			
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
			padding-bottom : 100%;
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
			
			function showParttime(){
				document.getElementById("fulltime").style.display = "none";
				document.getElementById("parttime").style.display = "block";
			}
			
			function showPassword(){
				if (document.getElementById("show_password").value == "1") {
					document.getElementById("admin_access").style.display = "block";
					document.getElementById("employee_reporter").style.display = "none";
					document.getElementById("employee_writer").style.display = "none";
					} else if (document.getElementById("show_password").value == "2") {
					document.getElementById("employee_reporter").style.display = "block";
					document.getElementById("admin_access").style.display = "none";
					document.getElementById("employee_writer").style.display = "none";
					} else if (document.getElementById("show_password").value == "3") {
					document.getElementById("employee_writer").style.display = "block";
					document.getElementById("employee_reporter").style.display = "none";
					document.getElementById("admin_access").style.display = "none";
					} else{
					document.getElementById("employee_writer").style.display = "none";
					document.getElementById("employee_reporter").style.display = "none";
					document.getElementById("admin_access").style.display = "none";
				}
				
				
				
			}			
			
		</script>
		
		
		
	</head>
	
	<body class = "bodyboxing">
		<a href="index.php" class = "sitename">agroSOFT</a>
		<p class = "user"><?php 
				if(isset($_SESSION["username"])){
					$display = "none";
					echo "Hi ". $_SESSION["message"]; //check how it is viewed in diff. page
					
					//echo "	"."<a href=\"logout_process.php\">Log Out</a>";
					}else{
					$display = "block";
				}
	        ?></p>
		<ul id="drop-nav"  class = "dropdown">
							<li><?php 
				if(isset($_SESSION["username"])){
					$display = "none";
					//echo $_SESSION["message"]; //check how it is viewed in diff. page
					
					echo "	"."<a href=\"logout_process.php\">Log Out</a>";
					}else{
					$display = "block";
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
				
				<div id="message" style="display:<?php echo $message_display ; ?>">
					
					<?php 
						echo $message;
					?>
					
				</div>
				
				<br />
				
				<!---------------------------------------------------year------------------------------------>
				Year:
				<select name="year[]" id="year" multiple >
					
					<?php 
						
						$connection = database();
						if(!$connection){
							//error
							die("error while connecting to database!!!");
							
							}else{
							//successful connection
							$query1 = "select distinct year from crop order by year;";
							$result1 = mysqli_query($connection,$query1);
							while($row1 = mysqli_fetch_assoc($result1)){
								$year1 = $row1["year"];
								if(exists($year_array,$year1)){
									echo "<option value=\"$year1\" selected=\"selected\">". ucfirst($year1) ."</option>";
								}else{
									echo "<option value=\"$year1\" >". ucfirst($year1) ."</option>";
								}
								
							}
						}
						mysqli_close($connection);
					?>
				</select>
				
				
				<!---------------------------------------------------Division------------------------------------>
				Division:
				<select name="division[]" id="division" multiple>
					
					<?php 
						
						$connection = database();
						if(!$connection){
							//error
							die("error while connecting to database!!!");
							
							}else{
							//successful connection
							
							$query1 = "select distinct division_name from division order by division_name;";
							$result1 = mysqli_query($connection,$query1);
							while($row1 = mysqli_fetch_assoc($result1)){
								$division1 = $row1["division_name"];
								if(exists($division_array,$division1)){
									echo "<option value=\"$division1\" selected=\"selected\">". ucfirst($division1) ."</option>";
								}else{
									echo "<option value=\"$division1\" >". ucfirst($division1) ."</option>";
								}
								
								
							}
						}
						mysqli_close($connection);
					?>
				</select>
				
				
				<!------------------------------------------Crop Name------------------------------------>
				
				<!-- crop name drop down list-->
				Crop:
				
				<select name="crop_name" id="crop_name">
					<option value="" <?php if($crop_name == "") {echo " selected='selected'"; } ?> > --- </option>
					
					<?php 
						
						$connection = database();
						if(!$connection){
							//error
							die("error while connecting to database!!!");
							
							}else{
							//successful connection
							$query1 = "select distinct name from crop order by name;";
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
				
				
				<!------------------------------------crop attributes--------------------->
				
				Crop Attributes:
				<select name="crop_attribute[]" id="crop_attribute" multiple>
					
					<option value="price" <?php if(exists($crop_attribute_array,"price")){echo " selected=\"selected\"";} ?> > Price </option>
					<option value="cultivated_land" <?php if(exists($crop_attribute_array,"cultivated_land")){echo " selected=\"selected\"";} ?> > Cultivated Land </option>
					<option value="estimated_production" <?php if(exists($crop_attribute_array,"estimated_production")){echo " selected=\"selected\"";} ?> > Estimated Production </option>
					
				</select>
				
				<p>Hold down the Ctrl (windows) OR Drag to select consecutive options / Command (Mac) button to select multiple options.</p>
				
				<br /><br />
				<input type ="submit" name="submit" id="submit" value="Show Data" >
				<strong>NOT Selecting Any Option Of A List Will Show Information For All Options</strong>
				<br /><br />
				
			</form>
			
			
			<h2>Information Of <?php echo ucfirst($crop_name) ?> </h2>
			
			
			<?php 
				$msg = "";
				
				if(count($query_array) == 0){
					//no query, NO TABLE
				}else{
					
					$c = 1;
					
					$connection = database();
					if(!$connection){
						//error
						die("error while connecting to database!!!");
						
						}else{
						
						reset($year_color);
						reset($crop_color);   //division_color
						
						//successful connection
						echo "<table  class = \"table_1\" width = \"1050px\" cellpadding = \"5px\" border = \".1px\" >";
						
						echo "<tr>";
						echo "<th class=\"th_1\">Year</th>";
						echo "<th class=\"th_1\">Division</th>";
						
						foreach($crop_attribute_array as $c_attr){
							echo "<th class=\"th_1\">".col_name($c_attr)."</th>";
						}
						echo "</tr>";
						
						foreach($year_array as $yr){
							$flag = 1; // means first crop
							echo "<tr>";
							
							$color = current($year_color);
							
							if($color === false){
								reset($year_color);
								$color = current($year_color);
							}
							next($year_color);
							
							echo "<td style=\"background-color:#{$color}; color:#000000 \" rowspan=\"{$division_array_count}\"> <strong>{$yr}</strong></td>";
							
							reset($crop_color);
							
							foreach($division_array as $dn){
								if($flag == 1){
									//first info , so NO <tr>
									$flag++;
									
									}else{
									echo "<tr>";
								}
								
								$temp_color = current($crop_color);
								if($temp_color === false){
									die("NO MORE DISTINCT COLOR");
								}
								next($crop_color);
								 
								echo "<td style=\"background-color:#{$temp_color}\" > <strong>".ucfirst($dn)."</strong> </td>";
								$query = current($query_array);
								
								next($query_array);
								
								$result = mysqli_query($connection,$query);
								if($result){
									//successful query executuion, DOES NOT MEAN any row returned
									//printing rows
									if(mysqli_num_rows($result) != 0){
										
										while($row = mysqli_fetch_assoc($result)){
											
											if(isset($row["price"])){
												echo "<td style=\"background-color:#{$temp_color}\" > <strong>".$row["price"]."</strong> </td>";
											}
											if(isset($row["cultivated_land"])){
												echo "<td style=\"background-color:#{$temp_color}\" > <strong>".$row["cultivated_land"]."</strong> </td>";
											}
											if(isset($row["estimated_production"])){
												echo "<td style=\"background-color:#{$temp_color}\" > <strong>".$row["estimated_production"]."</strong> </td>";
											}
											
											
										}
										}else{
										// no data sent from database...
										foreach($crop_attribute_array as $c_attr){
											
											echo "<td style=\"background-color:#{$temp_color}\" ><strong>  - </strong> </td>";
										}
										
									}
									
									
									
									}else{
									die("Error while connecting to databse");
								}
								
								echo "</tr>";
								
							}
							
						}
						
						
						
						echo "</table>";
						
					}
					
					mysqli_close($connection);
				}
				
				echo "<p>{$msg}</p>";
			?>
			
			
		</div>
		
		<!--end of bodycenter-->
		
		
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
		

		
		
	</body>
</html>			