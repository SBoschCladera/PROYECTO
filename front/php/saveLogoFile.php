<?php
session_start();

function saveFile($file, $directory)
{
    // Comprueba si se ha enviado un archivo
    if (isset($file['error']) && $file['error'] === UPLOAD_ERR_OK) {
        $fileName = /*uniqid() . '_' . */$file['name'];
        $fullRoute = $directory . $fileName;

        // Mueve el archivo al directorio de destino
        if (move_uploaded_file($file['tmp_name'], $fullRoute)) {
            // El archivo se ha guardado correctamente
            $urlFile = getUrlFile($fileName);

            // Guarda la URL en una variable de sesión
            $_SESSION['urlFile'] = $urlFile;

            // Redirige a la página anterior
            if (isset($_SESSION['url'])) {
                //header("Location: " . $_SESSION['url']);              
                echo '<script>window.close();</script>';
                exit();
            }
        } else {
            // Error al mover el archivo
            return 'Error al subir el archivo.';
        }
    } else {
        // No se ha enviado ningún archivo o ocurrió un error en la carga
        return 'No se ha seleccionado ningún archivo.';
    }
}

function getUrlFile($fileName)
{
    // Obtiene la URL base de tu sitio web
    //$baseUrl = 'C:/xampp/htdocs/php/';

    // Combina la URL base con el nombre del archivo
    $urlFile = $fileName;

    return $urlFile;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['logoFile'])) {
        $destinatioDirectory = 'C:/xampp/htdocs/php/PROYECTO/front/images/logosImages/';
        saveFile($_FILES['logoFile'], $destinatioDirectory);
    }
}
?>