<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Autores</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>
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

    // Obtener las columnas seleccionadas
    $columnas = $_POST["columnas"];

    // Verificar si se seleccionaron columnas
    if (empty($columnas)) {
        echo "No se seleccionaron columnas.";
    } else {
        // Construir la consulta SQL con las columnas seleccionadas
        $columnasStr = implode(",", $columnas);
        $sql = "SELECT $columnasStr FROM autores";

        // Ejecutar la consulta y mostrar los resultados en una tabla
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            while ($row = $result->fetch_assoc()) {
                // Mostrar los nombres de las columnas
                if (!isset($headerDisplayed)) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<th>$key</th>";
                    }
                    echo "</tr>";
                    $headerDisplayed = true;
                }

                // Mostrar los datos de cada fila
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla.";
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
</body>
</html>