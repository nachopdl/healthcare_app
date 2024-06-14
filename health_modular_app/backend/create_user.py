import bcrypt
import mysql.connector

# Configuración de la base de datos
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",  # Cambia esto por tu contraseña de MySQL
    database="healthcare"
)

cursor = db.cursor()

# Datos del usuario a crear
email = "user@example.com"
password = "password123"

# Encriptar la contraseña
hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())

# Insertar el usuario en la base de datos
try:
    cursor.execute("INSERT INTO users (email, password) VALUES (%s, %s)", (email, hashed_password.decode('utf-8')))
    db.commit()
    print("Usuario creado exitosamente")
except mysql.connector.Error as err:
    print(f"Error: {err}")
finally:
    cursor.close()
    db.close()
