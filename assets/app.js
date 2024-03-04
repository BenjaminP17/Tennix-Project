// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

        // affiche la popup au clik de la navbar sur desktop
        const photo = document.getElementById('photo');
        const menu = document.getElementById('menu');

        photo.addEventListener('click', () => {
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });

        // déroule le menu sur mobile
        const button = document.getElementById('btn');
        const menu2 = document.getElementById('mobile-menu');

        button.addEventListener('click', () => {
            if (menu2.style.display === 'none') {
                menu2.style.display = 'block';
            } else {
                menu2.style.display = 'none';
            }
        });