<?php

function rm_files()
{
    wp_enqueue_script('rm-js', get_theme_file_uri('/build/index.js'), array(), '1.0', true);
    wp_enqueue_script('rm-recaptcha', "https://www.google.com/recaptcha/api.js", array(), '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css');
    wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.9.3/dist/leaflet.css');
    wp_enqueue_style('rm-properties-style', get_theme_file_uri('/build/rm-properties-style.css'));


    wp_localize_script(
        'rm-js',
        'rmData',
        array(
            'root_url' => esc_url(get_site_url()),
            'theme_url' => esc_url(get_theme_file_uri())
        )
    );

}
;
add_action('wp_enqueue_scripts', 'rm_files');



function additionalMeta()
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
}

add_action('wp_head', 'additionalMeta');


function rm_features()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('person-square', 400, 400, array('center', 'center'));
    add_image_size('person-square-thumb', 200, 200, array('center', 'center'));
    add_image_size('post-thumbnail-300', 300, 300, array('center', 'center'));
    add_image_size('page-banner', 1920, 350, array('center', 'center'));
}
add_action('after_setup_theme', 'rm_features');

function rm_menus()
{
    register_nav_menus(
        array(
            'headerNavMenu' => 'Menu główne w nagłówku',
            'footerExploreNavMenu' => 'Pierwsze menu w stopce',
            'footerSecondNavMenu' => 'Drugie menu w stopce'
        )
    );
}
add_action('after_setup_theme', 'rm_menus');

function rm_post_types()
{
    register_post_type(
        'offer',
        array(
            'supports' => array(
                'title',
                'editor'
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Oferty',
                'add_new_item' => 'Dodaj Ofert',
                'edit_item' => 'Edytuj Ofert',
                'all_items' => 'Wszystkie Oferty',
                'singular_name' => 'Oferta'
            ),
            'menu_icon' => 'dashicons-building',

        )
    );
    register_post_type(
        'employee',
        array(
            'supports' => array(
                'title'
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Pracownicy',
                'add_new_item' => 'Dodaj Pracownika',
                'edit_item' => 'Edytuj Pracownika',
                'all_items' => 'Wszyscy Pracownicy',
                'singular_name' => 'Pracownik'
            ),
            'menu_icon' => 'dashicons-businessperson',

        )
    );

}

add_action('init', 'rm_post_types');


function offerBannerParam($fieldName, $before = '', $after = '')
{
    if (get_field($fieldName)) {

        $fieldValue = get_field($fieldName);

        if ($fieldName === 'property_price' or $fieldName === 'price_per_meter') {
            $fieldValue = str_replace(',', ' ', number_format($fieldValue, 0));
        }
        ;
        ?>
        <span class='offer-banner-param'>
            <?php echo '<span>' . $before . esc_attr($fieldValue) . $after . '</span>'; ?>
        </span>
        <?php
    }
}

function offerFullParam($fieldName, $label, $before = '', $after = '')
{
    if (get_field($fieldName)) {

        $fieldValue = get_field($fieldName);

        if ($fieldName === 'property_price' or $fieldName === 'price_per_meter') {
            $fieldValue = str_replace(',', ' ', number_format($fieldValue, 0));
        }


        ?>
        <div class="offer-full-param">
            <span>
                <?php echo $label ?>:
            </span>
            <?php echo '<span>' . $before . esc_attr($fieldValue) . $after . '</span>'; ?>
        </div>
        <?php
    }
}

function searchOffer()
{
    ?>
    <div class="offer-search-form">
        <h2 class="heading__small font-weight__500 ">Wyszukiwarka nieruchomości</h2>
        <form id="offer-search-form" method="GET" action="<?php echo site_url('/offer') ?>" accept-charset="UTF-8"
            role='form'>
            <select name="transaction_type" id="transaction_type">
                <option disabled selected value="">Rodzaj Transakcji</option>
                <option value="Sprzedaż">Sprzedaż</option>
                <option value="Wynajem">Wynajem</option>
            </select>
            <select name="property_type" id="property_type">
                <option disabled selected value="">Typ Nieruchomości</option>
                <option value="Mieszkanie">Mieszkanie</option>
                <option value="Dom">Dom</option>
                <option value="Działka">Działka</option>
            </select>
            <input type="text" name="location" id="location" value='' placeholder="Dzielnica / Miasto">
            <button type="submit" value="Szukaj"><i class="fa fa-search"></i> Szukaj</button>
            <button type="reset" value="Wyczyść"><i class="fa fa-close"></i> Wyczyść</button>

        </form>
    </div>
    <?php
}

function sortOffersSelect()
{
    ?>
    <form class="offer-sorting">
        <select id="offer-sorting-select" name="orderby" id="orderby">
            <option value="" disable>Sortuj oferty</option>
            <option value="post_date|DESC">Data dodania: malejąco</option>
            <option value="post_date|ASC">Data dodania: rosnąco</option>
            <option value="property_price|DESC">Cena: malejąco</option>
            <option value="property_price|ASC">Cena: rosnąco</option>
        </select>
    </form>
    <?php
}

