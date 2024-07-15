<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the mealId from the POST data
    $data = json_decode(file_get_contents("php://input"));
    $mealId = $data->mealId;
    $mealName = $data->mealName;
    $username= $data->username;

    // Now you can process the meal ID as needed
    // For example, you can store it in a database or perform any other operations

    // Here, we'll just send a response back to the client to acknowledge that the data was received
    echo json_encode(array("success" => true, "message" => "Received meal ID: $mealId , $mealName , $username"));
} else {
    // If the request method is not POST
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
$servername="localhost";
    $user="root";
    $password="";
    $dbname="food_website";
    $c=mysqli_connect($servername,$user,$password,$dbname);
    $sql = "insert into favfood(username,mealid,mealname)values('$username',$mealId,'$mealName') ";
    $d=mysqli_query($c,$sql);
?>
