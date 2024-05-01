<?php
function theme_enqueue_styles() { // LES FEUILLES DE STYLE
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css' ); // CSS GÉNÉRAL
    wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/css/fonts.css' ); // CSS POUR LES FONTS EN LOCAL
    wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css' ); // CSS RESPONSIVE
    wp_enqueue_style( 'select-style', get_template_directory_uri() . '/css/select2.min.css' ); // CSS LIBRAIRIE SELECT2
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles');


function scripts(){ // LES SCRIPTS
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, NULL, true );
    wp_enqueue_script( 'jquery' ); // RE-ENREGISTRE LE SCRIPT 'JQUERY' A CAUSE DE CERTAINS PROBLEMES
    
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), true);
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), true);
    wp_enqueue_script( 'font-awesome', get_template_directory_uri() . '/js/fontawesome.js', array('jquery'), true);

    if (is_single()) { // SCRIPTS A CHARGER UNIQUEMENT DANS LA PAGE DU POST
        wp_enqueue_script('carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), true);    
        wp_enqueue_script('single', get_template_directory_uri() . '/js/single.js', array('jquery'), true);
    }

    if(is_front_page()){ // SCRIPTS A CHARGER UNIQUEMENT DANS LA PAGE D'ACCUEIL
        wp_enqueue_script( 'pagination', get_template_directory_uri() . '/js/pagination.js', array('jquery'), true);
        wp_localize_script('pagination', 'ajaxurl', admin_url('admin-ajax.php'));
        wp_enqueue_script( 'select', get_template_directory_uri() . '/js/select2.min.js', array('jquery'), true);
    }
    
}
add_action( 'wp_enqueue_scripts', 'scripts');


function menus(){ // LE MENU HEADER ET FOOTER
    register_nav_menu('header', 'En-tête de la page');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'menus');

function pagination_terms() { // FONCTION APPELÉ PAR AJAX
    $page = $_POST['page']; // RECUPERE LES DONNEES ENVOYÉES PAR AJAX
    $categories_slug = $_POST['categorieSelectionne']; 
    $formats_slug = $_POST['formatsSelectionne'];
    $tri = $_POST['triSelectionne'];

    $args = array( // TABLEAU LISTANT LES POSTS SUIVANTS
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 8,
        'paged' => $page,
    );
    

    if ($categories_slug !== 'categories' && $formats_slug !== 'formats' && $categories_slug !== '' && $formats_slug !== '') { // VERIFIE SI MES TERMS NE SONT PAS VIDES ET DIFFERENTS DE "CATEGORIES" ET "FORMATS"
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
    elseif ($categories_slug !== 'categories' && $categories_slug !== '') { // VERIFIE SI LE TERM EST DIFFERENT DE 'CATEGORIES' ET QU'IL N'EST PAS VIDE
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categories_slug,
            ),
        );
    } 
    elseif ($formats_slug !== 'formats' && $formats_slug !== '') { // VERIFIE SI LE TERM EST DIFFERENT DE 'FORMATS' ET QU'IL N'EST PAS VIDE
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

    $posts = new WP_Query($args);
    if ($posts->have_posts()) { // BOUCLE POUR RÉCUPÉRER CHAQUE POST DANS LA REQUÊTE WP_QUERY ET L'AFFICHER
        while ($posts->have_posts()) {
            $posts->the_post();
            if (has_post_thumbnail()) {
                echo get_template_part('templates_part/photo_block');
             }
        }
        if($posts->max_num_pages <=$page){ // SI LA LIMITE DE PAGE A ÉTÉ ATTEINTE, LE BOUTON "CHARGER PLUS" SERA CACHÉ
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

add_action('wp_ajax_pagination_terms', 'pagination_terms');
add_action('wp_ajax_nopriv_pagination_terms', 'pagination_terms');


// LES TAILLES D'IMAGES
add_image_size('desktop', 1440, 1400);
add_image_size('tablette', 768, 768);
add_image_size('smartphone', 425, 425);
?>