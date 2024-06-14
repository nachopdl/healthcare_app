<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Healthcare</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="images/login_2.webp" alt="Healthcare Image">
            <div class="overlay">
                <div class="overlay-content">
                    <h1>MediConnect</h1>
                    <p>Potenciando la atención médica, un clic a la vez: su salud, sus registros, su control.</p>
                </div>
            </div>
        </div>
        <div class="form-container">
            <div class="form-logo">
                <img src="images/logo.webp" alt="Logo">
            </div>
            <form id="login-form">
                <h2>Login</h2>
                <p>Log in to your account.</p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="login-btn">Log In</button>
                <button type="button" class="google-login-btn">Log in with Google</button>
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
