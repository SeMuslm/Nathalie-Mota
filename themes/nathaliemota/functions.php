<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/css/footer.css' );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles');

function menus(){
    register_nav_menu('header', 'En-tête de la page');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'menus');






?>