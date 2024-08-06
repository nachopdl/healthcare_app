<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - MediConnect</title>
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet"></head>
<body>
        <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">MediConnect</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
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
                            <a class="dropdown-item" href="diagnostico_mental.php"><i class="bi bi-file-earmark-medical-fill"></i> Diagnóstico</a>
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
        
    <div class="container mt-5">
        <h1 class="text-center">Perfil de Usuario</h1>
        <div class="card mx-auto mt-4" style="max-width: 600px;">
            <div class="card-body text-center">
                <img id="user-photo" src="" alt="User Photo" class="img-thumbnail mb-3" style="width: 150px;" onclick="showPhotoOptions()">
                <h2 id="user-fullname"></h2>
                <p id="user-age-location"></p>
                <div class="user-info">
                    <div class="info-item">
                        <p>
                            <strong>Correo Electrónico: </strong>
                            <span id="user-correo"></span>
                        </p>
                    </div>
                    <div class="info-item">
                        <p>
                            <strong>Género: </strong>
                            <span id="user-genero" ondblclick="editGender(this)"></span>
                        </p>
                    </div>
                    <div class="info-item">
                        <p>
                            <strong>Estatura: </strong>
                            <span id="user-estatura" ondblclick="editField(this)"></span><span> cm</span>
                        </p>
                    </div>
                    <div class="info-item">
                        <p>
                            <strong>Peso: </strong>
                            <span id="user-peso" ondblclick="editField(this)"></span><span> kg</span>
                        </p>
                    </div>
                    <div class="info-item">
                        <p>
                            <strong>Tipo de Sangre: </strong>
                            <span id="user-tipo_sangre" ondblclick="editField(this)"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar el perfil -->
    <div id="edit-profile-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-profile-form">
                        <div class="form-group">
                            <label for="first-name">Nombres</label>
                            <input type="text" class="form-control" id="first-name" name="first-name" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Apellidos</label>
                            <input type="text" class="form-control" id="last-name" name="last-name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="height">Estatura (cm)</label>
                            <input type="number" class="form-control" id="height" name="height" required>
                        </div>
                        <div class="form-group">
                            <label for="weight">Peso (kg)</label>
                            <input type="number" class="form-control" id="weight" name="weight" required>
                        </div>
                        <div class="form-group">
                            <label for="blood-type">Tipo de Sangre</label>
                            <input type="text" class="form-control" id="blood-type" name="blood-type" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto de Perfil</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para opciones de la foto -->
    <div class="modal fade" id="photoOptionsModal" tabindex="-1" aria-labelledby="photoOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="photoOptionsModalLabel">Opciones de la Foto</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <button class="btn btn-primary" onclick="viewPhoto()">Ver Foto</button>
            <button class="btn btn-secondary" onclick="changePhoto()">Cambiar Foto</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal para ver la foto -->
    <div class="modal fade" id="viewPhotoModal" tabindex="-1" aria-labelledby="viewPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewPhotoModalLabel">Foto Actual</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <img id="current-photo" src="images/avatar.png" alt="User Photo" class="img-fluid">
        </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

    <script src="js/perfil.js"></script>
</body>
</html>
