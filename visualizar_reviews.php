<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Reviews</title>
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

    // Verificar si se enviaron los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener las columnas seleccionadas
        $columnas = $_POST["columnas"];

        // Construir la consulta SQL
        $sql = "SELECT ";

        // Agregar las columnas seleccionadas a la consulta
        $numColumnas = count($columnas);
        for ($i = 0; $i < $numColumnas; $i++) {
            $sql .= $columnas[$i];
            if ($i < $numColumnas - 1) {
                $sql .= ", ";
            }
        }

        // Especificar la tabla
        $sql .= " FROM reviews";

        // Ejecutar la consulta y mostrar los resultados
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Tabla: reviews</h2>";
            echo "<table>";
            echo "<tr>";

            // Mostrar los nombres de las columnas
            foreach ($columnas as $columna) {
                echo "<th>$columna</th>";
            }

            echo "</tr>";

            // Mostrar los datos de cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";

                foreach ($columnas as $columna) {
                    echo "<td>" . $row[$columna] . "</td>";
                }

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron registros en la tabla 'reviews'.";
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
</body>
</html>