<?php
foreach ($posts as $post) {
    setup_postdata($post);
    $post_thumb_id = get_post_thumbnail_id($post);
    $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, 'large');
    ?>
    <div class="single-image">
        <img src="<?php echo $post_thumb_url[0]; ?>" alt="<?php echo get_the_title($post); ?>" data-post-id="<?php echo $post->ID; ?>">
    </div>
<?php } ?>