<?php
session_start();

// Comprueba si se ha enviado un archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['logoMultimedia'])) {
    $destinationDirectory = 'C:/xampp/htdocs/php/PROYECTO/front/images/advertisementImages/';
    saveFile($_FILES['logoMultimedia'], $destinationDirectory);
}

function saveFile($file, $directory)
{
    // Comprueba si se ha enviado un archivo
    if (isset($file['error']) && $file['error'] === UPLOAD_ERR_OK) {
        $fileName = /*uniqid() . '_' .*/$file['name'];
        $fullRoute = $directory . $fileName;

        // Mueve el archivo al directorio de destino
        if (move_uploaded_file($file['tmp_name'], $fullRoute)) {
            // El archivo se ha guardado correctamente
            $urlMultimedia = getUrlFile($fileName);

            // Guarda la URL en una variable de sesión
            $_SESSION['urlMultimedia'][] = $urlMultimedia;

            // Incrementa el contador de repeticiones
            if (isset($_SESSION['repetitions'])) {
                $_SESSION['repetitions']++;
            } else {
                $_SESSION['repetitions'] = 1;
            }

            // Comprueba si se ha alcanzado el límite de repeticiones
            if (isset($_SESSION['repetitions']) && $_SESSION['repetitions'] >= 6) {
                // Redirige a la URL indicada
                $_SESSION['repetitions'] = 1;
                if (isset($_SESSION['url'])) {
                    //header("Location: " . $_SESSION['url']);
                    echo '<script>window.close();</script>';
                    exit();
                }
            }
            // Vuelve a cargar la página actual
            header("Location: http://localhost/php/PROYECTO/front/Views/loadMultimediaView.phtml");
            exit();
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
    // Obtener la URL base de tu sitio web
//$baseUrl = 'C:/xampp/htdocs/php/';
// Combinar la URL base con el nombre del archivo
    $urlMultimedia = $fileName;

    return $urlMultimedia;
}