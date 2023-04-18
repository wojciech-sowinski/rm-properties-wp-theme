<?php
get_header();
pageBanner(
    array(
        'title' => 'Oferty'
    )
);
searchOffer();
?>
<div class="page-section">
    <div class="page-content">
        <div class="offer-cards-container top-bot_padding__large">
            <?php
            $metaArgs = array('relation' => 'AND');
            if (isset($_GET['property_type'])) {
                array_push(
                    $metaArgs,
                    array(
                        'key' => 'property_type',
                        'value' => sanitize_text_field($_GET['property_type']),
                        'compare' => '='
                    )
                );
            }
            if (isset($_GET['transaction_type'])) {
                array_push(
                    $metaArgs,
                    array(
                        'key' => 'transaction_type',
                        'value' => sanitize_text_field($_GET['transaction_type']),
                        'compare' => '='
                    )
                );
            }
            if (isset($_GET['location'])) {
                array_push(
                    $metaArgs,
                    array(
                        'key' => 'lokalizacja',
                        'value' => sanitize_text_field($_GET['location']),
                        'compare' => 'LIKE'
                    )
                );
            }
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'offer',
                'meta_query' => $metaArgs
            );

            if ((isset($_GET['sort']) and isset($_GET['order']))) {
                if ($_GET['sort'] == 'post_date') {
                    $args['orderby'] = 'post_date';
                    $args['order'] = $_GET['order'];
                }
                if ($_GET['sort'] == 'property_price') {
                    $args['meta_key'] = 'property_price';
                    $args['orderby'] = 'meta_value_num';
                    $args['order'] = $_GET['order'];
                }
            }
            ;

            $customOffers = new WP_Query($args);
            if ($customOffers->have_posts()) {
                sortOffersSelect();
                while ($customOffers->have_posts()) {
                    $customOffers->the_post();
                    ?>
                    <a href="<?php echo esc_url(the_permalink()) ?>">
                        <div class="offer-card">
                            <img src="<?php echo esc_url(get_field('img_0')['sizes']['post-thumbnail-300']) ?>"
                                alt="offer image">
                            <div class="offer-card-description">
                                <h2 class="heading__small text-align__left font-weight__500">
                                    <?php echo esc_attr(get_the_title()) ?>
                                </h2>
                                <div class="offer-card-params">
                                    <?php
                                    offerFullParam('property_type', 'Typ nieruchomości');
                                    offerFullParam('transaction_type', 'Typ transakcji');
                                    offerFullParam('property_size', 'Powierzchnia', '', ' m<sup>2</sup>', );
                                    offerFullParam('price_per_meter', 'Cena za m<sup>2</sup>', '', ' PLN');
                                    offerFullParam('room_count', 'Liczba pokoi');

                                    ?>
                                </div>
                                <div>
                                    <?php
                                    offerBannerParam('property_price', '', ' PLN');
                                    ?>
                                </div>
                            </div>

                        </div>
                    </a>
                    <?php
                }
            } else {
                echo '<h2>Nie odnaleziono ofert, zmień parametry wyszukiwania.</h2>';
            }

            ?>
        </div>
    </div>
</div>
</div>
<?php
get_footer();
?>