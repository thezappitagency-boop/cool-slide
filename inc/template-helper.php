<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package agntix
 */

/** 
 *
 * agntix header
 */
function get_header_style($style)
{
    if ($style == 'header_2') {
        get_template_part('template-parts/header/header-2');
    } else {
        get_template_part('template-parts/header/header-1');
    }
}



function agntix_check_header()
{
    $tp_header_tabs = function_exists('tpmeta_field') ? tpmeta_field('agntix_header_tabs') : false;
    $elementor_header_template_meta = function_exists('tpmeta_field') ? tpmeta_field('agntix_header_templates') : false;

    $agntix_header_option_switch = get_theme_mod('agntix_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod('header_layout_custom', 'header_1');
    $elementor_header_templates_kirki = get_theme_mod('agntix_header_templates');

    // Check if Elementor is active
    $is_elementor_active = did_action('elementor/loaded');

    if ($tp_header_tabs == 'default') {
        if ($agntix_header_option_switch) {
            if ($is_elementor_active && $elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        } else {
            if ($header_default_style_kirki) {
                get_header_style($header_default_style_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        }
    } elseif ($tp_header_tabs == 'elementor') {
        if ($is_elementor_active) {
            if ($elementor_header_template_meta) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
            } else {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }
    } else {
        if ($agntix_header_option_switch) {
            if ($is_elementor_active && $elementor_header_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            } else {
                get_template_part('template-parts/header/header-1');
            }
        } else {
            get_header_style($header_default_style_kirki);
        }
    }
}

add_action('agntix_header_style', 'agntix_check_header', 10);

/* agntix seach */
function agntix_header_search(){
    $header_search_text = get_theme_mod('agntix_header_search_text', __('What are you looking for?', 'agntix'));
    ?>
        <!-- tp header search  -->
        <div class="tp-header-search-bar d-flex align-items-center">
        <button class="tp-search-close">×</button>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="tp-search-bar text-center">
                        <?php if(!empty($header_search_text)): ?>
                            <h2 class="tp-search-bar-title mb-30">
                                <?php echo esc_html($header_search_text);?>
                            </h2>
                        <?php endif; ?>
                        <div class="contact-form-box contact-search-form-box">
                            <form ction="<?php print esc_url(home_url('/')); ?>">
                                <input type="text" placeholder="<?php print esc_attr__('Search Here', 'agntix'); ?>" name="s" value="<?php print esc_attr(get_search_query()) ?>">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
add_action('agntix_header_search', 'agntix_header_search', 10);
/* agntix offcanvas */

function agntix_check_offcanvas()
{
    get_template_part('template-parts/offcanvas/offcanvas-1');
}

add_action('agntix_offcanvas_style', 'agntix_check_offcanvas', 10);

// agntix_header_lang_defualt
function agntix_header_lang_defualt()
{
    ?>
<ul>
    <li>
        <?php do_action('agntix_header_language'); ?>
        <?php
}

/**
 * [agntix_language_list description]
 * @return [type] [description]
 */
function _agntix_header_language($mar)
{
    return $mar;
}
function agntix_header_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="d-flex align-items-center" style="gap: 8px; list-style: none">';
        $mar .= '<li><a href="#">' . esc_html__('EN', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('FR', 'agntix') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agntix_header_language($mar);
}
add_action('agntix_header_language', 'agntix_header_language_list');
function agntix_header_language_dropdown()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="header-lang-submenu">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'agntix') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agntix_header_language($mar);
}
add_action('agntix_header_language', 'agntix_header_language_dropdown');


// agntix_footer_lang_defualt
function agntix_footer_lang_defualt()
{
    ?>
        <ul>
            <li>

                <a id="header-bottom__lang-toggle" href="javascript:void(0)">
                    <span><?php echo esc_html__('EN', 'agntix'); ?></span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                            <path d="M1 1L5 5L9 1" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>

                <?php do_action('agntix_language'); ?>

                <?php
}

/**
 * [agntix_language_list description]
 * @return [type] [description]
 */
function _agntix_language($mar)
{
    return $mar;
}
function agntix_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="header-bottom__lang-submenu-2">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'agntix') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agntix_language($mar);
}
add_action('agntix_language', 'agntix_language_list');


/**
 * [agntix_offcanvas_language description]
 * @return [type] [description]
 */


/**
 * [agntix_header_lang description]
 * @return [type] [description]
 */
function agntix_offcanvas_lang_defualt()
{
    ?>

                <div class="offcanvas__select language">
                    <div class="offcanvas__lang d-flex align-items-center justify-content-md-end">
                        <div class="offcanvas__lang-img mr-15">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/icon/language-flag.png'); ?>" 
                                alt="<?php echo esc_attr__('language', 'agntix'); ?>">
                        </div>

                        <div class="offcanvas__lang-wrapper">
                            <span class="offcanvas__lang-selected-lang tp-lang-toggle"
                                id="tp-offcanvas-lang-toggle"><?php echo esc_html__('English', 'agntix'); ?></span>
                            <?php do_action('agntix_offcanvas_language'); ?>
                        </div>
                    </div>
                </div>
                <?php
}
function _agntix_offcanvas_language($mar)
{
    return $mar;
}
function agntix_offcanvas_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="offcanvas__lang-list tp-lang-list">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="offcanvas__lang-list tp-lang-list">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'agntix') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agntix_language($mar);
}
add_action('agntix_offcanvas_language', 'agntix_offcanvas_language_list');



