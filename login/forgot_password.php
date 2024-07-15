<?php
$servername="localhost";
$username="root";
$password="";
$dbname="food_website";
$c=mysqli_connect($servername,$username,$password,$dbname);
error_reporting(0);
$email=$_POST['email'];

$sql = "SELECT * FROM login WHERE email = '$email'";
$d=mysqli_query($c,$sql);
if(mysqli_num_rows($d) == 1){
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form action="change_password.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $email;?>"readonly required>
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required>
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="submit" value="Change Password">
        </form>
    </div>
</body>
</html>
<?php
}
else {
   ?>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <p style="color : red">Wrong email address</p>
        <form action="forgot_password.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Reset_Password">
        </form>
    </div>
</body>
</html>
<?php
}
?>
