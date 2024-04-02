<?php               
    $post_thumb_id = get_post_thumbnail_id();
    $post_thumb_url = wp_get_attachment_image_src($post_thumb_id, 'large'); ?>

    <div class="single-image">
        <a href="<?php the_permalink(); ?>"><img src="<?php echo $post_thumb_url[0]; ?>" alt="<?php echo get_the_title(); ?>" data-post-id="<?php echo get_the_ID(); ?>"></a>
    </div>