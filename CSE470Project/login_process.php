<?php 
session_start();
include("database_function.php");
include("php_functions.php");

$connection = database();

if(isset($_POST["submit"])){
	
	$username = check_data($_POST["username"]); // email can be used also....
	$password = check_data($_POST["password"]);
	
	$query = "select * from userrecord where (username='{$username}' or email='{$username}');";
	//to find the username
	$result = mysqli_query($connection,$query);
	$row_number = mysqli_num_rows ($result);
	if($row_number  == 1){
		$row =  mysqli_fetch_assoc($result);
		
		if($username == $row["username"] && password_verify($password,$row["password"])){
		//trying to match with hashed password....
			$_SESSION["username"] = $username;
			$_SESSION["posting"] = $row["posting"];
			$_SESSION["message"] = "{$username}, you are logged in";
			header("Location: index.php");
			
		}else{
			$_SESSION["message"] = "Username and Password do not match";
			header("Location: index.php");
		}
	}else{
		$_SESSION["message"] = "Invalid Username";
		header("Location: index.php");
	}
	
	
}


exit;

?>