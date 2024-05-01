<?php
get_header();

$heroheader = new WP_Query(array( // WP QUERY POUR LE HERO
    'post_type' => 'photos',        
    'posts_per_page' => 1,
    'orderby' => 'rand',
));

$posts = new WP_query(array( // WP QUERY POUR LES POSTS RÉCENTS
    'post_type' => 'photos',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'ASC',
    'paged' => 1,
));

$categories_terms = get_terms(array( // RÉCUPÈRE LES TERMS DE CATÉGORIES
    'taxonomy' => 'categorie',
));

$formats_terms = get_terms(array( // RÉCUPÈRE LES TERMS DE FORMATS
    'taxonomy' => 'formats',
));
?>

<main>
    <div id="heroheader"> <!-- LE HERO !-->
        <h1>Photographe Event</h1>
        <?php if($heroheader->have_posts()){
                $heroheader->the_post();
                $hero_thumbnail = get_post_thumbnail_id();
                $hero_thumbnail_url = wp_get_attachment_image_src($hero_thumbnail, 'full');
                $hero_thumbnail_url_desktop = wp_get_attachment_image_src($hero_thumbnail, 'large');
                $hero_thumbnail_url_tablette = wp_get_attachment_image_src($hero_thumbnail, 'tablette');
                $hero_thumbnail_url_smartphone = wp_get_attachment_image_src($hero_thumbnail, 'smartphone');
                ?>
                <img
                src="<?php echo $hero_thumbnail_url[0] ?>"
                srcset="
                <?php echo $hero_thumbnail_url_smartphone[0] ?> 425w,
                <?php echo $hero_thumbnail_url_tablette[0] ?> 768w,
                <?php echo $hero_thumbnail_url_desktop[0] ?> 1024w,
                <?php echo $hero_thumbnail_url[0] ?> 1440w"
                sizes="(max-width: 1440px) 50vw, 1440px"
                alt="<?php the_title(); ?>" >
        <?php } ?>
    </div>

    <section>
        <div id="main-menu">
            <div id="select-container"> <!-- LES FILTRES !-->
                <div id="select-container-left">
                    <div class="select-container__filtre"> <!-- FILTRE CATEGORIE !-->
                        <select name="categories" id="categories-select"> 
                            <option selected hidden value="categories">Catégories</option>
                            <?php 
                            foreach($categories_terms as $term){ ?>
                                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <div class="select-container__filtre"> <!-- FILTRE FORMAT !-->
                        <select name="formats" id="formats-select">
                            <option disabled selected value='formats'>formats</option>
                            <?php 
                            foreach($formats_terms as $term){ ?>
                                <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id="select-container-right"> <!-- FILTRE DATE !-->
                    <div class="select-container__filtre">
                        <select name="tri" id="tri-select">
                            <option disabled selected>Trier par</option>
                            <option value="asc">A partir des plus récentes</option>
                            <option value="desc">A partir des plus anciennes</option>
                        </select>
                    </div>
                </div>

            </div>

            <div id="liste_photos"> <!-- LES POSTS !-->
                <?php
                    if( $posts->have_posts() ) : 
                        while( $posts->have_posts() ) : 
                            $posts->the_post();
                            if(has_post_thumbnail()){
                                echo get_template_part('templates_part/photo_block');
                            }
                        endwhile;
                    endif; 
                ?>
            </div>
            <button class="bouton-contact">Charger plus</button>
        </div>
    </section>
</main>
<?php
get_footer();
?>