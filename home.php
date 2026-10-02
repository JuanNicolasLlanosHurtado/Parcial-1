<?php
// home.php - Archivo principal (Router)
// Este es el archivo que debes abrir en el navegador: http://localhost/tu-proyecto/home.php
require_once __DIR__ . '/entornoLadodelServidor.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sitio Web - <?php echo htmlspecialchars(ucfirst($seccion_actual)); ?></title>
    <link rel="stylesheet" href="componenteCSS.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #fafafa; }
        header { background-color: #2c3e50; color: white; padding: 20px; text-align: center; }
        nav ul { list-style-type: none; padding: 0; margin: 15px 0 0 0; display: flex; justify-content: center; gap: 20px; }
        nav a { color: #ecf0f1; text-decoration: none; font-weight: bold; padding: 8px 16px; border-radius: 4px; transition: background 0.3s; }
        nav a:hover { background-color: #34495e; color: #3498db; }
        #contenedor-principal { max-width: 900px; margin: 30px auto; padding: 30px; background-color: white; min-height: 350px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 8px; }
        footer { background-color: #333; color: #bbb; text-align: center; padding: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <header>
        <h1>Mi Primer Sitio Web</h1>
        <nav>
            <ul>
                <li><a href="home.php?seccion=inicio" class="<?= $seccion_actual === 'inicio' ? 'activo' : '' ?>">Inicio</a></li>
                <li><a href="home.php?seccion=servicios" class="<?= $seccion_actual === 'servicios' ? 'activo' : '' ?>">Servicios</a></li>
                <li><a href="home.php?seccion=contacto" class="<?= $seccion_actual === 'contacto' ? 'activo' : '' ?>">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main id="contenedor-principal">
        <?php switch ($seccion_actual):
            case 'inicio': ?>
                <h2>Bienvenido a nuestra Página de Inicio</h2>
                <p>Este contenido cambia dinámicamente con PHP según el parámetro <code>?seccion=</code> sin crear múltiples HTML.</p>
                <?php if ($lista_contactos): ?>
                    <h3>Últimos contactos registrados</h3>
                    <ul>
                        <?php foreach ($lista_contactos as $c): ?>
                            <li><strong><?= htmlspecialchars($c['nombre']) ?></strong> - <?= $c['fecha_registro'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php break; ?>

            <?php case 'servicios': ?>
                <h2>Nuestros Servicios</h2>
                <p>Ofrecemos soluciones web a medida:</p>
                <ul>
                    <li>Desarrollo Backend con PHP</li>
                    <li>Maquetación Semántica HTML/CSS</li>
                    <li>Diseño de Interfaces Dinámicas</li>
                </ul>
                <?php break; ?>

            <?php case 'contacto': ?>
                <h2>Página de Contacto</h2>
                <?= $mensaje_db ?>
                <form action="home.php?seccion=contacto" method="POST">
                    <label for="nombre">Tu Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" ><br><br>
                    <button type="submit">Enviar Mensaje</button>
                </form>
                <?php break; ?>

            <?php default: ?>
                <h2>Error 404</h2>
                <p>La sección solicitada no existe.</p>
                <a href="home.php?seccion=inicio"><button>Volver al inicio</button></a>
        <?php endswitch; ?>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> Parcial</p>
    </footer>
</body>
</html>
