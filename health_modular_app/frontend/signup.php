<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Healthcare</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-logo">
                <img src="images/logo.webp" alt="Logo">
            </div>
            <form id="signup-form">
                <h2>Sign Up</h2>
                <p>Create a new account.</p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="signup-btn">Sign Up</button>
                <p>Already have an account? <a href="login.php">Log In</a></p>
            </form>
        </div>
        <div class="image-container">
            <img src="images/signup.webp" alt="Healthcare Image">
            <div class="overlay">
                <div class="overlay-content">
                    <h1>MediConnect</h1>
                    <p>Potenciando la atención médica, un clic a la vez: su salud, sus registros, su control.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/signup.js"></script>
</body>
</html>

