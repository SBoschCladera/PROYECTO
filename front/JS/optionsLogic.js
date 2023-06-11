
// Actualiza un elemento select con id "marca".
function optionValue(selectedId) {
    // Crea una nueva solicitud HTTP
    var xhttp = new XMLHttpRequest();

    // Define una función que se ejecutará cuando cambie el estado de la solicitud
    xhttp.onreadystatechange = function () {
        // Si la solicitud se completó correctamente
        if (this.readyState == 4 && this.status == 200) {
            // Analiza la respuesta JSON recibida
            let data = JSON.parse(this.responseText);

            // Elimina todas las opciones existentes en los elemento select "brand" y "model", excepto la opción predeterminada
            while (document.getElementById('brand').options.length > 1) {
                document.getElementById('brand').remove(1);
                document.getElementById('model').remove(1);
            }

            // Crea nuevos arrays
            let brandsArray = [], brandsId = [], totalBrandsName = [], totalBrandsId = [];

            // Itera a través de los datos JSON y crea opciones adicionales en el elemento select
            for (let i = 0; i < data.advertisements.length; i++) {
                let idVehicle = data.advertisements[i].model_id.vehicleType_id.id;
                let value = data.advertisements[i].brand_id.id;
                let text = data.advertisements[i].brand_id.name;

                // Si se ha seleccionado un tipo de vehículo, crea opciones solo para marcas que corresponden a ese tipo
                // Si el id del select coincide con el id del tipo de vehiculo y no está repetido, se añade al array "brandsArray"
                if (parseInt(idVehicle) == parseInt(selectedId) && brandsArray.indexOf(text) === -1) {
                    fillArray(brandsArray, brandsId, text, value);
                }
            }

            let brandsWithoutVehicleIdName = [], brandsWithoutVehicleIdValue = [];
            //Si no se ha seleccionado ningún tipo de vehículo, crea opciones para todas las marcas
            if (parseInt(document.getElementById('vehicleType').value) == "0") {
                for (let j = 0; j < data.advertisements.length; j++) {
                    fillArray(brandsWithoutVehicleIdName, brandsWithoutVehicleIdValue, data.advertisements[j].brand_id.name, data.advertisements[j].model_id.id);
                }

                for (let j = 0; j < brandsWithoutVehicleIdName.length; j++) {
                    createOption(brandsWithoutVehicleIdValue[j], brandsWithoutVehicleIdName[j], 'brand', 'optionsClassName');
                }
            }

            // Añadimos al select los valores del array "brandsArray" y "brandsId" sin repeticiones (cuando hay un id seleccionado)
            // Crea una opción predeterminada en el elemento select
            if (document.getElementById('vehicleType').dataset.info == "3") {
                let option = createOption("-1", 'Nuevo registro', 'brand', 'optionsClassName');
                option.style.color = 'white';
                option.style.fontWeight = 'bold';
                option.style.backgroundColor = '#62cf79';  
                document.getElementById('brand').appendChild(option);
            } 

            for (let j = 0; j < brandsArray.length; j++) {
                let value = brandsId[j];
                let text = brandsArray[j];

                createOption(value, text, 'brand', 'optionsClassName');
            }
            //Si no se ha seleccionado ningún tipo de vehículo, crea opciones para todas las marcas (sin id seleccionado)
            // Añadimos al select los valores del array "totalBrandsName"  y "totalBrandsId" sin repeticiones
            for (let j = 0; j < totalBrandsName.length; j++) {
                let value = totalBrandsId[j];
                let text = totalBrandsName[j];

                createOption(value, text, 'brand', 'optionsClassName');
            }
        }
    };

    // Envía la solicitud HTTP con el parámetro seleccionadoId
    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + selectedId);
}


