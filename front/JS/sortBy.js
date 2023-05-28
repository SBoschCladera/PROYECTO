// Ordena los anuncios por marca
function sortByBrandName() {
    // Crea una solicitud HTTP POST al servidor para obtener los datos de los anuncios
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        let counter = 0;
        let classPortadaDivs = document.querySelectorAll('.portada');
        let advertisementsArray = [];

        // Si la solicitud se completa con éxito, parsea los datos de respuesta y los pasa a la función makeList
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

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

            // Añadimos todos los objetos recogidos en el modelo para posteriormente ordenarlos mediante el método sort() y pintarlos en pantalla;
            for (let i = 0; i < data.advertisements.length; i++) {
                advertisementsArray.push(data.advertisements[i]);
            }

            let ordenedAdvertisementsArray = [...advertisementsArray].sort(function (a, b) {
                return a.brand_id.name.localeCompare(b.brand_id.name);
            });

            for (let i = 0; i < ordenedAdvertisementsArray.length; i++) {
                for (let j = 0; j < classPortadaDivs.length; j++) {
                    if (ordenedAdvertisementsArray[i].id == classPortadaDivs[j].dataset.advertisementId) {

                        alignedDiv(counter);
                        counter++;
                        makeCard(i, i, ordenedAdvertisementsArray);
                    }
                }
            }

            // Muestra un mensaje de error
            errorMessageModal('Algo no ha ido bien...', 'No hay resultados para ordenar.');
            deleteShowErrorModal();

        }
    };

    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Ordena los anuncios por precio ASC
function sortByPriceAsc() {

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        let counter = 0;
        let classPortadaDivs = document.querySelectorAll('.portada');
        let advertisementsArray = [];

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let divToDelete = document.getElementById("notFoundMatchesDiv");

            if (divToDelete !== null) {
                divToDelete.remove();
            }

            divDeleter();

            let divCarousel = document.querySelectorAll(".carouselClass");

            for (let j = 0; j < divCarousel.length; j++) {
                divCarousel[j].remove();
            }

            for (let i = 0; i < data.advertisements.length; i++) {
                advertisementsArray.push(data.advertisements[i]);
            }

            let ordenedAdvertisementsArray = [...advertisementsArray].sort(function (a, b) {
                return a.price - b.price;
            });

            for (let i = 0; i < ordenedAdvertisementsArray.length; i++) {
                for (let j = 0; j < classPortadaDivs.length; j++) {
                    if (ordenedAdvertisementsArray[i].id == classPortadaDivs[j].dataset.advertisementId) {

                        alignedDiv(counter);
                        counter++;
                        makeCard(i, i, ordenedAdvertisementsArray);
                    }
                }
            }
            errorMessageModal('Algo no ha ido bien...', 'No hay resultados para ordenar.');
            deleteShowErrorModal();
        }
    };

    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}


// Ordena los anuncios por precio ASC
function sortByPriceDesc() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        let counter = 0;
        let classPortadaDivs = document.querySelectorAll('.portada');
        let advertisementsArray = [];

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let divToDelete = document.getElementById("notFoundMatchesDiv");

            if (divToDelete !== null) {
                divToDelete.remove();
            }

            divDeleter();

            let divCarousel = document.querySelectorAll(".carouselClass");

            for (let j = 0; j < divCarousel.length; j++) {
                divCarousel[j].remove();
            }

            for (let i = 0; i < data.advertisements.length; i++) {
                advertisementsArray.push(data.advertisements[i]);
            }

            let ordenedAdvertisementsArray = [...advertisementsArray].sort(function (a, b) {
                return b.price - a.price;
            });

            for (let i = 0; i < ordenedAdvertisementsArray.length; i++) {
                for (let j = 0; j < classPortadaDivs.length; j++) {
                    if (ordenedAdvertisementsArray[i].id == classPortadaDivs[j].dataset.advertisementId) {

                        alignedDiv(counter);
                        counter++;
                        makeCard(i, i, ordenedAdvertisementsArray);
                    }
                }
            }
            errorMessageModal('Algo no ha ido bien...', 'No hay resultados para ordenar.');
            deleteShowErrorModal();
        }
    };

    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}


