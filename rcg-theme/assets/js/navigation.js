/**
 * RCG Theme - Navigation mobile
 *
 * Toggle du menu mobile et gestion de l'etat.
 */
(function () {
    'use strict';

    var toggle = document.getElementById('rcg-mobile-toggle');
    var menu = document.getElementById('rcg-mobile-menu');

    if (!toggle || !menu) {
        return;
    }

    toggle.addEventListener('click', function () {
        var isOpen = menu.classList.contains('hidden');

        if (isOpen) {
            menu.classList.remove('hidden');
            menu.classList.add('flex');
            toggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        } else {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    });

    // Fermer le menu si on clique sur un lien
    var links = menu.querySelectorAll('a');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('click', function () {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        });
    }

    // Fermer le menu au resize (passage desktop)
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            menu.classList.add('hidden');
            menu.classList.remove('flex');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    });
})();
