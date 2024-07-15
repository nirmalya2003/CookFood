<?php
$mysqli = new mysqli('localhost', 'root', '', 'food_website');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idRecipe = $_POST['idRecipe'];
    $username = $_POST['username'];

    $recipeid = isset($_GET['recipeid']) ? intval($_GET['recipeid']) : 1;

    $commentQuery = "SELECT * FROM comments WHERE recipeid = ? ORDER BY created_at DESC";
    $commentQuery = $mysqli->prepare($commentQuery);
    $commentQuery->bind_param("i", $idRecipe);
    $commentQuery->execute();
    $commentResult = $commentQuery->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../CookFood.png" type="png">
    <title>All Comments</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .comment-section {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 20px;
        }

        .comment-section h1 {
            margin: 0 0 30px;
            text-align: center;
            font-size: 2.5em;
            color: #2c3e50;
            font-weight: 600;
        }

        .comment {
            padding: 20px;
            border-bottom: 1px solid #ecf0f1;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .comment:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .comment:hover {
            background-color: #f8f9fa;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .comment strong {
            display: block;
            font-size: 1.2em;
            color: #3498db;
            margin-bottom: 10px;
        }

        .comment p {
            margin: 10px 0;
            color: #555;
            line-height: 1.6;
        }

        .comment small {
            display: block;
            text-align: right;
            color: #95a5a6;
            font-size: 0.9em;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            .comment-section {
                padding: 20px;
            }

            .comment-section h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="comment-section">
        <h1>All Comments</h1>
        <?php while ($comment = $commentResult->fetch_assoc()): ?>
            <div class="comment">
                <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                <small><?php echo htmlspecialchars($comment['created_at']); ?></small>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
$commentQuery->close();
$mysqli->close();
?>
