<?php


$servername = "localhost";   // Host de la base de datos
$username   = "root";        // Usuario de la base de datos
$password   = "";            // Contraseña de la base de datos
$database   = "kaluma";      // Nombre de la base de datos a usar

// Crear la conexión usando mysqli
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>