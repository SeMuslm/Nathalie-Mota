<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title>Nathalie Mota</title>
</head>

<body>
    <header id="header">
        <a href="/"><img src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="Logo du site Nathalie Mota"/></a>           
        <?php
        wp_nav_menu([
            'theme_location' => 'header',
            'menu_id' => 'header_ul',
        ]);
        echo get_template_part('templates_part/menu_burger');
        ?>
    </header>