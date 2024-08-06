<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MediConnect</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" id="button-mediconnect" href="dashboard.php">MediConnect</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="perfil.php" id="profile-button"><i class="bi bi-person"></i> Perfil</a>
                        </li>
                </ul>
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="medicos.php" id="medicos-button"><i class="bi bi-hospital"></i> Médicos</a>
                        </li>
                </ul>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="fisicaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-dumbbell"></i>
                            Física
                        </a>
                        <div class="dropdown-menu" aria-labelledby="fisicaDropdown">
                            <a class="dropdown-item" href="diagnostico_diabetes.php"><i class="bi bi-file-earmark-medical-fill"></i> Diagnóstico</a>
                            <a class="dropdown-item" href="entrenamiento.php"><i class="bi bi-bicycle"></i> Entrenamiento</a>
                            <a class="dropdown-item" href="nutricion.php"><i class="bi bi-egg-fill"></i> Nutrición</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mentalDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-brain"></i> 
                            Mental
                        </a>
                        <div class="dropdown-menu" aria-labelledby="mentalDropdown">
                            <a class="dropdown-item" href="#"><i class="bi bi-file-earmark-medical-fill"></i> Diagnóstico</a>
                            <a class="dropdown-item" href="#">Registro de Emociones</a>
                            <a class="dropdown-item" href="#">Consejos</a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" id="logout-button">Cerrar Sesión <i class="bi bi-box-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
     <h1><span id="user-name"></span></h1>
    <div class="container mt-4" style="max-width: 1400px;">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4 text-center">
                    <div class="card-body">
                        <img id="user-photo" src="" alt="User Photo" class="img-thumbnail mb-3" style="width: 100px;">
                        <h5 id="user-fullname"></h5>
                        <p id="user-age"></p>
                        <p><strong>Sangre: </strong><span id="user-blood"></span></p>
                        <p><strong>Estatura: </strong><span id="user-height"></span></p>
                        <p><strong>Peso: </strong><span id="user-weight"></span></p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Últimos Diagnósticos</h4>
                        <ul id="diagnostics-list" class="list-group">
                            <li class="list-group-item">Diagnóstico 1: Normal</li>
                            <li class="list-group-item">Diagnóstico 2: Sobrepeso</li>
                            <li class="list-group-item">Diagnóstico 3: Bajo Peso</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Progreso de Peso</h4>
                        <canvas id="weightProgressChart"></canvas>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Entrenamiento Semanal</h4>
                        <canvas id="weeklyTrainingChart"></canvas>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Registro de Emociones</h4>
                        <canvas id="emotionsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-3 float-right">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Consejo del día</h4>
                        <p id="daily-tip"></p>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Calendario de Citas</h4>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
