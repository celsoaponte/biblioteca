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
            // Código para visualizar los datos de la tabla seleccionada
            $sql = "SELECT * FROM $tabla";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Accede a los datos de cada fila y muestra los resultados
                    echo "ID: " . $row["id"] . "<br>";
                    if ($tabla === "libros") {
                        echo "Título: " . $row["titulo_libro"] . "<br>";
                        echo "Autor ID: " . $row["autor_id"] . "<br>";
                        echo "Editorial ID: " . $row["editorial_id"] . "<br>";
                        echo "Género ID: " . $row["genero_id"] . "<br>";
                    } elseif ($tabla === "autores") {
                        echo "Nombre Autor: " . $row["nombre_autor"] . "<br>";
                    } elseif ($tabla === "editoriales") {
                        echo "Nombre Editorial: " . $row["nombre_editorial"] . "<br>";
                    } elseif ($tabla === "generos") {
                        echo "Nombre Género: " . $row["nombre_genero"] . "<br>";
                    } elseif ($tabla === "reviews") {
                        echo "Libro ID: " . $row["libro_id"] . "<br>";
                        echo "Calificación: " . $row["calificacion"] . "<br>";
                        echo "Comentario: " . $row["comentario"] . "<br>";
                    }
                    echo "<br>";
                }
            } else {
                echo "No se encontraron registros.";
            }

            break;

        case "insertar":
            // Código para insertar nuevos datos en la tabla seleccionada
            if ($tabla === "libros") {
                $titulo = $_POST["titulo"];
                $autor_id = $_POST["autor_id"];
                $editorial_id = $_POST["editorial_id"];
                $genero_id = $_POST["genero_id"];

                $sql = "INSERT INTO $tabla (titulo_libro, autor_id, editorial_id, genero_id)
                        VALUES ('$titulo', '$autor_id', '$editorial_id', '$genero_id')";
            } elseif ($tabla === "autores") {
                $nombre_autor = $_POST["nombre_autor"];

                $sql = "INSERT INTO $tabla (nombre_autor)
                        VALUES ('$nombre_autor')";
            } elseif ($tabla === "editoriales") {
                $nombre_editorial = $_POST["nombre_editorial"];

                $sql = "INSERT INTO $tabla (nombre_editorial)
                        VALUES ('$nombre_editorial')";
            } elseif ($tabla === "generos") {
                $nombre_genero = $_POST["nombre_genero"];

                $sql = "INSERT INTO $tabla (nombre_genero)
                        VALUES ('$nombre_genero')";
            } elseif ($tabla === "reviews") {
                $libro_id = $_POST["libro_id"];
                $calificacion = $_POST["calificacion"];
                $comentario = $_POST["comentario"];

                $sql = "INSERT INTO $tabla (libro_id, calificacion, comentario)
                        VALUES ('$libro_id', '$calificacion', '$comentario')";
            }

            if ($conn->query($sql) === TRUE) {
                echo "Nuevo registro insertado correctamente.";
            } else {
                echo "Error al insertar el registro: " . $conn->error;
            }

            break;

        case "modificar":
            // Código para modificar los datos de la tabla seleccionada
            $id = $_POST["id"];
            $nuevo_titulo = $_POST["nuevo_titulo"];

            $sql = "UPDATE $tabla SET titulo_libro = '$nuevo_titulo' WHERE id = '$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Registro actualizado correctamente.";
            } else {
                echo "Error al actualizar el registro: " . $conn->error;
            }

            break;

        default:
            // Acción inválida
            echo "Acción inválida seleccionada.";
            break;
    }
}
?>