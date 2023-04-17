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
    $sql = 'SELECT anuncio.id AS id, anuncio.descripcion AS descripcion, FORMAT(anuncio.precio, 2, ",") AS precio, anuncio.fecha_publicacion AS "fechaPublicacion",  
                   marca.nombre AS marca, marca.logo AS logo, modelo.nombre AS modelo, modelo.serie AS serie, anuncio.color AS color, FORMAT(anuncio.kilometraje, 0) AS kilometraje, 
                   pais.nombre AS paisMarca, tipo_vehiculo.nombre as "tipoVehiculo", tipo_motor.nombre AS "tipoMotor", motorizacion.cilindrada AS cilindrada, 
                   motorizacion.potencia AS potencia, prestaciones.velocidad_maxima AS "velocidadMax", prestaciones.aceleracion_0_100 AS "aceleracion", 
                   prestaciones.consumo_combustible AS consumo,  multimedia.foto1 AS foto1, multimedia.foto2 AS foto2, multimedia.foto3 AS foto3, 
                   multimedia.foto4 AS foto4, multimedia.foto5 AS foto5, propietario.nombre AS nombrePropietario, propietario.NIF AS NIF, 
                   propietario.correo AS email, propietario.telefono AS telefono, propietario.nombre_usuario_app AS usuario
            FROM anuncio     
            INNER JOIN modelo ON anuncio.modelo_id = modelo.id
            INNER JOIN marca ON modelo.marca_id = marca.id
            INNER JOIN pais ON pais.id = marca.pais_id
            INNER JOIN tipo_motor ON tipo_motor.id = modelo.tipo_motor_id
            INNER JOIN tipo_vehiculo ON tipo_vehiculo.id = modelo.tipo_vehiculo_id
            INNER JOIN motorizacion ON motorizacion.id = modelo.id
            INNER JOIN prestaciones ON prestaciones.id = modelo.id
            INNER JOIN propietario ON propietario.id = anuncio.propietario_id
            INNER JOIN multimedia ON multimedia.anuncio_id = anuncio.id 
            ORDER BY RAND();';

     $result = $conn->query($sql);

    // Crea un array con los nombres de usuario
    $anuncios = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $anuncios[] = array('id' => $row["id"], 'descripcion' => $row["descripcion"], 'precio' => $row["precio"], 'fechaPublicacion' => $row["fechaPublicacion"], 
        'marca' => $row['marca'], 'logo' => $row['logo'],'modelo' => $row["modelo"], 'serie' => $row["serie"],'color' => $row["color"], 'kilometraje' => $row['kilometraje'], 
        'paisMarca' => $row["paisMarca"],'tipoVehiculo' => $row['tipoVehiculo'], 'tipoMotor' => $row['tipoMotor'], 'cilindrada' => $row['cilindrada'], 
        'potencia' => $row['potencia'], 'velocidadMax' => $row['velocidadMax'], 'aceleracion' => $row['aceleracion'], 'consumo' => $row['consumo'], 
        'foto1' => $row['foto1'],'foto2' => $row['foto2'], 'foto3' => $row['foto3'], 'foto4' => $row['foto4'], 'foto5' => $row['foto5'], 
        'nombrePropietario' => $row['nombrePropietario'],'NIF' => $row['NIF'],  'email' => $row['email'],  'telefono' => $row['telefono'],  'usuario' => $row['usuario']);
        }
    }

    // Imprime el resultado en formato JSON
    echo json_encode($anuncios);

    // Cierra la conexión
    $conn->close();
}
?>