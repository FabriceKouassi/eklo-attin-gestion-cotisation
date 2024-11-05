document.addEventListener('DOMContentLoaded', function() {
    var menu = document.getElementById('menu_secondaire');

    // Fonction pour masquer le menu
    function masquerMenu() {
        menu.style.display = 'none';
    }

    function estDansMenu(element) {
        return element.closest('#menu_secondaire') !== null;
    }
    function estHorsMenu(element) {
        return element.closest('#mobile_menu_icon1') !== null;
    }
    function estHorsMenu2(element) {
        return element.closest('#mobile_menu_icon') !== null;
    }
    function estHorsMenu(element) {
        return element.closest('#mobile_menu_icon1') !== null;
    }

    document.addEventListener('click', function(event) {
        if (!estDansMenu(event.target) && !estHorsMenu(event.target) && !estHorsMenu2(event.target)) {
            masquerMenu();
        }
    });

    // Écouter les clics sur le menu pour éviter de le masquer lorsqu'on y clique
    menu.addEventListener('click', function(event) {
        event.stopPropagation(); // Empêcher la propagation du clic à l'extérieur du menu
    });
});


function showSecondMenu() {
    const menu = document.querySelector('#menu_secondaire')
    menu.style.display = "block"
}

function closeSecondMenu() {
    const menu = document.querySelector('#menu_secondaire')
    menu.style.display = "none"
}

function showSubMenu(link) {
    link.parentNode.querySelector('.mobile-submenu').classList.toggle('mobile-submenu-active');
    // link.parentNode.querySelector('.mobile-submenu').style.transition = 'all 0.5s ease'
}

function showSubSubMenu(link) {
    link.parentNode.querySelector('.mobile-subsubmenu').classList.toggle('mobile-subsubmenu-active');
    // link.parentNode.querySelector('.mobile-submenu').style.transition = 'all 0.5s ease'
}