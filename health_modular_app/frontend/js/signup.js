document.getElementById('signup-form').addEventListener('submit', function (event) {
    event.preventDefault();
    
    const firstName = document.getElementById('firstname').value;
    const lastName = document.getElementById('lastname').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const dob = document.getElementById('dob').value;
    const gender = document.getElementById('gender').value;
    const height = document.getElementById('height').value;
    const weight = document.getElementById('weight').value;
    const bloodType = document.getElementById('bloodtype').value;

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
            height: parseInt(height), 
            weight: parseInt(weight), 
            blood_type: bloodType 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registration successful!');
            window.location.href = 'dashboard'; // Redirige al dashboard después de registrarse
        } else {
            alert('Registration failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
