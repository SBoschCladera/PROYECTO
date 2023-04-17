const numResultados = 12;

function pintarAnuncios() {

    let xmlhttp = new XMLHttpRequest();
    let url = "./modelos/anunciosModelo.php";

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let anuncios = JSON.parse(this.responseText);

            // Crea una lista de anuncios
            crearLista(anuncios);

        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.send();
}

function crearLista(datos) {

    for (let i = 0; i < numResultados; i++) {

        if (i > 2 && (i % 3 == 0)) {
            let divSeparador = crearDiv("col-md-2 mt-4", 'divSeparador')
            salida.appendChild(divSeparador);
        }

        let divPadre = crearDiv("col-md-3 mt-4 portada ml-3 mb-3", `divAnuncio${i}`);
        divPadre.setAttribute('id', salida);

        let divHijo = crearDiv("card");
        let imagen = crearImagen(datos[i].foto1, 'card-img-top', `Imagen del modelo ${i + 1}`);
        divHijo.appendChild(imagen);

        let divHijoHijo = crearDiv("card-body", `divtextoAnuncio`);

        

        let h5 = crarH5('card-title', `${datos[i].marca} ${datos[i].modelo} ${datos[i].serie}`);
        divHijoHijo.appendChild(h5);

        let logo = crearImagen(datos[i].logo, 'float-right fotoLogo', `logo modelo${i + 1}`);
        divHijoHijo.appendChild(logo);
        
        let precio = crarH5('card-text precio', `€ ${datos[i].precio}`);
        divHijoHijo.appendChild(precio);

        let tipoMotor = crearParrafo('card-text', `${datos[i].potencia}CV, ${datos[i].tipoMotor}.`);
        divHijoHijo.appendChild(tipoMotor);

        let kilometraje = crearParrafo('card-text', `${datos[i].kilometraje} Km.`);
        divHijoHijo.appendChild(kilometraje);

        let enlace = crearEnlace('btn btn-primary', '#', 'Ver detalles');
        divHijoHijo.appendChild(enlace);

        divHijo.appendChild(divHijoHijo);
        divPadre.appendChild(divHijo);

        document.getElementById('salida').appendChild(divPadre);
    }
}

function crearImagen(url, clase, alt) {
    let x = document.createElement("IMG");
    x.setAttribute("src", url);
    x.setAttribute('class', clase)
    x.setAttribute("alt", alt);

    return x;
}

function crearDiv(clase, id) {
    let div = document.createElement('div');
    div.setAttribute('class', clase);
    div.setAttribute('id', id);

    return div;
}

function crarH5(clase, texto) {
    let h5 = document.createElement('h5');
    h5.setAttribute('class', clase);
    let textoH5 = document.createTextNode(texto);
    h5.appendChild(textoH5);

    return h5;
}

function crearParrafo(clase, texto) {
    let parrafo = document.createElement('p');
    parrafo.setAttribute('class', clase);
    let textoParrafo = document.createTextNode(texto);
    parrafo.appendChild(textoParrafo);

    return parrafo;
}

function crearEnlace(clase, href, texto) {
    let enlace = document.createElement('a');
    enlace.setAttribute('class', clase);
    enlace.setAttribute('href', href)
    let textoEnlace = document.createTextNode(texto);
    enlace.appendChild(textoEnlace);

    return enlace;
}

window.onload = function () {
    pintarAnuncios();
}
