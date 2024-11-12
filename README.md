# Proyecto de Prueba en Laravel

Proyecto Laravel para implementar una API con autenticación, gestión de leads y pruebas automatizadas.

## Descripción

El proyecto implementa una API RESTful para la gestión de leads, incluyendo autenticación de usuarios, creación, obtención y listado de leads.

## Requisitos Previos

- PHP >= 8.2
- Composer
- Laravel >= 11.x
- MySQL >= 8
- SQLite (para pruebas)


## Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/jonquintero/twgroup.git
   cd twgroup

2. Instala las dependencias de PHP con Composer:

    ```bash
   composer install

3. Instala npm:

    ```bash
   npm install

## Configuración

1. Copia el archivo de entorno:

   ```bash
   cp .env.example .env

2. Genera la clave de la aplicación:

    ```bash
   php artisan key:generate

3. Configura la base de datos MySQL en el archivo .env:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña

4. Ejecuta las migraciones:

    ```bash
    php artisan migrate 

# Uso

1. Ejecutar el comando 

    ```bash
   npm run dev

2. Ejecutar el comando

    ```bash
   php artisan serve
   

## Autenticación
1. Se crea un usuario administrador con las siguientes credenciales

   ```bash
   email: admin@example.com
   password: password

## Extras

1. Arquitectura modular `✔️`
2. Form Request `✔️`