/**
 * [agntix_language_list description]
 * @return [type] [description]
 */
function _agntix_footer_language($mar)
{
    return $mar;
}
function agntix_footer_language_list()
{
    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul class="footer__lang-list tp-lang-list-2">';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="footer__lang-list tp-lang-list-2">';
        $mar .= '<li><a href="#">' . esc_html__('English', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('Spanish', 'agntix') . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__('French', 'agntix') . '</a></li>';
        $mar .= ' </ul>';
    }
    print _agntix_footer_language($mar);
}
add_action('agntix_footer_language', 'agntix_footer_language_list');



// header logo
function agntix_header_logo()
{ ?>
    <?php
        $agntix_logo_dir = get_template_directory_uri() . '/assets/img/logo/logo-white.png';
        $agntix_logo_ = get_theme_mod('header_logo_black', $agntix_logo_dir);
        ?>
        <a class="tp-logo" href="<?php print esc_url(home_url('/')); ?>">
            <img src="<?php print esc_url($agntix_logo_); ?>"
                alt="<?php print esc_attr__('agntix Logo', 'agntix'); ?>">
        </a>
    <?php
}



/**
 * [agntix_header_menu description]
 * @return [type] [description]
 */
function agntix_header_menu()
{
    ?>
    <?php
        wp_nav_menu([
            'theme_location' => 'main-menu',
            'menu_class' => '',
            'container' => '',
            'fallback_cb' => 'agntix_Navwalker_Class::fallback',
            'walker' => new \TPCore\Widgets\agntix_Navwalker_Class,
        ]);
        ?>
    <?php
}


/**
 *
 * agntix footer
 */
add_action('agntix_footer_style', 'agntix_check_footer', 10);

function get_footer_style($style)
{
    if ($style == 'footer_2') {
        get_template_part('template-parts/footer/footer-2');
    } else {
        get_template_part('template-parts/footer/footer-1');
    }
}

