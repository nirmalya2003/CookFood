<?php
$servername="localhost";
$username="root";
$password="";
$dbname="food_website";
$c=mysqli_connect($servername,$username,$password,$dbname);
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password=$_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $sql1="select pass from login where email='$email'";
    $d=mysqli_query($c,$sql1);
    while($row=mysqli_fetch_assoc($d)) {
            $pass1=$row['pass'];
        }
    if($pass1==$current_password)
    {
        if ($new_password === $confirm_password) {
        
            $sql = "UPDATE login SET pass='$new_password' WHERE email='$email'";
            $d1=mysqli_query($c,$sql);
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
        <p style="color:green">Password successfully changed </p>
        <form action="forgot_password.php" method="post">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Reset_Password">
        </form>
    </div>
</body>
</html>
<?php
    header("refresh:2; url=../index.html");
        } else {
            ?>
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
                <p style="color:red">New password and confirm password missmatch</p>
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
    }
    else
    {
        ?>
        <html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../CookFood.png" type="png">
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form action="change_password.php" method="post">
            <p style="color:red">Current password is wrong !!</p>
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
    
?>
