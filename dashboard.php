<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit();
}

echo "Bienvenido, " . $_SESSION['nombre_completo'];
echo "<br>Tipo de usuario: " . $_SESSION['tipo_usuario'];
?>

<a href="logout.php">Cerrar Sesión</a>
