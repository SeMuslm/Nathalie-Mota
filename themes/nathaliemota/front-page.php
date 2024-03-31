<?php
get_header(); ?>

<?php
$heroheader = get_posts(array( //Tableau des posts du CPT photos avec une ordre catégorie
    'post_type' => 'photos',        
    'posts_per_page' => 1,
    'orderby' => 'rand',
));
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
</main>

<?php
get_footer();
?>
