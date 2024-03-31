<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourite Recipes</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
            max-width: 100%;
            height: auto;
        }

        .recipe-card-content {
            padding: 20px;
            flex-grow: 1;
            padding-bottom: 80px;
        }

        .recipe-card-content h1 {
            font-size: 20px;
            margin-bottom: 10px;
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

        .recipe-card-content button,
        .recipe-card-content a {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            background: crimson;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 15px;
        }

        .recipe-card-content button:hover,
        .recipe-card-content a:hover {
            background-color: #b30000;
        }

        .recipe-card-content .button-container {
            text-align: center;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">CookFood.</div>
        <div class="navbar-link">Find your Favourite Recipes here...</div>
    </div>
    <div class="container">
        <?php
        $c = mysqli_connect('localhost', 'root', '', 'food_website');
        $username = $_GET['username'];
        $sql = "SELECT DISTINCT mealid, mealname FROM favfood WHERE username='$username' ORDER BY favfoodno DESC;";
        $d = mysqli_query($c, $sql);

        while ($r = mysqli_fetch_assoc($d)) {
            $mealId = $r['mealid'];
            $url = 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $mealId;
            $response = file_get_contents($url);

            if ($response === false) {
                echo "Error fetching data from API";
            } else {
                $data = json_decode($response, true);

                foreach ($data['meals'] as $mealDetails) {
                    $mealName = $mealDetails['strMeal'];
                    $mealCategory = $mealDetails['strCategory'];
                    $mealArea = $mealDetails['strArea'];
                    $mealInstructions = $mealDetails['strInstructions'];
                    $mealImage = $mealDetails['strMealThumb'];
                    $mealVideo = $mealDetails['strYoutube'];

                    $ingredient = "<ul>";
                    for ($i = 1; $i <= 20; $i++) {
                        $ingredientKey = 'strIngredient' . $i;
                        $measureKey = 'strMeasure' . $i;
                        if (!empty($mealDetails[$ingredientKey]) && !empty($mealDetails[$measureKey])) {
                            $ingredient .= "<li>{$mealDetails[$measureKey]} {$mealDetails[$ingredientKey]}</li>\n";
                        }
                    }
                    $ingredient .= "</ul>";

                    echo "<div class='recipe-card'>
                            <img src='$mealImage' alt='$mealName'>
                            <div class='recipe-card-content'>
                                <h1>$mealName</h1>
                                <p><b>Category:</b> $mealCategory</p>
                                <p><b>Area:</b> $mealArea</p>
                                <p><b>Instructions:</b>$mealInstructions</p>
                                <p><b>YouTube Link:</b><a href='$mealVideo' target='_blank'>Watch Recipe</a></p>
                                <p><b>Ingredients:</b>$ingredient</p>
                                <div class='button-container'>
                                    <form method='post' action='removeFavourite.php' style='display: inline;'>
                                        <input type='hidden' name='username' value='$username'>
                                        <input type='hidden' name='mealid' value='$mealId'>
                                        <button type='submit'>Remove from Favourites</button>
                                    </form>
                                    <a href='../login/loggedIn.php?variable=$username'>Go To Home</a>
                                </div>
                            </div>
                        </div>";
                }
            }
        }
        ?>
    </div>
</body>
</html>