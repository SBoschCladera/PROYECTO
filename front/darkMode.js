// Añade la clase 'dark-mode'.
function setDarkMode() {
    let body = document.body;
    let cardDarkMode = document.getElementById('cardSearcher');
    let barNav = document.getElementById('barNav');
    let advertisementCard = document.getElementsByClassName('advertisementCard');

    let barNavStyles = document.getElementById('barNav');
    let signUpLink = document.getElementById('signUpLink');
    let loginLink = document.getElementById('loginLink');

    // Elimina las clases de estilos de bootstrap
    barNavStyles.classList.remove("navbar-light");
    barNavStyles.classList.remove('bg-light');

    if (signUpLink) {
        signUpLink.classList.remove('bg-light');
    }

    loginLink.classList.remove('bg-light');

    // Añade clases para el modo oscuro
    body.classList.toggle("dark-mode");
    cardDarkMode.classList.toggle("dark-mode");
    barNav.classList.toggle("dark-mode");

    if (signUpLink) {
        signUpLink.classList.toggle("dark-mode");
    }

    loginLink.classList.toggle("dark-mode");

    for (let i = 0; i < advertisementCard.length; i++) {
        advertisementCard[i].classList.toggle("dark-mode");
    }

    // Añade botón de evento para volver a las clases cuando no está activo el modo oscuro
    document.getElementById('oscuro').addEventListener('click', setBootstrapStyles);

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

    if (!document.body.classList.contains('dark-mode')) {
        barNavStyles.classList.toggle("navbar-light");
        barNavStyles.classList.toggle('bg-light');

        if (signUpLink) {
            signUpLink.classList.toggle('bg-light');
        }

        loginLink.classList.toggle('bg-light');
    }
}

// // Guarda en  el almacenamiento local del navegador la clase para el modo oscuro para compartir datos entre las páginas
// function saveBodyClassInLocalStorage() {
//     const body = document.body;
//     const bodyClass = body.className;

//         // Guardar la clase en el almacenamiento local
//         localStorage.setItem("classBody", bodyClass);   
// }

// // Devuelve la clase para el modo oscuro guarada en el almacenamiento local del navegador
// function displayBodyClassFromLocalStorage() {
//     const claseBody = localStorage.getItem("classBody");

//     return claseBody;
// }

//function removeBodyClassInLocalStorage() {
    //     const body = document.body;
    //     const bodyClass = body.className;
    
    //     localStorage.removeItem("classBody", bodyClass);
    // }
//}    