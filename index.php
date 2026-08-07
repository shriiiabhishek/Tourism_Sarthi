<?php 
// API folder ke andar se db.php ko include kar rahe hain
if(file_exists('api/db.php')){
    include('api/db.php');
} else {
    echo "<div style='color:white; background:red; padding:10px; text-align:center;'>Warning: api/db.php file not found!</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP Tourism Sarthi - Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #e67e22;
            --secondary-color: #d35400;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /* Professional Cinematic Background */
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1593351415075-3bac9f45c877?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .main-container {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(255,255,255,0.3);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            font-family: 'Montserrat', sans-serif;
            color: var(--secondary-color);
            font-size: 30px;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 12px;
            outline: none;
            transition: 0.3s;
            background: #fdfdfd;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(230, 126, 34, 0.2);
        }

        .submit-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(211, 84, 0, 0.3);
        }

        .submit-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(211, 84, 0, 0.4);
        }

        .footer-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #555;
        }

        .footer-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        /* Forms Hidden state */
        #login-box { display: none; }
    </style>
</head>
<body>

    <div class="main-container">
        
        <div id="register-box">
            <div class="header">
                <h2>Join The Sarthi</h2>
                <p>Plan your incredible MP journey</p>
            </div>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="E.g. Abhishek Shrivastava" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="reg_email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="reg_pass" placeholder="Create strong password" required>
                </div>
                <button type="submit" name="btn_register" class="submit-btn">Create Account</button>
            </form>
            
            <div class="footer-link">
                Already have an account? <a href="javascript:void(0)" onclick="toggleUI('login')">Login Now</a>
            </div>
        </div>

        <div id="login-box">
            <div class="header">
                <h2>Welcome Back</h2>
                <p>The Heart of India awaits you</p>
            </div>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label>Email ID</label>
                    <input type="email" name="login_email" placeholder="Your registered email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="login_pass" placeholder="Enter password" required>
                </div>
                <button type="submit" name="btn_login" class="submit-btn">Login to Journey</button>
            </form>
            
            <div class="footer-link">
                Don't have an account? <a href="javascript:void(0)" onclick="toggleUI('register')">Register Free</a>
            </div>
        </div>

    </div>

    <script>
        // Smooth switching between forms
        function toggleUI(formType) {
            const regBox = document.getElementById('register-box');
            const loginBox = document.getElementById('login-box');
            
            if(formType === 'login') {
                regBox.style.display = 'none';
                loginBox.style.display = 'block';
                document.title = "MP Tourism Sarthi - Login";
            } else {
                regBox.style.display = 'block';
                loginBox.style.display = 'none';
                document.title = "MP Tourism Sarthi - Register";
            }
        }
    </script>

    <?php
    // Logic for Registration
    if(isset($_POST['btn_register'])) {
        $name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['reg_email']);
        $pass = $_POST['reg_pass']; // Secure password use password_hash in real projects

        $query = "INSERT INTO users (fullname, email, password) VALUES ('$name', '$email', '$pass')";
        if(mysqli_query($conn, $query)) {
            echo "<script>alert('Registration successful! Please login.'); toggleUI('login');</script>";
        } else {
            echo "<script>alert('Email already registered! Use another email.');</script>";
        }
    }

    // Logic for Login
    if(isset($_POST['btn_login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['login_email']);
        $pass = $_POST['login_pass'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
        
        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('Success! Redirecting to dashboard...'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Oops! Incorrect email or password.');</script>";
        }
    }
    ?>

</body>
</html>