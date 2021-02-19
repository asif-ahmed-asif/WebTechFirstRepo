<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
	<?php 
	$nameErr = $passErr = "";
	$name = $password = "";


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
    	$nameErr = "User Name is required";
    } else {
	    $name = $_POST["name"];
	    $count = strlen("$name");
	    if ((!preg_match("/^[a-zA-Z-_' ]*$/",$name)) || $count < 2 ){
	      $nameErr = "Only alpha numeric characters, period, dash, underscore allowed and contains at least two characters";
	    }
    }

    if (empty($_POST["password"])) {
    	$passErr = "Password is required";
    }else {
    	$password = $_POST["password"];
    	$count = strlen("$password");
    	if ((!preg_match("([@#$%])",$password)) || $count < 8 ) {
    		$passErr = "Password must not be less than eight characters and  must contain at least one of the special characters (@, #, $, %) ";
    	}

    }

    }
	?>

	<form method="post" action="">
		<fieldset>
			<legend><b>LOGIN</b></legend>
			<label>User Name:</label>
			<input type="text" name="name" value="<?php echo $name;?>">
    		<span class="error"><?php echo $nameErr;?></span><br>
    		<label>Password:</label>
    		<input type="password" name="password" value="<?php echo $password;?>">
    		<span class="error"><?php echo $passErr;?></span><hr>
    		<input type="checkbox" name="remember" value="">Remember Me<br><br>
    		<input type="submit" name="submit" value="Submit">
    		<a href="">Forgot Password?</a>
		</fieldset>
	</form>

</body>
</html>