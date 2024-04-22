<?php               
    $post_thumb_id = get_post_thumbnail_id();
    $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, 'large'); 
    $post_thumb_url_full = wp_get_attachment_image_src($post_thumb_id, 'full'); // ON MET EN FULL POUR LA LIGHTBOX

    $liste_terms = get_the_terms(get_the_ID(), 'categorie'); // RECUPERE LA LISTE DES CATEGORIES (TERMS) AFIN DE LES AFFICHER SOUS FORMAT TEXTE SANS LIEN 
    foreach($liste_terms as $term_name){
        $liste_des_terms[] = $term_name->name;
    }
    ?>

    <div class="single-image">
        <div class="lightbox__preview">
            <a href="<?php echo the_permalink(); ?>"><i class="fa-regular fa-eye"></i></a>
            <i class="fa-solid fa-expand"
            data-post-src="<?php echo $post_thumb_url_full[0]; ?>"
            data-post-alt="<?php echo get_the_title(); ?>"
            data-post-ref="<?php echo get_field('reference'); ?>"
            data-post-cat="<?php echo implode($liste_des_terms); ?>"
            ></i> 
            <p class="description lightbox__preview--reference"><?php echo get_field('reference');?></p>
            <p class="description lightbox__preview--categorie"><?php echo implode($liste_des_terms)?></p>
        </div>
        <a href="<?php the_permalink(); ?>"><img class="photo_block" data-post-src-full="<?php echo $post_thumb_url_full[0]; ?>" src="<?php echo $post_thumb_url[0]; ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo get_the_ID(); ?>"></a>
    </div>