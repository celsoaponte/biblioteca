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
    // Obtener los datos del formulario
    $id = $_POST["id"];
    $nueva_calificacion = $_POST["nueva_calificacion"];
    $nuevo_comentario = $_POST["nuevo_comentario"];

    // Validar que los datos no estén vacíos
    if (empty($id) || empty($nueva_calificacion) || empty($nuevo_comentario)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Realizar la modificación en la base de datos
        $sql = "UPDATE reviews SET calificacion = $nueva_calificacion, comentario = '$nuevo_comentario' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "La review se ha modificado correctamente.";
        } else {
            echo "Error al modificar la review: " . $conn->error;
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>