function pageBanner($args = array())
{
    ?>
    <div class="page-banner">
        <div class="page-banner-bg-image"
            style="background-image: linear-gradient(
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    135deg,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    rgba(252, 252, 252, 0.95),
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    rgba(252, 252, 252, 0.8),
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    rgba(252, 252, 252, 0.1)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ),
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  url(<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  if (isset($args['page-banner-background'])) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      echo $args['page-banner-background'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      if (get_the_post_thumbnail_url(null, 'page-banner')) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo esc_url(get_the_post_thumbnail_url(null, 'page-banner'));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo esc_url(get_theme_file_uri('/src/images/default/page-banner-def.webp'));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  } ?>);">
        </div>
        <div class="page-banner-content">
            <h1 class="page-banner-title heading__largest">
                <?php
                if (isset($args['title'])) {
                    echo $args['title'];
                } else {
                    echo get_the_title();
                }
                ?>
            </h1>
        </div>
    </div>
    <?php
}

function offerBanner($args = array())
{


    ?>
    <div class="offer-banner">
        <div class="offer-banner-bg-image"
            style="background-image: linear-gradient(                                                                                                                                                                                     135deg,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        rgba(252, 252, 252, 0.95),
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        rgba(252, 252, 252, 0.8),
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        rgba(252, 252, 252, 0.6)
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ),
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      url(<?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      if (isset($args['page-banner-background'])) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          echo $args['page-banner-background'];
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          if (isset(get_field('img')['sizes']['page-banner'])) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              echo esc_url(get_field('img')['sizes']['page-banner']);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              echo esc_url(get_theme_file_uri('/src/images/default/page-banner-def.webp'));
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      } ?>);">
        </div>
        <div class="offer-banner-content">
            <h1 class="offer-banner-title">
                <?php
                if (isset($args['title'])) {
                    echo $args['title'];
                } else {
                    echo get_the_title();
                }
                ?>
            </h1>
            <div class="offer-general-params">
                <div>
                    <?php
                    offerBannerParam('transaction_type');
                    offerBannerParam('property_type');
                    ?>
                </div>
                <div>
                    <?php
                    offerBannerParam('property_price', '', ' PLN');
                    offerBannerParam('property_size', 'pow. ', ' m<sup>2</sup>');
                    ?>
                </div>

            </div>
        </div>
    </div>
    <?php
}

function employeeSmallCard($id)
{
    ?>
    <div class="employee-card">
        <h3 class="heading__small top-bot_padding__small"> <strong>Opiekun</strong> Oferty</h3>
        <img src="<?php
        if (get_field('employee_img', $id)) {
            echo esc_url(get_field('employee_img', $id)['sizes']['thumbnail']);
        }
        ?>" alt="employee img">
        <div class='employee-param'>
            <h3 class="heading__small" style=" width: 100%; ">
                <?php
                if (get_the_title($id)) {
                    echo esc_attr(get_the_title($id));
                }
                ?>
            </h3>
        </div>
        <?php
        if (get_field('employee_tel', $id)) {
            ?>
            <div class='employee-param'>
                <a href="tel:<?php echo esc_attr(get_field('employee_tel', $id)); ?>">
                    <i class="fa fa-mobile" style="font-size:2rem"></i>
                    <span>
                        <?php
                        echo esc_attr(get_field('employee_tel', $id));
                        ?>
                    </span>
                </a>
            </div>
            <?php
        }
        ?>
        <?php
        if (get_field('email', $id)) {
            ?>
            <div class='employee-param'>
                <a href="mailto:<?php echo esc_attr(get_field('email', $id)); ?>">
                    <i class="fa fa-envelope" style="font-size:1.2rem"></i>
                    <span>
                        <?php
                        echo esc_attr(get_field('email', $id));
                        ?>
                    </span>
                </a>
            </div>
            <?php
        }
        ?>
        <a href="<?php echo esc_url(site_url('/offer')) ?>" class="btn olive "> <span>Oferty Opiekuna</span> </a>
    </div>
    <?php
}

function backNav()
{
    ?>
    <nav class="context-nav">
        <a href="<?php
        if (get_post_type_archive_link(get_post_type())) {

            echo esc_url(get_post_type_archive_link(get_post_type()));
        } else {
            echo esc_url(site_url());
        }



        ?>" class=" btn  olive"> <span>
                Powrót</span></a>
    </nav>
    <?php
}


function wpb_filter_query($query, $error = true)
{
    if (is_search()) {
        $query->is_search = false;
        $query->query_vars['s'] = false;
        $query->query['s'] = false;
        if ($error == true)
            $query->is_404 = true;
    }
}
add_action('parse_query', 'wpb_filter_query');


function searchReturn($a)
{
    return null;
}

add_filter('get_search_form', 'searchReturn');
function remove_search_widget()
{
    unregister_widget('WP_Widget_Search');
}
add_action('widgets_init', 'remove_search_widget');


