<?php
get_header();
while (have_posts()) {
    the_post();
    offerBanner();
    backNav()
        ?>
    <div class="offer-page-section">
        <div class="offer-page-content">
            <div class="main-column">
                <div class="offer-gallery">
                    <section id="offer-carousel" class="splide" aria-label="Offer Gallery">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php
                                for ($i = 0; $i < 11; $i++) {
                                    if (get_field('img_' . $i)) {
                                        ?>
                                        <li class="splide__slide">
                                            <img src="<?php echo esc_url(get_field('img_' . $i)['sizes']['large']) ?>" alt="">
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </section>
                    <section id="offer-thumbnails" class="splide" aria-label="Offer Thumbnails">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php
                                for ($i = 0; $i < 11; $i++) {
                                    if (get_field('img_' . $i)) {
                                        ?>
                                        <li class="splide__slide">
                                            <img src="<?php echo esc_url(get_field('img_' . $i)['sizes']['large']) ?>" alt="">
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </section>
                </div>
                <div class="offer-full-params">
                    <div>
                        <?php
                        offerFullParam('property_type', 'Typ nieruchomości');
                        offerFullParam('transaction_type', 'Typ transakcji');
                        offerFullParam('lokalizacja', 'Lokalizacja');
                        offerFullParam('property_size', 'Powierzchnia', '', ' m<sup>2</sup>', );
                        ?>
                    </div>
                    <div>
                        <?php
                        offerFullParam('price_per_meter', 'Cena za m<sup>2</sup>', '', ' PLN');
                        offerFullParam('room_count', 'Liczba pokoi');
                        offerFullParam('floor', 'Piętro');
                        offerFullParam('year', 'Rok budowy');
                        ?>
                    </div>
                </div>
                <div class="offer-description">
                    <?php the_content() ?>
                </div>
            </div>
            <div class="aside-column">
                <div class="sticky-container">
                    <?php
                    $employee = get_field('employee_rel');
                    foreach ($employee as $id) {
                        employeeSmallCard($id);
                    }
                    ;

                    asideSmallContactForm(get_the_title(), get_the_permalink());
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (get_field('geo')) {
        ?>
        <div id="map" data-geo="<?php echo esc_attr(get_field('geo')) ?>"></div>
        </div>
        <?php
    }
?>
<?php }
backNav();
get_footer();
?>