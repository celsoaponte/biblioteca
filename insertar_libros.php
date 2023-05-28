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
    // Obtener los datos del libro
    $titulo_libro = $_POST["titulo_libro"];
    $autor_id = $_POST["autor_id"];
    $editorial_id = $_POST["editorial_id"];
    $genero_id = $_POST["genero_id"];

    // Insertar el libro en la base de datos
    $sql = "INSERT INTO libros (titulo_libro, autor_id, editorial_id, genero_id) VALUES ('$titulo_libro', '$autor_id', '$editorial_id', '$genero_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Libro insertado correctamente.";
    } else {
        echo "Error al insertar el libro: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>