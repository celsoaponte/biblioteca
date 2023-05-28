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
    // Obtener el nombre del autor
    $nombre_autor = $_POST["nombre_autor"];

    // Insertar el autor en la base de datos
    $sql = "INSERT INTO autores (nombre_autor) VALUES ('$nombre_autor')";

    if ($conn->query($sql) === TRUE) {
        echo "Autor insertado correctamente.";
    } else {
        echo "Error al insertar el autor: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>