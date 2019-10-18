<?php 
	
	function database() {
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "root";
		$dbname = "agrosoft";
		$connection = mysqli_connect($dbhost , $dbuser, $dbpass, $dbname);
		return $connection;
	}
	
	function get_total_estimated_production($crop_name,$year){
		$total = 0;
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
		}else{
			//successful connection
			$query1 = "select sum(estimated_production) as Total from crop where name='{$crop_name}' and year='{$year}';";
			$result1 = mysqli_query($connection,$query1);
			if($row1 = mysqli_fetch_assoc($result1)){
				$total = $row1["Total"];
			}
			
		}
		mysqli_close($connection);
		
		return $total;
	}
	
	
	function get_division_id($div_name) {
		$div_id = "";
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
		}else{
			//successful connection
			
			$query1 = "select distinct division_id from division where division_name='{$div_name}';";
			$result1 = mysqli_query($connection,$query1);
			if($row1 = mysqli_fetch_assoc($result1)){
				$div_id = $row1["division_id"];
			}
			
		}
		mysqli_close($connection);
		
		return $div_id;
		
	}
	
	function get_division() {
		$div_array = array();
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
		}else{
			//successful connection
			
			$query1 = "select distinct division_name from division order by division_name;";
			$result1 = mysqli_query($connection,$query1);
			while($row1 = mysqli_fetch_assoc($result1)){
				$div = $row1["division_name"];
				$div_array[] = $div;
			}
		}
		mysqli_close($connection);
		
		return $div_array;
		
	}
	
	function get_div_crop($div_id) {
		$crop_array = array();
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
			}else{
			//successful connection
			
			$query1 = "select distinct name from crop where division_id='{$div_id}' order by name;";
			$result1 = mysqli_query($connection,$query1);
			while($row1 = mysqli_fetch_assoc($result1)){
				$name = $row1["name"];
				$crop_array[] = $name;
			}
		}
		mysqli_close($connection);
		
		return $crop_array;
		
	}
	
	function get_bangladesh_crop() {
		$crop_array = array();
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
			}else{
			//successful connection
			
			$query1 = "select distinct name from crop order by name;";
			$result1 = mysqli_query($connection,$query1);
			while($row1 = mysqli_fetch_assoc($result1)){
				$name = $row1["name"];
				$crop_array[] = $name;
			}
		}
		mysqli_close($connection);
		
		return $crop_array;
		
	}
	
	
	function get_div_year($div_id) {
		$y_array = array();
		$connection = database();
		if(!$connection){
			//error
			die("error while connecting to database!!!");
			
		}else{
			//successful connection
			
			$query1 = "select distinct year from crop where division_id='{$div_id}' order by year;";
			$result1 = mysqli_query($connection,$query1);
			while($row1 = mysqli_fetch_assoc($result1)){
				$year1 = $row1["year"];
				$y_array[] = $year1;
			}
		}
		mysqli_close($connection);
		
		return $y_array;
		
	}
	
	
	function get_bangladesh_year() {
		$y_array = array();
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
				$y_array[] = $year1;
			}
		}
		mysqli_close($connection);
		
		return $y_array;
		
	}
	
	
	function get_year() {
		$y_array = array();
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
				$y_array[] = $year1;
			}
		}
		mysqli_close($connection);
		
		return $y_array;
		
	}
	
	function get_attribute() {
		$c_a_array = array("price","cultivated_land","estimated_production");
		
		return $c_a_array;
		
	}
	
	
	
?>