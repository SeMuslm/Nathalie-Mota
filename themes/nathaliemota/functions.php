<?php
function theme_enqueue_styles() {
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css' ); // CSS GÉNÉRAL
    wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/css/fonts.css' ); // CSS POUR LES FONTS
    wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css' ); // CSS RESPONSIVE
    wp_enqueue_style( 'select-style', get_template_directory_uri() . '/css/select2.min.css' ); // CSS SELECT2
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles');

function scripts(){
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, NULL, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), true);
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), true);
    wp_enqueue_script( 'select', get_template_directory_uri() . '/js/select2.min.js', array('jquery'), true);
    wp_enqueue_script( 'font-awesome', 'https://kit.fontawesome.com/eed015c6f7.js', array('jquery'), true);

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

add_action('wp_ajax_pagination_terms', 'pagination_terms');
add_action('wp_ajax_nopriv_pagination_terms', 'pagination_terms');

function pagination_terms() { // FONCTION APPELÉ PAR AJAX
    $page = $_POST['page']; // MÉTHODE UTILISÉE POUR RÉCUPÉRER LA DEMANDE DU CLIENT (PAGE)
    $categories_slug = $_POST['categorieSelectionne'];
    $formats_slug = $_POST['formatsSelectionne'];
    $tri = $_POST['triSelectionne'];

    $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 8,
        'paged' => $page,
    );
    

    if ($categories_slug !== 'categories' && $formats_slug !== 'formats' && $categories_slug !== '' && $formats_slug !== '') {
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categories_slug,
            ),
            array(
                'taxonomy' => 'formats',
                'field' => 'slug',
                'terms' => $formats_slug,
            ),
        );
    }
    elseif ($categories_slug !== 'categories' && $categories_slug !== '') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categories_slug,
            ),
        );
    } 
    elseif ($formats_slug !== 'formats' && $formats_slug !== '') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'formats',
                'field' => 'slug',
                'terms' => $formats_slug,
            ),
        );
    }

    if ($tri === 'desc') { // TRI PAR DATE
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } elseif ($tri === 'asc') {
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
    }

    $query = new WP_Query($args);
    if ($query->have_posts()) { // BOUCLE POUR RÉCUPÉRER CHAQUE POST DANS LA REQUÊTE WP_QUERY ET L'AFFICHER
        while ($query->have_posts()) {
            $query->the_post();
            if (has_post_thumbnail()) {
                echo get_template_part('templates_part/photo_block');
             }
        }
        if($query->max_num_pages <=$page){ // SI LA LIMITE DE PAGE A ÉTÉ ATTEINTE, LE BOUTON "CHARGER PLUS" SERA CACHÉ
            ?>
            <style>
                .bouton-contact {
                    display: none;
                }
            </style>
            <?php }
            wp_reset_postdata();
    }
    wp_die();
}
?>