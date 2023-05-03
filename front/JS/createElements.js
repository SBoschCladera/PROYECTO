
/*******************************************      CREACIÓN / ELIMINACIÓN  DE ELEMENTOS    ******************************************************* */

// Crea un div con formato BOOSTRAP que se mostrará en pantalla
function makeCard(cont, cont2, data) {
    let fatherDiv = createDiv("col-md-3 mt-4 portada ml-3 mb-3 anuncio", `advertisementDiv${cont + 1}`);

    let sonDiv = createDiv("card", `sonDivId${cont + 1}`);
    let mainImage = createImage(data[cont].images.foto1, 'card-img-top', `Imagen del modelo ${cont + 1}`);
    sonDiv.appendChild(mainImage);

    let grandsonDiv = createDiv("card-body", `advertisementTextDiv${cont + 1}`);

    let h5 = createH5('card-title', `${data[cont2].brand_id.name} ${data[cont].model_id.name} ${data[cont].model_id.series}`);
    grandsonDiv.appendChild(h5);

    let logo = createImage(data[cont2].brand_id.logo, 'float-right photoLogo', `logo modelo${cont + 1}`);
    grandsonDiv.appendChild(logo);

    let price = createH5('card-text price', `€  ${data[cont].price}`);
    grandsonDiv.appendChild(price);

    let engineType = createParagraf('card-text', `${data[cont].motorization_id.power}CV, ${data[cont].model_id.engineType_id.name}.`);
    grandsonDiv.appendChild(engineType);

    let km = createParagraf('card-text', `${data[cont].km} Km.`);
    grandsonDiv.appendChild(km);

    let link = createLinks('btn btn-primary', `idCar${data[cont].model_id.id}`, '../Views/singleAdvertisement.phtml', 'Ver detalles');
    grandsonDiv.appendChild(link);

    sonDiv.appendChild(grandsonDiv);
    fatherDiv.appendChild(sonDiv);

    document.getElementById('result').appendChild(fatherDiv);
}

// Borra todos los div contenedores de anuncios que se muestran en pantalla
function divDeleter() {
    let div1 = document.querySelectorAll(".anuncio");
    let div2 = document.querySelectorAll(".separatorClass");

    for (let j = 0; j < div1.length; j++) {
        div1[j].remove();
    }

    for (let j = 0; j < div2.length; j++) {
        div2[j].remove();
    }
}

// Condiciones par amaquetado de anuncios en pantalla
function alignedDiv(cont) {
    if (cont > 2 && (cont % 3 == 0)) {
        let separator = createDiv("col-md-2 mt-4 separatorClass", 'separatorDiv')
        result.appendChild(separator);
    }
}

// Crea y devuelve un elemento option <option> para un elemto select según su id, con los parámetros indicados
function createOption(value, text, id, className) {
    let option = document.createElement("option");
    option.value = value;
    option.text = text;
    option.setAttribute('class', className);
    document.getElementById(id).appendChild(option);

    return option;
}

// Crea y devuelve un elemento de imagen <img> con los parámetros indicados
function createImage(url, className, alt) {
    let image = document.createElement("IMG");
    image.setAttribute("src", url);
    image.setAttribute('class', className)
    image.setAttribute("alt", alt);

    return image;
}

// Crea y devuelve un elemento div <div> con los parámetros indicados
function createDiv(className, id) {
    let div = document.createElement('div');
    div.setAttribute('class', className);
    div.setAttribute('id', id);

    return div;
}

// Crea y devuelve un elemento h5 <h5> con los parámetros indicados
function createH5(className, text) {
    let h5 = document.createElement('h5');
    h5.setAttribute('class', className);
    let textH5 = document.createTextNode(text);
    h5.appendChild(textH5);

    return h5;
}

// Crea y devuelve un elemento  párrafo <p> con los parámetros indicados
function createParagraf(className, text) {
    let paragraf = document.createElement('p');
    paragraf.setAttribute('class', className);
    let paragrafText = document.createTextNode(text);
    paragraf.appendChild(paragrafText);

    return paragraf;
}

// Crea y devuelve un elemento enlace <a> con los parámetros indicados
function createLinks(className, id, href, text) {
    let link = document.createElement('a');
    link.setAttribute('class', className);
    link.setAttribute('id', id);
    link.setAttribute('href', href);
    link.setAttribute('target', 'blank');
    let linkText = document.createTextNode(text);
    link.appendChild(linkText);

    return link;

// Crea y devuelve un elemento button <button> con los parámetros indicados
function createButton(type, className, data, text) {
    let button = document.createElement('button');
    button.setAttribute('type', type);
    button.setAttribute('class', className);
    button.setAttribute('data-bs-dismiss', data);
    let textButton = document.createTextNode(text);
    button.appendChild(textButton);

    return button;
}

// Mensaje si no se encuentran resultados
function notFoundMatches() {

    let div1 = createDiv('messageDiv', 'notFoundMatchesDiv');
    let h5 = createH5('notFoundH5', '¿Resultados? No veo nada aquí excepto algunos gatitos adorables. Lo siento.');
    let div2 = createDiv('catsDiv', 'catsId');
    let img1 = createImage('../images/cats/cute-adorable.gif', 'cuteCats', 'gatitos adorables');
    let img2 = createImage('../images/cats/cat-peach.gif', 'cuteCats', 'gatitos adorables');

    div2.appendChild(img1);
    div2.appendChild(img2);   
    div1.appendChild(h5);  
    div1.appendChild(div2);

    let h5b = createH5('notFoundH5b', '¡Inténtalo de nuevo!');
    div1.appendChild(h5b)
    document.getElementById('result').appendChild(div1)

    return div1;
}
