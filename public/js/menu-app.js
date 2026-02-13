// Todas las rutas para cada menú
let rutasMenu = {
    planes: "/planes",
    sesiones: "/sesiones",
    bicicletas: "/bicicletas",
    bloques: "/bloques",
    resultados: "/resultados",
    perfil: "/perfil",
};

// Cargar menús al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    cargarMenus();
});

// Cargar menús de la API
function cargarMenus() {
    fetch("/api/menus")
        .then((response) => response.json())
        .then((data) => {
            crearMenu(data);
        });
}

// Crear el menú en HTML
function crearMenu(menus) {
    let menu = document.getElementById("menu-principal");
    menu.innerHTML = "";

    for (let key in menus) {
        let nombre = menus[key].nombre;

        // Crear item del menú
        let li = document.createElement("li");
        li.className = "nav-item";

        // Crear enlace
        let a = document.createElement("a");
        a.className = "nav-link";
        a.href = "#";
        a.textContent = nombre;
        a.onclick = function (e) {
            e.preventDefault();
            window.location.href = rutasMenu[key];
        };

        li.appendChild(a);

        // Agregar submenu solo si no es perfil (que no tiene submenu)
        if (key !== "perfil") {
            // Crear submenu vacío
            let submenu = document.createElement("ul");
            submenu.className = "dropdown-menu";
            li.appendChild(submenu);

            let hideTimeout;

            // Cargar submenu con el cursor
            li.addEventListener("mouseenter", function () {
                clearTimeout(hideTimeout);
                submenu.style.display = "block";
                if (submenu.children.length === 0) {
                    cargarSubmenu(key, submenu);
                }
            });

            // Mantener abierto si estás en el submenu
            submenu.addEventListener("mouseenter", function () {
                clearTimeout(hideTimeout);
            });

            // Cerrar con delay largo
            li.addEventListener("mouseleave", function () {
                hideTimeout = setTimeout(function () {
                    submenu.style.display = "none";
                }, 500);
            });

            submenu.addEventListener("mouseleave", function () {
                hideTimeout = setTimeout(function () {
                    submenu.style.display = "none";
                }, 500);
            });
        }

        menu.appendChild(li);
    }
}

// Cargar items del submenu
function cargarSubmenu(menuKey, submenuElement) {
    fetch(`/api/${menuKey}`)
        .then((response) => response.json())
        .then((data) => {
            // Convertir a array
            let items = Object.values(data);

            // Mostrar solo los primeros 5
            items.slice(0, 5).forEach((item) => {
                let li = document.createElement("li");
                let a = document.createElement("a");
                a.href = rutasMenu[menuKey] + "/" + item.id;
                a.textContent = item.nombre || item.id;
                li.appendChild(a);
                submenuElement.appendChild(li);
            });

            // Agregar separador
            let separador = document.createElement("li");
            separador.innerHTML = '<hr class="dropdown-divider">';
            submenuElement.appendChild(separador);

            // Agregar enlace para ver todo
            let verTodo = document.createElement("li");
            let verTodoA = document.createElement("a");
            verTodoA.href = rutasMenu[menuKey];
            verTodoA.textContent = "Ver todo";
            verTodo.appendChild(verTodoA);
            submenuElement.appendChild(verTodo);
        });
}
