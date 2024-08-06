function nextModal(currentModalId, nextModalId) {
    $('#' + currentModalId).modal('hide');
    $('#' + nextModalId).modal('show');
}

function prevModal(prevModalId, currentModalId) {
    $('#' + currentModalId).modal('hide');
    $('#' + prevModalId).modal('show');
}

$(document).ready(function() {
    $('#timeForm').on('submit', function(event) {
        event.preventDefault();
        $('#timeModal').modal('hide');
        alert('Preferencias guardadas. Se generará un entrenamiento personalizado.');
        // Aquí puedes añadir el código para manejar las preferencias y generar el entrenamiento personalizado.
    });
});

$(document).ready(function() {
    $('#read-more-bttn').click(function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $('#custom-card').offset().top - 60
        }, 800); // 800 es la duración del scroll en milisegundos
    });
});

function loadExercises(category, listId) {
    $.ajax({
        url: `http://localhost:5000/api/get_excercises`,
        method: 'POST',
        contentType: 'application/json',
        credentials: 'include', //Importante para la sincronizacion de credenciales
        data: JSON.stringify({ category: category }),
        success: function(data) {
            console.log(data)
            var exercisesList = $(listId);
            exercisesList.empty();
            data.forEach(function(exercise) {
                exercisesList.append(`
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>${exercise.nombre}</h5>
                                <p>${exercise.descripcion}</p>
                                <div style="align-items: center;">
                                    <button type="button" class="btn btn-primary btn-lg mr-4">Comenzar</button>
                                    <button type="button" class="btn btn-secondary btn-lg">Añadir a lista del día</button>        
                                </div>
                            </div>
                            <div class="col-md-2">
                                <h5>Duracion</h5>
                                <p>${exercise.duracion}</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <img src="images_excersises/${exercise.imagen}" class="img-fluid" id="img_excercise" alt="${exercise.nombre}">
                            </div>
                        </div>
                    </li>
                `);
            });
        },
        error: function(error) {
            console.error('Error loading exercises:', error);
        }
    });
}

// Eventos para modales
$('#yogaModal').on('show.bs.modal', function(event) {
    loadExercises('yoga', '#yoga-ejercicios-lista');
});

$('#cardioModal').on('show.bs.modal', function(event) {
    loadExercises('cardio', '#cardio-ejercicios-lista');
});

$('#fuerzaModal').on('show.bs.modal', function(event) {
    loadExercises('fuerza', '#fuerza-ejercicios-lista');
});

$('#coreModal').on('show.bs.modal', function(event) {
    loadExercises('core', '#core-ejercicios-lista');
});

$('#resistenciaModal').on('show.bs.modal', function(event) {
    loadExercises('resistencia', '#resistencia-ejercicios-lista');
});

$('#altaModal').on('show.bs.modal', function(event) {
    loadExercises('alta', '#alta-ejercicios-lista');
});
