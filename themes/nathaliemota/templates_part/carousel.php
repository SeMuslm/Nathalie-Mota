<?php
    $posts = get_posts(array( //Tableau des posts du CPT photos avec ordre croissant en années
        'posts_per_page' => -1,
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'ASC',
    ));


?>

<div class="container-single__middle">
    <div class="container-single__middle--contact">
    <p>Cette photo vous intéresse ?</p>
    <button id="bouton-contact" data-reference="<?php the_field('reference')?>">Contact</button> <!-- Le bouton stock la référence de la photo -->            
    </div>


<?php
// Récupérer le post actuel
$current_post_id = get_the_ID();
$current_post_index = array_search($current_post_id, array_column($posts, 'ID'));

// Récupérer le post précédent
$previous_post_index = ($current_post_index > 0) ? $current_post_index - 1 : count($posts) - 1;
$previous_post = $posts[$previous_post_index];

// Récupérer le post suivant
$next_post_index = ($current_post_index < count($posts) - 1) ? $current_post_index + 1 : 0;
$next_post = $posts[$next_post_index];

// Récupérer l'ID du post précédent
$previous_post_id = get_previous_post() ? get_previous_post()->ID : '';
// Récupérer l'ID du post suivant
$next_post_id = get_next_post() ? get_next_post()->ID : '';

?>



<div class="container-single__middle--carousel">
<div id="carousel-image">
    <?php foreach ($posts as $post) : setup_postdata($post); ?>
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo $post->ID; ?>">    
    <?php endforeach; ?>
</div>
<div class="fleches">
<a id="fleche-gauche" data-post-id="<?php echo $previous_post->ID; ?>" href="<?php echo get_permalink($previous_post->ID); ?>"><span>&#8592;</span></a>
<a id="fleche-droite" data-post-id="<?php echo $next_post->ID; ?>" href="<?php echo get_permalink($next_post->ID); ?>"><span>&#8594;</span></a>    
</div>

</div>
</div>
</div>




<script>
    var previousPostId = <?php echo json_encode($previous_post_id); ?>;
    var nextPostId = <?php echo json_encode($next_post_id); ?>;
</script>