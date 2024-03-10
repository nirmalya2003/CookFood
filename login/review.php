<?php
			$servername="localhost";
            $user="root";
            $password="";
            $dbname="food_website";
            $review=$_GET['review'];
            $userid=$_GET['userid'];
            $c=mysqli_connect($servername,$user,$password,$dbname);
            $sql="select username from login where email='$userid' or username='$userid'";
            $d=mysqli_query($c,$sql);
            $row=mysqli_fetch_assoc($d);
            $username=$row['username'];

            $sql1 = "insert into review(username,review) values('$username','$review');";
            $d1=mysqli_query($c,$sql1);
        ?>            
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <h1>Thank You for Your Review!</h1>
    <p>Your review has been successfully submitted.</p>
    <p>We appreciate your feedback.</p>
</body>
</html>
<?php
    header("refresh:3; url= loggedIn.php?variable=$userid");
    exit;
?>

		