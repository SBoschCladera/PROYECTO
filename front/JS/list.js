// Número de anuncios que se muestran en pantalla
document.onload = function () {    
    //totalAdvertisements();
    
}
numAdvertisements = 51;

// Obtiene el número total de anuncios que se mostrarán en pantalla
function totalAdvertisements() {
    // Crea una solicitud HTTP POST al servidor para obtener los datos de los anuncios
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        // Si la solicitud se completa con éxito, parsea los datos de respuesta y los pasa a la función makeList
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            numAdvertisements = data.total;
        }
    };
    xhttp.open("POST", "../../back/Controllers/totalAdvertisementsController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Obtiene los datos de los anuncios del backEnd.
function toListAdvertisements() {
    // Crea una solicitud HTTP POST al servidor para obtener los datos de los anuncios
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        // Si la solicitud se completa con éxito, parsea los datos de respuesta y los pasa a la función makeList
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            makeList(data, numAdvertisements);
        }
    };
    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Crea una lista en la página principal de la aplicación  con el número de anuncios indicado en la variable "numAdvertisements"
function makeList(data, listNum) {

    for (let i = 0; i < listNum; i++) {

        // Condición para añadir un "div" separador para continuar con el formato HTML de la primera fila de anuncios
        alignedDiv(i);

        // Crea un anuncio con bootstrap       
        makeCard(i, i, data.advertisements)
    }
}


//Muestra los anunciones en pantalla según las opciones seleccionadas de los selects
function sendData() {

    // Obtiene los valores de los campos del formulario
    let selectVehicleTypeValue = document.getElementById('vehicleType').value;
    let selectBrandValue = document.getElementById('brand').value;
    let modelSearcherValue = document.getElementById('model').value;
    let maxPriceValue = document.getElementById('maxPrice').value;

    // Crear una instancia de XMLHttpRequest
    let xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open('POST', '../../back/Controllers/listController.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Definir la función que se llamará cuando la solicitud se complete
    xhr.onload = function () {
        if (xhr.status === 200) {
            let data = JSON.parse(this.responseText);
            let counter = 0;


            // Buscar el div que deseas verificar por su clase
            let divToDelete = document.getElementById("notFoundMatchesDiv");

            if (divToDelete !== null) {
                divToDelete.remove();
            }

            // Recorrer todos los elementos y los elimina
            divDeleter();

            for (let i = 0; i < numAdvertisements; i++) {


                //  Variables con condiciones
                let selectVehicleTypeValueEqualsVehicleTypeId = (parseInt(data.advertisements[i].model_id.vehicleType_id.id) == selectVehicleTypeValue);
                let selectBrandValueEqualsBrandId = (parseInt(data.advertisements[i].brand_id.id) == parseInt(selectBrandValue));

                // Si hay seleccionado un id para el select con el tipo de vehículo y un id para el select con la marca diferentes a "0"...
                if (selectVehicleTypeValueEqualsVehicleTypeId && selectBrandValueEqualsBrandId) {

                    let modelSelect = parseInt(selectBrandValue) - 1;

                    // Condición para añadir un "div" separador para continuar con el formato HTML de la primera fila de anuncios
                    alignedDiv(counter);
                    counter++;

                    // Crea un anuncio con bootstrap
                    makeCard(i, modelSelect, data.advertisements);
                }

                // Si no ha sido seleccionado un id para el select con el tipo de vehículo ni para el select de marca...
                else if (parseInt(selectVehicleTypeValue) == "0" && selectBrandValue == "0") {
                    // Recorrer todos los elementos y eliminarlos
                    counter++;
                    divDeleter();
                    makeList(data, numAdvertisements);
                }
                // Si hay seleccionado un id para el select con el tipo de vehículo y no se ha seleccionado ninguna opción para select con la marca...
                else if (selectVehicleTypeValueEqualsVehicleTypeId && selectBrandValue == "0") {
                    alignedDiv(counter);
                    counter++;

                    // Crea un anuncio con bootstrap
                    makeCard(i, i, data.advertisements);
                }

                // Si no se ha seleccionado seleccionado un id para el select con el tipo de vehículo y sí ha seleccionado una opción en el select con la marca...
                else if (selectVehicleTypeValue == "0" && selectBrandValueEqualsBrandId) {
                    alignedDiv(counter);
                    counter++;

                    // Crea un anuncio con bootstrap
                    makeCard(i, i, data.advertisements);
                }
            }

            if (counter < 1) {
                //punto                
                document.getElementById('result').appendChild(notFoundMatches());
            }
        }
    }

    // Enviar la solicitud con los datos del formulario
    xhr.send();
}

