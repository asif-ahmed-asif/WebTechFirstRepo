<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
</head>
<body>

</body>
</html>
<?php
session_start();
if (isset($_POST['submit'])) {
	

	$userid = $_POST['uid'];
	$pass = $_POST['password'];
	include 'Controller/LoginValidate.php';
	$row = LoginValidation($userid, $pass);
}


	if (isset($_SESSION['userid'])) 
	{
		include "LoginHeader.php";
		include "Sidebar.php"; 
		echo "<h1> Welcome ".$rows['name']."</h2>";
	}
	else
	{
		if (($row == null) || ($row['status'] == "i")) {
			echo "<script>alert(Username or Password incorrect! or account is not activated)</script>";
			header('location:Login.php');
		}else{
			$_SESSION['userid'] = $row['uid'];
			if (isset($_POST['remember'])){
					setcookie("userid", $row['uid'], time() + (86400 * 30)); 
					setcookie("password", $row['password'], time() + (86400 * 30)); 
			}
	 
			
			header('location:Dashboard.php');

		}
	}
?>
