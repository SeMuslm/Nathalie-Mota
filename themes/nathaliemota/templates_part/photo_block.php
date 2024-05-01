<?php               
    $post_thumb_id = get_post_thumbnail_id();
    $post_thumb_url_full = wp_get_attachment_image_src($post_thumb_id, 'full'); // FULL POUR LA LIGHTBOX
    $post_thumb_url_medium = wp_get_attachment_image_src($post_thumb_id, 'medium'); // TAILLE NORMALE
    $post_thumb_url_smartphone = wp_get_attachment_image_src($post_thumb_id, 'smartphone'); // POUR LE MOBILE
    $post_thumb_url_tablette = wp_get_attachment_image_src($post_thumb_id, 'tablette'); // POUR LA TABLETTE
    $liste_terms = get_the_terms(get_the_ID(), 'categorie'); // RECUPERE LA LISTE DES CATEGORIES (TERMS) AFIN DE LES AFFICHER SOUS FORMAT TEXTE SANS LIEN 
    foreach($liste_terms as $term_name){
        $liste_des_terms[] = $term_name->name;
    }
    ?>

    <div class="single-image">
        <div class="lightbox__preview"> <!-- PREVISUALISATION DE LA LIGHTBOX AU SURVOL -->
            <a aria-label="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>"><i class="fa-regular fa-eye"></i></a> <!-- L'OEIL DE LA LIGHTBOX -->
            <i class="fa-solid fa-expand"
            data-post-src="<?php echo $post_thumb_url_full[0]; ?>"
            data-post-alt="<?php echo get_the_title(); ?>"
            data-post-ref="<?php echo get_field('reference'); ?>"
            data-post-cat="<?php echo implode($liste_des_terms); ?>"></i> <!-- ICONE PLEINE ÉCRAN CONTENANT LES INFOS UTILES DU POST POUR LA NAVIGATION DANS LA LIGHTBOX !-->
            <p class="description lightbox__preview--reference"><?php echo get_field('reference');?></p>
            <p class="description lightbox__preview--categorie"><?php echo implode($liste_des_terms)?></p>
        </div>
        <img class="photo_block"
        data-post-src-full="<?php echo $post_thumb_url_full[0]; ?>"
        src="<?php echo $post_thumb_url_medium[0]; ?>"
        srcset="
        <?php echo $post_thumb_url_smartphone[0] ?> 425w,
        <?php echo $post_thumb_url_tablette[0] ?> 768w,
        <?php echo $post_thumb_url_medium[0] ?> 1024w"
        sizes="(max-width: 1024px) 50vw, 564px"
        alt="<?php echo get_the_title(); ?>">
    </div>