from flask import Flask, request, jsonify, session
from flask_mysqldb import MySQL
import bcrypt
from flask_cors import CORS
from flask_session import Session
import logging

app = Flask(__name__)
CORS(app, supports_credentials=True, origins=["http://localhost"])  # Habilitar CORS para todas las rutas

logging.basicConfig(level=logging.DEBUG)

# Configuración de MySQL
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'healthcare'

mysql = MySQL(app)

# Configuración de la sesión
app.secret_key = 'supersecretkey'
app.config['SESSION_TYPE'] = 'filesystem'
Session(app)

@app.route('/api/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data['email']
    password = data['password']

    cursor = mysql.connection.cursor()
    cursor.execute("SELECT id, nombres, apellidos, correo, password FROM users WHERE correo = %s", (email,))
    user = cursor.fetchone()

    if user and bcrypt.checkpw(password.encode('utf-8'), user[4].encode('utf-8')):
        session['user'] = user[0]
        app.logger.debug(f'User logged in: {session["user"]}')
        return jsonify({'success': True, 'message': 'Login successful'})
    return jsonify({'success': False, 'message': 'email o contraseña invalida'})

@app.route('/api/signup', methods=['POST'])
def signup():
    data = request.get_json()
    try:
        nombres = data['firstName']
        apellidos = data['lastName']
        email = data['email']
        password = data['password']
        dob = data['dob']
        genero = data['gender']
        estatura = data['height']
        peso = data['weight']
        tipo_sangre = data['blood_type']
    except KeyError as e:
        return jsonify({'success': False, 'message': f'Missing field: {e.args[0]}'})

    # Verificar si el usuario ya existe
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT * FROM users WHERE correo = %s", (email,))
    user = cursor.fetchone()

    if user:
        cursor.close()
        return jsonify({'success': False, 'message': 'Email already exists'})

    # Encriptar la contraseña
    hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())

    # Insertar nuevo usuario en la base de datos
    cursor.execute("""INSERT INTO users (nombres, apellidos, correo, password, dob, genero, estatura, peso, tipo_sangre) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)""",
                   (nombres, apellidos, email, hashed_password.decode('utf-8'), dob, genero, estatura, peso, tipo_sangre))

    mysql.connection.commit()

    # Obtener el ID del usuario recién registrado
    cursor.execute("SELECT id FROM users WHERE correo = %s", (email,))
    new_user = cursor.fetchone()
    cursor.close()

    if new_user:
        session['user'] = new_user[0]
        app.logger.debug(f'New user registered: {session["user"]}')
        return jsonify({'success': True, 'message': 'User registered successfully'})
    return jsonify({'success': False, 'message': 'User registration failed'})

@app.route('/api/user_data', methods=['GET'])
def user_data():
    try:
        if 'user' in session:
            user_id = session['user']
            cursor = mysql.connection.cursor()
            cursor.execute("SELECT nombres, apellidos, correo, dob, genero, estatura, peso, tipo_sangre FROM users WHERE id = %s", (user_id,))
            user1 = cursor.fetchone()
            cursor.close()
            if user1:
                return jsonify({
                    'success': True,
                    'first_name': user1[0],
                    'last_name': user1[1],
                    'email': user1[2],
                    'dob': user1[3],
                    'gender': user1[4],
                    'height': user1[5],
                    'weight': user1[6],
                    'blood_type': user1[7]
                })
            else:
                return jsonify({'success': False, 'message': 'User not found'}), 404
        else:
            return jsonify({'success': False, 'message': 'No user logged in'}), 401
    except Exception as e:
        app.logger.error(f'Error fetching user data: {e}')
        return jsonify({'success': False, 'message': 'Internal server error'}), 500
    
@app.route('/api/logout', methods=['POST'])
def logout():
    session.pop('user', None)
    return jsonify({'success': True, 'message': 'Logged out successfully'})

if __name__ == '__main__':
    app.run(debug=True)
