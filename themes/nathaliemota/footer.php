<footer>
    <?php
    wp_nav_menu([
        'theme_location' => 'footer',
    ]);
    ?>
    <?php get_template_part( 'templates_part/modale_contact' ); ?>
    <?php wp_footer(); ?>
    <?php echo get_template_part('templates_part/lightbox') ?>
    <script src="/js/lightbox.js"></script>
</footer>
</body>