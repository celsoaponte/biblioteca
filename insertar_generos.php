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
    // Obtener el nombre del género
    $nombre_genero = $_POST["nombre_genero"];

    // Insertar el género en la base de datos
    $sql = "INSERT INTO generos (nombre_genero) VALUES ('$nombre_genero')";

    if ($conn->query($sql) === TRUE) {
        echo "Género insertado correctamente.";
    } else {
        echo "Error al insertar el género: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>