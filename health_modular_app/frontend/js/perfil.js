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
            document.getElementById('user-correo').textContent = data.email;
            document.getElementById('user-genero').textContent = data.gender;
            document.getElementById('user-tipo_sangre').textContent = data.blood_type;
            document.getElementById('user-estatura').textContent = `${data.height}`;
            document.getElementById('user-peso').textContent = `${data.weight}`;
            let photoUrl = '';
            if (data.foto) {
                photoUrl = `uploads/${data.foto}`;
            } else {
                photoUrl = data.gender == 'masculino' ? 'images/avatar1.png' : 'images/avatar.png';
            }
            document.getElementById('user-photo').src = photoUrl;
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
    
    document.getElementById('edit-profile-button').addEventListener('click', function() {
        $('#edit-profile-modal').modal('show');
    });

    $('.close').on('click', function() {
        $('#edit-profile-modal').modal('hide');
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

function editField(element) {
    // Guardar el texto actual
    var currentText = element.innerText;
    var fieldName = element.id.split('-')[1];  // Extraer el nombre del campo, por ejemplo, "name" de "user-name"

    // Crear un input y asignarle el valor del texto actual
    var input = document.createElement("input");
    input.type = "text";
    input.value = currentText;
    input.className = "form-control";  // Añadir clases para estilo Bootstrap

    // Crear un contenedor para el mensaje de error
    var errorContainer = document.createElement("div");
    errorContainer.className = "error-message text-danger mt-1";
    errorContainer.style.display = "none"; // Ocultar inicialmente

    // Agregar restricciones basadas en el tipo de campo
    if (fieldName === 'peso') {
        input.type = "number";
        input.step = "0.01"; // Permitir decimales
        input.min = "0"; // No permitir números negativos
    } else if (fieldName === 'tipo_sangre') {
        input.maxLength = 3;
    } else if(fieldName === 'estatura'){
        input.type = "number";
        input.min = "0"; // No permitir números negativos
        input.maxLength = 3;
    }

    // Definir eventos
    input.onblur = function() {
        saveField(this, element, errorContainer);
    };
    input.onkeydown = function(event) {
        if (event.key === 'Enter') {
            saveField(this, element, errorContainer);
        } else if (event.key === 'Escape') {
            cancelEdit(this, element, currentText, errorContainer);
        }
    };

    input.oninput = function() {
        if ((fieldName === 'peso' || fieldName === 'estatura') && isNaN(input.value)) {
            errorContainer.innerText = 'Solo se permiten valores numéricos.';
            errorContainer.style.display = "block";
        } else {
            errorContainer.style.display = "none";
        }
    };

    // Reemplazar el texto con el input y el contenedor de error
    element.innerHTML = "";
    element.appendChild(input);
    element.appendChild(errorContainer);
    input.focus();
}

function cancelEdit(input, element, originalText, errorContainer) {
    // Reemplazar el input con el texto original y eliminar el mensaje de error
    element.innerHTML = originalText;
    if (errorContainer) {
        errorContainer.remove();
    }
}

function saveField(input, element, errorContainer) {
    var newValue = input.value.trim();
    var fieldName = element.id.split('-')[1];  // Extraer el nombre del campo, por ejemplo, "name" de "user-name"

    // Validar si el campo está vacío o si hay un error
    if (newValue === "" || (fieldName === 'peso' || fieldName === 'estatura') && isNaN(newValue)) {
        errorContainer.innerText = 'Este campo no puede estar vacío y debe ser numérico.';
        errorContainer.style.display = "block"; // Mostrar mensaje de error
        input.focus(); // Mantener el enfoque en el campo de entrada
        return;
    } else if (fieldName === 'tipo_sangre' && newValue.length > 3) {
        errorContainer.innerText = 'El tipo de sangre debe tener un máximo de 3 caracteres.';
        errorContainer.style.display = "block"; // Mostrar mensaje de error
        input.focus(); // Mantener el enfoque en el campo de entrada
        return;
    } else {
        errorContainer.style.display = "none"; // Ocultar mensaje de error
    }

    // Realizar una solicitud AJAX para actualizar el campo en el servidor
    fetch('http://localhost:5000/api/update_profile_field', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify({ field: fieldName, value: newValue })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reemplazar el input con el nuevo texto si la actualización fue exitosa
            element.innerHTML = newValue;
            errorContainer.remove(); // Eliminar el contenedor de error si fue exitoso
        } else {
            errorContainer.innerText = 'Error al actualizar el perfil: ' + data.message;
            errorContainer.style.display = "block"; // Mostrar mensaje de error
            // Restaurar el texto original si hubo un error
            cancelEdit(input, element, input.defaultValue, errorContainer);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorContainer.innerText = 'Error al actualizar el perfil.';
        errorContainer.style.display = "block"; // Mostrar mensaje de error
        // Restaurar el texto original si hubo un error
        cancelEdit(input, element, input.defaultValue, errorContainer);
    });
}


function editGender(element) {
    var currentText = element.innerText;
    var select = document.createElement('select');
    select.className = 'form-control';

    // Opciones predefinidas de género
    var options = ['Masculino', 'Femenino', 'Otro'];
    options.forEach(function(option) {
        var opt = document.createElement('option');
        opt.value = option.toLowerCase();
        opt.text = option;
        if (option.toLowerCase() === currentText.toLowerCase()) {
            opt.selected = true;
        }
        select.appendChild(opt);
    });

    // Cuando el usuario cambia el valor del select, se guarda
    select.addEventListener('change', function() {
        saveGender(select, element);
    });

    // Reemplazar el elemento original con el select
    element.innerText = '';
    element.appendChild(select);
    select.focus();
}

function saveGender(select, element) {
    var newValue = select.value;

    fetch('http://localhost:5000/api/update_profile_field', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify({ field: 'genero', value: newValue })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            element.innerText = select.options[select.selectedIndex].text;
        } else {
            alert('Error al actualizar el perfil: ' + data.message);
            element.innerText = select.options[select.selectedIndex].text;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        element.innerText = select.options[select.selectedIndex].text;
    });
}

