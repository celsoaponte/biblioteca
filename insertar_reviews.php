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
    // Obtener los datos de la reseña
    $libro_id = $_POST["libro_id"];
    $calificacion = $_POST["calificacion"];
    $comentario = $_POST["comentario"];

    // Insertar la reseña en la base de datos
    $sql = "INSERT INTO reviews (libro_id, calificacion, comentario) VALUES ('$libro_id', '$calificacion', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "Reseña insertada correctamente.";
    } else {
        echo "Error al insertar la reseña: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>