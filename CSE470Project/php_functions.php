<?php 
	
	
	function check_data($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	

	function bangladesh_query_generator1($query_array, $y, $c_array, $c_a_array) {
		
		$q = "select ";
		//crop attribute
		$counter = 0;
		foreach($c_a_array as $attr){
			if($counter == 0){
					//first time, so no comma
					$counter = $counter+1;
					if($attr == "price"){
						$q = $q." round(avg(".$attr."),2) as AveragePrice";
					}else{
						if($attr == "cultivated_land"){
							$q = $q." sum(".$attr.") as TotalCultivatedLand";
						
						}else{
							$q = $q." sum(".$attr.") as TotalEstimatedProduction";
						}
					}
					
			}else{
					if($attr == "price"){
						$q = $q." , round(avg(".$attr."),2) as AveragePrice";
					}else{
						if($attr == "cultivated_land"){
							$q = $q.", sum(".$attr.") as TotalCultivatedLand";
						
						}else{
							$q = $q.", sum(".$attr.") as TotalEstimatedProduction";
						}
						
					}
					
				}
		}
		$q = $q." from crop where";
		
		//crop
		foreach($c_array as $c){
			$temp_q = $q;
			$temp_q = $temp_q." year='{$y}' and name='{$c}' group by year, name;";
			$query_array[] = $temp_q;
		}
		
		return $query_array;
	}
	
	
	
	
	function query_generator($query_array, $c_name, $div, $y_array, $c_a_array) {
		$q = "select ";
		
		$div_id = get_division_id($div);
		//crop attribute
		$counter = 0;
		foreach($c_a_array as $attr){
			if($counter == 0){
				//first attr, so no comma
				$counter = $counter + 1;
				$q = $q.$attr;
			}else{
			
				$q = $q.", ".$attr;
			}
		}
		$q = $q." from crop where";
		
		//year
		foreach($y_array as $y){
			$temp_q = $q;
			$temp_q = $temp_q." year='{$y}' and name='{$c_name}' and division_id='{$div_id}';";
			$query_array[] = $temp_q;
		}
		
		
		return $query_array;
	}
	
	
	
	
	function div_query_generator1($query_array, $y, $div_id, $c_array, $c_a_array) {
		$q = "select ";
		
		//crop attribute
		$counter = 0;
		foreach($c_a_array as $attr){
			if($counter == 0){
				//first attr, so no comma
				$counter = $counter + 1;
				$q = $q.$attr;
			}else{
			
				$q = $q.", ".$attr;
			}
		}
		$q = $q." from crop where";
		
		//crop
		foreach($c_array as $c){
			$temp_q = $q;
			$temp_q = $temp_q." year='{$y}' and name='{$c}' and division_id='{$div_id}' group by year, name;";
			$query_array[] = $temp_q;
		}
		
		
		return $query_array;
	}
	
	function explore_query_generator($query_array, $y, $div_array, $c_name, $c_a_array) {
		$q = "select ";
		
		//crop attribute
		$counter = 0;
		foreach($c_a_array as $attr){
			if($counter == 0){
				//first attr, so no comma
				$counter = $counter + 1;
				$q = $q.$attr;
			}else{
			
				$q = $q.", ".$attr;
			}
		}
		$q = $q." from crop where";
		
		//crop
		foreach($div_array as $d){
			$d_id = get_division_id($d);
			$temp_q = $q;
			$temp_q = $temp_q." year='{$y}' and name='{$c_name}' and division_id='{$d_id}' group by year,division_id;";
			$query_array[] = $temp_q;
		}
		
		
		return $query_array;
	}
	
	
	function exists($array, $data) {
		
		foreach($array as $obj){
			if($obj === $data){
				return true;
			}
		}
		
		return false;
	}
	
	function bangladesh_col_name($data) {
		
		if($data == "name"){
			return "Crop";
		}
		if($data == "year"){
			return "Year";
		}
		if($data == "price"){
			return "AveragePrice";
		}
		if($data == "cultivated_land"){
			return "TotalCultivatedLand";
		}
		if($data == "estimated_production"){
			return "TotalEstimatedProduction";
		}
		
	}
	
	
	function col_name($data) {
		
		if($data == "name"){
			return "Crop";
		}
		if($data == "year"){
			return "Year";
		}
		if($data == "price"){
			return "Price";
		}
		if($data == "cultivated_land"){
			return "Cultivated Land";
		}
		if($data == "estimated_production"){
			return "Estimated Production";
		}
		
	}
	
?>