function asideSmallContactForm($offer, $offerPermalink)
{

    if (isset($_GET['msgsent'])) {
        if ($_GET['msgsent'] == 'true') {
            ?>
            <div id='msg-sent-pop-up' class='sucess open'>
                <span>Twoja wiadomość została wysłana</span>
            </div>

            <?php
        } else if ($_GET['msgsent'] == 'captchafalse') {
            ?>
                <div id='msg-sent-pop-up' class='fail open'>
                    <span>Twoja wiadomość nie została wysłana</span>
                    <span>Błędna weryfikacja Captcha <a href='mailto:email@email.ccom'>email@email.ccom</a></span>
                </div>
            <?php
        } else {
            ?>
                <div id='msg-sent-pop-up' class='fail open'>
                    <span>Twoja wiadomość nie została wysłana</span>
                    <span>Spróbuj ponownie, lub napisz do nas bezpośrednio na <a
                            href='mailto:email@email.ccom'>email@email.ccom</a></span>
                </div>
            <?php
        }
    }

    if (isset($_POST["g-recaptcha-response"]) and isset($_POST["guest-name"]) and isset($_POST["guest-email"]) and isset($_POST["guest-message"]) and isset($_POST["agreements"])) {
        $token = $_POST["g-recaptcha-response"];
        $secret = "6LeQjLUkAAAAALKDTRm4VTbkTjMchSFbUrcNRRtu";
        $ip = $_SERVER["REMOTE_ADDR"];
        $guestName = $_POST["guest-name"];
        $guestEmail = $_POST["guest-email"];
        $guestMessage = $_POST["guest-message"];
        $agreements = $_POST["agreements"];
        $adminEmail = get_option('admin_email');
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: RM Properties <mywebsite@example.com>',
            'Reply-To: ' . $guestName . ' <' . $guestEmail . '>'
        );

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $token . "&remoteip=" . $ip;
        $request = file_get_contents($url);
        $response = json_decode($request);

        $message = '<h1>Wiadomość w sprawie oferty: ' . $offer . '</h1> </br><strong>Zapytanie od:</strong>' . $guestName . '</br> <strong>EMAIL: </strong> ' . $guestEmail . '</br> <strong>Wiadomość: </strong> ' . $guestMessage . '</br> <a href=' . $offerPermalink . '>Link do oferty</a>';

        if ($response->success) {
            $sent = wp_mail($adminEmail, 'Wiadomość w sprawie oferty.', $message, $headers);
            if ($sent) {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . the_permalink() . '?msgsent=true">';
                exit;
            } else {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . the_permalink() . '?msgsent=false">';
                exit;
            }
        } else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . the_permalink() . '?msgsent=captchafalse">';
            exit;
        }

    } else {

        ?>
        <form id="aside-small-contact-form" method="POST">
            <h3 class="heading__small top-bot_padding__small"> <strong>Napisz</strong> do NAS</h3>
            <input required type="text" name="guest-name" id="guest-name" placeholder='Imię Nazwisko'>
            <input required type="email" name="guest-email" id="guest-email" placeholder="Adres Email">
            <textarea name="guest-message" id="guest-message" cols="30"
                rows="5">Jestem zainteresowany(a) tą ofertą. Proszę o kontakt.</textarea>
            <label id='agreements-label' for="agreements">
                <input required type="checkbox" name="agreements" id="agreements">
                Oświadczam, że wysyłając przy pomocy systemów teleinformatycznych (m.in. zapytanie ze stron internetowych,
                formularza kontaktowego, adresu poczty elektronicznej, wiadomości sms, wiadomości na portalu społecznościowym
                itp.) zapytania dotyczącego danej nieruchomości, usługi lub umowy pośrednictwa, lub bezpośrednio z nimi nie
                związanych, ale skierowanych bezpośrednio do firmy RM Properties, wyrażam zgodę na przetwarzanie podanych danych
                osobowych w celu obsługi zapytania.
            </label>
            <button type='submit' id="btnSubmit" class="btn gold submit-form-btn" onclick=' asideContactFormCheck(event)'>
                Wyślij
            </button>
            <div class="g-recaptcha" data-sitekey="6LeQjLUkAAAAAO9DVUpwe49c93eYk31Qcj6PNxB7"
                data-callback='asideContactFormSubmit' data-size="invisible">
            </div>
            <script>

                const checkbox = document.querySelector('#agreements');
                const agreementsLabel = document.querySelector('#agreements-label')
                const input = document.querySelector('#guest-name');
                const email = document.querySelector('#guest-email');

                function validateForm() {
                    if (input.value === '') {
                        input.style.borderColor = 'red';
                        return false;
                    } else {
                        input.style.borderColor = '';
                    }
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(email.value)) {
                        email.style.borderColor = 'red';
                        return false;
                    } else {
                        email.style.borderColor = '';
                    }
                    if (!checkbox.checked) {
                        agreementsLabel.style.color = 'red';

                        return false;
                    } else {
                        agreementsLabel.style.color = '';
                    }
                    return true;
                }

                [checkbox, input, email].forEach(element => {
                    element.addEventListener('change', validateForm)
                });

                function asideContactFormCheck(event) {
                    event.preventDefault();
                    if (validateForm()) {
                        grecaptcha.execute();
                    }
                }
                function asideContactFormSubmit(token) {
                    document.getElementById('aside-small-contact-form').submit()
                }
            </script>
        </form>

        <?php

    }






}


?>