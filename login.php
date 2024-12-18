<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="E-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J.J.E Website</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admin";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $registrationMessage = "";
    $loginError = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if it's a registration form submission
        if (isset($_POST['register_username'], $_POST['register_email'], $_POST['register_password'])) {
            $username = $_POST['register_username'];
            $email = $_POST['register_email'];
            $password = $_POST['register_password'];

            // Check if the email already exists
            $checkEmailQuery = "SELECT * FROM user WHERE email = ?";
            $stmt = $conn->prepare($checkEmailQuery);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $registrationMessage = "Email already exists. Please log in.";
            } else {
                // Insert new user into the database
                $insertQuery = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("sss", $username, $email, $password);

                if ($stmt->execute()) {
                    $registrationMessage = "Registration successful! Please log in.";
                } else {
                    $registrationMessage = "Registration failed. Please try again.";
                }
            }
            $stmt->close();
        }

        // Check if it's a login form submission
        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate user credentials
            $loginQuery = "SELECT * FROM user WHERE email = ? AND password = ?";
            $stmt = $conn->prepare($loginQuery);
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Login successful, redirect to Home.html
                echo "<script>window.location.href = 'Home.html';</script>";
                exit;
            } else {
                $loginError = "Invalid email or password.";
            }
            $stmt->close();
        }
    }

    $conn->close();
    ?>


    <header>
        <div class="logo_container">
            <img src="frostygoods.png" alt="Logo" class="logo_img">
            <h2 class="logo">Frosty Goods</h2>
        </div>
        <div>
            <nav class="navigation">
                <a href="#" id="aboutUsBtn">About Us</a>
                <a href="#" id="contactUsBtn">Contact Us</a>
                <a href="#">Grocery</a>
                <button class="btnLogin">Login</button>
            </nav>

        </div>
    </header>

    <!-- About Us Section -->
<div class="about_us_popup" id="aboutUsPopup">
    <span class="icon_close about_close"><ion-icon name="close"></ion-icon></span>
    <div class="about_us_content">
        <h2>About Us</h2>
        <p>
            Welcome to <strong>Frosty Goods</strong>, a website created for users to browse products seamlessly and with ease. 
            Our team strives to deliver the best user experience with a smooth and elegant design. 
            <br><br>
            <strong>Our Vision:</strong> To provide a digital platform for exploring and shopping groceries online efficiently.
        </p>
    </div>
</div>

<!-- Contact Us Section -->
<div class="contact_us_popup" id="contactUsPopup">
    <span class="icon_close contact_close"><ion-icon name="close"></ion-icon></span>
    <div class="contact_us_content">
        <h2>Contact Us</h2>
        <div class="team_members">
            <div class="member">
                <img src="jpQ.jpg" alt="Member 1" class="member_img">
                <p><strong>John Paul Quinones</strong></p>
                <p>Role: Developer</p>
            </div>
            <div class="member">
                <img src="Ej.jpg" alt="Member 2" class="member_img">
                <p><strong>Erick Jay Maras</strong></p>
                <p>Role: Developer</p>
            </div>
            <div class="member">
                <img src="jpD.jpg" alt="Member 3" class="member_img">
                <p><strong>Jhon Paul Dichoso</strong></p>
                <p>Role: Designer</p>
            </div>
        </div>
    </div>
</div>



    <div class="wrapper">
        <span class="icon_close"><ion-icon name="close"></ion-icon></span>

        <!-- Login Form -->
        <div class="login_form login">
            <h2>Login</h2>
            <form method="POST" action="">
                <div class="input_box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input_box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember_forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>

                <!-- Display login error if exists -->
                <?php if (!empty($loginError)) {
                    echo "<p style='color: red; text-align: center;'>$loginError</p>";
                } ?>

                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="login_form register">
            <h2>Registration</h2>
            <form method="POST" action="">
                <div class="input_box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="register_username" required>
                    <label>Username</label>
                </div>
                <div class="input_box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="register_email" required>
                    <label>Email</label>
                </div>
                <div class="input_box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="register_password" required>
                    <label>Password</label>
                </div>
                <div class="remember_forgot">
                    <label><input type="checkbox" required> I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="btn">Register</button>

                <!-- Display registration message if exists -->
                <?php if (!empty($registrationMessage)) {
                    echo "<p style='color: green; text-align: center;'>$registrationMessage</p>";
                } ?>

                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>


    <script src="login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>