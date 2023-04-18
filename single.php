<?php
get_header();
pageBanner();
backNav();
while (have_posts()) {
    the_post();
    ?>
    <div class="page-section">
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    </div>
<?php }
backNav();
get_footer();
?>