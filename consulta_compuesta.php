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
    // Obtener la tabla 1 y la tabla 2 seleccionadas
    $tabla1 = $_POST["tabla1"];
    $tabla2 = $_POST["tabla2"];

    // Obtener las columnas seleccionadas para la tabla 1
    $columnas1 = isset($_POST["columnas1"]) ? $_POST["columnas1"] : array();

    // Obtener las columnas seleccionadas para la tabla 2
    $columnas2 = isset($_POST["columnas2"]) ? $_POST["columnas2"] : array();

    // Verificar si se seleccionaron columnas para la tabla 1
    if (empty($columnas1)) {
        die("No se seleccionaron columnas para la tabla 1.");
    }

    // Verificar si se seleccionaron columnas para la tabla 2
    if (empty($columnas2)) {
        die("No se seleccionaron columnas para la tabla 2.");
    }

    // Construir la consulta SQL con las columnas seleccionadas
    $columnas1Str = implode(",", $columnas1);
    $columnas2Str = implode(",", $columnas2);

    $sql = "SELECT $columnas1Str, $columnas2Str FROM $tabla1, $tabla2";

    // Ejecutar la consulta y mostrar los resultados en una tabla
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        // Mostrar los nombres de las columnas para la tabla 1
        foreach ($columnas1 as $columna) {
            echo "<th>$columna</th>";
        }
        // Mostrar los nombres de las columnas para la tabla 2
        foreach ($columnas2 as $columna) {
            echo "<th>$columna</th>";
        }
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            // Mostrar los datos de las columnas para la tabla 1
            foreach ($columnas1 as $columna) {
                echo "<td>{$row[$columna]}</td>";
            }
            // Mostrar los datos de las columnas para la tabla 2
            foreach ($columnas2 as $columna) {
                echo "<td>{$row[$columna]}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron registros en la consulta compuesta.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>