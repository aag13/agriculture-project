<?php 
	
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: index.php");
		exit;
	}
	
	//total need in Kg, price in tk/kg, cost in tk/kg , production in kg/hector
	
	include("database_function.php");
	include("php_functions.php");
	
	$message = "";
	$message_display = "none";
	$year = "2016";
	$division = $_SESSION["posting"];
	$crop_name_array = array();
	
	$cultivable_land = "";
	$crop_name_array_count =  0;
	$column_count =  6;
	
	$query = "";
	$query_array = array();
	
	if(isset($_POST["submit"])){
		$cultivable_land = $_POST["cultivable_land"];
		if(!is_numeric($cultivable_land) || $cultivable_land === "" || floatval($cultivable_land ) < 0){
			$message = "Must put valid Number in Cultivable land";
			$message_display = "block";
			}else{
			
			if(isset($_POST["crop_name"])){
				$crop_name_array = $_POST["crop_name"];
				$crop_name_array_count =  count($crop_name_array);
				}else{
				$connection = database();
				if(!$connection){
					//error
					die("error while connecting to database!!!");
					
					}else{
					//successful connection
					$query1 = "select distinct name from bangladesh_crops;";
					$result1 = mysqli_query($connection,$query1);
					while($row1 = mysqli_fetch_assoc($result1)){
						$crop_name_array[] = $row1["name"];
						
					}
					$crop_name_array_count =  count($crop_name_array);
				}
				mysqli_close($connection);
			}
			
			
			
			foreach($crop_name_array as $cn){
				$q = "select * from bangladesh_crops where year='{$year}' and name='{$cn}';";
				$query_array[] = $q;
			}
		}
		
		/* echo $year;
			echo "<br />";
			echo $division;
			echo "<br />";
			print_r($crop_name_array);
			echo "<br />";
			echo $crop_name_array_count;
			echo "<br />";
			echo $cultivable_land;
			echo "<br />";
			print_r($query_array);
			echo "<br />";
		die("whazzzz up"); */
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
			Which Crop To Plant
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
			position : relative;
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
			
			
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				
				<div id="message" style="display:<?php echo $message_display ; ?>">
					
					<?php 
						echo $message;
					?>
					
				</div>
				
				<br />
				
				<!---------------------------------------------------year------------------------------------>
				Year:
				<select name="year" >
					<option value="<?php echo $year ?>" selected="selected" > <?php echo $year ?></option>
					
				</select>
				
				
				<!------------------------------------------Crop Name------------------------------------>
				
				<!-- crop name drop down list-->
				Crop:
				
				<select name="crop_name[]" id="crop_name" multiple>
					
					<?php 
						$connection = database();
						if(!$connection){
							//error
							die("error while connecting to database!!!");
							
							}else{
							//successful connection
							$query1 = "select distinct name from bangladesh_crops;";
							$result1 = mysqli_query($connection,$query1);
							while($row1 = mysqli_fetch_assoc($result1)){
								$crop_name1 = $row1["name"];
								if(exists($crop_name_array,$crop_name1)){
									echo "<option value=\"$crop_name1\" selected=\"selected\" >". ucfirst($crop_name1) ."</option>";
									}else{
									echo "<option value=\"$crop_name1\" >". ucfirst($crop_name1) ."</option>";
								}
								
							}
							
						}
						mysqli_close($connection);
					?>
				</select>
				<br /><br />
				
				Cultivable Land:
				<input type="text" name="cultivable_land" value="<?php echo $cultivable_land; ?>">
				<br /><br />
				
				
				<p>Hold down the Ctrl (windows) OR Drag to select consecutive options / Command (Mac) button to select multiple options.</p>
				
				<br /><br />
				<input type ="submit" name="submit" id="submit" value="Show Data" >
				<strong>NOT Selecting Any Option Of A List Will Show Information For All Options</strong>
				<br /><br />
				
			</form>
			
			
			<h2> % of Profit of Crops in <?php echo $year ?></h2>
			
			<?php 
				
				if(count($query_array) == 0){
					//no query, NO TABLE
					}else{
					$connection = database();
					if(!$connection){
						//error
						die("error while connecting to database!!!");
						
						}else{
						//successful connection
						echo "<table  class = \"table_1\" width = \"1050px\" cellpadding = \"5px\" border = \".1px\" >";
						
						echo "<tr>";
						echo "<th class = \"th_1\" >Crop</th>";
						echo "<th class = \"th_1\" >Total Need(Kg)</th>";
						echo "<th class = \"th_1\" >Average Price(per Kg)</th>";
						echo "<th class = \"th_1\" >Estimated Production So Far (in Kg)</th>";
						echo "<th class = \"th_1\" >Your Estimated Production(in Kg)</th>";
						echo "<th class = \"th_1\" >Your Gross Profit</th>";
						echo "<th class = \"th_1\" >Your Estimated Cost</th>";
						echo "<th class = \"th_1\" >Your Net Profit</th>";
						echo "<th class = \"th_1\" >Profit Percentage(in %)</th>";
						
						echo "</tr>";
						
						
						foreach($crop_name_array as $cn){
							echo "<tr>";
							echo "<td>".ucfirst($cn)."</td>";
							$query = current($query_array);
							next($query_array);
							
							$result = mysqli_query($connection,$query);
							if($result){
								//successful query executuion, DOES NOT MEAN any row returned
								//printing rows
								if(mysqli_num_rows($result) != 0){
									
									while($row = mysqli_fetch_assoc($result)){
										//Total Need
										$total_need = $row["total_need"];
										echo "<td>{$total_need}</td>";
										
										//Average Price
										echo "<td>".$row["price"]."</td>";
										
										//Estimated Production So Far.
										$temp = get_total_estimated_production($cn,$year); 
										echo "<td>".$temp."</td>";
										
										$production_left = $total_need - $temp; // amount left to be produced
										
										//Your Estimated Production
										$y_estimated_production = $row["estimated_production"]*$cultivable_land;
										echo "<td>{$y_estimated_production}</td>";
										
										if($production_left >= $y_estimated_production){
											// profit
											$y_production =  $y_estimated_production;
											
											//Your Gross Profit
											$y_gross_profit = $y_production*$row["price"];
											echo "<td><strong>{$y_gross_profit}</strong></td>";
											//Your Estimated Cost
											$y_estimated_cost = $y_estimated_production*$row["estimated_cost"];
											echo "<td>{$y_estimated_cost}</td>";
											//Your Net Profit
											$y_net_profit = $y_gross_profit - $y_estimated_cost;
											echo "<td><strong>{$y_net_profit}</strong></td>";
											//Profit/Loss
											echo "<td><strong>".floor(($y_net_profit/$y_estimated_cost)*100)."%</strong></td>"; 
											
										}else{
										
											// loss
											//Your Gross Profit
											$y_gross_profit = $production_left*$row["price"];
											echo "<td><strong>{$y_gross_profit}</strong></td>";
											
											//Your Estimated Cost
											$y_estimated_cost = $y_estimated_production*$row["estimated_cost"];
											echo "<td>{$y_estimated_cost}</td>";
											//Your Net Profit
											$y_net_profit = $y_gross_profit - $y_estimated_cost;
											echo "<td><strong>{$y_net_profit}</strong></td>";
											//Profit/Loss
											echo "<td><strong>".floor(($y_net_profit/$y_estimated_cost)*100)."%</strong></td>"; 
										}
										
										
									}
									}else{
									// no data sent from database...
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									echo "<td>-</td>";
									
								}
								
								
								
								}else{
								die("something wrong with the query!!!");
							}
							
							echo "</tr>";
							
						}
						
						
						echo "</table>";
						
						
					}
					
					
					mysqli_close($connection);
				}
				
				
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
			
			<!------------------------------------------
			
			<div class = "end">
			<p>type something to fill up this section </p>
			</div>
			
			---------------------------------------------->
			</body>
			</html>						