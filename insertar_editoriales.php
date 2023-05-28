<?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de la editorial
    $nombre_editorial = $_POST["nombre_editorial"];

    // Insertar la editorial en la base de datos
    $sql = "INSERT INTO editoriales (nombre_editorial) VALUES ('$nombre_editorial')";

    if ($conn->query($sql) === TRUE) {
        echo "Editorial insertada correctamente.";
    } else {
        echo "Error al insertar la editorial: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
