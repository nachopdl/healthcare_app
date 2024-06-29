document.addEventListener('DOMContentLoaded', function () {
    //Llamada a api para cargar informacion del usuario en elementos de dashboard
    fetch('http://localhost:5000/api/user_data',{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include' //Importante para la sincronizacion de credenciales
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data =>{
        console.log(data);
        if (data.success){ //Asignacion de informacion en elementos HTML
            document.getElementById('user-name').textContent = `Bienvenido, ${data.first_name}`;
            document.getElementById('user-fullname').textContent = `${data.first_name} ${data.last_name}`;
            document.getElementById('user-age-location').textContent = `${getAge(data.dob)} años`;
            document.getElementById('user-blood').textContent = data.blood_type;
            document.getElementById('user-height').textContent = `${data.height} cm`;
            document.getElementById('user-weight').textContent = `${data.weight} kg`;
            let photoUrl = '';
            if (data.foto) {
                photoUrl = `uploads/${data.foto}`;
            } else {
                photoUrl = data.gender == 'masculino' ? 'images/avatar1.png' : 'images/avatar.png';
            }
            document.getElementById('user-photo').src = photoUrl;
        }else {
            alert('Failed to load user data: ' + data.message);
            window.location.href = 'login.php'; // Redirigir al login si no hay datos de usuario
        }
    })
    .catch(error => {
        console.error('Error:', error)
        alert('Failed to load user data: ' + error.message);
        window.location.href = 'login.php';
    });

    // Progreso de Peso
    var ctxWeight = document.getElementById('weightProgressChart').getContext('2d');
    var weightProgressChart = new Chart(ctxWeight, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Peso (kg)',
                data: [75, 74.5, 74, 73.8, 73.5, 73, 72.5],
                backgroundColor: 'rgba(169, 150, 196, 0.6)',
                borderColor: 'rgba(169, 150, 196, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    // Entrenamiento Semanal
    var ctxTraining = document.getElementById('weeklyTrainingChart').getContext('2d');
    var weeklyTrainingChart = new Chart(ctxTraining, {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Minutos de Entrenamiento',
                data: [30, 45, 50, 60, 70, 40, 30],
                backgroundColor: 'rgba(220, 195, 196, 0.6)',
                borderColor: 'rgba(220, 195, 196, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Registro de Emociones
    var ctxEmotions = document.getElementById('emotionsChart').getContext('2d');
    var emotionsChart = new Chart(ctxEmotions, {
        type: 'pie',
        data: {
            labels: ['Feliz', 'Triste', 'Estresado', 'Relajado'],
            datasets: [{
                label: 'Registro de Emociones',
                data: [40, 20, 30, 10],
                backgroundColor: [
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 205, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
});

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

function logout() {
    fetch('http://localhost:5000/api/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'index.php'; // Redirigir al login después de cerrar sesión
        } else {
            alert('Failed to log out: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Asignar la función logout al botón de logout
document.getElementById('logout-button').addEventListener('click', logout);
