<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="author" content="Kelly Jones, <?php echo php_uname('n');?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); wp_title(' | ', true, 'left'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
</head>

<body id="<?php echo $post->post_type . '-' . $post->post_name; ?>" <?php body_class(); ?>>

<div id="topbar">
    <div class="container">
        <ul class="topbar-1">
            <?php
                if (is_active_sidebar('topbar-1')) {
                    dynamic_sidebar('topbar-1');
                }
            ?>
        </ul>
        <ul class="topbar-2">
            <?php
                if (is_active_sidebar('topbar-2')) {
                    dynamic_sidebar('topbar-2');
                }
            ?>
        </ul>
    </div>
</div>

<header>
    <div class="container">
        <div class="site-logo">
            <?php
                if (has_custom_logo()) {
                    echo get_custom_logo();
                }
            ?>
        </div>
        <nav>
            <?php
                if (has_nav_menu('header-menu')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header-menu', 
                            'container_class' => 'menu-container'
                        )
                    );
                }
            ?>
            <a id="menu-toggle" href="javascript:void(0);"></a>
        </nav>
    </div>
</header>

<main>
    <div class="page-content">