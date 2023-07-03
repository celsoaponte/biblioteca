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

// Obtener la tabla y las columnas seleccionadas
$tabla = $_POST["tabla"];
$columnasSeleccionadas = $_POST["columnas"];

// Construir la consulta SQL
$columnas = implode(", ", $columnasSeleccionadas);
$sql = "SELECT $columnas FROM $tabla";

// Ejecutar la consulta
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Mostrar la tabla con las columnas seleccionadas
    echo "<h2>Tabla: $tabla</h2>";
    echo "<table>";
    echo "<tr>";
    foreach ($columnasSeleccionadas as $columna) {
        echo "<th>$columna</th>";
    }
    echo "</tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        foreach ($columnasSeleccionadas as $columna) {
            echo "<td>" . $fila[$columna] . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros en la tabla.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
