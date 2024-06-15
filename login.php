<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisp_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['correo_electronico']) && isset($_POST['contrasena'])) {
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];

        $sql = "SELECT * FROM Usuarios WHERE correo_electronico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo_electronico);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($contrasena, $row['contrasena'])) {
                $_SESSION['usuario_id'] = $row['usuario_id'];
                $_SESSION['nombre_completo'] = $row['nombre_completo'];
                $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
                header("Location: dashboard.php");
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Correo electrónico no registrado";
        }

        $stmt->close();
    }
}

$conn->close();
?>
