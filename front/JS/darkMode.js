// Añade la clase 'dark-mode'.
function setDarkMode() {
    let body = document.body;
    let cardDarkMode = document.getElementById('cardSearcher');
    let barNav = document.getElementById('barNav');
    let advertisementCard = document.getElementsByClassName('advertisementCard');
    let cardInfoCar = document.getElementsByClassName('cardInfoCar');

    let barNavStyles = document.getElementById('barNav');
    let signUpLink = document.getElementById('signUpLink');
    let loginLink = document.getElementById('loginLink');
    let sellYourCar = document.getElementById('sellYourCar');
    let searchButton = document.getElementById('searchButton');
    let searchSelect = document.getElementById('searchSelect');

    // Elimina las clases de estilos de bootstrap
    barNavStyles.classList.remove("navbar-light");
    barNavStyles.classList.remove('bg-light');

    if (signUpLink) {
        signUpLink.classList.remove('bg-light');
    }

    loginLink.classList.remove('bg-light');
    sellYourCar.classList.remove('bg-light');
    searchButton.classList.remove('bg-light');
    searchSelect.classList.remove('bg-light');

    // Añade clases para el modo oscuro
    body.classList.toggle("dark-mode");
    cardDarkMode.classList.toggle("dark-mode");
    barNav.classList.toggle("dark-mode");

    if (signUpLink) {
        signUpLink.classList.toggle("dark-mode");
    }

    loginLink.classList.toggle("dark-mode");
    sellYourCar.classList.toggle("dark-mode");
    searchButton.classList.toggle("dark-mode");
    searchSelect.classList.toggle("dark-mode");

    for (let i = 0; i < advertisementCard.length; i++) {
        advertisementCard[i].classList.toggle("dark-mode");
    }

    for (let i = 0; i < cardInfoCar.length; i++) {
        cardInfoCar[i].classList.toggle("dark-mode");
    }

    // Añade botón de evento para volver a las clases cuando no está activo el modo oscuro
    document.getElementById('oscuro').addEventListener('click', setBootstrapStyles);
    document.getElementById('sellYourCar').addEventListener('click', setBootstrapStyles);
    document.getElementById('searchButton').addEventListener('click', setBootstrapStyles);
    document.getElementById('searchSelect').addEventListener('click', setBootstrapStyles);

    if (signUpLink) {
        document.getElementById('signUpLink').addEventListener('click', setBootstrapStyles);
    }
    
    document.getElementById('loginLink').addEventListener('click', setBootstrapStyles);
}



// Añade o elimina la clase 'dark-mode' en los anuncios
function darkModeCards() {
    let advertisementCard = document.getElementsByClassName('advertisementCard');

    if (document.body.classList.contains('dark-mode')) {
        for (let i = 0; i < advertisementCard.length; i++) {
            advertisementCard[i].classList.toggle("dark-mode");
        }
    } else {
        for (let i = 0; i < advertisementCard.length; i++) {
            advertisementCard[i].classList.remove("dark-mode");
        }
    }
}

// Añade los estilos de bootstrap que tenía antes del modo oscuro
function setBootstrapStyles() {
    let barNavStyles = document.getElementById('barNav');
    let signUpLink = document.getElementById('signUpLink');
    let loginLink = document.getElementById('loginLink');
    let sellYourCar = document.getElementById('sellYourCar');
    let searchButton = document.getElementById('searchButton');
    let searchSelect = document.getElementById('searchSelect');

    if (!document.body.classList.contains('dark-mode')) {
        barNavStyles.classList.toggle("navbar-light");
        barNavStyles.classList.toggle('bg-light');
        sellYourCar.classList.toggle('bg-light');
        searchButton.classList.toggle('bg-light');
        searchSelect.classList.toggle('bg-light');

        if (signUpLink) {
            signUpLink.classList.toggle('bg-light');
        }
        loginLink.classList.toggle('bg-light');
    }
}
