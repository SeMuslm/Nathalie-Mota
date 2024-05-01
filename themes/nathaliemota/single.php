<?php
get_header();

    $posts_photo = get_posts(array( // ARRAY RECUPERANT TOUS LES POSTS
        'posts_per_page' => -1,
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'ASC',
    ));

    // RECUPERE LE THUMBNAIL DU POST ACTUEL DANS UN FORMAT SPECIFIQUE
    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'large');

    // RECUPERE LE POST ACTUEL ET SON INDEX DANS LE TABLEAU
    $current_post_id = get_the_ID();
    $current_post_index = array_search($current_post_id, array_column($posts_photo, 'ID'));

    // RECUPERE LE POST PRECEDENT GRACE A L'INDEX
    $previous_post_index = ($current_post_index > 0) ? $current_post_index - 1 : count($posts_photo) - 1;
    $previous_post = $posts_photo[$previous_post_index];
    $previous_post_id = get_previous_post() ? get_previous_post()->ID : '';

    // RECUPERE LE PROCHAIN POST GRACE A L'INDEX
    $next_post_index = ($current_post_index < count($posts_photo) - 1) ? $current_post_index + 1 : 0;
    $next_post = $posts_photo[$next_post_index];
    $next_post_id = get_next_post() ? get_next_post()->ID : '';

    // EXCLURE LES POSTS EN DEHORS DU PRECEDENT ET DU PROCHAIN
    $posts_exclu = array();
    foreach($posts_photo as $postexclu){
        if($postexclu->ID != $previous_post->ID && $postexclu->ID != $next_post->ID) {
            $posts_exclu[] = $postexclu->ID;
        }
    }
    
    // ARRAY DES POSTS POUR LE CAROUSEL (NAVIGATION)
    $postscarousel = get_posts(array(
        'posts_per_page' => 2,
        'post_type' => 'photos',
        'post__not_in' => $posts_exclu
    ));
?>

<section id="single-page">
    <div id="single">
        <div id="single-left">
            <div id="single-left__desc"> <!-- DESCRIPTION DU POST !--> 
                <h2><?php the_title(); ?></h2>
                <p class="description">Référence : <?php the_field('reference'); ?></p>
                <p class="description">Catégorie : <?php echo get_the_term_list(get_the_ID(), 'categorie', '', ', '); ?></p>
                <p class="description">Format : <?php echo get_the_term_list(get_the_ID(), 'formats', '', ', '); ?></p>
                <p class="description">Type : <?php the_field('type'); ?></p>
                <p class="description">Année : <?php echo get_the_date('Y'); ?></p>                
            </div>
        </div>

        <div id="single-right"> <!-- IMAGE DU POST !--> 
            <img id="single-right__photo" src="<?php echo $thumbnail_url[0]; ?>" alt="<?php echo get_the_title(); ?>">
        </div>

        <div id="single-left__contact"> <!-- CONTACT !--> 
            <p>Cette photo vous intéresse ?</p>
            <button class="bouton-contact" data-reference="<?php the_field('reference')?>">Contact</button> <!-- Le bouton stock la référence de la photo -->  
        </div>
        
        <div id="single-carousel"> <!-- MINI CAROUSEL (NAVIGATION) !--> 
            <div id="carousel-image">
                <?php foreach ($postscarousel as $postcarousel) : setup_postdata($postcarousel); ?>
                    <img src="<?php echo get_the_post_thumbnail_url($postcarousel, 'medium'); ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo $postcarousel->ID; ?>">    
                <?php endforeach; ?>
            </div>
            <div class="fleches">
                <a id="fleche-gauche" data-post-id="<?php echo $previous_post->ID; ?>" href="<?php echo get_permalink($previous_post->ID); ?>"><span>&#8592;</span></a>
                <a id="fleche-droite" data-post-id="<?php echo $next_post->ID; ?>" href="<?php echo get_permalink($next_post->ID); ?>"><span>&#8594;</span></a>    
            </div>
        </div>
    </div>

    <div id="single-photos-apparentees"> <!-- PHOTOS APPARENTEES !--> 
        <h3>Vous aimerez aussi</h3>
        <div class="photo-apparentee">
            <?php
            $terms_categories = array();
            $taxonomies = get_the_terms(get_the_ID(), 'categorie'); // RECUPERE LE TERM DE LA PHOTO
                foreach ($taxonomies as $term) {
                    $terms_categories[]= $term->name;
                }
            
            $post_actuel = get_the_ID();
            $posts = new WP_Query(array(
                'post_type' => 'photos',        
                'posts_per_page' => 2,
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field'    => 'slug',
                        'terms'    => $terms_categories
                    )
                ),
                'post__not_in' => array($post_actuel)
            ));

            if($posts->have_posts()) :
                while($posts->have_posts()) :
                    $posts->the_post();
                    if(has_post_thumbnail()){
                        echo get_template_part('templates_part/photo_block');
                    };
                endwhile;
            else: ?>
            <p class="description" style="display: flex, justify-content: center">Il n'y a actuellement aucun post similaire à celui que vous avez consulté.</p>
            <?
            endif;
            ?>
        </div>
    </div>
</section>

<script>
    var previousPostId = <?php echo json_encode($previous_post_id); ?>;
    var nextPostId = <?php echo json_encode($next_post_id); ?>;
</script>

<?php 
get_footer();

?>
