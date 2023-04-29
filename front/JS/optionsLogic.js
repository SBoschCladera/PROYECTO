
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

            // Crea una opción predeterminada en el elemento select
            let option = document.createElement("option");
            option.value = '0';
            option.text = 'Todos las marcas';
            document.getElementById("brand").appendChild(option);

            // Elimina todas las opciones existentes en el elemento select, excepto la opción predeterminada
            while (document.getElementById('brand').options.length > 1) {
                document.getElementById('brand').remove(1);
            }

            // Crea nuevos arrays
            let brandsArray = [], brandsId = [], totalBrandsName = [], totalBrandsId = [];

            // Itera a través de los datos JSON y crea opciones adicionales en el elemento select
            for (let i = 0; i < data.advertisements.length; i++) {
                let idVehicle = data.advertisements[i].model_id.vehicleType_id.id
                let value = data.advertisements[i].model_id.id;
                let text = data.advertisements[i].brand_id.name;

                // Si se ha seleccionado un tipo de vehículo, crea opciones solo para marcas que corresponden a ese tipo
                // Si el id del select coincide con el id del tipo de vehiculo y no está repetido, se añade al array "brandsArray"
                if (parseInt(idVehicle) == parseInt(selectedId) && brandsArray.indexOf(text) === -1) {
                    fillArray(brandsArray, brandsId, text, value);
                }
            }

            let brandsWithoutVehicleIdName = [], brandsWithoutVehicleIdValue = [];
            //Si no se ha seleccionado ningún tipo de vehículo, crea opciones para todas las marcas
            if (parseInt(document.getElementById('vehicleType').value) == "0" /*&& totalBrandsName.indexOf(text) === -1*/) {
                for (let j = 0; j < data.advertisements.length; j++) {
                    fillArray(brandsWithoutVehicleIdName, brandsWithoutVehicleIdValue, data.advertisements[j].brand_id.name, data.advertisements[j].model_id.id);
                }

                for (let j = 0; j < brandsWithoutVehicleIdName.length; j++) {
                    createOption(brandsWithoutVehicleIdValue[j], brandsWithoutVehicleIdName[j], 'brand');
                }
            }

            // Añadimos al select los valores del array "brandsArray" y "brandsId" sin repeticiones (cuando hay un id seleccionado)
            for (let j = 0; j < brandsArray.length; j++) {
                let value = brandsId[j];
                let text = brandsArray[j];

                createOption(value, text, 'brand');
            }
            //Si no se ha seleccionado ningún tipo de vehículo, crea opciones para todas las marcas (sin id seleccionado)
            // Añadimos al select los valores del array "totalBrandsName"  y "totalBrandsId" sin repeticiones
            for (let j = 0; j < totalBrandsName.length; j++) {
                let value = totalBrandsId[j];
                let text = totalBrandsName[j];

                createOption(value, text, 'brand');
            }
        }
    };

    // Envía la solicitud HTTP con el parámetro seleccionadoId
    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + selectedId);
}

// Rellena un array sin valores repetidos.
function fillArray(brandsWithoutVehicleIdName, brandsWithoutVehicleIdValue, text, value) {
    if (brandsWithoutVehicleIdName.indexOf(text) === -1) {
        brandsWithoutVehicleIdName.push(text);
        brandsWithoutVehicleIdValue.push(value);
    }
}
