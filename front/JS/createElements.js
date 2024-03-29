
/*******************************************      CREACIÓN / ELIMINACIÓN  DE ELEMENTOS    ******************************************************* */

// Crea un div con formato BOOSTRAP que se mostrará en pantalla
function makeCard(cont, cont2, data) {
    let fatherDiv = createDiv("col-md-3 mt-4 portada ml-3 mb-3 anuncio", `advertisementDiv${cont + 1}`);
    fatherDiv.dataset.advertisementId = data[cont].id;

    let sonDiv = createDiv("card advertisementCard", `sonDivId${cont + 1}`);
    let mainImage = createImage(data[cont].images.foto1, 'card-img-top', `Imagen del modelo ${cont + 1}`);
    sonDiv.appendChild(mainImage);

    let grandsonDiv = createDiv("card-body", `advertisementTextDiv${cont + 1}`);

    let h5 = createH5('card-title', `${data[cont2].brand_id.name} ${data[cont].model_id.name} ${data[cont].model_id.series}`);
    grandsonDiv.appendChild(h5);

    let logo = createImage(data[cont2].brand_id.logo, 'float-right photoLogo', `logo modelo${cont + 1}`);
    grandsonDiv.appendChild(logo);

    let formattedPrice = (data[cont].price).toLocaleString();
    let price = createH5('card-text price', `€  ${formattedPrice}`);
    grandsonDiv.appendChild(price);

    let engineType = createParagraf('card-text', `${data[cont].motorization_id.power}CV, ${data[cont].model_id.engineType_id.name}.`);
    grandsonDiv.appendChild(engineType);

    let formattedKm = (data[cont].km).toLocaleString();
    let km = createParagraf('card-text', `${formattedKm} Km.`);
    grandsonDiv.appendChild(km);

    let link = createLinks('btn btn-primary', `idCar${data[cont].model_id.id}`, ` ../Controllers/singleAdvertisementController.php?id=${data[cont].id}`, 'Ver detalles');
    grandsonDiv.appendChild(link);

    sonDiv.appendChild(grandsonDiv);
    fatherDiv.appendChild(sonDiv);

    document.getElementById('result').appendChild(fatherDiv);
}

// Borra todos los div contenedores de anuncios que se muestran en pantalla
function divDeleter() {
    let div1 = document.querySelectorAll(".anuncio");
    let div2 = document.querySelectorAll(".separatorClass");
    let div3 = document.querySelectorAll(".carouselClass");

    for (let j = 0; j < div1.length; j++) {
        div1[j].remove();
    }

    for (let j = 0; j < div2.length; j++) {
        div2[j].remove();
    }

    for (let j = 0; j < div3.length; j++) {
        div3[j].remove();
    }
}

// Condiciones para maquetado de anuncios en pantalla
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
}

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
function notFoundMatches(id) {
    let div1 = createDiv('messageDiv', 'notFoundMatchesDiv');
    let h5 = createH5('notFoundH5', '¿Resultados? No veo nada aquí excepto algunos gatitos adorables. Lo siento.');
    let div2 = createDiv('catsDiv', 'catsId');
    let img1 = createImage('../images/cats/cute-adorable.gif', 'cuteCats', 'gatitos adorables');
    let img2 = createImage('../images/cats/cat-peach.gif', 'cuteCats', 'gatitos adorables');

    div2.appendChild(img1);
    div2.appendChild(img2);
    div1.appendChild(h5);
    div1.appendChild(div2);

    let h5b = createH5('notFoundH5b', '¡Inténtalo de nuevo!"');
    div1.appendChild(h5b);
    document.getElementById(id).appendChild(div1);

    return div1;
}

// Muestra mensaje de no resultado par el buscador
function notResults(counter) {
    if (counter < 1) {
        notFoundMatches('result');
    }
}

// Mensaje si no se encuentran resultados
function notFoundMatches(id) {
    let div1 = createDiv('messageDiv', 'notFoundMatchesDiv');
    let h5 = createH5('notFoundH5', '¿Resultados? No veo nada aquí excepto algunos gatitos adorables. Lo siento.');
    let div2 = createDiv('catsDiv', 'catsId');
    let img1 = createImage('../images/cats/cute-adorable.gif', 'cuteCats', 'gatitos adorables');
    let img2 = createImage('../images/cats/cat-peach.gif', 'cuteCats', 'gatitos adorables');

    div2.appendChild(img1);
    div2.appendChild(img2);
    div1.appendChild(h5);
    div1.appendChild(div2);

    let h5b = createH5('notFoundH5b', '¡Inténtalo de nuevo!"');
    div1.appendChild(h5b);
    document.getElementById(id).appendChild(div1);

    return div1;
}

// Modal para mensaje de error
function notSelectedFilter(id, title, message) {
    let div1 = createDiv('modal fade modalClass', 'myModal');
    div1.setAttribute('tabindex' ,'-1');
    div1.setAttribute('role', 'dialog');
    div1.setAttribute('aria-labelledby', 'exampleModalLabel'),
    div1.setAttribute('aria-hidden','true');

    let div2 = createDiv('modal-dialog modal-dialog-centered', 'div2Id');
    div2.setAttribute('role', 'dialog');    

    let div3 = createDiv('modal-content', 'div3Id');
    div2.appendChild(div3);

    div4 = createDiv('modal-header', 'div4Id');
    let h51 = createH5('modal-title', title);
    h51.setAttribute('id', 'h5HeaderId');
    div4.appendChild(h51);
    let boton1 = createButton('button', 'btn-close', 'dataset-buttonClose', '');
    div4.appendChild(boton1);
    div3.appendChild(div4);

    div5= createDiv('modal-body', 'div5Id');
    let h52 = createH5('modal-title', message);
    h52.setAttribute('id', 'h5BodyId');
    div5.appendChild(h52);
    div3.appendChild(div5);

    div6 = createDiv('modal-footer', 'div6Id');    
    let boton2 = createButton('button', 'btn btn-primary', 'dataset-buttonClose', 'Aceptar');
    div6.setAttribute('data-bs-dismiss', 'modal')
    div6.appendChild(boton2);
    div3.appendChild(div6);

    div1.appendChild(div2);

    document.getElementById(id).appendChild(div1);

    return div1;
}

// Muestra el mensaje de error en un modal Bootstrap
function errorMessageModal(title, message){
    if (document.getElementById('result').children.length < 2) {

        let divModal = notSelectedFilter('result', title, message)
        var modal = new bootstrap.Modal(document.getElementById('myModal'));
        modal.show();
    }
}

// Elimina los modal del HTML
function deleteShowErrorModal(){
    let modalDiv = document.querySelectorAll(".modalClass");

    for (let j = 0; j < modalDiv.length; j++) {
        modalDiv[j].remove();
    }
}

  