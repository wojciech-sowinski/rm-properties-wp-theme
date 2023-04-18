<?php
get_header();
pageBanner();

?>
<div class="page-section">
    sdas
    <div class="page-content">
        <div class="offer-cards-container">
            <?php
            while (have_posts()) {
                the_post();
                ?>



            <?php } ?>
        </div>
    </div>
</div>
</div>
<?php
get_footer();
?>