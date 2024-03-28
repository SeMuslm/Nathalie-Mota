<?php

$burger = get_template_directory_uri() . '/images/Icons/Burger.png';
$cross = get_template_directory_uri() . '/images/Icons/Cross.png';

?>

<div id="menu_burger">
    <div class="menu_status">
        <img id="menu_icon" src="<?php echo $burger?>" alt="Menu en forme de burger">      
        <input id="menu_checkbox" type="checkbox">  
    </div>

    <div class="menu_list">
        <?php
        wp_nav_menu([
            'theme_location' => 'header',
            'menu_id' => 'menu_ul',
        ]);
        ?>
    </div>
</div>

<script>
    var burger = <?php echo json_encode($burger); ?>;
    var cross = <?php echo json_encode($cross); ?>;
</script>