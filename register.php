<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisp_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre_completo']) && isset($_POST['correo_electronico']) && isset($_POST['contrasena']) && isset($_POST['tipo_usuario'])) {
        $nombre_completo = $_POST['nombre_completo'];
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        $tipo_usuario = $_POST['tipo_usuario'];

        $sql = "INSERT INTO Usuarios (nombre_completo, correo_electronico, contrasena, tipo_usuario) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre_completo, $correo_electronico, $contrasena, $tipo_usuario);

        if ($stmt->execute()) {
            header("Location: index.html");
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
