<?php
function kjca_theme_enqueue() {
    $theme_version = wp_get_theme()->get('Version');

    /* Scripts */

    wp_enqueue_script('jquery');
    wp_enqueue_script('kjca-theme', get_template_directory_uri() . '/js/kjca-theme.js','','',true);

    /* Fonts */

    wp_enqueue_style('dashicons');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css', '', '6.1.2', 'all');
    wp_enqueue_style('montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,600,600i,700,700i,800,900&display=swap', '', '', 'all');

    /* CSS */

    wp_enqueue_style('kjca-theme', get_template_directory_uri() . '/style.css', '', $theme_version, 'all');
}

add_action('wp_enqueue_scripts', 'kjca_theme_enqueue');
?>