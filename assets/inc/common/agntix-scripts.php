<?php

/**
 * agntix_scripts description
 * @return [type] [description]
 */
function agntix_scripts()
{


    /**
     * all css files
     */
    wp_enqueue_style('agntix-fonts', agntix_fonts_url(), array());
    if (is_rtl()) {
        wp_enqueue_style('bootstrap-rtl', AGNTIX_THEME_CSS_DIR . 'bootstrap-rtl.css', array());
    } else {
        wp_enqueue_style('bootstrap', AGNTIX_THEME_CSS_DIR . 'bootstrap.css', array());
    }
    wp_enqueue_style('font-awesome-pro', AGNTIX_THEME_CSS_DIR . 'font-awesome-pro.css', []);
    wp_enqueue_style('swiper-bundle', AGNTIX_THEME_CSS_DIR . 'swiper-bundle.css', []);
    wp_enqueue_style('magnific-popup', AGNTIX_THEME_CSS_DIR . 'magnific-popup.css', []);
    wp_enqueue_style('spacing-agntix', AGNTIX_THEME_CSS_DIR . 'spacing.css', []);
    wp_enqueue_style('slick', AGNTIX_THEME_CSS_DIR . 'slick.css', []);
    wp_enqueue_style('nice-select', AGNTIX_THEME_CSS_DIR . 'nice-select.css', []);
    wp_enqueue_style('agntix-atropos', AGNTIX_THEME_CSS_DIR . 'atropos.min.css', []);
    wp_enqueue_style('agntix-unit', AGNTIX_THEME_CSS_DIR . 'agntix-unit.css', []);
    wp_enqueue_style('agntix-core', AGNTIX_THEME_CSS_DIR . 'agntix-core.css', []);
    wp_enqueue_style('agntix-custom-image', AGNTIX_THEME_CSS_DIR . 'custom-image.css', []);
    wp_enqueue_style('agntix-custom', AGNTIX_THEME_CSS_DIR . 'agntix-custom.css', []);
    wp_enqueue_style('agntix-shop', AGNTIX_THEME_CSS_DIR . 'shop.css', []);
    wp_enqueue_style('agntix-custom-mediaquery', AGNTIX_THEME_CSS_DIR . 'agntix-custom-mediaquery.css', []);
    wp_enqueue_style('agntix-style', get_stylesheet_uri());

    // all js
    wp_enqueue_script('bootstrap-bundle', AGNTIX_THEME_JS_DIR . 'bootstrap-bundle.js', ['jquery'], '', true);
    wp_enqueue_script('tp_swiper-bundle', AGNTIX_THEME_JS_DIR . 'swiper-bundle.js', ['jquery'], false, true);
    wp_enqueue_script('plugin', AGNTIX_THEME_JS_DIR . 'plugin.js', ['jquery'], '', true);
    wp_enqueue_script('three', AGNTIX_THEME_JS_DIR . 'three.js');
    wp_enqueue_script('agntix-webgl', AGNTIX_THEME_JS_DIR . 'webgl.js');
    wp_enqueue_script('slick', AGNTIX_THEME_JS_DIR . 'slick.js', ['jquery'], false, true);
    wp_enqueue_script('scroll-magic', AGNTIX_THEME_JS_DIR . 'scroll-magic.js', ['jquery'], false, true);
    wp_enqueue_script('hover-effect', AGNTIX_THEME_JS_DIR . 'hover-effect.umd.js', ['jquery'], false, true);
    wp_enqueue_script('magnific-popup', AGNTIX_THEME_JS_DIR . 'magnific-popup.js', ['jquery'], '', true);
    wp_enqueue_script('nice-select', AGNTIX_THEME_JS_DIR . 'nice-select.js', ['jquery'], '', true);
    wp_enqueue_script('purecounter', AGNTIX_THEME_JS_DIR . 'purecounter.js', ['jquery'], '', true);
    wp_enqueue_script('isotope-pkgd', AGNTIX_THEME_JS_DIR . 'isotope-pkgd.js', ['imagesloaded'], false, true);
    wp_enqueue_script('agntix-slider-active', AGNTIX_THEME_JS_DIR . 'slider-active.js', ['jquery'], false, true);
    wp_enqueue_script('tp-cursor', AGNTIX_THEME_JS_DIR . 'tp-cursor.js', ['jquery'], false, true);
    wp_enqueue_script('atropos', AGNTIX_THEME_JS_DIR . 'atropos.js');
    wp_enqueue_script('observer', AGNTIX_THEME_JS_DIR . 'Observer.min.js');
    wp_enqueue_script('parallax', AGNTIX_THEME_JS_DIR . 'parallax-scroll.js');
    wp_enqueue_script('splitting', AGNTIX_THEME_JS_DIR . 'splitting.min.js');
    wp_enqueue_script('agntix-main', AGNTIX_THEME_JS_DIR . 'main.js', ['jquery'], false, true);
    wp_enqueue_script_module('agntix-parallax_slider', AGNTIX_THEME_JS_DIR . 'parallax-slider.js');
    wp_enqueue_script_module('agntix-distortion', AGNTIX_THEME_JS_DIR . 'distortion-img.js');
    wp_enqueue_script_module('agntix-portfolio-slider-1', AGNTIX_THEME_JS_DIR . 'portfolio-slider-1.js');
    wp_enqueue_script_module('img-revel', AGNTIX_THEME_JS_DIR . 'img-revel/index.js');
    wp_enqueue_script_module('skew-slider', AGNTIX_THEME_JS_DIR . 'skew-slider/index.js');
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'agntix_scripts');

/*
Register Fonts
 */
function agntix_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'agntix' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Inter:wght@300;400;500;600;700;800&family=Besley:wght@400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=Playfair+Display:wght@300;400;500;600;700;800&family=Satisfy:wght@400&family=Teko:wght@300;400;500;600;700&family=Phudu:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&family=Onest:wght@300;400;500;600;700;800&display=swap');
    }
    return $font_url;
}