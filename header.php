<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <?php
    wp_head()
        ?>
</head>

<body <?php body_class() ?>>
    <header class="site-header">
        <div class="container">
            <div class="site-logo">
                <a href="<?php echo esc_url(site_url()) ?>">
                    <img src="<?php echo esc_url(get_theme_file_uri('/src/images/RMProperties-Logo.svg')) ?>"
                        alt="RMProperties Logo">
                </a>
            </div>
            <nav class="main-nav">
                <?php
                wp_nav_menu(
                    array(
                        'container' => 'ul',
                        'menu_class' => false,
                        'theme_location' => 'headerNavMenu'
                    )
                );
                ?>
                <div class="main-nav-social">
                    <i class="fa fa-facebook-f"></i>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-youtube"></i>
                    <i class="fa fa-instagram"></i>
                </div>
            </nav>
            <div class="main-buttons">
                <span class="mobile-menu-trigger">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </div>

        </div>
    </header>