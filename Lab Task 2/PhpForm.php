<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $dobErr = $genderErr = $degreeErr = $bloodErr = "";
$name = $email = $dd = $mm = $yyyy = $gender = $blood = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $count = str_word_count("$name");
    // check if name only contains letters and whitespace
    if ((!preg_match("/^[a-zA-Z-' ]*$/",$name)) || $count < 2 ){
      $nameErr = "Only letters and white space allowed and contains at least two words";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["dd"])) {
    $dobErr = "Empty Field";
  }else{
    $dd = test_input($_POST["dd"]);
    if ($dd<0 || $dd>31){
      $dobErr = "Invalid date ";
    }
  }

  if (empty($_POST["mm"])) {
    $dobErr = "Empty Field";
  }else{
    $mm = test_input($_POST["mm"]);
    if ($mm<0 || $mm>12){
      $dobErr = "Invalid month ";
    }
  }
  if (empty($_POST["yyyy"])) {
    $dobErr = "Empty Field";
  }else{
    $yyyy = test_input($_POST["yyyy"]);
    if ($yyyy<1953 || $yyyy>1998){
      $dobErr = "Invalid year ";
    }
  }  

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if(!empty($_POST["degree"])){
    $countDegree = count($_POST["degree"]);
    if($countDegree<2){
      $degreeErr = "At least two of them must be selected";
    }
  }else{
     $degreeErr = "At least two of them must be selected";
  }

  if (empty($_POST["blood"])) {
      $bloodErr = "Must be selected";
    } else {
      $blood = test_input($_POST["blood"]);
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <fieldset>
    <legend><b>NAME</b></legend>
    <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span><hr>
  </fieldset><br>
  <fieldset>
    <legend><b>EMAIL</b></legend>
    <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span><hr>
  </fieldset><br>
  <fieldset>
    <legend><b>DATE OF BIRTH</b></legend>
    &emsp;dd &emsp;&emsp;&emsp; mm &emsp;&emsp;&emsp;  yyyy<br>
    <input type="text" name="dd" value="<?php echo $dd;?>" size="4"> /
    <input type="text" name="mm" value="<?php echo $mm;?>" size="4"> /
    <input type="text" name="yyyy" value="<?php echo $yyyy;?>" size="8">
    <span class="error">* <?php echo $dobErr;?></span><hr>
  </fieldset><br>
  <fieldset>
    <legend><b>GENDER</b></legend>
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="Female">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="Male">Male
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="Other">Other  
    <span class="error">* <?php echo $genderErr;?></span><hr>
  </fieldset><br>
  <fieldset>
    <legend><b>DEGREE</b></legend>
    <input type="checkbox" name="degree[]" value="SSC">SSC
    <input type="checkbox" name="degree[]" value="HSC">HSC
    <input type="checkbox" name="degree[]" value="BSc">BSc
    <input type="checkbox" name="degree[]" value="MSc">MSc
    <span class="error">* <?php echo $degreeErr;?></span><hr>
  </fieldset><br>
  <fieldset>
    <legend><b>BLOOD GROUP</b></legend>
    <select name = "blood">
      <option ></option>  
      <option value="A+">A+</option>
      <option value="B+">B+</option>  
      <option value="A-">A-</option>
      <option value="B-">B-</option>    
      <option value="AB+">AB+</option>  
      <option value="AB-">AB-</option>
      <option value="O+">O+</option>  
      <option value="O-">O-</option>
    </select>
    <span class="error">* <?php echo $bloodErr;?></span><hr>    
  </fieldset><br><br><br>

  <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Output:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $dd; echo " / "; echo $mm; echo" / "; echo $yyyy;
echo "<br>";
echo $gender;
echo "<br>";
if(!empty($_POST["degree"])){
  foreach($_POST["degree"] as $Degree){
    echo $Degree; echo "&emsp;&emsp;";
  }
}
echo "<br>";
echo $blood;
?>

</body>
</html>