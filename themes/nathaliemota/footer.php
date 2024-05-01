<footer>
    <?php
    wp_nav_menu([
        'theme_location' => 'footer',
    ]);
    ?>
    <?php get_template_part( 'templates_part/modale_contact' );
    get_template_part('templates_part/lightbox');
    wp_footer();
    ?>
    
</footer>
</body>