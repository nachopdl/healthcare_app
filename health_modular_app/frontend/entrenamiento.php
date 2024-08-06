<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrenamiento - MediConnect</title>
    <link rel="stylesheet" href="css/entrenamiento.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"/>

</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">MediConnect</a>
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

    <!-- Sección Hero -->
    <div class="hero-section">
        <div class="overlay"></div>
        <div class="container content" data-aos="fade-left">
            <h1>Entrena Tu Cuerpo</h1>
            <p>En esta seccion podrás disfrutar de un basto catalogo de entrenamientos en los cuales podras interactuar y hacer ejercicio basandote en ellos. Ademas, tienes la opcion de en base a tus preferencias el sistema te asignara un entrenamiento completamente personalizado hacia tu perfil..</p>
            <a href="#custom-card" class="btn btn-custom" id="read-more-bttn">A POR ELLO</a>
        </div>
    </div>

        <!-- Tarjeta personalizacion de entrenamiento -->
    <div class="container-fluid" id="custom-card">
        <div class="card custom-card" data-aos="fade-up">
        <div class="overlay"></div>
            <div class="card-text">
                <h5 class="card-title" id="title-perso">Consulta tu entrenamiento personalizado</h5>
                <p class="card-text" id="texto-perso">¡Da clic y contesta las preguntas para darte un entrenamiento personalizado!</p>
                <!-- Botón para abrir el primer modal -->
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#goalModal">
                    <i class="fas fa-dumbbell"></i> Iniciar Configuración de Entrenamiento Personalizado
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta personalizada -->
    <div class="container my-6">
        <!-- Título de la Sección de Categorías de Ejercicios -->
        <div class="section-title" data-aos="fade-up">
            <h2>Categorías de Ejercicios</h2>
            <p>Haz clic en una categoría para abrir un catálogo de ejercicios que podrás realizar</p>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#yogaModal"><img src="images/yoga.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Yoga</h5>
                        <div class="text-center mb-3">
                            <p>El yoga es una práctica de cuerpo y mente que incluye posturas físicas, respiración controlada y meditación. Ayuda a mejorar la flexibilidad, la fuerza muscular y la respiración, además de reducir el estrés y mejorar el bienestar mental.</p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#cardioModal"><img src="images/treadmill.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Cardio</h5>
                        <div class="text-center mb-3">
                            <p>Los ejercicios cardiovasculares, también conocidos como aeróbicos, incluyen actividades que aumentan la frecuencia cardíaca y la respiración durante un período prolongado.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#fuerzaModal"><img src="images/fuerza.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Fuerza</h5>
                        <div class="text-center mb-3">
                            <p> El entrenamiento de fuerza implica el uso de resistencia para inducir contracciones musculares que aumenten la fuerza, la resistencia anaeróbica y el tamaño de los músculos esqueléticos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-4 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#coreModal"><img src="images/core.jpg" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Core</h5>
                        <div class="text-center mb-3">
                            <p>Los ejercicios de core se centran en los músculos del tronco, incluidos los abdominales, los oblicuos y la parte baja de la espalda.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#resistenciaModal"><img src="images/resistencia.jpeg" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Resistencia</h5>
                        <div class="text-center mb-3">
                            <p>El entrenamiento de resistencia, también conocido como entrenamiento de endurance, se centra en la capacidad del cuerpo para mantener un esfuerzo físico prolongado.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#altaModal"><img src="images/intensidad.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">Alta Intensidad</h5>
                        <div class="text-center mb-3">
                            <p> El entrenamiento de alta intensidad (HIIT) implica ráfagas cortas de ejercicio intenso alternadas con períodos de descanso o ejercicio de baja intensidad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    

    <!-- Modal para la primera pregunta -->
    <div class="modal fade" id="goalModal" tabindex="-1" aria-labelledby="goalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goalModalLabel">Preferencias de Entrenamiento - Objetivo Principal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="goalForm">
                        <div class="form-group">
                            <label for="goal">¿Cuál es tu objetivo principal?</label>
                            <select class="form-control" id="goal" required>
                                <option value="perder_peso">Perder Peso</option>
                                <option value="ganar_musculo">Ganar Músculo</option>
                                <option value="mejorar_resistencia">Mejorar Resistencia</option>
                                <option value="mejorar_flexibilidad">Mejorar Flexibilidad</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" onclick="nextModal('goalModal', 'levelModal')">Siguiente</button>
                    </form>
                </div>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 25%">25%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para la segunda pregunta -->
    <div class="modal fade" id="levelModal" tabindex="-1" aria-labelledby="levelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="levelModalLabel">Preferencias de Entrenamiento - Nivel de Experiencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="levelForm">
                        <div class="form-group">
                            <label for="level">¿Cuál es tu nivel de experiencia?</label>
                            <select class="form-control" id="level" required>
                                <option value="principiante">Principiante</option>
                                <option value="intermedio">Intermedio</option>
                                <option value="avanzado">Avanzado</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary btn-block" onclick="prevModal('goalModal', 'levelModal')">Anterior</button>
                        <button type="button" class="btn btn-primary btn-block" onclick="nextModal('levelModal', 'timeModal')">Siguiente</button>
                    </form>
                </div>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 50%">50%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para la tercera pregunta -->
    <div class="modal fade" id="timeModal" tabindex="-1" aria-labelledby="timeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeModalLabel">Preferencias de Entrenamiento - Tiempo Disponible</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="timeForm">
                        <div class="form-group">
                            <label for="time">¿Cuánto tiempo tienes disponible por sesión? (en minutos)</label>
                            <input type="number" class="form-control" id="time" min="10" max="120" required>
                        </div>
                        <button type="button" class="btn btn-secondary btn-block" onclick="prevModal('levelModal', 'timeModal')">Anterior</button>
                        <button type="submit" class="btn btn-primary btn-block">Finalizar</button>
                    </form>
                </div>
                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 75%">75%</div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal para la tarjeta de Yoga -->
<div class="modal fade" id="yogaModal" tabindex="-1" aria-labelledby="yogaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yogaModalLabel">Lista de ejercicios de Yoga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="yoga-ejercicios-lista" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cardio -->
<div class="modal fade" id="cardioModal" tabindex="-1" aria-labelledby="cardioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardioModalLabel">Lista de ejercicios de Cardio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="cardio-ejercicios-lista" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Fuerza -->
<div class="modal fade" id="fuerzaModal" tabindex="-1" aria-labelledby="fuerzaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fuerzaModalLabel">Lista de ejercicios de Fuerza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="fuerza-ejercicios-lista" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Core -->
<div class="modal fade" id="coreModal" tabindex="-1" aria-labelledby="coreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coreModalLabel">Lista de ejercicios de Core</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="core-ejercicios-lista" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Resistencia -->
<div class="modal fade" id="resistenciaModal" tabindex="-1" aria-labelledby="resistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resistenciaModalLabel">Lista de ejercicios de Resistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="resistencia-ejercicios-lista" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Alta intensidad -->
<div class="modal fade" id="altaModal" tabindex="-1" aria-labelledby="altaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="altaModalLabel">Lista de ejercicios de Alta Intensidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="alta-ejercicios-lista" class="list-group">
                </ul>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts de AOS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/entrenamiento.js"></script>
</body>
</html>
