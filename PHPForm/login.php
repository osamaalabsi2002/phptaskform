<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
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
<body>
    <div class="container">
        <h2>Login</h2>
        <p>Welcome back! Login with your credentials</p>
        <form action="#" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="button login">Login</button>
        </form>
        <p>Don't have an account? <a href="rigiter.php">Sign Up</a></p>
    </div>
</body>
</html>

<?php
session_start();
include 'conndb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];



    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['roleid'] = $row['roleid'];
            if ($row['roleid'] == 1) {
                header("Location: admin.php");
            } else {
                header("Location: welcome.php");
            }
        } else {
            $_SESSION['error'] = "Invalid email or password";
            header("Location: login.php");
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "An error occurred. Please try again.";
        header("Location: login.php");
    }

    mysqli_close($conn);
}
?>