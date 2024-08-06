document.getElementById('signup-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const firstName = document.getElementById('firstname').value.trim();
    const lastName = document.getElementById('lastname').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const dob = document.getElementById('dob').value;
    const gender = document.getElementById('gender').value;
    const height = parseInt(document.getElementById('height').value);
    const weight = parseInt(document.getElementById('weight').value);
    const bloodType = document.getElementById('bloodtype').value;

    // Clear previous messages
    document.getElementById('error-message').textContent = '';
    document.getElementById('success-message').textContent = '';

    // Basic validations
    if (!firstName || !lastName || !email || !password || !dob || !gender || !height || !weight || !bloodType) {
        document.getElementById('error-message').textContent = 'Por favor, completa todos los campos.';
        return;
    }

    if (!validateEmail(email)) {
        document.getElementById('error-message').textContent = 'Correo electrónico no es válido.';
        return;
    }

    if (password.length < 6) {
        document.getElementById('error-message').textContent = 'La contraseña debe tener al menos 6 caracteres.';
        return;
    }

    fetch('http://localhost:5000/api/signup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            firstName,
            lastName,
            email, 
            password, 
            dob, 
            gender, 
            height, 
            weight, 
            blood_type: bloodType 
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('success-message').textContent = '¡Registro exitoso!';
            setTimeout(() => {
                window.location.href = 'login.php'; // Redirige al inicio de sesión después de registrarse
            }, 2000);
        } else {
            document.getElementById('error-message').textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('error-message').textContent = 'Error en el registro. Inténtalo de nuevo más tarde.';
    });
});

// Función para validar el formato del correo electrónico
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
