function pintarMarcas() {

    let xmlhttp = new XMLHttpRequest();
    let url = "./modelos/marcaModelo.php";

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let marcas = JSON.parse(this.responseText);

            // Crea una tabla con los empleados (id, apellidos)
            crearTabla(marcas);

        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.send();
}


// // Crea una tabla con los datos seleccionados,
function crearTabla(datos) {
    let arrayCabecera = ['MARCA', 'LOGO', 'PAIS'];

    let tabla = document.createElement('table');
    tabla.id = "idTabla";
    let caption = document.createElement('caption');
    let contenidoTitulo = document.createTextNode('COCHES');
    caption.appendChild(contenidoTitulo);
    tabla.appendChild(caption);

    let tr = document.createElement('tr');

    for (let i = 0; i < arrayCabecera.length; i++) {
        let td = document.createElement('td');
        let contenido = document.createTextNode(arrayCabecera[i]);
        td.appendChild(contenido);
        tr.appendChild(td);
    }
    tabla.appendChild(tr);
    console.log()
    for (let i = 0; i < datos.length; i++) {
        let tr = document.createElement('tr');

        for (let j = 0; j < 1; j++) {
            let td = document.createElement('td');
            let contenido = document.createTextNode(datos[i].nombre);
            td.appendChild(contenido);
            tr.appendChild(td);
        }

        for (let j = 1; j < 2; j++) {
            let td = document.createElement('td');
            let url = datos[i].logo;

            let imagen = crearImagen(url,'foto_logo');
            td.appendChild(imagen);
            tr.appendChild(td);
        }
        tabla.appendChild(tr);

        for (let j = 2; j < 3; j++) {
            let td = document.createElement('td');
            let contenido = document.createTextNode(datos[i].nombre_pais);
            td.appendChild(contenido);
            tr.appendChild(td);
        }
        tabla.appendChild(tr);

    }
    document.getElementById('salida').appendChild(tabla);

}

function crearImagen(url, clase) {
    let x = document.createElement("IMG");
    x.setAttribute("src", url);
    x.setAttribute("alt", "image");
    x.setAttribute('class', clase)

    return x;
}

window.onload = function () {
    pintarMarcas();
}
