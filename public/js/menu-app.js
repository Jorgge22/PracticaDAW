// bjeto para guardar los menús
let menusApp = {};

// Cuando la pagina cargue
document.addEventListener("DOMContentLoaded", function () {
    cargarMenus();
});

function cargarMenus() {
    // Obtener menus de la API
    fetch("/api/menus")
        .then(response => response.json())
        .then(data => {
            menusApp = data;
            crearMenu();
        })
}

function crearMenu() {
    let menu = document.getElementById('menu-principal');
    if (!menu) return;

    // Recorrer cada menú y crear su estructura
    for (let key in menusApp) {
        let item = menusApp[key];
        
        // Crear elemento del menú
        let menuItem = document.createElement('li');
        menuItem.className = 'nav-item dropdown';
        
        // Crear enlace del menú
        let link = document.createElement('a');
        link.className = 'nav-link dropdown-toggle';
        link.href = (key === 'perfil') ? '/perfil' : '#';
        link.textContent = item.nombre;
        
        // Crear contenedor del submenú
        let submenu = document.createElement('div');
        submenu.className = 'dropdown-menu';
        submenu.style.display = 'none';
        
        // Agregar elementos al menú
        menuItem.appendChild(link);
        menuItem.appendChild(submenu);
        menu.appendChild(menuItem);
        
        // Si no estamos en "perfil", cargar submenú al pasar el ratón
        if (key !== 'perfil') {
            menuItem.addEventListener('mouseenter', () => {
                cargarSubmenu(key, submenu);
                submenu.style.display = 'block';
            });
            
            menuItem.addEventListener('mouseleave', () => {
                submenu.style.display = 'none';
            });
        }
    }
}

function cargarSubmenu(menuKey, submenuElement) {
    // Evitar cargar dos veces el mismo submenú
    if (submenuElement.dataset.loaded) return;
    
    // Obtener datos del submenú
    fetch(`/api/${menuKey}`)
        .then(response => response.json())
        .then(data => {
            // Limpiar submenú
            submenuElement.innerHTML = '';
            
            // Convertir datos a array y tomar primeros 5
            let items = Array.isArray(data) 
                ? data.slice(0, 5) 
                : Object.values(data).slice(0, 5);
            
            // Si no hay datos
            if (!items.length) {
                let emptyItem = document.createElement('a');
                emptyItem.className = 'dropdown-item disabled';
                emptyItem.href = '#';
                emptyItem.textContent = 'Sin datos';
                submenuElement.appendChild(emptyItem);
            } else {
                // Crear cada item del submenú
                items.forEach(item => {
                    let submenuItem = document.createElement('a');
                    submenuItem.className = 'dropdown-item';
                    submenuItem.href = '#';
                    submenuItem.textContent = item.nombre || item.id || 'Item';
                    submenuElement.appendChild(submenuItem);
                });
            }
            
            // Marcar como cargado
            submenuElement.dataset.loaded = 'true';
        })
        .catch(error => {
            console.error("Error cargando submenú:", error);
        });
}