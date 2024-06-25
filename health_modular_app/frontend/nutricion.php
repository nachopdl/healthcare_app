<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MediConnect</title>
    <link rel="stylesheet" href="css/dashboard.css">
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
            <li><a href="dashboard.php" id="dashboard-button"><i class="fa-solid fa-house"></i> Inicio</a></li>
                <li class="nav-item">
                    <a href="#"><i class="fas fa-dumbbell"></i> Física</a>
                    <ul class="submenu">
                        <li><a href="#diagnostico-fisico">Diagnóstico</a></li>
                        <li><a href="#entrenamiento">Entrenamiento</a></li>
                        <li><a href="nutricion.php">Nutrición</a></li>
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
        
        <!-- Panel Principal -->
        <div class="main-panel">
            <div class="overview">
                <h1 id="user-name">[Nombre del Usuario]</h1>
                <p>Aquí puedes tener tus avances nutritivos avanzados y ayuda personal de peso.</p>
            </div>


            </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/nutricion.js"></script>
</body>
</html>
