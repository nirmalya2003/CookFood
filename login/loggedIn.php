<?php
    $servername="localhost";
    $user="root";
    $password="";
    $dbname="food_website";
    $receivedVariable = $_GET['variable'];
    $c=mysqli_connect($servername,$user,$password,$dbname);
    $sql = "Select username,email,fullname from login WHERE email='$receivedVariable' or username='$receivedVariable' ";
    $d=mysqli_query($c,$sql);
    $row=mysqli_fetch_assoc($d);
    $username=$row['username'];
    $fullname=$row['fullname'];
    $email=$row['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookFood.</title>
    <link rel="icon" href="../CookFood.png" type="png">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <style>
        /* Styles for modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 5% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 30%; /* Could be more or less, depending on screen size */
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

   
        #dropdown {
            background-color: #126918; 
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
        }

        #dropdown option {
            background-color: #f2f2f2;
            color: #333;
        }

        @media (max-width: 768px) {
            .modal-content {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            .modal-content {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="check-btn">
                <i class="fa-solid fa-bars"></i>
            </label>
            <label class="logo">CookFood.</label>
            <ul>
                <li><a href="#home" onclick="closeNav()">Home</a></li>
                <li><a href="#services" onclick="closeNav()">Services</a></li>
                <li><a href="#reviews" onclick="closeNav()">Reviews</a></li>
                <li><a href="#aboutus" onclick="closeNav()">About Us</a></li>
                <li><button onclick="openModal()"><i class='fas fa-user-alt'></i> Profile </button></li>
                <li><button onclick="redirectToAnotherPage3()">Sign Out</button></li>
                <script>
                    function redirectToAnotherPage() {
                        window.location.href = 'login/login.html';
                    }
                    function redirectToAnotherPage3() {
                        window.location.href = '../index.html';
                    }
                </script>
            </ul>
        </nav>
    </header>

    <section id="home">
        <div class="home-left">
            <h1>Indulge in the art of <span>wellness</span> through delicious nourishment.</h1>
            <h3>Revitalize Your Plate, Rejuvenate Your Health!</h3>
           <!-- <button>Get Started</button> -->
           <h2>Welcome <span><?php echo $fullname;?></span></h2>
           <style>
                .home-left h2 span {
                    color: #126918;
                }
           </style>
        </div>

        <div class="home-right">
            <div class="home-right-top">
                <div></div>
            </div>
            <div class="home-right-mid">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-youtube"></i>
            </div>
            <div class="home-right-btm">
                <div></div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="services1">
            <h1>Curated Recipe Collection</h1>
            <h2>Crafted flavors for every palate.</h2>
            <form id="exploreForm">
                <input type="hidden" name="username" value="<?php echo $username;?>">
                <button type="button" onclick="showDropdown()">Explore</button>
                <select id="dropdown" style="display: none; margin-top: 1px;">
                    <option value="" >Select an option</option>
                    <option value="../expFav/expFavName/expFavName.html">By Name</option>
                    <option value="../expFav/expFavLetter/expFavLetter.html">By First Letter</option>
                    <option value="../expFav/expFavArea/expFavArea.html">By Area</option>
                    <option value="../expFav/expFavCategories/expFavCategories.html">By Category</option>
                    <option value="../expFav/expFavIngredients/expFavIngredients.html">By Main Ingredient</option>
                    <option value="../expFav/expFavRandom/expFavRandom.html">A Random Meal</option>
                    <option value="../addRecipe/showUserRecipe.php">By CookFood Users</option>
                </select>
            </form>

            <script>
                function showDropdown() {
                    var dropdown = document.getElementById("dropdown");
                    dropdown.style.display = "block";
                }

                document.getElementById("dropdown").addEventListener("change", function() {
                    var selectedOption = this.value;
                    if (selectedOption) {
                        var form = document.getElementById("exploreForm");
                        form.action = selectedOption;
                        form.submit();
                    }
                });
            </script>

	        <form class="favButton" action="../favourite/favourite.php" >
                <input type="hidden" name="username" value="<?php echo $username;?>" >
                <button type="submit">Favourites</button>
            </form>
            <style>
                .services1 .favButton {
                margin-top: 3px;
                }
            </style>
 
            <form class="addRecipeButton" action="../addRecipe/addRecipe.php" >
                <input type="hidden" name="username" value="<?php echo $username;?>" >
                <button type="submit">Add Recipe</button>
            </form>
            <style>
                .services1 .addRecipeButton {
                margin-top: 3px;
                }
            </style>
        </div>
        </div>
        <div class="services2">
            <h1>Smart Meal Planning</h1>
            <h2>Efficient plans, delicious results.</h2>
            <button>Explore</button>
        </div>
        <div class="services3">
            <h1>Nutritional Tracker</h1>
            <h2>Stay on track, feel great!</h2>
            <button>Explore</button>
        </div>
    </section>

    <section id="reviews">
        <div class="rev-top">
            <h1>What our <span>users</span> say?</h1>
            <h3>(Voices of satisfaction, stories that inspire.)</h3>
        </div>
        <div class="rev-btm">
            <div class="div1">
                <?php 
                    $q1="select username,review from review where username='sayan'";
                    $d=mysqli_query($c,$q1);
                    $row=mysqli_fetch_assoc($d);
                    $username=$row['username'];
                    $review=$row['review'];
                ?>
                <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="user1">
                <h3><?php echo $username ?></h3>
                <p><?php echo $review ?></p>
            </div>
            <div class="div2">
            <?php 
                    $q1="select username,review from review where username='raja'";
                    $d=mysqli_query($c,$q1);
                    $row=mysqli_fetch_assoc($d); 
                    $username=$row['username'];
                    $review=$row['review'];
                ?>
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="user2">
                <h3><?php echo $username ?></h3>
                <p><?php echo $review ?></p>
            </div>
            <div class="div3">
            <?php 
                    $q1="select username,review from review where review_no=4";
                    $d=mysqli_query($c,$q1);
                    $row=mysqli_fetch_assoc($d); 
                    $username=$row['username'];
                    $review=$row['review'];
                ?>
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=1480&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="user3">
                <h3><?php echo $username ?></h3>
                <p><?php echo $review ?></p>
            </div>
        </div>
    </section>

    <section id="aboutus">
        <div class="aboutus-top">
            <h2>Join Our Community</h2>
            <h3>Connect, share, and thrive with us today!</h3>
        </div>
        <div class="aboutus-mid">
            <h2>Add your thoughts</h2>
		<form action="review.php" method="get">
            <input type="text" placeholder="Type Here.." name="review" style="width:500px"><br>
            <input type="hidden" name="userid" value="<?php echo $receivedVariable ?>">
            <button type="submit">Submit Now</button>
        </form>
        <div class="aboutus-btm">
            <div class="div1">
                <h3>Developers</h3>
                <span>NA</span>
                <span>SM</span>
                <span>SD</span>
                <span>SD</span>
            </div>
            <div class="div2">
                <h3>About Us</h3>
                <span>Small Team. </span>
            </div>
            <div class="div3">
                <h3>Contact Us</h3>
                <span>Phone: +91111222003</span><br>
                <span>Email: contact@email.com</span>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 CookFood. All rights reserved.</p>
    </footer>

    <script>
        function closeNav() {
            document.getElementById("check").checked = false;
        }
    </script>
<div id="profileModal" class="modal">
        <!-- Modal content -->
        <?php
        $c=mysqli_connect($servername,$user,$password,$dbname);
        $sql = "Select username,email from login WHERE email='$receivedVariable' or username='$receivedVariable' ";
        $d=mysqli_query($c,$sql);
        while($row=mysqli_fetch_assoc($d)) {
                    $username=$row['username'];
                    $email=$row['email'];
            }
        ?>
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>User Profile</h2>
            <div class="profile-info">
                <label for="username">Username : </label>
                <input type="text" value="<?php echo $username ?>" readonly required>
                <label for="email">Email:</label>
                <input type="text" value="<?php echo $email ?>" readonly required>
                <!-- Add more profile information here -->
            </div>
            <div class="profile-actions">
                <br>
                <p><button onclick="redirectToAnotherPage4()">Change Password</button></p><br>
                <p><button onclick="redirectToAnotherPage3()">Sign Out</button></p>
                <script>
                    function redirectToAnotherPage4() {
                        window.location.href = 'forgot_password.html';
                    }
                    function redirectToAnotherPage3() {
                        window.location.href = '../index.html';
                    }
                </script>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("profileModal");

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

</body>
</html>