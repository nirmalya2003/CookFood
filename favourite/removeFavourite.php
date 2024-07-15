<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Remove From Favourites</title>
   <link rel="icon" href="../CookFood.png" type="png">
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
        
       body {
           display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           height: 100vh;
           margin: 0;
           font-family: Arial, sans-serif;
       }
       .button {
           display: inline-block;
           padding: 10px 20px;
           background-color: #4CAF50;
           color: white;
           text-decoration: none;
           border-radius: 4px;
           margin: 10px;
           font-weight: bold;
       }
       .button:hover {
           background-color: #45a049;
       }
   </style>
</head>

<body>
   <div>
       <?php
       $c = mysqli_connect('localhost', 'root', '', 'food_website');

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
           $username = $_POST['username'];
           $mealId = $_POST['mealid'];

           $sql = "DELETE FROM favfood WHERE username='$username' AND mealid='$mealId'";
           if (mysqli_query($c, $sql)) {
               echo "<p style='text-align: center;'>Recipe removed from favourites successfully.</p>";
               echo "<a class='button' href='../login/loggedIn.php?variable=$username'>Add another recipe</a>";
               echo "<a class='button' href='favourite.php?username=$username'>View all favourite recipes</a>";
           } else {
               echo "<p>Error removing recipe from favorites: " . mysqli_error($c) . "</p>";
               header("refresh:2; url=favourite.php?username=$username");
           }
       }
       ?>
   </div>
</body>
</html>