
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = "";
  $email = "";
  $password = "";
  $confirmPassword = "";
  $nameErr = "";
  $emailErr = "Email is required";
  $passwordErr = "Password is required";
  $confirmPasswordErr = "Passwords do not match";
  $phoneNumberRrr="";


  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
   
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }


  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    if (strlen($password) < 8) {
      $passwordErr = "Password must be at least 8 characters long";
    }
  }


  if (empty($_POST["confirmpassword"])) {
    $confirmPasswordErr = "Confirm password is required";
  } else {
    $confirmPassword = test_input($_POST["confirmpassword"]);
    if ($password !== $confirmPassword) {
      $confirmPasswordErr = "Passwords do not match";
    }
  }


 
  if (empty($_POST["phoneNumber"])) {
    $phoneNumberErr = "phoneNumber is required";
  } else {
    $phoneNumber= test_input($_POST["phoneNumber"]);
   
  }


  if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {

  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
    <style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f4;
}

.container {
    background: #fff;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
    width: 50%;
}

h1, h2 {
    margin-bottom: 20px;
    font-size: 24px;
}

p {
    margin-bottom: 20px;
    color: #666;
}

form {
    display: flex;
    flex-direction: column;
    align-items: stretch;
}

label {
    text-align: left;
    margin-bottom: 5px;
    font-weight: bold;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.button {
    display: block;
    width: 100%;
    padding: 10px;
    text-align: center;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
}

.login {
    background-color: #007bff;
}

.signup {
    background-color: #dc3545;
}

.button:hover {
    opacity: 0.9;
}

.buttons {
    display: flex;
    justify-content: space-between;
}

.buttons .button {
    width: 48%;
}
</style>
</head>



<body>
    <div class="container">
        <h2>Sign Up</h2>
        <p>Create an Account. It's free</p>
        <form action="" method="POST">

        <label for="text">Name</label>
        <input type="text" id="nameError" name="name" required>
        <span id="nameError" style="color: red;"><?php echo $nameErr; ?></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <span id="nameError" style="color: red;"><?php echo  $emailErr; ?></span>


            
            <label for="phoneNumber">phoneNumber</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>
            <span id="phoneNumberErr" style="color: red;"><?php echo $phoneNumberErr; ?></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span id="nameError" style="color: red;"><?php echo  $passwordErr; ?></span>




            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" required>
            <span id="nameError" style="color: red;"><?php echo   $confirmPasswordErr; ?></span>

            <button type="submit" class="button signup">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
<?php




include 'conndb.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=  $conn->real_escape_string($_POST['name']) ;
$email= $conn->real_escape_string($_POST['email']) ;
$password= $conn->real_escape_string($_POST['password']) ;

$password=password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
$sql="INSERT INTO superuser (name, email,password,phoneNumber,role_ID) VALUES('$name','$email','$password','$phoneNumber',1)";
if($conn->query($sql)===TRUE){
    exit();


}}
$conn->close();
?>