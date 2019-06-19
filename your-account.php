<?php 
	session_start();
	if (isset($_SESSION['user_id']) && $_SESSION['user_id']>=0) {
		$userid = $_SESSION['user_id'];
	} else {
		header("Location: http://localhost/login.php");
	}	
?>
<?php include "header.php"; ?>

<h2>Your Account</h2>

<?php
	
	include('connect.php');
	include('phpfunction.php');

	//$userid = $_GET["user"];
	

	if(isset($_POST['updatesubmit'])){

		$name = (!empty($_POST['Name']) ? $connection->real_escape_string($_POST['Name']) : false);  
		$email = (!empty($_POST['Email']) ? $connection->real_escape_string($_POST['Email']) : false);       
		$password = (!empty($_POST['Password']) ? $connection->real_escape_string($_POST['Password']) : false); 
		

		if($name && $email && $password){
			$query="update user set name='$name', email='$email', password='$password' where userid=".$userid;
			$result = mysqli_query($connection, $query);
			echo "<p class='confirmmsg'>Your account info is updated</p>";
		}else{
			echo "<p class='confirmmsg'>Name, Email and Password cannot be left blank.</p>";
		}

		

	}

	if(isset($_SESSION['user_id'])){ 	
		$query = "select name as Name, email as Email, password as Password from user where userid = ".$userid;

		$result = mysqli_query($connection, $query);

		if(!$result) {
		  	die('Could not process the query.');
		}

		printResultFormAllEdit($result, 'your-account.php');
	}
			
	


?>

<div class="resultposition"></div>
<?php include "footer-user.php"; ?>