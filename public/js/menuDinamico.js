let menusData = {};

document.addEventListener('DOMContentLoaded', function() {
    cargarDatosMenus();
});

function cargarDatosMenus() {
    fetch('/api/menus')
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            menusData = data;
            crearMenuDinamico();
            
            if (Object.keys(menusData).length > 0) {
                let primeraClave = Object.keys(menusData)[0];
                cargarContenido(primeraClave);
            }
        })
        .catch(function (error) {
            console.error('Error cargando menús:', error);
            mostrarErrorEnMenu();
        });
}

function mostrarErrorEnMenu() {
    let menuDinamico = document.getElementById('menu-dinamico');
    
    while (menuDinamico.firstChild) {
        menuDinamico.removeChild(menuDinamico.firstChild);
    }
    
    let parrafoError = document.createElement("p");
    parrafoError.textContent = "Error cargando menús";
    menuDinamico.appendChild(parrafoError);
}

function crearMenuDinamico() {
    let menuContainer = document.getElementById('menu-dinamico');
    
    while (menuContainer.firstChild) {
        menuContainer.removeChild(menuContainer.firstChild);
    }
    
    let claves = Object.keys(menusData);

    for (let i = 0; i < claves.length; i++) {
        let clave = claves[i];
        let menuInfo = menusData[clave];

        let boton = document.createElement('button');
        boton.textContent = menuInfo.nombre + ' (' + menuInfo.cantidad + ')';
        boton.className = 'menu-btn';
        boton.setAttribute('data-tipo', clave);

        boton.onclick = (function (tipo) {
            return function () {
                cargarContenido(tipo);
            };
        })(clave);

        menuContainer.appendChild(boton);
    }
}

function cargarContenido(tipo) {
    let contenidoDiv = document.getElementById('contenido-dinamico');
    let menuInfo = menusData[tipo];
    
    limpiarContenido(contenidoDiv);
    mostrarMensajeCarga(contenidoDiv, menuInfo.nombre);

    fetch('/api/' + tipo)
        .then(function (response) {
            return response.json();
        })
        .then(function (datosReales) {
            mostrarDatosReales(contenidoDiv, menuInfo, tipo, datosReales);
        })
        .catch(function (error) {
            mostrarErrorContenido(contenidoDiv, menuInfo.nombre);
        });
}

function limpiarContenido(contenidoDiv) {
    while (contenidoDiv.firstChild) {
        contenidoDiv.removeChild(contenidoDiv.firstChild);
    }
}

function mostrarMensajeCarga(contenidoDiv, nombreMenu) {
    let h3 = document.createElement("h3");
    h3.textContent = "Cargando " + nombreMenu + "...";
    contenidoDiv.appendChild(h3);
}

function mostrarDatosReales(contenidoDiv, menuInfo, tipo, datos) {
    limpiarContenido(contenidoDiv);
    
    let h3 = document.createElement("h3");
    h3.textContent = menuInfo.nombre;
    contenidoDiv.appendChild(h3);
    
    let pCantidad = document.createElement("p");
    pCantidad.textContent = "Cantidad: " + menuInfo.cantidad;
    contenidoDiv.appendChild(pCantidad);
    
    if (Array.isArray(datos) && datos.length > 0) {
        let lista = document.createElement("ul");
        
        for (let i = 0; i < datos.length; i++) {
            let item = document.createElement("li");
            
            // Formatear cada dato
            let textoDato = "";
            for (let clave in datos[i]) {
                if (datos[i].hasOwnProperty(clave)) {
                    textoDato += clave + ": " + datos[i][clave] + ", ";
                }
            }
            // Quitar última coma
            textoDato = textoDato.slice(0, -2);
            
            item.textContent = textoDato;
            lista.appendChild(item);
        }
        
        contenidoDiv.appendChild(lista);
    } else if (typeof datos === 'object' && datos !== null) {
        // Si es un objeto simple
        let divDatos = document.createElement("div");
        divDatos.className = "datos-objeto";
        
        for (let clave in datos) {
            if (datos.hasOwnProperty(clave)) {
                let p = document.createElement("p");
                p.textContent = clave + ": " + datos[clave];
                divDatos.appendChild(p);
            }
        }
        
        contenidoDiv.appendChild(divDatos);
    } else {
        // Datos simples
        let pDatos = document.createElement("p");
        pDatos.textContent = "Datos: " + datos;
        contenidoDiv.appendChild(pDatos);
    }
    
    // Información del tipo
    let pTipo = document.createElement("p");
    pTipo.textContent = "Tipo de consulta: " + tipo;
    pTipo.style.fontStyle = "italic";
    pTipo.style.color = "#666";
    contenidoDiv.appendChild(pTipo);
}

function mostrarErrorContenido(contenidoDiv, nombreMenu) {
    limpiarContenido(contenidoDiv);
    
    let p = document.createElement("p");
    p.textContent = "Error cargando " + nombreMenu;
    p.style.color = "red";
    contenidoDiv.appendChild(p);
}