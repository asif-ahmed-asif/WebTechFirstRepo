<?php
session_start();

$uname="admin";
$password="admin@123";

if (isset($_SESSION['uname'])) 
{
	include "LoginHeader.php";
	include "Sidebar.php"; 
	echo "<h1> Welcome ".$_SESSION['uname']."</h2>";
}
else
{
	if ($_POST['uname']==$uname && $_POST['password']==$password)
	{
		$_SESSION['uname'] = $uname;
		echo "<script>location.href='Dashboard.php'</script>";
	}
	else
	{
		echo "<script>alert(Username or Password incorrect!)</script>";
		echo "<script>location.href='Login.php'</script>";
	}
}
?>
