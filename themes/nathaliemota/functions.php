<?php

function theme_enqueue_styles() {
    
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/css/fonts.css' );
    wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles');


function scripts(){
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), true);
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), true);



    if (is_single()) {    // SCRIPTS A CHARGER UNIQUEMENT DANS LA PAGE DU POST
        wp_enqueue_script('carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), true);        
        wp_enqueue_script('single', get_template_directory_uri() . '/js/single.js', array('jquery'), true);
    }


    if(is_front_page()){    // SCRIPTS A CHARGER UNIQUEMENT DANS LA PAGE D'ACCUEIL
        wp_enqueue_script( 'pagination', get_template_directory_uri() . '/js/pagination.js', array('jquery'), true);
        wp_localize_script('pagination', 'ajaxurl', admin_url('admin-ajax.php'));

    }
    
}
add_action( 'wp_enqueue_scripts', 'scripts');


function menus(){
    register_nav_menu('header', 'En-tête de la page');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'menus');



add_action('wp_ajax_pagination', 'pagination');
add_action('wp_ajax_nopriv_pagination', 'pagination');

function pagination() { // FONCTION APPELÉ PAR AJAX
    $page = $_POST['page']; // MÉTHODE UTILISÉE POUR RÉCUPÉRER LA DEMANDE DU CLIENT (PAGE)
    $posts = new WP_Query(array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'ASC',
        'paged' => $page,
    ));

    if ($posts->have_posts()) { // BOUCLE POUR RÉCUPÉRER CHAQUE POST DANS LA REQUÊTE WP_QUERY ET L'AFFICHER
        while ($posts->have_posts()) {
            $posts->the_post();
            if (has_post_thumbnail()) {
                $post_thumb_id = get_post_thumbnail_id();
                $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, 'large'); ?>
                <div class="single-image">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $post_thumb_url[0]; ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo get_the_ID(); ?>"></a>
                </div>
            <?php }
        }
        
        if ($posts->max_num_pages <= $page) { //SI LE TABLEAU ATTEINT LA DERNIERE PAGE, LE BOUTON DISPARAIT ?>
            <style>
                .bouton-contact {
                    display: none;
                }
            </style>
        <?php }
    }
    wp_die();
}

?>