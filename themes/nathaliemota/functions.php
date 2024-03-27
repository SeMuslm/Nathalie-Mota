<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'header-style', get_template_directory_uri() . '/css/header.css' );
    wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/css/footer.css' );
    wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/css/fonts.css' );
    wp_enqueue_style( 'animation-style', get_template_directory_uri() . '/css/animations.css' );
    wp_enqueue_style( 'singlepage-style', get_template_directory_uri() . '/css/single-page.css' );
    wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles');


function scripts(){
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), true);
    wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), true);
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), true);
}
add_action( 'wp_enqueue_scripts', 'scripts');


function menus(){
    register_nav_menu('header', 'En-tête de la page');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'menus');





?>