<?php
get_header();
while (have_posts()) :
    the_post();

    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');


    $current_post_id = get_the_ID();

    $terms_categories = array();
    $taxonomies = get_the_terms(get_the_ID(), 'categorie');

    if ($taxonomies && !is_wp_error($taxonomies)) {
        foreach ($taxonomies as $term) {

            $terms_categories[]= $term->name;
        }
    }
    
    $postscategories = get_posts(array( //Tableau des posts du CPT photos avec une ordre catégorie
        'post_type' => 'photos',        
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'tax_query' => [
            [
              'taxonomy' => 'categorie',
              'field'    => 'slug',
              'terms'    => $terms_categories
            ]
        ],
        'post__not_in' => array($current_post_id) // Exclure le post actuel de la boucle

    ));


?>

<section id="post-page">
    <div class="container-single">

        <div class="container-single__infos">

            <div class="container-single__infos--description">
            <h2><?php the_title(); ?></h2>
            <p class="description">Référence : <?php the_field('reference'); ?></p>
            <p class="description">Catégorie : <?php echo get_the_term_list(get_the_ID(), 'categorie', '', ', '); ?></p>
            <p class="description">Format : <?php echo get_the_term_list(get_the_ID(), 'formats', '', ', '); ?></p>
            <p class="description">Type : <?php the_field('type'); ?></p>
            <p class="description">Année : <?php the_field('annee'); ?></p>
            </div>

            <div class="container-single__infos--photo">
            <img src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo get_the_title(); ?>">
            </div>

        </div>

        <?php echo get_template_part("templates_part/carousel") ?>

        <!-- <div class="container-single__recommandation">
            <h3>Vous aimerez aussi</h3>
            <div class="container-single__recommandation--images">
            <?php
            foreach ($postscategories as $postcategories){
                setup_postdata($postcategories);
                $thumbnail_id_recommandation = get_post_thumbnail_id($postcategories);
                $thumbnail_url2 = wp_get_attachment_image_src($thumbnail_id_recommandation, 'thumbnail');
                
            ?>
            <div id="recommandation">

                <div class="hover_effect">

                    <a href="<?php echo get_permalink($postcategories->ID); ?>">
                        <img class="eye_icon" src="<?php echo get_template_directory_uri() . "/images/Icons/Icon_eye.png"; ?>" alt="">
                    </a>
                    
                    <img class="fullscreen_icon" src="<?php echo get_template_directory_uri() . "/images/Icons/Icon_fullscreen.png"; ?>" alt="">

                </div>

            <img src="<?php echo $thumbnail_url2[0]; ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo $postcategories->ID; ?>">                
            </div>

            <?php } ?>
            </div>
        </div> -->


    </div>
</section>



<?php endwhile;
get_footer();

?>