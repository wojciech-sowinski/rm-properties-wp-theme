<?php
get_header();
pageBanner(
    array(
        'title' => 'Witaj na naszym Blogu'
    )
);
?>
<div class="page-section">
    <div class="page-content">
        <?php
        while (have_posts()) {
            the_post();
            ?>
            <li class="post-li-item">
                <a href=" <?php echo esc_url(get_permalink()) ?>">
                    <h3 class="heading__medium">
                        <?php echo get_the_title() ?>
                    </h3>
                </a>
                <div>
                    <a href=" <?php echo esc_url(get_permalink()) ?>">
                        <?php
                        if (get_the_post_thumbnail()) {
                            the_post_thumbnail('thumbnail');
                        } else {
                            echo '<img src="' . esc_url(get_theme_file_uri('/src/images/default/default-post-thumb.jpg')) . '" alt="post thumbnail" />';
                        }
                        ?>
                    </a>
                    <p class="post-li-item-desc">
                        <?php

                        if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_content(), 30, '');
                        }
                        ?>
                        <a class="read-more" href="<?php echo esc_url(get_permalink()) ?>">czytaj dalej...</a>
                    </p>
                </div>
            </li>
        <?php }
        ?>
    </div>
</div>
<?php
get_footer();
?>