<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados por el formulario
$nombre_autor = $_POST['nombre_autor'];
$editorial = $_POST['editorial'];
$genero = $_POST['genero'];
$titulo = $_POST['titulo'];
$calificacion = $_POST['calificacion'];
$resena = $_POST['resena'];

// Preparar la consulta SQL para insertar los datos en la base de datos
$sql = "INSERT INTO libros (nombre_autor, editorial, genero, titulo, calificacion, resena) 
        VALUES ('$nombre_autor', '$editorial', '$genero', '$titulo', '$calificacion', '$resena')";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    echo "Libro guardado exitosamente.";
} else {
    echo "Error al guardar el libro: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
