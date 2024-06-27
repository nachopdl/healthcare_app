<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - MediConnect</title>
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Barra de Navegación -->
        <nav class="navbar">
            <div class="navbar-brand">
                <img src="images/logo.webp" alt="Logo">
                <span>MediConnect</span>
            </div>
            <ul class="nav-links">
                <li class='nav-item'><a href="dashboard.php"><i class="fa-solid fa-gauge-high"></i> Dashboard</a></li>

                <li class="nav-item">
                    <a href="#"><i class="fas fa-dumbbell"></i> Física</a>
                    <ul class="submenu">
                        <li><a href="#diagnostico-fisico">Diagnóstico</a></li>
                        <li><a href="#entrenamiento">Entrenamiento</a></li>
                        <li><a href="#nutricion">Nutrición</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#"><i class="fas fa-brain"></i> Mental</a>
                    <ul class="submenu">
                        <li><a href="#diagnostico-mental">Diagnóstico</a></li>
                        <li><a href="#registro-emociones">Registro de Emociones</a></li>
                        <li><a href="#consejos">Consejos</a></li>
                    </ul>
                </li>
                <li><a href="#" id="logout-button"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            </ul>
        </nav>
        
        <div class="profile-container">
            <h1>Perfil de Usuario</h1>
            <div class="profile-card">
                <img id="user-photo" src="images/user.jpg" alt="User Photo" class="user-photo">
                <h2 id="user-fullname">John Doe</h2>
                <p id="user-age-location">24 años</p>
                <div class="user-info">
                    <div class="info-item">
                        <p>ID</p>
                        <p id="user-id"></p>
                    </div>
                    <div class="info-item">
                        <p>Correo Electrónico</p>
                        <p id="user-email">john.doe@example.com</p>
                    </div>
                    <div class="info-item">
                        <p>Género</p>
                        <p id="user-gender">Masculino</p>
                    </div>
                    <div class="info-item">
                        <p>Estatura</p>
                        <p id="user-height">170 cm</p>
                    </div>
                    <div class="info-item">
                        <p>Peso</p>
                        <p id="user-weight">60 kg</p>
                    </div>
                    <div class="info-item">
                        <p>Tipo de Sangre</p>
                        <p id="user-blood">-B</p>
                    </div>
                    <button id="edit-profile-button">Editar Perfil</button>
                </div>
            </div>
        </div>
        <!-- Modal para editar el perfil -->
        <div id="edit-profile-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Editar Perfil</h2>
                <form id="edit-profile-form">
                    <div class="form-group">
                        <label for="first-name">Nombres</label>
                        <input type="text" id="first-name" name="first-name" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Apellidos</label>
                        <input type="text" id="last-name" name="last-name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="height">Estatura (cm)</label>
                        <input type="number" id="height" name="height" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso (kg)</label>
                        <input type="number" id="weight" name="weight" required>
                    </div>
                    <div class="form-group">
                        <label for="blood-type">Tipo de Sangre</label>
                        <input type="text" id="blood-type" name="blood-type" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto de Perfil</label>
                        <input type="file" id="photo" name="photo">
                    </div>
                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/perfil.js"></script>
</body>
</html>
