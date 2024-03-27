<?php
get_header();
while (have_posts()) :
    the_post();

    $thumbnail_id = get_post_thumbnail_id();
    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');

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

        <div class="container-single__recommandation">
            <h3>Vous aimerez aussi</h3>
            <div class="container-single__recommandation--images">

            <?php echo get_template_part("templates_part/photo_block"); ?>

            </div>
        </div>


    </div>
</section>



<?php endwhile;
get_footer();

?>