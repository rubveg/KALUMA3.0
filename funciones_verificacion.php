<?php
function obtenerSugerencias($url_usuario, $conexion) {
    // 1. Limpieza básica para la comparación
    $url_limpia = preg_replace('#^https?://(www\.)?#', '', $url_usuario);
    $url_limpia = strtolower(rtrim($url_limpia, '/'));

    // 2. Traer solo los sitios SEGUROS para sugerir
    $sql = "SELECT dominio FROM dominios WHERE clasificacion = 'seguro'";
    $resultado = $conexion->query($sql);

    $sugerencias = [];
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $dominio_bd = strtolower($row['dominio']);
            $distancia = levenshtein($url_limpia, $dominio_bd);

            // Si se parece lo suficiente (distancia de hasta 5 letras)
            if ($distancia > 0 && $distancia <= 5) {
                $sugerencias[] = [
                    'dominio' => $row['dominio'],
                    'distancia' => $distancia
                ];
            }
        }
    }

    // Ordenar por cercanía y devolver las mejores 5
    usort($sugerencias, function($a, $b) {
        return $a['distancia'] <=> $b['distancia'];
    });

    return array_slice($sugerencias, 0, 5);
}
?>