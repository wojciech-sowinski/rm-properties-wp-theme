<?php get_header(); ?>



<div class="front-page">
    <section id="front-page-slider" class="splide" aria-label="Slider">
        <div class="splide__progress">
            <div class="splide__progress__bar front-page-slider-progress">
            </div>
        </div>
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide">
                    <div class="front-page-slide">
                        <img class="front-page-slide-img"
                            src="<?php echo esc_attr(get_theme_file_uri('/src/images/6758771.webp')) ?>"
                            alt="house interior image">
                        <div class='front-page-slide-overlay'>
                            <div class="text">
                                <img class='site-logo-slider'
                                    src="<?php echo esc_url(get_theme_file_uri('/src/images/RMProperties-Logo.svg')) ?>"
                                    alt="RM Properties logo">
                                <p>
                                    Marzysz o nowym mieszkaniu lub domu?</br>
                                    Zostaw to Nam i ciesz się spokojem.
                                </p>
                                <div class='front-page-slide-overlay-buttons'>
                                    <a class="btn olive" href="#">
                                        <span>Napisz do Nas</span>
                                    </a>
                                    <a class="btn darkGray " href="<?php echo esc_url(site_url('/offer')) ?>">
                                        <span>Sprawdź nasze oferty</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="front-page-slide">
                        <img class="front-page-slide-img"
                            src="<?php echo esc_attr(get_theme_file_uri('/src/images//6186507.webp')) ?>"
                            alt="house interior image">
                        <div class='front-page-slide-overlay'>
                            <div class="text">
                                <h2>Chcesz <strong>kupić</strong> nieruchomość?</h2>
                                <p>
                                    Dobrze trafiłeś!</br>
                                    Nasz doświadczony agent pomoże spełnić Twoje marzenie o nowym domu.
                                </p>

                                <div class='front-page-slide-overlay-buttons'>
                                    <a class="btn olive" href="#">
                                        <span>Napisz do Nas</span>
                                    </a>
                                    <a class="btn darkGray " href="#">
                                        <span>zobacz jak pracujemy</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="front-page-slide">
                        <img class="front-page-slide-img"
                            src="<?php echo esc_attr(get_theme_file_uri('/src/images/6758788.webp')) ?>"
                            alt="house interior image">
                        <div class='front-page-slide-overlay'>
                            <div class="text">
                                <h2>Chcesz <strong>sprzedać</strong>?</h2>
                                <p>
                                    Profesjonalnie wycenimy i</br>
                                    przygotujemy nieruchomość do sprzedaży.
                                </p>
                                <div class='front-page-slide-overlay-buttons'>
                                    <a class="btn olive flip" href="#">
                                        <span>Napisz do Nas</span>
                                    </a>
                                    <a class="btn darkGray flip" href="#">
                                        <span>Sprzedaj skutecznie</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="splide__slide">
                    <div class="front-page-slide">
                        <img class="front-page-slide-img"
                            src="<?php echo esc_attr(get_theme_file_uri('/src/images/6585752.webp')) ?>"
                            alt="house interior image">
                        <div class='front-page-slide-overlay'>
                            <div class="text">
                                <h2>Razem możemy <strong>więcej</strong></h2>
                                <p>
                                    Zajmujesz się nieruchomościami na poważnie?</br>
                                    Chcemy z Tobą <strong>współpracować.</strong>
                                </p>
                                <div class='front-page-slide-overlay-buttons'>
                                    <a class="btn olive" href="#">
                                        <span>Napisz do Nas</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="search-offer">
        <?php searchOffer() ?>
    </section>
    <section id="offers-Slider" class="splide background__lightGold top-bot_padding__large"
        aria-label="Offers carousel">
        <h2 class="heading  top-bot_padding__medium">Najnowsze oferty</h2>
        <div class="splide__track top-bot_padding__large">
            <ul class="splide__list">
                <?php
                $recentOffers = new WP_Query(
                    array(
                        'posts_per_page' => 5,
                        'post_type' => 'offer',

                    )
                );
                while ($recentOffers->have_posts()) {
                    $recentOffers->the_post()
                        ?>
                    <li class="splide__slide">
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
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <a class="btn olive float__center bottom-button" href="/offer">Zobacz oferty</a>
    </section>
    <section class='join-us'>
        <div class='text-container'>
            <h2 class="heading__large top-bot_padding__medium">
                <strong>Dołącz</strong> do NAS!
            </h2>
            <p>
                Dołącz do Nas na Facebooku i Youtube</br>
                Bądź zawsze na bieżąco, nie przegap żadnej okazji!
            </p>
            <div class="social-buttons">
                <a class="btn skew mainBlue" href=""> <span>Facebook Link</span> </a>
                <a class="btn skew darkRed" href=""> <span>Youtube Link</span> </a>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>