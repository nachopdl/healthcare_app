<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate - MediConnect</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-logo">
                <img src="images/logo.webp" alt="Logo">
            </div>
            <form id="signup-form">
                <h2>Regístrate</h2>
                <p>Crea una cuenta nueva.</p>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">Nombres</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Ingresa tus Nombres" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Apellidos</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Ingresa tus Apellidos" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="dob">Fecha de Nacimiento</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Sexo</label>
                        <select id="gender" name="gender" required>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="height">Estatura (cm)</label>
                        <input type="number" id="height" name="height" placeholder="Ingresa tu Estatura en cm" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso (kg)</label>
                        <input type="number" id="weight" name="weight" placeholder="Ingresa tu Peso en kg" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="bloodtype">Tipo de Sangre</label>
                        <select id="bloodtype" name="bloodtype" required>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" placeholder="Ingresa tu Correo Electrónico" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Ingresa tu Contraseña" required>
                    </div>
                </div>
                <button type="submit" class="signup-btn">Registrarte</button>
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
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
