document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorMessage = document.getElementById('error-message');

    // Limpiar mensajes previos
    errorMessage.textContent = '';

    // Validaciones básicas
    if (!email || !password) {
        errorMessage.textContent = 'Por favor, ingresa tu correo electrónico y contraseña.';
        return;
    }

    if (!validateEmail(email)) {
        errorMessage.textContent = 'Por favor, ingresa un correo electrónico válido.';
        return;
    }

    fetch('http://localhost:5000/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify({ email, password })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.href = 'dashboard.php'; // Redirigir al dashboard
        } else {
            errorMessage.textContent = data.message || 'Error de inicio de sesión. Por favor, intenta nuevamente.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorMessage.textContent = 'Error en la red. Inténtalo de nuevo más tarde.';
    });
});

document.getElementById('toggle-password').addEventListener('click', function () {
    var passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        passwordInput.type = 'password';
        this.innerHTML = '<i class="fas fa-eye"></i>';
    }
});

// Función para validar el formato del correo electrónico
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
