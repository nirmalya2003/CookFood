<?php
$c=mysqli_connect('localhost','root','','food_website');
error_reporting(0);
$name=$_POST['name1'];
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$confirm_password=$_POST['confirm_password'];

if ($password === $confirm_password) {
	// Passwords match, proceed with signup
	// You can perform further validation and sanitation here

	// Example SQL query to insert data into the database
	$sql = "INSERT INTO login (username, email, pass, fullname) VALUES ('$username', '$email', '$password','$name')";
	$d1=mysqli_query($c,$sql);
	if ($d1 === TRUE) {
		?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <p style="color:green">Sign up successfully done</p>
            <label for="name">Name</label>
            <input type="text" id="name" name="name1" required>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <label for="password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
<?php
    header("refresh:2; url=../index.html");
	} else {
		echo "Error: " . $sql . "<br>" ;
	}
} else {
	?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <p style="color:red">Password and confirm password missmatch</p>
            <label for="name">Name</label>
            <input type="text" id="name" name="name1" required>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <label for="password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
<?php
}
?>