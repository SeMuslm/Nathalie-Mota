<footer>
    <?php
    wp_nav_menu([
        'theme_location' => 'footer',
    ]);
    ?>
    <?php get_template_part( 'templates_part/modale_contact' ); ?>
    <?php wp_footer(); ?>
</footer>
</body>