function agntix_check_footer()
{
    global $post;

    $_id = get_the_ID() ?? NULL;

    if (is_single() && 'product' === get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") && is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $tp_footer_tabs = function_exists('tpmeta_field') ? tpmeta_field('agntix_footer_tabs', $_id ?: NULL) : false;
    $tp_footer_style_meta = function_exists('tpmeta_field') ? tpmeta_field('agntix_footer_style', $_id ?: NULL) : '';
    $elementor_footer_template_meta = function_exists('tpmeta_field') ? tpmeta_field('agntix_footer_templates', $_id ?: NULL) : false;

    $agntix_footer_option_switch = get_theme_mod('agntix_footer_elementor_switch', false);
    $footer_default_style_kirki = get_theme_mod('footer_layout_custom', 'footer_1');
    $elementor_footer_templates_kirki = get_theme_mod('agntix_footer_templates');

    $is_elementor_active = did_action('elementor/loaded');

    if ($tp_footer_tabs === 'default') {
        if ($agntix_footer_option_switch && $is_elementor_active) {
            if ($elementor_footer_templates_kirki) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
            }
        } else {
            if ($footer_default_style_kirki) {
                get_footer_style($footer_default_style_kirki);
            } else {
                get_template_part('template-parts/footer/footer-1');
            }
        }

    } elseif ($tp_footer_tabs === 'custom') {
        if ($tp_footer_style_meta) {
            get_footer_style($tp_footer_style_meta);
        } else {
            get_footer_style($footer_default_style_kirki);
        }

    } elseif ($tp_footer_tabs === 'elementor' && $is_elementor_active) {
        if ($elementor_footer_template_meta) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template_meta);
        } elseif ($elementor_footer_templates_kirki) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        } else {
            get_footer_style($footer_default_style_kirki);
        }

    } else {
        if ($agntix_footer_option_switch && $is_elementor_active && $elementor_footer_templates_kirki) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_templates_kirki);
        } else {
            get_footer_style($footer_default_style_kirki);
        }
    }
}

// agntix_copyright_text
function agntix_copyright_text()
{
    print get_theme_mod('agntix_copyright', esc_html__('© Copyright 2025 | Allright Reserved Agntix', 'agntix'));
}

/**
 *
 * pagination
 */
if (!function_exists('agntix_pagination')) {

    function _agntix_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function agntix_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul>';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _agntix_pagi_callback($pagi);
    }
}

function agntix_arr_to_string(array $array = [])
{
    $result = "";
    foreach ($array as $key => $value) {
        $result .= $key . ": " . $value . "; ";
    }
    return $result;
}

function agntix_breadcrumb_typography()
{
    $typo_for_desktop = get_theme_mod('breadcrumb_typography_desktop');
    $typo_for_tablet = get_theme_mod('breadcrumb_typography_tablet');
    $typo_for_mobile = get_theme_mod('breadcrumb_typography_mobile');

    wp_enqueue_style('agntix-breadcrumb-typo', AGNTIX_THEME_CSS_DIR . 'agntix-custom.css', []);

    if ($typo_for_desktop) {
        $typo = '';
        $typo .= '.breadcrumb__title{' . agntix_arr_to_string($typo_for_desktop) . '}';
        if (array_key_exists('text-align', $typo_for_desktop)) {
            $typo .= '.breadcrumb_content{text-align : ' . $typo_for_desktop['text-align'] . '}';
        }
        wp_add_inline_style('agntix-breadcrumb-typo', $typo);
    }
    if ($typo_for_tablet) {
        $typo = '';
        $typo .= '@media (max-width: 991px){.breadcrumb__title{' . agntix_arr_to_string($typo_for_tablet) . '}}';
        if (array_key_exists('text-align', $typo_for_mobile)) {
            $typo .= '@media (max-width: 991px){.breadcrumb_content{text-align : ' . $typo_for_tablet['text-align'] . '}}';
        }
        wp_add_inline_style('agntix-breadcrumb-typo', $typo);
    }
    if ($typo_for_mobile) {
        $typo = '';
        $typo .= '@media (max-width: 767px){.breadcrumb__title{' . agntix_arr_to_string($typo_for_mobile) . '}}';
        if (array_key_exists('text-align', $typo_for_mobile)) {
            $typo .= '@media (max-width: 767px){.breadcrumb_content{text-align : ' . $typo_for_mobile['text-align'] . '}}';
        }
        wp_add_inline_style('agntix-breadcrumb-typo', $typo);
    }
}
add_action('wp_enqueue_scripts', 'agntix_breadcrumb_typography');


