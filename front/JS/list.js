// Número de anuncios que se muestran en pantalla
numAdvertisements = 118

// Obtiene el número total de anuncios que se mostrarán en pantalla
function totalAdvertisements() {
    // Crea una solicitud HTTP POST al servidor para obtener los datos de los anuncios
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        // Si la solicitud se completa con éxito, parsea los datos de respuesta y los pasa a la función makeList
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            loco['total'] = data.total;
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
            numAdvertisements;
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
    let selectModelValue = document.getElementById('model').value;
    let modelSelect = document.getElementById('model');
    let modelSelectName = modelSelect.options[modelSelect.selectedIndex].text;
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
                let selectmodeldValueEqualsModelName = (data.advertisements[i].model_id.name == modelSelectName);
                let selectMaxPrice = parseInt(data.advertisements[i].price) <= parseInt(maxPriceValue);

                // Comprueba si hay seleccionado un precio máximo en el buscador
                if (selectMaxPrice || maxPriceValue == "") {

                    // Si hay seleccionado un id para el select con el tipo de vehículo... 
                    if (selectVehicleTypeValueEqualsVehicleTypeId) {

                        // ... y un id para el select con la marca diferentes a "0"...    
                        if (selectBrandValueEqualsBrandId) {

                            if (selectmodeldValueEqualsModelName) {
                                // Condición para añadir un "div" separador para continuar con el formato HTML de la primera fila de anuncios
                                alignedDiv(counter);
                                counter++;

                                // Crea un anuncio con bootstrap
                                makeCard(i, i, data.advertisements);

                            } else if (selectModelValue == "0") {
                                alignedDiv(counter);
                                counter++;
                                makeCard(i, i, data.advertisements);
                            }
                        }
                        // ... y no se ha seleccionado ninguna opción para select con la marca...
                        else if (selectBrandValue == "0") {

                            alignedDiv(counter);
                            counter++;
                            makeCard(i, i, data.advertisements);
                        }
                    }

                    // Si no se ha seleccionado seleccionado un id para el select con el tipo de vehículo... 
                    else if (parseInt(selectVehicleTypeValue) == "0") {

                        // ... y sí se ha seleccionado una opción en el select con la marca...
                        if (selectBrandValueEqualsBrandId) {

                            if (selectmodeldValueEqualsModelName) {
                                // Condición para añadir un "div" separador para continuar con el formato HTML de la primera fila de anuncios
                                alignedDiv(counter);
                                counter++;

                                // Crea un anuncio con bootstrap
                                makeCard(i, i, data.advertisements);

                            } else if (selectModelValue == "0") {
                                alignedDiv(counter);
                                counter++;
                                makeCard(i, i, data.advertisements);
                            }
                        }
                        // ... y no se ha selecionado un id para el select de marca...
                        else if (selectBrandValue == "0") {

                            alignedDiv(counter);
                            counter++;
                            makeCard(i, i, data.advertisements);
                        }
                    }
                }
            }
            // Condición para la muestra del mensaje de búsqueda sin resultados
            if (counter < 1) {

                notFoundMatches('result');
            }
        }
    }

    // Enviar la solicitud con los datos del formulario
    xhr.send();
    document.getElementById('maxPrice').value = "";
}


/**  query para el buscador
 select advertisement.description AS description, advertisement.price AS price, model.name AS modelName, advertisement.color AS color,
advertisement.km AS km, brand.name as brandName, motorization.power AS power, vehicle_type.name AS vehicleTypeName,
benefits.max_velocity as maxVelocity, benefits.acceleration_0_100 AS acceleration, benefits.consumption as consumption
from advertisement 
INNER JOIN model ON model.id = advertisement.model_id
INNER JOIN brand ON brand.id = advertisement.brand_id
INNER JOIN motorization ON motorization.id = advertisement.motorization_id
INNER JOIN vehicle_type ON vehicle_type.id = model.vehicle_type_id
INNER JOIN benefits ON benefits.id = advertisement.benefits_id
where description like '%Ci%' || price like '%10%'|| model.name like '%Po%' || color like '%ro%' || km like '%21%' || brand.name like '%Do%'
      || motorization.displacement like '%1.%' || vehicle_type.name like '%Mo%'|| benefits.max_velocity like '%20%' || benefits.acceleration_0_100 like '%4%' 
      || benefits.consumption like '%7%';
 */


// function modoOscuro() {

//     document.body.classList.add("darkMode");
//     let cards = document.getElementsByClassName('card');
//     for (let i = 0; i < cards.length; i++) {
//         document.getElementsByClassName('card')[i].classList.add("darkMode");
//     }
//     let selects = document.getElementsByClassName('form-control');
//     for (let i = 0; i < selects.length; i++) {
//         document.getElementsByClassName('form-control')[i].classList.add("darkMode");
//     }
//     let options = document.getElementsByClassName('optionsClassName');
//     for (let i = 0; i < options.length; i++) {
//         document.getElementsByClassName('optionsClassName')[i].classList.add("darkMode");
//     }
//     let cardsBody = document.getElementsByClassName('card-body');
//     for (let i = 0; i < cardsBody.length; i++) {
//         document.getElementsByClassName('card-body')[i].classList.add("darkMode");
//     }

// }
