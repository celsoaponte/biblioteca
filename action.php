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
            // Redirigir a la página correspondiente para visualizar datos
            switch ($tabla) {
                case "autores":
                    header("Location: visualizar_autores.html");
                    break;
                case "editoriales":
                    header("Location: visualizar_editoriales.html");
                    break;
                case "generos":
                    header("Location: visualizar_generos.html");
                    break;
                case "libros":
                    header("Location: visualizar_libros.html");
                    break;
                case "reviews":
                    header("Location: visualizar_reviews.html");
                    break;
                default:
                    echo "Tabla seleccionada inválida.";
                    break;
            }
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

// Cerrar la conexión a la base de datos
$conn->close();
?>