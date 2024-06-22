<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MediConnect</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        
        <!-- Panel Principal -->
        <div class="main-panel">
            <div class="overview">
                <h1 id="user-name">Bienvenido, [Nombre del Usuario]</h1>
                <p>Aquí tienes un resumen de tu estado de salud física y mental.</p>
            </div>

            <!-- KPIs y Gráficos Interactivos -->
            <div class="kpis">
                <div class="kpi-card">
                    <img src="images/user.jpg" alt="User Photo" class="user-photo">
                    <h2 id="user-fullname">Ignacio Partida de Leon</h2>
                    <p id="user-age-location">24 años</p>
                    <div class="user-info">
                        <div class="info-item">
                            <p>Sangre</p>
                            <p id="user-blood">-B</p>
                        </div>
                        <div class="info-item">
                            <p>Estatura</p>
                            <p id="user-height">170 cm</p>
                        </div>
                        <div class="info-item">
                            <p>Peso</p>
                            <p id="user-weight">60 kg</p>
                        </div>
                    </div>
                </div>
                <div class="kpi-item">
                    <h2>Progreso de Peso</h2>
                    <canvas id="weightProgressChart"></canvas>
                </div>
                <div class="kpi-item">
                    <h2>Últimos Diagnósticos</h2>
                    <ul id="diagnosticos">
                        <li>Diagnóstico 1: Normal</li>
                        <li>Diagnóstico 2: Sobrepeso</li>
                        <li>Diagnóstico 3: Bajo Peso</li>
                    </ul>
                </div>
            </div>

            <!-- Gráficos Interactivos Adicionales -->
            <div class="additional-charts">
                <div class="chart-item small-chart">
                    <h2>Entrenamiento Semanal</h2>
                    <canvas id="weeklyTrainingChart"></canvas>
                </div>
                <div class="chart-item small-chart">
                    <h2>Registro de Emociones</h2>
                    <canvas id="emotionsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
