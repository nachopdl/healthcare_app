document.addEventListener('DOMContentLoaded', function () {
    //Llamada a api para cargar informacion del usuario en elementos de dashboard
    fetch('http://localhost:5000/api/user_data',{
        method: 'GET',
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
            //document.getElementById('user-name').textContent = `Bienvenido, ${data.first_name}`;
            document.getElementById('user-fullname').textContent = `${data.first_name} ${data.last_name}`;
            document.getElementById('user-age-location').textContent = `${getAge(data.dob)} años`;
            document.getElementById('user-id').textContent = data.id;
            document.getElementById('user-email').textContent = data.email;
            document.getElementById('user-gender').textContent = data.gender;
            document.getElementById('user-blood').textContent = data.blood_type;
            document.getElementById('user-height').textContent = `${data.height} cm`;
            document.getElementById('user-weight').textContent = `${data.weight} kg`;
            if (data.gender == 'masculino'){
                document.getElementById('user-photo').src = `uploads/${data.foto}` || 'images/avatar1.png'
            }else{
                document.getElementById('user-photo').src = `uploads/${data.foto}` || 'images/avatar.png'
            }
            // Pre-cargar los datos en el formulario de edición
            document.getElementById('first-name').value = data.first_name;
            document.getElementById('last-name').value = data.last_name;
            document.getElementById('email').value = data.email;
            document.getElementById('height').value = data.height;
            document.getElementById('weight').value = data.weight;
            document.getElementById('blood-type').value = data.blood_type;

        }else {
            alert('Error al cargar usuario: ' + data.message);
            window.location.href = 'login.php'; // Redirigir al login si no hay datos de usuario
        }
    })
    .catch(error => {
        console.error('Error:', error)
        alert('Failed to load user data: ' + error.message);
        window.location.href = 'login.php';
    });
    // Manejar la actualización del perfil
    document.getElementById('edit-profile-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }

        fetch('http://localhost:5000/api/update_user', {
            method: 'POST',
            credentials: 'include',  // Esto es crucial para incluir las cookies en la solicitud
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data)
                alert('Perfil actualizado correctamente');
                location.reload();
            } else {
                alert('Error al actualizar el perfil: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Función para calcular la edad
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
});
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

document.getElementById('edit-profile-button').addEventListener('click', function() {
    document.getElementById('edit-profile-modal').style.display = 'block';
});

document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('edit-profile-modal').style.display = 'none';
});

// Asignar la función logout al botón de logout
document.getElementById('logout-button').addEventListener('click', logout);
