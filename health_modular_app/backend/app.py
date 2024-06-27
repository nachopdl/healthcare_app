from flask import Flask, request, jsonify, session
from flask_mysqldb import MySQL
import bcrypt
from flask_cors import CORS
from flask_session import Session
import logging
import os
from werkzeug.utils import secure_filename

app = Flask(__name__)
CORS(app, supports_credentials=True)  # Habilitar CORS para todas las rutas

logging.basicConfig(level=logging.DEBUG)

# Configuración de MySQL
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'healthcare'


mysql = MySQL(app)

# Configuración de la sesión
# Configuración de la sesión
app.config['SECRET_KEY'] = 'your_secret_key'
app.config['SESSION_TYPE'] = 'filesystem'
app.config['SESSION_PERMANENT'] = False
app.config['SESSION_USE_SIGNER'] = True
app.config['SESSION_KEY_PREFIX'] = 'session:'
app.config['SESSION_COOKIE_HTTPONLY'] = True
app.config['SESSION_COOKIE_SAMESITE'] = 'Lax'

# Configuración de carga de archivos
UPLOAD_FOLDER = '..\\frontend\\uploads\\'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['MAX_CONTENT_LENGTH'] = 16 * 1024 * 1024  # 16 MB límite de tamaño de archivo
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg', 'gif'}
Session(app)

#Funcion para tratar las imagenes
def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS


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
            app.logger.debug(f'User {(user_id)}')

            cursor = mysql.connection.cursor()
            cursor.execute("SELECT id, nombres, apellidos, correo, dob, genero, estatura, peso, tipo_sangre, foto FROM users WHERE id = %s", (user_id,))
            user1 = cursor.fetchone()
            cursor.close()
            print(user1[9])
            if user1:
                return jsonify({
                    'success': True,
                    'id': user1[0],
                    'first_name': user1[1],
                    'last_name': user1[2],
                    'email': user1[3],
                    'dob': user1[4],
                    'gender': user1[5],
                    'height': user1[6],
                    'weight': user1[7],
                    'blood_type': user1[8],
                    'foto': user1[9]
                })
            else:
                return jsonify({'success': False, 'message': 'User not found'}), 404
        else:
            return jsonify({'success': False, 'message': 'No user logged in'}), 401
    except Exception as e:
        app.logger.error(f'Error fetching user data: {e}')
        return jsonify({'success': False, 'message': 'Internal server error'}), 500
    
@app.route('/api/update_user', methods=['POST'])
def update_user():
    try:
        data = request.form
        user_id = session['user']
        app.logger.debug(f'User {user_id}')
        print(data)
        first_name = data['first-name']
        last_name = data['last-name']
        email = data['email']
        height = data['height']
        weight = data['weight']
        blood_type = data['blood-type']
    except KeyError as e:
        return jsonify({'success': False, 'message': f'Missing field: {e.args[0]}'})

    photo_url = None
    if 'photo' in request.files:
        file = request.files['photo']
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
            photo_url = filename
        else:
            return jsonify({'success': False, 'message': 'Invalid file type'})

    try:
        cursor = mysql.connection.cursor()
        if photo_url:
            cursor.execute("""
                UPDATE users SET 
                nombres = %s, 
                apellidos = %s, 
                correo = %s, 
                estatura = %s, 
                peso = %s, 
                tipo_sangre = %s,
                foto = %s
                WHERE id = %s
            """, (first_name, last_name, email, height, weight, blood_type, photo_url, user_id))
        else:
            cursor.execute("""
                UPDATE users SET 
                nombres = %s, 
                apellidos = %s, 
                correo = %s,  
                estatura = %s, 
                peso = %s, 
                tipo_sangre = %s
                WHERE id = %s
            """, (first_name, last_name, email, height, weight, blood_type, user_id))
        mysql.connection.commit()
        cursor.close()
        return jsonify({'success': True, 'message': 'Perfil actualizado correctamente'})
    except mysql.Error as e:
        return jsonify({'success': False, 'message': 'Error updating user: {}'.format(e)})
    
@app.route('/api/logout', methods=['POST'])
def logout():
    session.pop('user', None)
    return jsonify({'success': True, 'message': 'Logged out successfully'})

if __name__ == '__main__':
    app.run(debug=True)
