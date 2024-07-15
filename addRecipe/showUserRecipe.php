<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../CookFood.png" type="png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourite Recipes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #54E9BD;
            height: 50px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 2rem;
        }

        .navbar-brand,
        .navbar-link {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .recipe-card {
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(214, 25, 25, 0.5), 
                -5px -5px 10px rgba(79, 233, 32, 0.678),  
                -5px 5px 10px rgba(47, 166, 235, 0.5),  
                5px -5px 10px rgba(243, 28, 225, 0.5);
            border-radius: 5px;
            overflow: hidden;
            margin: 20px;
            width: 400px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .recipe-card img {
            width: 100%;
            height: 300px; 
            object-fit: cover; 
        }

        .recipe-card-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .recipe-card-content h1 {
            font-size: 30px;
            margin-top: 0px;
            margin-bottom: 10px;
            text-align: center;
        }

        .recipe-card-content p {
            margin-bottom: 10px;
        }

        .recipe-card-content ul {
            list-style-type: none;
            padding: 0;
        }

        .recipe-card-content ul li {
            margin-bottom: 5px;
        }

        .recipe-card-content .youtube-link {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            background: crimson;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 15px;
            text-align: center;
        }

        .recipe-card-content .youtube-link:hover {
            background-color: #b30000;
        }

        .comment-section {
            margin-top: 20px;
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
        }

        .comment-form {
            display: flex;
            margin-bottom: 10px;
        }

        .comment-form input[type="text"] {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .comment-form input[type="submit"],
        .view-comments-btn {
            padding: 8px 15px;
            background-color: #54E9BD;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .comment-form input[type="submit"]:hover,
        .view-comments-btn:hover {
            background-color: #3cb371;
        }

        .view-comments-btn {
            display: block;
            width: 80%;
            margin: 10px auto;
            text-decoration: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">CookFood.</div>
        <div class="navbar-link">Find user uploaded Recipes here...</div>
    </div>
    <div class="container">
        <?php
        $c = mysqli_connect('localhost', 'root', '', 'food_website');
        if (!$c) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $username_user = urldecode($_GET['username']);
        
        $sql = "SELECT DISTINCT idRecipe, username, strRecipe, strInstructions, strYoutube, strCategory, strArea, strRecipeThumb, strIngredientsMeasurements FROM addrecipe ORDER BY idRecipe DESC;";
        $d = mysqli_query($c, $sql);

        if (mysqli_num_rows($d) > 0) {
            while ($r = mysqli_fetch_assoc($d)) {
                $idRecipe = $r['idRecipe'];
                $username = $r['username'];
                $recipeName = $r['strRecipe'];
                $instructions = $r['strInstructions'];
                $youtube = $r['strYoutube'];
                $category = $r['strCategory'];
                $area = $r['strArea'];
                $recipeThumb = $r['strRecipeThumb'];
                $ingredientsMeasurements = explode(';', $r['strIngredientsMeasurements']);

                echo '<div class="recipe-card">';
                echo '<img src="' . $recipeThumb . '" alt="' . $recipeName . '">';
                echo '<div class="recipe-card-content">';
                echo '<h1>' . $recipeName . '</h1>';
                echo '<h3>Posted by:  ' . $username . '</h3>';
                echo '<p><strong>Category:</strong> ' . $category . '</p>';
                echo '<p><strong>Area:</strong> ' . $area . '</p>';
                echo '<p><strong>Instructions:</strong> ' . $instructions . '</p>';
                echo '<h3>Ingredients:</h3>';
                echo '<ul>';
                foreach ($ingredientsMeasurements as $ingredient) {
                    echo '<li>' . $ingredient . '</li>';
                }
                echo '</ul>';
                echo '<a href="' . $youtube . '" target="_blank" class="youtube-link">Watch on YouTube</a>';
                echo '<div class="comment-section">';
                echo "<form class='comment-form' action='userRecipeComment.php' method='POST'>
                        <input type='hidden' name='idRecipe' value='$idRecipe'>
                        <input type='hidden' name='username' value='$username_user'>
                        <input type='text' name='comment' placeholder='Add a comment...'>
                        <input type='submit' value='Comment'>
                    </form>
                ";
                echo "<form action='userComment.php' method='POST'>
                        <input type='hidden' name='idRecipe' value='$idRecipe'>
                        <input type='hidden' name='username' value='$username_user'>
                        <input type='submit' value='View All Comments' class='view-comments-btn'>
                    </form>
                ";
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No recipes found.';
        }

        mysqli_close($c);
        ?>
    </div>
</body>
</html>