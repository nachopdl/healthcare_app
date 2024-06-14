#!/bin/bash

# Configurar base de datos
mysql -u root -p < sql/create_tables.sql

# Crear entorno virtual y activar
python3 -m venv venv
source venv/bin/activate

# Instalar dependencias
pip install -r requirements.txt

# Crear usuario
python backend/create_user.py
