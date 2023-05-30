<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        // Obtener la tabla y la acción seleccionadas
        $tabla = $_POST["tabla"];
        $accion = $_POST["accion"];

        // Realizar diferentes acciones según la selección
        switch ($accion) {
            case "visualizar":
                visualizarTabla($conn, $tabla);
                break;

            case "insertar":
                // Redirigir a la página correspondiente para insertar datos
                switch ($tabla) {
                    case "autores":
                        header("Location: insertar_autores.html");
                        break;
                    case "editoriales":
                        header("Location: insertar_editoriales.html");
                        break;
                    case "generos":
                        header("Location: insertar_generos.html");
                        break;
                    case "libros":
                        header("Location: insertar_libros.html");
                        break;
                    case "reviews":
                        header("Location: insertar_reviews.html");
                        break;
                    default:
                        echo "Tabla seleccionada inválida.";
                        break;
                }
                break;

            case "modificar":
                // Redirigir a la página correspondiente para modificar datos
                switch ($tabla) {
                    case "autores":
                        header("Location: modificar_autores.html");
                        break;
                    case "editoriales":
                        header("Location: modificar_editoriales.html");
                        break;
                    case "generos":
                        header("Location: modificar_generos.html");
                        break;
                    case "libros":
                        header("Location: modificar_libros.html");
                        break;
                    case "reviews":
                        header("Location: modificar_reviews.html");
                        break;
                    default:
                        echo "Tabla seleccionada inválida.";
                        break;
                }
                break;

            case "eliminar":
                // Redirigir a la página correspondiente para eliminar datos
                switch ($tabla) {
                    case "autores":
                        header("Location: eliminar_autores.html");
                        break;
                    case "editoriales":
                        header("Location: eliminar_editoriales.html");
                        break;
                    case "generos":
                        header("Location: eliminar_generos.html");
                        break;
                    case "libros":
                        header("Location: eliminar_libros.html");
                        break;
                    case "reviews":
                        header("Location: eliminar_reviews.html");
                        break;
                    default:
                        echo "Tabla seleccionada inválida.";
                        break;
                }
                break;

            default:
                // Acción inválida
                echo "Acción inválida seleccionada.";
                break;
        }
    }

    // Función para visualizar los datos de una tabla
    function visualizarTabla($conn, $tabla)
    {
        echo "<h2>Tabla: $tabla</h2>";

        // Realizar la consulta a la base de datos y mostrar los resultados
        $sql = "SELECT * FROM $tabla";
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