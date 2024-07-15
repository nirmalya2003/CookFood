<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../CookFood.png" type="png">
    <title>Recipe Form</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F1F8E8;
            padding: 20px;
        }
    
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-in-out;
        }
        
        form {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 0 auto;
            animation: slideIn 0.5s ease-out;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #444;
        }
        
        input[type="text"], textarea, select, input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        input[type="text"]:focus, textarea:focus, select:focus, input[type="file"]:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 8px rgba(108, 99, 255, 0.2);
            outline: none;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        input[type="submit"] {
            background-color: #6c63ff;
            color: white;
            padding: 14px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        
        input[type="submit"]:hover {
            background-color: #5a51ff;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            form {
                padding: 20px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

</head>
<body>
    <h1>Recipe Form</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="strRecipe">Recipe Name</label>
            <input type="text" id="strRecipe" name="strRecipe" required>
        </div>

        <div class="form-group">
            <label for="strInstructions">Instructions</label>
            <textarea id="strInstructions" name="strInstructions" required></textarea>
        </div>

        <div class="form-group">
            <label for="strYoutube">YouTube Link</label>
            <input type="text" id="strYoutube" name="strYoutube" required>
        </div>
        
        <div class="form-group">
            <div id="ingredients-measures">
                <div>
                    <label for="strIngredientMeasurement">Ingredients & Measurements</label>
                    <textarea id="strIngredientsMeasurements" name="strIngredientsMeasurements" placeholder="Eg: Butter- 100g, Salt- As taste" required></textarea>   
                </div>
            </div>      
        </div>
        
        <div class="form-group">
            <label for="strCategory">Category</label>
            <select id="strCategory" name="strCategory">
                <option value="">Select Category</option>
                <option value="Beef">Beef</option>
                <option value="Chicken">Chicken</option>
                <option value="Dessert">Dessert</option>
                <option value="Lamb">Lamb</option>
                <option value="Miscllaneous">Miscllaneous</option>
                <option value="Pasta">Pasta</option>
                <option value="Pork">Pork</option>
                <option value="Seafood">Seafood</option>
                <option value="Side">Side</option>
                <option value="Starter">Starter</option>
                <option value="Vegan">Vegan</option>
                <option value="Vegetarian">Vegetarian</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Goat">Goat</option>
            </select>
        </div>

        <div class="form-group">
            <label for="strArea">Area</label>
            <select id="strArea" name="strArea">
                <option value="">Select Area</option>
                <option value="American">American</option>
                <option value="British">British</option>
                <option value="Canadian">Canadian</option>
                <option value="Chinese">Chinese</option>
                <option value="Croatian">Croatian</option>
                <option value="Dutch">Dutch</option>
                <option value="Egyptian">Egyptian</option>
                <option value="Filipino">Filipino</option>
                <option value="French">French</option>
                <option value="Greek">Greek</option>
                <option value="Indian">Indian</option>
                <option value="Irish">Irish</option>
                <option value="Italian">Italian</option>
                <option value="Jamaican">Jamaican</option>
                <option value="Japanese">Japanese</option>
                <option value="Kenyan">Kenyan</option>
                <option value="Malaysian">Malaysian</option>
                <option value="Mexican">Mexican</option>
                <option value="Moroccan">Moroccan</option>
                <option value="Polish">Polish</option>
                <option value="Portuguese">Portuguese</option>
                <option value="Russian">Russian</option>
                <option value="Spanish">Spanish</option>
                <option value="Thai">Thai</option>
                <option value="Tunisian">Tunisian</option>
                <option value="Turkish">Turkish</option>
                <option value="Ukrainian">Ukrainian</option>
                <option value="Unknown">Unknown</option>
                <option value="Vietnamese">Vietnamese</option>
            </select>
        </div>

        <div class="form-group">
            <label for="strRecipeThumb">Recipe Thumbnail</label>
            <input type="file" id="strRecipeThumb" name="strRecipeThumb" accept="image/*" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Submit">
        </div>

    </form>

    <?php
        $servername = "localhost";
        $username = "root"; // replace with your database username
        $password = ""; // replace with your database password
        $dbname = "food_website";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $username = urldecode($_GET['username']);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $strRecipe = $_POST['strRecipe'];
            $strInstructions = $_POST['strInstructions'];
            $strYoutube = $_POST['strYoutube'];
            $strCategory = $_POST['strCategory'];
            $strArea = $_POST['strArea'];
            $strIngredientsMeasurements = $_POST['strIngredientsMeasurements'];

            // Handle file upload
            $strRecipeThumb = '';
            if (isset($_FILES['strRecipeThumb']) && $_FILES['strRecipeThumb']['error'] == 0) {
                $target_dir = "uploads/";
                $file_name = pathinfo($_FILES["strRecipeThumb"]["name"], PATHINFO_FILENAME);
                $file_extension = pathinfo($_FILES["strRecipeThumb"]["name"], PATHINFO_EXTENSION);
                $unique_name = $file_name . '_' . time() . '.' . $file_extension;
                $target_file = $target_dir . $unique_name;
                
                if (move_uploaded_file($_FILES["strRecipeThumb"]["tmp_name"], $target_file)) {
                    $strRecipeThumb = $target_file;
                }
            }

            $stmt = $conn->prepare("INSERT INTO addrecipe (username, strRecipe, strInstructions, strYoutube, strCategory, strArea, strRecipeThumb, strIngredientsMeasurements) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssssss", $username, $strRecipe, $strInstructions, $strYoutube, $strCategory, $strArea, $strRecipeThumb, $strIngredientsMeasurements);

            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();
    ?>
</body>
</html>