<?php
get_header(); ?>

<?php
$heroheader = get_posts(array( //Tableau des posts du CPT photos avec une ordre catégorie
    'post_type' => 'photos',        
    'posts_per_page' => 1,
    'orderby' => 'RAND',
));

$posts = get_posts(array(
    'post_type' => 'photos',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'ASC'
))
?>

<main>
    <div id="heroheader">
        <h1>Photographe Event</h1>
        <?php
        foreach($heroheader as $hero){
            setup_postdata($hero);
            $hero_thumbnail = get_post_thumbnail_id($hero);
            $hero_thumbnail_url = wp_get_attachment_image_src($hero_thumbnail, 'full');
            ?>
            <img src="<?php echo $hero_thumbnail_url[0] ?>" alt="<?php the_title();?>">
        <?php
        }
        ?> 
    </div>

    <section>

        <!-- <div id="filtres">

            <select name="categories" id="categories-select">
                <option value="categories">Catégories</option>
                <option value=""></option>
                <option value="reception">Réception</option>
                <option value="television">Télévision</option>
                <option value="concert">Concert</option>
                <option value="mariage">Mariage</option>
            </select>

            <select name="formats" id="formats-select">
                <option value="formats">Formats</option>
                <option value="portrait">Portrait</option>
                <option value="paysage">Paysage</option>
                <option value="11">1/1</option>
                <option value="44">4/4</option>
            </select>

            <select name="trier" id="trier-select">
                <option value="">Trier par</option>
                <option value="recentes">A partir des plus récentes</option>
                <option value="anciennes">A partir des plus anciennes</option>
            </select>
        </div> -->


        <div id="liste_photos">
            <?php echo get_template_part('templates_part/photo_block')?>
        </div>
    </section>

</main>

<?php
get_footer();
?>
