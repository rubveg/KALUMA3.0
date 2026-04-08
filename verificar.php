<?php
include 'conexion.php';

// Estilos integrados para mejorar la vista
echo "
<style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; color: #333; margin: 40px; }
    .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    h2 { border-bottom: 2px solid #eee; padding-bottom: 10px; color: #2c3e50; }
    .url-analizada { color: #555; margin-bottom: 25px; word-break: break-all; }
    
    /* Clases para los cuadros de resultado */
    .result-card { padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 6px solid; }
    .seguro { background-color: #e8f5e9; border-color: #4caf50; color: #2e7d32; }
    .peligroso { background-color: #ffebee; border-color: #f44336; color: #c62828; }
    .sin-datos { background-color: #fff3e0; border-color: #ff9800; color: #e65100; }
    
    .status-title { font-weight: bold; font-size: 1.2em; display: block; margin-bottom: 5px; }
    .btn-volver { display: inline-block; margin-top: 10px; text-decoration: none; background: #2c3e50; color: white; padding: 12px 20px; border-radius: 6px; transition: background 0.3s; }
    .btn-volver:hover { background: #1a252f; }
</style>
<div class='container'>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $url_usuario = $conn->real_escape_string($_POST['url_sitio']);
    $sql = "SELECT clasificacion, fecha_registro FROM dominios WHERE dominio = '$url_usuario'";
    $resultado = $conn->query($sql);

    echo "<h2>Resultado de Verificación</h2>";
    echo "<p class='url-analizada'>Sitio analizado: <strong>" . htmlspecialchars($url_usuario) . "</strong></p>";

    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $clase_db = strtolower($row["clasificacion"]); // 'seguro' o 'inseguro'
            
            // Determinamos el estilo visual
            if ($clase_db == 'seguro') {
                $div_class = "seguro";
                $titulo = "✓ SITIO SEGURO";
            } else {
                $div_class = "peligroso";
                $titulo = "⚠ SITIO INSEGURO";
            }

            echo "<div class='result-card $div_class'>";
            echo "<span class='status-title'>$titulo</span>";
            echo "Clasificación: " . strtoupper($row["clasificacion"]) . "<br>";
            echo "<small>Registrado en sistema desde: " . $row["fecha_registro"] . "</small>";
            echo "</div>";
        }
    } else {
        echo "<div class='result-card sin-datos'>";
        echo "<span class='status-title'>? SIN DATOS</span>";
        echo "Este dominio no se encuentra en nuestra lista de verificación. Te recomendamos navegar con precaución.";
        echo "</div>";
    }
}

$conn->close();
echo "<br><a href='index.html' class='btn-volver'>Hacer otra consulta</a>";
echo "</div>"; // Cierre de container
?>