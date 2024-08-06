<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricion - MediConnect</title>
    <link rel="stylesheet" href="css/nutricion.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"/>

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
                            <a class="dropdown-item" href="diagnostico_fisico.php"><i class="bi bi-file-earmark-medical-fill"></i> Diagnóstico</a>
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
            <h1>Cuida Tu Salud</h1>
            <p>En esta seccion podrás cuidar tu cuerpo de una forma saludable, en MediConnect encontraras planes alimenticios acorde a tus necesidades y un seguimiento para lograr a alcanzar tu meta..</p>
            <a href="#" class="btn btn-custom" id="read-more-bttn">Read More</a>
        </div>
    </div>

    <!-- Tarjeta personalizada -->
    <div class="container-fluid" id="custom-card">
        <div class="card custom-card" data-aos="fade-up">
        <div class="overlay"></div>
            <div class="card-text">
                <h3 class="card-title" id="title-perso">¿Que significa TMB?</h3>
                <p class="card-text" id="tmb-info">La tasa metabólica basal (TMB) es la cantidad mínima de energía que necesita tu cuerpo para sobrevivir realizando las funciones básicas, tales como respirar, parpadear, filtrar la sangre, regular la temperatura del cuerpo o sintetizar hormonas.</p>
                <h5 class="card-title" id="tmb"></h5>
                <p class="card-text" id="texto-perso">¡Da clic y contesta las preguntas para darte un deficit calorico!</p>
                <!-- Botón para abrir el primer modal -->
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#goalModal">
                    <i class="bi bi-lungs-fill"></i></i> Iniciar Configuración de Deficit Calorico
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para la primera pregunta -->
    <div class="modal fade" id="goalModal" tabindex="-1" aria-labelledby="goalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="goalModalLabel">Deficit Calorico</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿para que sirve un deficit calorico?</h5>
                    <p>El cuerpo necesita energía para funcionar, y quema esa energía para hacerlo, cuando se quema más energía de la que consumimos existe déficit calórico. El déficit calórico es importante pare perder peso, si no existe déficit calórico el peso no disminuirá.</p>
                    <hr>
                    <form id="goalForm">
                        <div class="form-group">
                            <label for="goal">¿Con que frecuencia haces ejercicio?</label>
                            <select class="form-control" id="goal" required>
                                <option value="0">Poco o ningún ejercicio</option>
                                <option value="1">Ejercicio ligero (1 - 3 días por semana)</option>
                                <option value="2">Ejercicio moderado (3 - 5 días por semana)</option>
                                <option value="3">Ejercicio fuerte (6 - 7 días por semana)</option>
                                <option value="4">Ejercicio muy fuerte (dos veces al día, entrenamientos muy duros)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" onclick="nextModal('goalModal', 'levelModal')">Generar Deficit Calorico</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para mostrar el deficit calorico -->
    <div class="modal fade" id="levelModal" tabindex="-1" aria-labelledby="levelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="levelModalLabel">Resultado del Deficit Calorico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 id="deficit_calorico"></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjeta personalizada -->
    <div class="container my-6">
        <!-- Título de la Sección de Categorías de Planes Alimenticios -->
        <div class="section-title" data-aos="fade-up">
            <h2>Planes Alimenticios</h2>
            <p>Haz clic en una categoría para obtener un plan alimenticio basado en tu meta</p>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#yogaModal"><img src="images/Perder-peso.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title-1">Bajar de peso</h5>
                        <div class="text-center mb-3">
                            <p>La pérdida de peso puede ayudarle a evitar la resistencia a la insulina y el diagnóstico de diabetes. Incluso si se le ha diagnosticado diabetes previamente, perder peso puede ayudar a prevenir las graves complicaciones cardiovasculares y neurológicas mencionadas anteriormente.</p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#cardioModal"><img src="images/mantener-perso.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title-1">Mantener tu peso</h5>
                        <div class="text-center mb-3">
                            <p>Para mantener un peso saludable evite los alimentos densos en calorías. Y evite las bebidas azucaradas. - El tamaño de las porciones también cuenta, porciones más grandes de alimentos son más calorías. - Las grasas saturadas y grasas trans son nocivas para la salud.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" id="ejercicio">
                    <a href="" data-toggle="modal" data-target="#fuerzaModal"><img src="images/aumento-peso.webp" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title-1">Aumentar peso</h5>
                        <div class="text-center mb-3">
                            <p> Comer alimentos nutritivos y ricos en calorías es una buena forma de ganar peso. También es importante comprender la razón por la que tienes un bajo peso.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para la tarjeta de bajar de peso -->
<div class="modal fade" id="yogaModal" tabindex="-1" aria-labelledby="yogaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yogaModalLabel">Lista de planes alimenticios para bajar de peso</h5>
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

<!-- Modal para mantener peso -->
<div class="modal fade" id="cardioModal" tabindex="-1" aria-labelledby="cardioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cardioModalLabel">Lista de planes alimenticios para mantener tu peso</h5>
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

<!-- Modal para aumentar de peso -->
<div class="modal fade" id="fuerzaModal" tabindex="-1" aria-labelledby="fuerzaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fuerzaModalLabel">Lista de planes alimenticios para subir de peso</h5>
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

    <!-- Tarjeta personalizada -->
    <div class="container-fluid" id="custom-card-1">
        <div class="card custom-card-1" data-aos="fade-up">
        <div class="overlay"></div>
            <div class="card-text">
                <h3 class="card-title" id="title-perso">¿Quieres tener una dieta mas personalizada?</h3>
                <p class="card-text" id="tmb-info">Contacta a uno de nuestros profesionistas especializados en el campo de la nutrición</p>
                <p class="card-text" id="texto-perso">¡Da clic para elegir al medico que te guiara al resultado deseado!</p>
                <!-- Botón para abrir el primer modal -->
                <div class="text-center mb-3">
                    <a href="medicos.php"><button type="button" class="btn btn-outline-light">
                    <i class="bi bi-heart-pulse-fill"></i>  Buscar Nutricionistas
                    </button></a>
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
    <script src="js/nutricion.js"></script>
</body>
</html>