// Ordena los anuncios por potencia ASC
function sortByPowerAsc() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        let counter = 0;
        let classPortadaDivs = document.querySelectorAll('.portada');
        let advertisementsArray = [];

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let divToDelete = document.getElementById("notFoundMatchesDiv");

            if (divToDelete !== null) {
                divToDelete.remove();
            }

            divDeleter();

            let divCarousel = document.querySelectorAll(".carouselClass");

            for (let j = 0; j < divCarousel.length; j++) {
                divCarousel[j].remove();
            }

            for (let i = 0; i < data.advertisements.length; i++) {
                advertisementsArray.push(data.advertisements[i]);
            }

            let ordenedAdvertisementsArray = [...advertisementsArray].sort(function (a, b) {
                return a.motorization_id.power - b.motorization_id.power;
            });

            for (let i = 0; i < ordenedAdvertisementsArray.length; i++) {
                for (let j = 0; j < classPortadaDivs.length; j++) {
                    if (ordenedAdvertisementsArray[i].id == classPortadaDivs[j].dataset.advertisementId) {

                        alignedDiv(counter);
                        counter++;
                        makeCard(i, i, ordenedAdvertisementsArray);
                    }
                }
            }
            errorMessageModal('Algo no ha ido bien...', 'No hay resultados para ordenar.');
            deleteShowErrorModal();
        }
    };

    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Ordena los anuncios por potencia DESC
function sortByPowerDesc() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        let counter = 0;
        let classPortadaDivs = document.querySelectorAll('.portada');
        let advertisementsArray = [];

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let divToDelete = document.getElementById("notFoundMatchesDiv");

            if (divToDelete !== null) {
                divToDelete.remove();
            }

            divDeleter();

            let divCarousel = document.querySelectorAll(".carouselClass");

            for (let j = 0; j < divCarousel.length; j++) {
                divCarousel[j].remove();
            }

            for (let i = 0; i < data.advertisements.length; i++) {
                advertisementsArray.push(data.advertisements[i]);
            }

            let ordenedAdvertisementsArray = [...advertisementsArray].sort(function (a, b) {
                return b.motorization_id.power - a.motorization_id.power;
            });

            for (let i = 0; i < ordenedAdvertisementsArray.length; i++) {
                for (let j = 0; j < classPortadaDivs.length; j++) {
                    if (ordenedAdvertisementsArray[i].id == classPortadaDivs[j].dataset.advertisementId) {

                        alignedDiv(counter);
                        counter++;
                        makeCard(i, i, ordenedAdvertisementsArray);
                    }
                }
            }
            errorMessageModal('Algo no ha ido bien...', 'No hay resultados para ordenar.');
            deleteShowErrorModal();
        }
    };

    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

// Ordena los anuncios por kiómetros ASC
function sortByKm() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {

        let counter = 0;
        let classPortadaDivs = document.querySelectorAll('.portada');
        let advertisementsArray = [];

        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);

            let divToDelete = document.getElementById("notFoundMatchesDiv");

            if (divToDelete !== null) {
                divToDelete.remove();
            }

            divDeleter();

            let divCarousel = document.querySelectorAll(".carouselClass");

            for (let j = 0; j < divCarousel.length; j++) {
                divCarousel[j].remove();
            }

            for (let i = 0; i < data.advertisements.length; i++) {
                advertisementsArray.push(data.advertisements[i]);
            }

            let ordenedAdvertisementsArray = [...advertisementsArray].sort(function (a, b) {
                return a.km - b.km;
            });

            for (let i = 0; i < ordenedAdvertisementsArray.length; i++) {
                for (let j = 0; j < classPortadaDivs.length; j++) {
                    if (ordenedAdvertisementsArray[i].id == classPortadaDivs[j].dataset.advertisementId) {

                        alignedDiv(counter);
                        counter++;
                        makeCard(i, i, ordenedAdvertisementsArray);
                    }
                }
            }
            errorMessageModal('Algo no ha ido bien...', 'No hay resultados para ordenar.');
            deleteShowErrorModal();
        }
    };

    xhttp.open("POST", "../../back/Controllers/listController.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}
