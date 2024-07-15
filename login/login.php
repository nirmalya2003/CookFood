<?php
$servername="localhost";
$user="root";
$password="";
$dbname="food_website";
$c=mysqli_connect($servername,$user,$password,$dbname);
error_reporting(0);
$username=$_POST['username&email'];
$password=$_POST['password'];
$variable = $username;


$q="SELECT * FROM login WHERE (email='$username' AND pass='$password') Or (username='$username' AND pass='$password')";   // Check the username and password
$d=mysqli_query($c,$q);
if(mysqli_num_rows($d) == 1){
    header("Location: loggedIn.php?variable=$variable");
    exit;
}
else{
	?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <p style="color:red">Invalid login credentials</p>
            <label for="username">Email / Username</label>
            <input type="text" id="username" name="username&email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <div class="options">
            <a href="signup.html">Sign Up</a>
            <a href="forgot_password.html">Forgot Password?</a>
        </div>
    </div>
</body>
</html>
<?php
}
?>