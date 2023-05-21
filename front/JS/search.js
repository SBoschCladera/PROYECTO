document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("searchForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener el valor del campo de entrada
        let searchTerm = document.getElementById("searchInput").value;

        // Realizar la solicitud AJAX al controlador del back-end
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../../back/Controllers/searcherController.php?param=" + encodeURIComponent(searchTerm), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Procesar la respuesta del controlador
                    let data = JSON.parse(xhr.responseText);
                    let advertisements = data.advertisements;

                    //let divCarousel = document.querySelectorAll(".carouselClass");

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
                    makeList(data, advertisements.length);                   

                } else {
                    console.error("Error en la solicitud AJAX. Estado: " + xhr.status);
                } 
                // Añade o elimina la clase 'dark-mode'
                    darkModeCards();
            }
        };
        xhr.send();
    });
});

