<?php
/**
 * conexion.php
 *
 * Archivo de configuración de conexión a la base de datos MySQL.
 * Inclúyelo en tus scripts cuando necesites ejecutar consultas.
 *
 * Ajusta las credenciales ($servername, $username, $password y $database)
 * según tu entorno de desarrollo o producción.
 */

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

// Si prefieres PDO en lugar de mysqli, descomenta el siguiente bloque y
// comenta (o elimina) la sección mysqli anterior.
/*
$dsn = "mysql:host=$servername;dbname=$database;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
*/

?>