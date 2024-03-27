<?php


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
            foreach ($postscategories as $postcategories){
                setup_postdata($postcategories);
                $thumbnail_id_recommandation = get_post_thumbnail_id($postcategories);
                $thumbnail_url2 = wp_get_attachment_image_src($thumbnail_id_recommandation, 'thumbnail');
                
            ?>
            <div class="single-image">
            <img src="<?php echo $thumbnail_url2[0]; ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo $postcategories->ID; ?>">                
            </div>
            <?php } ?>