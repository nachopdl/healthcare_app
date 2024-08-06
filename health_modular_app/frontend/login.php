<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="form-logo">
                <img src="images/logo.webp" alt="Logo">
            </div>
            <h2>Iniciar Sesión</h2>
            <div id="error-message" class="message error"></div>
            <form id="login-form">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="email-icon"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" id="email" placeholder="Correo Electrónico" required aria-describedby="email-icon">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="password-icon"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" required aria-describedby="password-icon">
                        <div class="input-group-append">
                            <span class="input-group-text" id="toggle-password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <button type="submit" id="login-button" class="btn btn-primary btn-block">Entrar</button>
                <div class="login-footer">
                    <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                    <p><a href="signup.php">Crear una cuenta nueva</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
