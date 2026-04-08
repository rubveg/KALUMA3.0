<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información - Kaluma</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">Kaluma</div>
        <nav class="nav-links">
            <a href="info.php?seccion=acerca">Acerca de</a>
            <a href="info.php?seccion=contacto">Contacto</a>
            <a href="index.html">Inicio</a>
        </nav>
    </header>

    <main class="hero-section">
        <section class="content-container">
            
            <?php
            // 1. Recibimos la variable 'seccion' de la URL. Si no existe, la dejamos vacía.
            $seccion = isset($_GET['seccion']) ? $_GET['seccion'] : '';

            // 2. Evaluamos qué sección pidió el usuario y mostramos el HTML correspondiente
            if ($seccion == 'acerca') {
                echo "<h1>Acerca de Kaluma</h1>";
                echo "<p>Kaluma es un verificador de confiabilidad de sitios web desarrollado en la UTCJ. Nuestro objetivo es brindar a los usuarios una herramienta rápida y eficaz para navegar con tranquilidad, analizando las URL en tiempo real para detectar posibles amenazas.</p>";
            
            } elseif ($seccion == 'contacto') {
                echo "<h1>Contacto</h1>";
                echo "<p>¿Tienes alguna duda o quieres reportar un falso positivo? Estamos en Ciudad Juárez. Escríbenos a soporte@shieldsoft.com.</p>";
            
            } else {
                // Mensaje por defecto si entran directo a info.php sin variables
                echo "<h1>Información</h1>";
                echo "<p>Por favor, selecciona una opción en el menú superior para ver más detalles.</p>";
            }
            ?>

        </section>
    </main>s

    <footer class="footer">
        <div class="brand-logo">
            <img src="/images/imgkaluma.jpg" alt="ShieldSoft Logo" class="ShieldSoft-img">
            <span>SHIELDSOFT</span>
        </div>
        <p>© 2025 ShieldSoft. Desarrollado en UTCJ.</p>
    </footer>

</body>
</html>