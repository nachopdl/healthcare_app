from flask import Flask, request, jsonify, session
from flask_mysqldb import MySQL
import bcrypt
from flask_cors import CORS
from flask_session import Session
import logging
import os
from werkzeug.utils import secure_filename
import random 

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

#Funcion para obtener de forma aleatoria un consejo de salud
def obtener_consejo_aleatorio():
    consejos = [
        "Bebe al menos 8 vasos de agua al día.",
        "Realiza al menos 30 minutos de ejercicio diario.",
        "Come frutas y verduras en cada comida.",
        "Evita el consumo excesivo de azúcar.",
        "Duerme al menos 7-8 horas cada noche.",
        "Lávate las manos frecuentemente.",
        "Evita el consumo de tabaco y alcohol.",
        "Mantén una postura correcta al sentarte.",
        "Realiza estiramientos diarios.",
        "Reduce el consumo de alimentos procesados.",
        "Come porciones pequeñas y equilibradas.",
        "Practica la meditación o técnicas de relajación.",
        "Evita el estrés tanto como sea posible.",
        "Mantén un peso saludable.",
        "Consulta a tu médico regularmente.",
        "Usa protector solar todos los días.",
        "Realiza chequeos médicos anuales.",
        "Limpia y desinfecta las superficies frecuentemente.",
        "Mantén un entorno limpio y ordenado.",
        "Usa hilo dental y cepilla tus dientes dos veces al día.",
        "Limita el tiempo frente a pantallas.",
        "Realiza actividades al aire libre.",
        "Mantén una vida social activa.",
        "Aprende algo nuevo cada día.",
        "Establece metas personales y trabaja para lograrlas.",
        "Mantén una actitud positiva.",
        "Escucha música que te relaje.",
        "Lee libros que te inspiren.",
        "Dedica tiempo a tus hobbies.",
        "Agradece lo que tienes todos los días."
    ]

    return random.choice(consejos)


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
        return jsonify({'success': False, 'message': 'Ya existe el correo electronico'})

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
                if user1[9]:
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
                        'foto': user1[9],
                        'consejo': obtener_consejo_aleatorio()
                    })
                else:
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
                        'consejo': obtener_consejo_aleatorio()
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
    print(photo_url)

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

@app.route('/api/get_excercises', methods=['POST'])
def get_excercises():
    data = request.get_json()
    categoria = {data.get('category')}
    
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT nombre, descripcion, duracion, imagen FROM entrenamientos WHERE categoria=%s", (categoria,))
    ejercicios = cursor.fetchall()
    cursor.close()

    ejercicios_lista = [{'nombre': ejercicio[0], 'descripcion': ejercicio[1], 'duracion':ejercicio[2], 'imagen': ejercicio[3]} for ejercicio in ejercicios]
    return jsonify(ejercicios_lista)

@app.route('/api/update_profile_field', methods=['POST'])
def update_profile_field():
    if 'user' not in session:
        return jsonify({'success': False, 'message': 'No autorizado'}), 401

    data = request.get_json()
    field = data['field']
    value = data['value']
    user_id = session['user']

    # Verificar y sanitizar el campo y valor para evitar inyecciones SQL
    allowed_fields = ['correo', 'genero', 'estatura', 'peso', 'tipo_sangre']
    if field not in allowed_fields:
        return jsonify({'success': False, 'message': 'Campo inválido'}), 400

    cursor = mysql.connection.cursor()
    try:
        cursor.execute(f"UPDATE users SET {field} = %s WHERE id = %s", (value, user_id))
        mysql.connection.commit()
        cursor.close()
        return jsonify({'success': True, 'message': 'Campo actualizado correctamente'})
    except Exception as e:
        print(e)
        return jsonify({'success': False, 'message': 'Error al actualizar el campo'}), 500

@app.route('/api/update_profile_photo', methods=['POST'])
def update_profile_photo():
    if 'user' not in session:
        return jsonify({'success': False, 'message': 'No autorizado'}), 401

    if 'photo' not in request.files:
        return jsonify({'success': False, 'message': 'No se ha enviado ninguna foto'}), 400

    file = request.files['photo']
    if file and allowed_file(file.filename):
        filename = secure_filename(file.filename)
        file_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(file_path)

        # Actualizar la base de datos con la ruta del archivo
        cursor = mysql.connection.cursor()
        cursor.execute("UPDATE users SET foto = %s WHERE id = %s", (filename, session['user']))
        mysql.connection.commit()
        cursor.close()

        return jsonify({'success': True, 'message': 'Foto de perfil actualizada correctamente'})
    else:
        return jsonify({'success': False, 'message': 'Tipo de archivo no permitido'}), 400


if __name__ == '__main__':
    app.run(debug=True)