// Actualiza un elemento select con id "model".
function optionModelValue(selectedBrandId) {
    // Crea una nueva solicitud HTTP
    var xhttp = new XMLHttpRequest();

    // Define una función que se ejecutará cuando cambie el estado de la solicitud
    xhttp.onreadystatechange = function () {
        // Si la solicitud se completó correctamente
        if (this.readyState == 4 && this.status == 200) {
            // Analiza la respuesta JSON recibida
            let data = JSON.parse(this.responseText);

            // Elimina todas las opciones existentes en el elemento select "model"
            while (document.getElementById('model').options.length > 0) {
                document.getElementById('model').remove(0);
            }

            // Crea nuevas arrays
            let modelsArray = [], modelsId = [];

            // Itera a través de los datos JSON y crea opciones adicionales en el elemento select "model"
            for (let i = 0; i < data.advertisements.length; i++) {
                let idVehicle = data.advertisements[i].model_id.vehicleType_id.id;
                let idVehicleTypeSelected = document.getElementById('vehicleType').value;
                let idBrand = data.advertisements[i].brand_id.id;
                let value = data.advertisements[i].model_id.id;
                let text = data.advertisements[i].model_id.name;

                // Si se ha seleccionado algún tipo de vehículo en concreto (id !=0) y se ha seleccionado un marca, crea opciones para los modelos ese tipo de vehículo 
                // seleccionado y marca  
                if (parseInt(idBrand) == parseInt(selectedBrandId) && parseInt(idVehicleTypeSelected) != 0 && parseInt(idVehicleTypeSelected) == parseInt(idVehicle)) {
                    fillArray(modelsArray, modelsId, text, value);
                    // Si el id del select coincide con el id de la marca y no está repetido, se añade al array "modelsArray"
                }
                // Si NO se ha seleccionado algún tipo de vehículo en concreto (id=0) y se ha seleccionado un marca, crea opciones para todos los tipos de vehículos 
                // y modelos que corresponden a esa marca  
                else if (parseInt(idBrand) == parseInt(selectedBrandId) && parseInt(idVehicleTypeSelected) == 0) {
                    fillArray(modelsArray, modelsId, text, value);
                }
            }

            // Añadimos al select los valores del array "modelsArray" y "modelsId" sin repeticiones
            // Crea una opción predeterminada en el elemento select
            if (document.getElementById('brand').dataset.info == "5") {
                let option = createOption("0", 'Selecciona una opción', 'model', 'optionsClassName');
                document.getElementById('model').appendChild(option);
                let option2 = createOption("-1", 'Nuevo registro', 'model', 'optionsClassName'); 
                option2.style.color = 'white';
                option2.style.fontWeight = 'bold';
                option2.style.backgroundColor = '#62cf79';          
                document.getElementById('model').appendChild(option2);
            } else {
                let option = createOption("0", 'Todos los modelos', 'model', 'optionsClassName');                
                document.getElementById('model').appendChild(option);
            }

            for (let j = 0; j < modelsArray.length; j++) {
                let value = modelsId[j];
                let text = modelsArray[j];

                createOption(value, text, 'model', 'optionsClassName');
            }
        }
    };

    // Envía la solicitud HTTP con el parámetro seleccionadoBrandId
    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("brand_id=" + selectedBrandId);
}

// Rellena un array sin valores repetidos.
function fillArray(brandsWithoutVehicleIdName, brandsWithoutVehicleIdValue, text, value) {
    if (brandsWithoutVehicleIdName.indexOf(text) === -1) {
        brandsWithoutVehicleIdName.push(text);
        brandsWithoutVehicleIdValue.push(value);
    }
}

// Habilita o deshabilita un textField
function toggleTextField(selectID, textFieldId) {
    let selectElement = document.getElementById(selectID);
    let textFieldElement = document.getElementById(textFieldId);

    if (selectElement.value === "-1") {
        textFieldElement.disabled = false;
    } else {
        textFieldElement.disabled = true;
        document.getElementById(textFieldId).value = "";
    }
}

// Habilita o deshabilita el textField para el insert de la nueva marca
function toggleTextFieldBrand() {
    let selectElement = document.getElementById('brand');
    let textFieldElement = document.getElementById('newBrand');
    let buttonLoadLogo = document.getElementById('loadLogo');
    let insertLogo = document.getElementById('newLogoId');

    if (selectElement.value === "-1") {
        textFieldElement.disabled = false;
        buttonLoadLogo.classList.remove('disabled');
        insertLogo.disabled = false;
        document.getElementById('newCountry').innerHTML = "hola";
    } else {
        textFieldElement.disabled = true;
        buttonLoadLogo.classList.add('disabled');
        insertLogo.disabled = true;
        textFieldElement.value = "";
        insertLogo.value = "";
    }
}

// Habilita o deshabilita el textField para el insert del nuevo modelo
function toggleTextFieldModel() {
    let selectElement = document.getElementById('model');
    let textFieldElement = document.getElementById('newModel');
    let textFieldElementSeries = document.getElementById('series');

    if (selectElement.value === "-1") {
        textFieldElement.disabled = false;
    } else {
        textFieldElement.disabled = true;
        textFieldElement.value = "";
        textFieldElementSeries.value = "";
    }
}
