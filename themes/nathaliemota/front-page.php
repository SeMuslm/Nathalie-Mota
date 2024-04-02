<?php
get_header();

$heroheader = new WP_Query(array(
    'post_type' => 'photos',        
    'posts_per_page' => 1,
    'orderby' => 'rand',
));

$posts = new WP_query(array(
    'post_type' => 'photos',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'asc',
    'paged' => 1,
));

?>

<main>
    <div id="heroheader">
        <h1>Photographe Event</h1>

        <?php

        if($heroheader->have_posts()){
            $heroheader->the_post();
            $hero_thumbnail = get_post_thumbnail_id();
            $hero_thumbnail_url = wp_get_attachment_image_src($hero_thumbnail, 'full'); ?>

            <img src="<?php echo $hero_thumbnail_url[0] ?>" alt="<?php the_title(); ?>">            
        <?php } ?>


    </div>

    <section>
        <div id="main-menu">
            <div id="liste_photos">
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
            <button id="charger_plus" class="bouton-contact">Charger plus</button>
        </div>
    </section>

</main>

<?php
get_footer();
?>