function changePhoto(element) {
    // Crear un input para la selección de archivo
    var fileInput = document.createElement("input");
    fileInput.type = "file";
    fileInput.accept = "image/*";  // Aceptar solo archivos de imagen

    // Escuchar el evento de cambio de archivo
    fileInput.onchange = function(event) {
        var file = event.target.files[0];
        if (file) {
            // Crear un objeto FileReader para leer el contenido del archivo
            var reader = new FileReader();
            reader.onload = function(e) {
                // Previsualizar la imagen seleccionada
                document.getElementById('user-photo').src = e.target.result;

                // Crear un FormData para enviar el archivo al servidor
                var formData = new FormData();
                formData.append('photo', file);

                // Realizar la solicitud AJAX para actualizar la foto del usuario
                fetch('http://localhost:5000/api/update_profile_photo', {
                    method: 'POST',
                    credentials: 'include',  // Incluir cookies para la autenticación
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                    } else {
                        alert('Error al actualizar la foto de perfil: ' + data.message);
                        // Restaurar la foto original si hubo un error
                        document.getElementById('user-photo').src = document.getElementById('current-photo').src;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al actualizar la foto de perfil.');
                    // Restaurar la foto original si hubo un error
                    document.getElementById('user-photo').src = document.getElementById('current-photo').src;
                });
            };
            reader.readAsDataURL(file);
        }
    };

    // Simular el clic en el input de archivo
    fileInput.click();
    $('#photoOptionsModal').modal('hide'); // Ocultar el modal de opciones
}

// Muestra el modal de opciones de foto
function showPhotoOptions() {
    $('#photoOptionsModal').modal('show');
}

// Muestra el modal para ver la foto actual
function viewPhoto() {
    var photoSrc = document.getElementById('user-photo').src;
    document.getElementById('current-photo').src = photoSrc;
    $('#viewPhotoModal').modal('show');
    $('#photoOptionsModal').modal('hide');
}


// Asignar la función logout al botón de logout
document.getElementById('logout-button').addEventListener('click', logout);
