<?php
// entornoLadodelCliente.php - Vista (Cliente)
// Incluimos la lógica del servidor ANTES de cualquier HTML
require_once __DIR__ . '/entornoLadodelServidor.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maqueta Web Dinámica en PHP - <?php echo htmlspecialchars(ucfirst($seccion_actual)); ?></title>
    <link rel="stylesheet" href="componenteCSS.css">
</head>
<body>

    <header>
        <h1>Mi Primer Sitio Web</h1>
        <nav>
            <ul>
                <li><a href="home.php?seccion=inicio" class="<?php echo $seccion_actual === 'inicio' ? 'activo' : ''; ?>">Inicio</a></li>
                <li><a href="home.php?seccion=servicios" class="<?php echo $seccion_actual === 'servicios' ? 'activo' : ''; ?>">Servicios</a></li>
                <li><a href="home.php?seccion=contacto" class="<?php echo $seccion_actual === 'contacto' ? 'activo' : ''; ?>">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div id="contenedor-principal">
        <?php
        switch ($seccion_actual) {
            case 'inicio':
                echo "<h2>Bienvenido a nuestra Página de Inicio</h2>";
                echo "<p>Este es el contenido principal de la portada. Cambia dinámicamente usando PHP al interactuar con el menú superior sin necesidad de crear múltiples archivos HTML.</p>";
                if (!empty($lista_contactos)) {
                    echo "<h3>Últimos registros (" . count($lista_contactos) . ")</h3><ul>";
                    foreach ($lista_contactos as $c) {
                        echo "<li>" . htmlspecialchars($c['nombre']) . " - " . $c['fecha_registro'] . "</li>";
                    }
                    echo "</ul>";
                }
                break;

            case 'servicios':
                echo "<h2>Nuestros Servicios</h2>";
                echo "<p>Ofrecemos soluciones web a medida:</p>";
                echo "<ul>";
                echo "<li>Desarrollo Backend con PHP</li>";
                echo "<li>Maquetación Semántica HTML/CSS</li>";
                echo "<li>Diseño de Interfaces Dinámicas</li>";
                echo "</ul>";
                break;

            case 'contacto':
                echo "<h2>Página de Contacto</h2>";
                // Mostramos mensaje del servidor
                if (!empty($mensaje_db)) {
                    echo $mensaje_db;
                }
                ?>
                <form action="home.php?seccion=contacto" method="POST">
                    <label for="nombre">Tu Nombre: </label><br>
                    <input type="text" id="nombre" name="nombre" required minlength="2" maxlength="100"><br><br>
                    <button type="submit">Enviar Mensaje</button>
                </form>
                <?php
                break;

            case '404':
            default:
                echo "<h2>Error 404</h2>";
                echo "<p>La sección solicitada no existe. <a href='home.php?seccion=inicio'>Volver al inicio</a></p>";
                break;
        }
        ?>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Mi Empresa - Todos los derechos reservados.</p>
    </footer>

</body>
</html>
