<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí va todo el código que realiza la consulta a la base de datos

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vehiculos_db";

    // Crea la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Realiza la consulta
    $sql = "SELECT marca.id as marca_id, marca.nombre as marca_nombre, marca.pais_id as marca_pais_id, marca.logo as marca_logo, pais.nombre as pais_nombre FROM marca INNER JOIN pais ON marca.pais_id = pais.id";
 

    $result = $conn->query($sql);

    // Crea un arreglo con los nombres de usuario
    $marcas = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marcas[] = array('id' => $row["marca_id"], 'nombre' => $row["marca_nombre"], 'pais_id' => $row["marca_pais_id"], 'logo' => $row["marca_logo"], 'nombre_pais' => $row['pais_nombre']);
        }
    }

    // Imprime el resultado en formato JSON
    echo json_encode($marcas);

    // Cierra la conexión
    $conn->close();
}
?>