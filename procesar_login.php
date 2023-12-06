<?php
// Configuración de la base de datos
$host = "localhost";
$usuario_bd = "root";
$contrasena_bd = "";
$nombre_bd = "test";

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consulta para verificar el usuario y la contraseña en la base de datos
$sql = "SELECT * FROM login WHERE usuario='$usuario' AND password='$contrasena'";
$resultado = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Usuario y contraseña válidos
    $respuesta = array('valido' => true);
} else {
    // Usuario o contraseña incorrectos
    $respuesta = array('valido' => false);
}

// Enviar respuesta como JSON
header('Content-Type: application/json');
echo json_encode($respuesta);

// Cerrar la conexión a la base de datos
$conexion->close();
?>
