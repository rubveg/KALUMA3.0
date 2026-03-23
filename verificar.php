<?php
// 1. Incluimos el archivo que ya tienes configurado con localhost
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibimos la URL del formulario de index.html
    // El 'real_escape_string' es para que no nos hackeen con Inyección SQL
    $url_usuario = $conn->real_escape_string($_POST['url_sitio']);

    // 2. Consulta SQL usando tus columnas reales: dominio y clasificacion
    // Buscamos si la URL que pegó el usuario contiene el dominio que tenemos en la tabla
    $sql = "SELECT clasificacion, fecha_registro FROM dominios WHERE dominio = '$url_usuario'";
    
    // NOTA: Cambia 'dominios_tabla' por el nombre real de tu tabla
    $resultado = $conn->query($sql);

    echo "<h2>Resultado de Verificación</h2>";
    echo "<p>Sitio analizado: <strong>" . htmlspecialchars($url_usuario) . "</strong></p>";

    if ($resultado->num_rows > 0) {
        // Si lo encuentra en la base de datos
        while($row = $resultado->fetch_assoc()) {
            $clase = $row["clasificacion"];
            
            // Lógica de colores según la clasificación
            $color = ($clase == 'Seguro') ? 'green' : 'red';

            echo "<div style='border: 2px solid $color; padding: 15px; border-radius: 10px;'>";
            echo "<p>Clasificación: <span style='color: $color; font-weight: bold;'>" . strtoupper($clase) . "</span></p>";
            echo "<p>Registrado desde: " . $row["fecha_registro"] . "</p>";
            echo "</div>";
        }
    } else {
        // Si no existe en tu tabla
        echo "<div style='border: 2px solid orange; padding: 15px; border-radius: 10px;'>";
        echo "<p style='color: orange;'>⚠️ <strong>SIN DATOS:</strong> Este dominio no se encuentra en nuestra lista de verificación.</p>";
        echo "<p>Te recomendamos navegar con precaución.</p>";
        echo "</div>";
    }
}

$conn->close();
?>
<br>
<a href="index.html" style="text-decoration: none; background: #333; color: white; padding: 10px; border-radius: 5px;">Hacer otra consulta</a>