// agntix_breadcrumb_bg_settings
function agntix_breadcrumb_bg_settings()
{
    global $post;
    $_id = get_the_ID();
    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $bg_color = function_exists('tpmeta_field') ? tpmeta_field('agntix_breadcrumb_bg_color', $_id ? $_id : NULL) : '';
    $bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('agntix_breadcrumb_bg', $_id ? $_id : NULL) : '';
    wp_enqueue_style('agntix-breadcrumb-bg-settings', AGNTIX_THEME_CSS_DIR . 'agntix-custom.css', []);

    if ($bg_color != '') {
        $custom_css = '';

        wp_add_inline_style('agntix-breadcrumb-bg-settings', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agntix_breadcrumb_bg_settings');


// agntix_footer_bg_settings
function agntix_footer_bg_settings()
{
    global $post;
    $_id = get_the_ID();
    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $bg_color = function_exists('tpmeta_field') ? tpmeta_field('agntix_footer_bg_color', $_id ? $_id : NULL) : '';
    $bg_img = function_exists('tpmeta_image_field') ? tpmeta_image_field('agntix_footer_bg', $_id ? $_id : NULL) : '';
    $bg_img = !empty($bg_img['url']) ? $bg_img['url'] : '';
    wp_enqueue_style('agntix-footer-bg-settings', AGNTIX_THEME_CSS_DIR . 'agntix-custom.css', []);

    if ($bg_color != '') {
        $custom_css = '';
        $custom_css .= "div.agntix-footer-settings { background-color: " . $bg_color . " ; background-image: url(" . $bg_img . "); background-size: cover; background-position: center; background-repeat: no-repeat;}";

        wp_add_inline_style('agntix-footer-bg-settings', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agntix_footer_bg_settings');



// theme color
function agntix_custom_color()
{
    $agntix_color_1 = get_theme_mod('agntix_color_1', '#FF5722');
    $agntix_color_2 = get_theme_mod('agntix_color_2', '#C1ED00');
    $agntix_color_3 = get_theme_mod('agntix_color_3', '#D0FF71');    
    $agntix_color_4 = get_theme_mod('agntix_color_4', '#FF4851');
    $agntix_color_5 = get_theme_mod('agntix_color_5', '#FF481F');
    $agntix_color_6 = get_theme_mod('agntix_color_6', '#E9FF48');
    $agntix_color_7 = get_theme_mod('agntix_color_7', '#7463FF');
    $agntix_color_8 = get_theme_mod('agntix_color_8', '#453030');
    $agntix_color_9 = get_theme_mod('agntix_color_9', '#FFF669');
    $agntix_color_10 = get_theme_mod('agntix_color_10', '#4d3d30');
    $agntix_color_11 = get_theme_mod('agntix_color_11', '#141414');
    $agntix_color_12 = get_theme_mod('agntix_color_12', '#2e2d2d');
    $agntix_color_13 = get_theme_mod('agntix_color_13', '#fff');


    wp_enqueue_style('agntix-custom', AGNTIX_THEME_CSS_DIR . 'agntix-custom.css', []);

    if (!empty($agntix_color_1 || $agntix_color_2 || $agntix_color_3 || $agntix_color_4 || $agntix_color_5 || $agntix_color_6 || $agntix_color_7 || $agntix_color_8 || $agntix_color_9 || $agntix_color_10 || $agntix_color_11 || $agntix_color_12 || $agntix_color_13 )) {
        $custom_css = '';
        $custom_css .= "html:root{
            --tp-common-red-3: " . $agntix_color_1 . ";
            --tp-common-green-regular: " . $agntix_color_2 . ";
            --tp-common-green-light: " . $agntix_color_3 . ";
            --tp-common-red: " . $agntix_color_4 . ";
            --tp-common-red-2: " . $agntix_color_5 . ";
            --tp-common-yellow-green: " . $agntix_color_6 . ";
            --tp-common-blue: " . $agntix_color_7 . ";
            --tp-common-brown: " . $agntix_color_8 . ";
            --tp-common-yellow-1: " . $agntix_color_9 . ";
            --tp-theme-shop: " . $agntix_color_10 . ";
           --tp-common-black: " . $agntix_color_11 . ";
            --tp-text-body: " . $agntix_color_12 . ";
            --tp-common-white: " . $agntix_color_13 . ";
        }";

        wp_add_inline_style('agntix-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'agntix_custom_color');



// agntix_kses_intermediate
function agntix_kses_intermediate($string = '')
{
    return wp_kses($string, agntix_get_allowed_html_tags('intermediate'));
}

function agntix_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b' => [],
        'i' => [],
        'u' => [],
        'em' => [],
        'br' => [],
        'abbr' => [
            'title' => [],
        ],
        'span' => [
            'class' => [],
        ],
        'strong' => [],
        'a' => [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function agntix_kses($raw)
{

    $allowed_tags = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'rel' => array(),
            'title' => array(),
            'target' => array(),
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b' => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite' => array(
            'title' => array(),
        ),
        'code' => array(),
        'del' => array(
            'datetime' => array(),
            'title' => array(),
        ),
        'dd' => array(),
        'div' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'h5' => array(),
        'h6' => array(),
        'i' => array(
            'class' => array(),
        ),
        'img' => array(
            'alt' => array(),
            'class' => array(),
            'height' => array(),
            'src' => array(),
            'width' => array(),
        ),
        'li' => array(
            'class' => array(),
        ),
        'ol' => array(
            'class' => array(),
        ),
        'p' => array(
            'class' => array(),
        ),
        'q' => array(
            'cite' => array(),
            'title' => array(),
        ),
        'span' => array(
            'class' => array(),
            'title' => array(),
            'style' => array(),
        ),
        'iframe' => array(
            'width' => array(),
            'height' => array(),
            'scrolling' => array(),
            'frameborder' => array(),
            'allow' => array(),
            'src' => array(),
        ),
        'strike' => array(),
        'br' => array(),
        'strong' => array(),
        'data-wow-duration' => array(),
        'data-wow-delay' => array(),
        'data-wallpaper-options' => array(),
        'data-stellar-background-ratio' => array(),
        'ul' => array(
            'class' => array(),
        ),
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'opacity' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g' => array('fill' => true),
        'title' => array('title' => true),
        'path' => array(
            'd' => true,
            'fill' => true,
            'opacity' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,

        ),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter('get_archives_link', 'agntix_archive_count_span');
function agntix_archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'agntix_cat_count_span');
function agntix_cat_count_span($links)
{
    $links = str_replace('</a> (', '<span> (', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}


function agntix_html_attrs(array $raw_attributes)
{
    $attributes = array();
    foreach ($raw_attributes as $name => $value) {
        $attributes[] = esc_attr($name) . '="' . esc_attr($value) . '"';
    }

    printf(' %s', implode(' ', $attributes));
}


if (function_exists('tutor')) {
    // add color field to course taxonomy

    function add_agntix_course_color_category($term = null)
    {


?>
        <?php if (!is_object($term)): ?>
        <div class="form-field term-color-wrap">
            <label><?php echo esc_html__('Add Color Code', 'agntix'); ?></label>
            <div>
                <input type="text" name="_agntix_course_cat_color">
            </div>
        </div>
        <?php else: ?>

        <tr class="form-field term-thumbnail-wrap">
            <th scope="tutor-row" valign="top"><label><?php echo esc_html__('Color', 'agntix'); ?></label></th>
            <td>
                <div class="form-field term-color-wrap">
                    <div>
                        <input type="text" name="_agntix_course_cat_color"
                            value="<?php echo esc_html(get_term_meta($term->term_id, '_agntix_course_cat_color', true)); ?>">
                    </div>
                </div>
            </td>
        </tr>

        <?php endif; ?>

        <?php
    }

    add_action('course-category_add_form_fields', 'add_agntix_course_color_category');
    add_action('course-category_edit_form_fields', 'add_agntix_course_color_category', 10, 1);

    function save_agntix_course_color_value($term_id)
    {


        if (isset($_POST['_agntix_course_cat_color']) && !empty($_POST['_agntix_course_cat_color'])) {
            update_term_meta($term_id, '_agntix_course_cat_color', $_POST['_agntix_course_cat_color']);
        }
    }

    add_action('create_course-category', 'save_agntix_course_color_value', 10, 1);
    add_action('edited_course-category', 'save_agntix_course_color_value', 10, 1);


    function add_agntix_course_color_column($columns)
    {
        $new_columns = $columns;
        $new_columns['agntix_course_color'] = __('Color', 'agntix');

        return $new_columns;
    }

    add_filter('manage_edit-course-category_columns', 'add_agntix_course_color_column', 10, 1);


    function display_agntix_course_color_column_value($row, $column_name, $term_id)
    {
        if ($column_name == 'agntix_course_color') {
            $row .= get_term_meta($term_id, '_agntix_course_cat_color', true);
        }

        return $row;
    }

    add_filter('manage_course-category_custom_column', 'display_agntix_course_color_column_value', 10, 3);

    function agntix_course_listing_filter($args)
    {
        if (isset($_POST['tutor-course-filter-instructor'])) {
            $args['author'] = is_array($_POST['tutor-course-filter-instructor']) ? implode(',', $_POST['tutor-course-filter-instructor']) : sanitize_text_field($_POST['tutor-course-filter-instructor']);
        }
        return $args;
    }
    add_filter('tutor_course_filter_args', 'agntix_course_listing_filter');
}


function add_agntix_post_color_category($term = null)
{
?>
    <?php if (!is_object($term)): ?>
    <div class="form-field term-color-wrap">
        <label><?php echo esc_html__('Add Color Code', 'agntix'); ?></label>
        <div>
            <input type="text" name="_agntix_post_cat_color">
        </div>
    </div>
    <?php else: ?>

    <tr class="form-field term-color-wrap">
        <th scope="row"><label><?php echo esc_html__('Color', 'agntix'); ?></label></th>
        <td>
            <div class="form-field term-color-wrap">
                <div>
                    <input type="text" name="_agntix_post_cat_color"
                        value="<?php echo esc_html(get_term_meta($term->term_id, '_agntix_post_cat_color', true)); ?>">
                </div>
            </div>
        </td>
    </tr>

    <?php endif; ?>

    <?php
}

add_action('category_add_form_fields', 'add_agntix_post_color_category');
add_action('category_edit_form_fields', 'add_agntix_post_color_category', 10, 1);

function save_agntix_post_color_value($term_id)
{


    if (isset($_POST['_agntix_post_cat_color']) && !empty($_POST['_agntix_post_cat_color'])) {
        update_term_meta($term_id, '_agntix_post_cat_color', $_POST['_agntix_post_cat_color']);
    }
}

add_action('create_category', 'save_agntix_post_color_value', 10, 1);
add_action('edited_category', 'save_agntix_post_color_value', 10, 1);

function add_agntix_post_color_column($columns)
{
    $new_columns = $columns;
    $new_columns['agntix_post_color'] = __('Color', 'agntix');

    return $new_columns;
}

add_filter('manage_edit-category_columns', 'add_agntix_post_color_column', 10, 1);


function display_agntix_post_color_column_value($row, $column_name, $term_id)
{
    if ($column_name == 'agntix_post_color') {
        $row .= "<div style='width: 40px; height: 40px; background-color: " . get_term_meta($term_id, '_agntix_post_cat_color', true) . "'></div>";

    }

    return $row;
}

add_filter('manage_category_custom_column', 'display_agntix_post_color_column_value', 10, 3);