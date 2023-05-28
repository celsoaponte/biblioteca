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
    $nuevo_nombre = $_POST["nuevo_nombre"];

    // Validar que los datos no estén vacíos
    if (empty($id) || empty($nuevo_nombre)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Realizar la modificación en la base de datos
        $sql = "UPDATE editoriales SET nombre_editorial = '$nuevo_nombre' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "El nombre de la editorial se ha modificado correctamente.";
        } else {
            echo "Error al modificar el nombre de la editorial: " . $conn->error;
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>