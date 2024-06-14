from flask import Flask, request, jsonify
from flask_mysqldb import MySQL
import bcrypt
import jwt
import datetime
from flask_cors import CORS


app = Flask(__name__)
CORS(app)  # Habilitar CORS para todas las rutas

# Configuración de MySQL
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'healthcare'

mysql = MySQL(app)

# Secret key para JWT
app.config['SECRET_KEY'] = 'your_secret_key'

@app.route('/api/login', methods=['POST'])
def login():
    data = request.get_json()
    email = data['email']
    password = data['password']

    cursor = mysql.connection.cursor()
    cursor.execute("SELECT * FROM users WHERE email = %s", (email,))
    user = cursor.fetchone()

    if user and bcrypt.checkpw(password.encode('utf-8'), user[2].encode('utf-8')):
        token = jwt.encode({
            'user_id': user[0],
            'exp': datetime.datetime.utcnow() + datetime.timedelta(hours=1)
        }, app.config['SECRET_KEY'])
        return jsonify({'success': True, 'token': token})

    return jsonify({'success': False, 'message': 'Invalid email or password'})

@app.route('/api/signup', methods=['POST'])
def signup():
    data = request.get_json()
    email = data['email']
    password = data['password']

    # Verificar si el usuario ya existe
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT * FROM users WHERE email = %s", (email,))
    user = cursor.fetchone()

    if user:
        return jsonify({'success': False, 'message': 'Email already exists'})

    # Encriptar la contraseña
    hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())

    # Insertar nuevo usuario en la base de datos
    cursor.execute("INSERT INTO users (email, password) VALUES (%s, %s)", (email, hashed_password.decode('utf-8')))
    mysql.connection.commit()
    cursor.close()

    return jsonify({'success': True, 'message': 'User registered successfully'})

if __name__ == '__main__':
    app.run(debug=True)
