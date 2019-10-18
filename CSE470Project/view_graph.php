<?php 
	
	session_start();
	
	include("database_function.php");
	include("php_functions.php");
	
	$message = "";
	$message_display = "none";
	$code = "";
	
	$crop_name = $crop_attribute = "";
	
	$query = "";
	$query_array = array();
	
	if(isset($_POST["submit"])){
		
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
			}else{
			
			$crop_attribute = $_POST["crop_attribute"];
			$crop_name = $_POST["crop_name"];
			
		}
		//========================================
		
		
	
	
		
		$temp_crop_attribute = col_name($crop_attribute);
		$temp_crop_name = ucfirst($crop_name);
		
		$message = "Showing ".$temp_crop_attribute." from Year 2011 to 2016 Of ".ucfirst($crop_name)." in Bangladesh" ;
		$message_display = "block";
		$amount = "";
		if($crop_attribute == "price"){
			$amount = "Tk";
		}else if($crop_attribute == "cultivated_land"){
			$amount = "Acre";
		}else{
			$amount = "Ton";
		}
		
		
		$code = "$(document).ready(function() {
		var title = {
		text: 'Yearly {$temp_crop_attribute} Graph For {$temp_crop_name}' 
		};";
		$code = $code."var xAxis = {
		categories: ['2011', '2012', '2013', '2014', '2015', '2016']
		};";
		
		$code = $code."var yAxis = {
		title: {
		text: 'Amount (".$amount.")'
		},
		plotLines: [{
		value: 0,
		width: 1,
		color: '#808080'
		}]
		};   
		
		
		var legend = {
		layout: 'vertical',
		align: 'right',
		verticalAlign: 'middle',
		borderWidth: 0
		};
		
		";
		
		$q_a = "";
		
		if($crop_attribute == "price"){
			$yr = 2011;
			for($a=0;$a<6;$a++){
				if($a == 0){
					
					}else{
					$q_a = $q_a.",";
				}
				$query1 = "select round(avg(price),2) as Average from crop where name='{$crop_name}' and year='{$yr}' group by year,name;";
				
				$result1 = mysqli_query($connection,$query1);
				if($row1 = mysqli_fetch_assoc($result1)){
					$val = $row1["Average"];
					$q_a = $q_a."{$val}";
					}else{
					$q_a = $q_a."0";
				}
				$yr = $yr + 1;
			}
			
			
			}else{
			
			if($crop_attribute == "cultivated_land"){
				$yr = 2011;
				for($a=0;$a<6;$a++){
					if($a == 0){
						
						}else{
						$q_a = $q_a.",";
					}
					$query1 = "select sum(cultivated_land) as cl from crop where name='{$crop_name}' and year='{$yr}' group by year,name;";
					
					$result1 = mysqli_query($connection,$query1);
					if($row1 = mysqli_fetch_assoc($result1)){
						$val = $row1["cl"];
						$q_a = $q_a."{$val}";
						}else{
						$q_a = $q_a."0";
					}
					$yr = $yr + 1;
					
				}
				
				
			}else{
				$yr = 2011;
				for($a=0;$a<6;$a++){
					if($a == 0){
						
						}else{
						$q_a = $q_a.",";
					}
					$query1 = "select sum(estimated_production) as ep from crop where name='{$crop_name}' and year='{$yr}' group by year,name;";
					
					$result1 = mysqli_query($connection,$query1);
					if($row1 = mysqli_fetch_assoc($result1)){
						$val = $row1["ep"];
						$q_a = $q_a."{$val}";
						}else{
						$q_a = $q_a."0";
					}
					$yr = $yr + 1;
					
				}
				
				
			}
			
			
		}
		
		
		$code = $code."var series =  [
		{
		name: '{$crop_name}',
		data: [{$q_a}]
		}];";
		
		$code = $code."var json = {};
		
		json.title = title;
		json.xAxis = xAxis;
		json.yAxis = yAxis;
		json.legend = legend;
		json.series = series;
		
		$('#container').highcharts(json);
		});";
		
		
		
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
			print_r($crop_attribute_array);
			echo "</pre>";
			echo $crop_attribute_array_count;
			echo "<br />";
			
		die("whazzzz up"); */
		
		
		$disp = "block";
		
		
		
		mysqli_close($connection);
		
	}
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			View Graph
		</title>
		
		<script src="jquery.min.js"></script>
		<script src="highcharts.js"></script> 
		<script src="highcharts-more.js"></script> 
		
		
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
			top : 100%;
			background-color : #263238;
			width : 1330px;
			padding-bottom : 300px; 
			color : #CFD8DC;
			text-align : center;
			}
			.bodyboxing
			{
			padding-bottom : 220%;
			}
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
		</style>
		
		
		
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
				<input type="text" name="2011" value="2011" readonly disabled> to <input type="text" name="2016" value="2016" readonly disabled>
				<br /><br />
				
				
				<!---------------------------------------------------Division------------------------------------>
				Bangladesh:
				<input type="text" name="bangladesh" value="Bangladesh" readonly disabled>
				
				<!------------------------------------------Crop Name------------------------------------>
				
				<!-- crop name drop down list-->
				Crop:
				
				<select name="crop_name" id="crop_name" >
					
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
								echo "<option value=\"$crop_name1\" >". ucfirst($crop_name1) ."</option>";
								
							}
							
						}
						mysqli_close($connection);
					?>
				</select>
				
				
				<!------------------------------------crop attributes--------------------->
				
				Crop Attributes:
				<select name="crop_attribute" id="crop_attribute" >
					
					<option value="price" > Price </option>
					<option value="cultivated_land" > Cultivated Land </option>
					<option value="estimated_production" > Estimated Production </option>
					
				</select>
				
				<br /><br />
				<input type ="submit" name="submit" id="submit" value="Show Graph" >
				<br /><br />
				
			</form>
			
			
			<h2>Graph: </h2>
			
			<div id="container" style="width:100%; height: 400px; margin: 0 auto"></div>
			
			<?php 
				
				echo "<script language=\"JavaScript\">";
				
				echo $code;
				
				
				echo "</script>";
				
				
				
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
		<!---------------------------------------------------------------------------------------->
		
	</body>
</html>			