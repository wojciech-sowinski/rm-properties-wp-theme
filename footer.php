<footer class="site-footer">
    <div>
        <div>
            <a href="<?php echo esc_url(site_url()) ?>">
                <img src="<?php echo esc_url(get_theme_file_uri('/src/images/RMProperties-Logo.svg')) ?>"
                    alt="RM Properties logo">
                <span>
                    <?php echo esc_attr(get_bloginfo('description')) ?>
                </span>
            </a>
        </div>
        <div>
            <?php
            wp_nav_menu(
                array(
                    'container' => 'nav',
                    'menu_class' => 'footer-menu',
                    'theme_location' => 'footerExploreNavMenu'
                )
            );
            ?>
        </div>
        <div>
            <?php
            wp_nav_menu(
                array(
                    'container' => 'nav',
                    'menu_class' => 'footer-menu',
                    'theme_location' => 'footerSecondNavMenu'
                )
            );
            ?>
        </div>
        <div class="footer-social-media">
            <span><strong>Dołącz</strong> do NAS!</span>
            <div>
                <i class="fa fa-facebook-f"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-youtube"></i>
                <i class="fa fa-instagram"></i>
            </div>
        </div>
    </div>
    <div id='owliedev-logo-container'>
        <span>
            © 2023 RM Properties Robert Marszałek
        </span>
        <a href="http://owliedev.pl/">
            <span>made by </span>
            <img src="<?php echo esc_url(get_theme_file_uri('/src/images/owliedev-logo.svg')) ?>"
                alt="RM Properties logo">
        </a>

    </div>
</footer>

<?php wp_footer() ?>
</body>

</html>