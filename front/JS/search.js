document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("searchForm").addEventListener("submit", function (event) {
        event.preventDefault();

        // Obtener el valor del campo de búsqueda
        let searchTerm = document.getElementById("searchInput").value;

        // Obtener el valor seleccionado del <select>
        let selectElement = document.getElementById("searchSelect");
        let selectedOption = selectElement.options[selectElement.selectedIndex];
        let selectedValue = selectedOption.value;

        // Crear un objeto FormData para enviar los datos por POST
        let formData = new FormData();
        formData.append("param", searchTerm);
        formData.append("selectParam", selectedValue);

        // Realizar la solicitud AJAX al controlador del backend
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../back/Controllers/listController.php", true);
        xhr.onreadystatechange = function () {

            let counter = 0;

            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Procesar la respuesta del controlador
                    let data = JSON.parse(xhr.responseText);

                    // Buscar el div que deseas verificar por su clase
                    let divToDelete = document.getElementById("notFoundMatchesDiv");

                    if (divToDelete !== null) {
                        divToDelete.remove();
                    }

                    // Recorrer todos los elementos y los elimina
                    divDeleter();

                    // Limpia los resultados anteriores
                    let divCarousel = document.querySelectorAll(".carouselClass");

                    for (let j = 0; j < divCarousel.length; j++) {
                        divCarousel[j].remove();
                    }

                    // Capitaliza un string para adecuarlo a la salida de base de datos
                    let stringToCapitalize = searchTerm;
                    let capitalizeSearchTerm = stringToCapitalize.charAt(0).toUpperCase() + stringToCapitalize.slice(1).toLowerCase();

                    // Búsqueda según la opción seleccionada.
                    switch (selectedValue) {
                        case "1":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].brand_id.name == capitalizeSearchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "2":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].model_id.name == capitalizeSearchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "3":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].engine_type_id.name == capitalizeSearchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "4":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].color == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "5":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].motorization_id.power == capitalizeSearchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "6":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].benefits_id.max_velocity == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "7":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].benefits_id.acceleration_0_100 == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "8":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].benefits_id.consumption == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "9":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].km == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "10":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].brand_id.country.name == capitalizeSearchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "11":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                let dateString = data.advertisements[i].model_id.releaseYear.date;
                                let year = dateString.slice(0, 4);
                                if (year == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                }
                            }
                            notResults(counter);
                            break;
                        case "12":
                            for (let i = 0; i < data.advertisements.length; i++) {
                                if (data.advertisements[i].price == searchTerm) {
                                    alignedDiv(counter);
                                    counter++;
                                    makeCard(i, i, data.advertisements);
                                } else { }
                            }
                            notResults(counter);
                            break;
                        default:
                            errorMessageModal('Algo no ha ido bien...', 'Debes seleccionar un filtro para encontrar resultados.');
                            deleteShowErrorModal();
                    }

                    // Reinicia los valores de búsqueda
                    selectElement.value = "0";
                    document.getElementById("searchInput").value = "";

                } else {
                    console.error("Error en la solicitud AJAX. Estado: " + xhr.status);
                }
                // Añade o elimina la clase 'dark-mode'
                darkModeCards();
            }
        };
        xhr.send(formData);
    });
});


