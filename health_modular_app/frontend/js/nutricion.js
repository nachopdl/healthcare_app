function nextModal(currentModalId, nextModalId) {
    $('#' + currentModalId).modal('hide');
    $('#' + nextModalId).modal('show');
}


function calculo_deficit(peso, estatura, edad, genero, goal){ //Funcion para calcular el deficit calorico
    let tmb = 0;
    if(genero == 'masculino'){
        tmb = (10 * peso) + (6.25 * estatura) - (5 * edad) + 5;
        tmb *= goal;
        return Math.round(tmb * 100) / 100;
    }else{
        tmb = (10 * peso) + (6.25 * estatura) - (5 * edad) - 161;
        tmb *= goal;
        return Math.round(tmb * 100) / 100;
    }
}

function calculo_TMB(peso, estatura, edad, genero){
    let tmb = 0;
    if(genero == 'masculino'){
        tmb = (10 * peso) + (6.25 * estatura) - (5 * edad) + 5;
        return Math.round(tmb * 100) / 100;
    }else{
        tmb = (10 * peso) + (6.25 * estatura) - (5 * edad) - 161;
        return Math.round(tmb * 100) / 100;
    }
}

function getAge(dateString) {
    const today = new Date();
    const birthDate = new Date(dateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function getTmbValue(goal) {
    const tmbValues = {
        0: 1.2,
        1: 1.375,
        2: 1.55,
        3: 1.725,
        4: 1.9
    };

    return tmbValues[goal] || 0; // Devuelve el valor correspondiente o 0 si no hay coincidencia
}

document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost:5000/api/user_data',{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include' //Importante para la sincronizacion de credenciales
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Respuesta de red no es buena');
        }
        return response.json();
    })
    .then(data =>{
        console.log(data);
        if (data.success){ //Asignacion de informacion en elementos HTML
            const tmbValue = calculo_TMB(data.weight, data.height, getAge(data.dob), data.gender);
            document.getElementById('tmb').textContent = `Tu Tasa Metabolica Basal es: ${tmbValue} kcal`;
        } else {
            alert('Error al cargar usuario: ' + data.message);
            window.location.href = 'login.php'; // Redirigir al login si no hay datos de usuario
        }
    })
    .catch(error => {
        console.error('Error:', error)
        alert('Failed to load user data: ' + error.message);
        window.location.href = 'login.php';
    });
    document.getElementById('goalForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que se envíe el formulario de la forma predeterminada

        // Obtener el valor seleccionado del campo 'select'
        var goal = document.getElementById('goal').value;

        // Mostrar el valor seleccionado (puedes eliminar este console.log)
        console.log('Frecuencia de ejercicio seleccionada:', goal);
        var goal_res = getTmbValue(goal);
        displayTmb(goal_res)
    });
    
    function displayTmb(goal_res) {
        fetch('http://localhost:5000/api/user_data',{
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include' //Importante para la sincronizacion de credenciales
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Respuesta de red no es buena');
            }
            return response.json();
        })
        .then(data =>{
            console.log(data);
            if (data.success){ //Asignacion de informacion en elementos HTML
                const deficitValue = calculo_deficit(data.weight, data.height, getAge(data.dob), data.gender, goal_res);
                document.getElementById('deficit_calorico').textContent = `Tu deficit calorico es: ${deficitValue} kcal`;
            } else {
                alert('Error al cargar usuario: ' + data.message);
                window.location.href = 'login.php'; // Redirigir al login si no hay datos de usuario
            }
        })
        .catch(error => {
            console.error('Error:', error)
            alert('Failed to load user data: ' + error.message);
            window.location.href = 'login.php';
        });
    }
});

$(document).ready(function() {
    $('#timeForm').on('submit', function(event) {
        event.preventDefault();
        $('#timeModal').modal('hide');
        alert('Datos Guardados, se generara su nuevo Deficit Calorico.');
        // Aquí puedes añadir el código para manejar las preferencias y generar el entrenamiento personalizado.
    });
    var read = $('#read').offset().top
        $('#btn-read').on('click', function(){
        $('php, body').animate({
            scrollTop: read
        },200);
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
