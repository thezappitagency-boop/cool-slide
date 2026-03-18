<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package agntix
 */

$post_id = get_queried_object_id();
$theme_bg_id = function_exists('tpmeta_field') ? tpmeta_field('agntix_theme_bg_color', $post_id) : '';

$theme_bg_color = '';
if ($theme_bg_id == 'dark') {
    $theme_bg_color = 'agntix-dark';
} elseif ($theme_bg_id == 'light') {
    $theme_bg_color = 'agntix-light';
} elseif ($theme_bg_id == 'default') {
    $theme_bg_color = '';
}

$agntix_smooth_scroll = get_theme_mod('agntix_theme_smooth_scroll_switch', 'off');

$agntix_smooth_scroll_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_smooth_scroll') : NULL;

$enable_smooth_scroll_condition = !empty($agntix_smooth_scroll_from_page) && $agntix_smooth_scroll_from_page == 'default' ? $agntix_smooth_scroll : $agntix_smooth_scroll_from_page;

$enable_smooth_scroll = ($enable_smooth_scroll_condition == 'on') ? true : false;



?>

<!doctype html>
<html <?php language_attributes(); ?> class="<?php echo esc_attr($theme_bg_color); ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())): ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(' tp-magic-cursor'); ?>>

    <?php wp_body_open(); ?>
    <?php
    $agntix_preloader = get_theme_mod('agntix_preloader_switch', false);
    $agntix_preloader_loading_text = get_theme_mod('agntix_preloader_loading_text', __('Loading', 'agntix'));
    $agntix_preloader_logo = get_theme_mod('agntix_preloader_logo', get_template_directory_uri() . '/assets/img/logo/preloader.png');

    $agntix_backtotop = get_theme_mod('agntix_backtotop_switch', false);





    $magic_cursor_switcher_theme = get_theme_mod('agntix_theme_magic_cursor_switch', false);
    $small_cursor_from_global = get_theme_mod('agntix_theme_magic_cursor_small_pointer', '#000');
    $big_cursor_from_global = get_theme_mod('agntix_theme_magic_cursor_big_pointer', '#fff');
    $cursor_text_from_global = get_theme_mod('agntix_theme_magic_cursor_text_color', '#000');

    $magic_cursor_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_magic_cursor_from_page') : NULL;
    $small_cursor_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_magic_cursor_from_page_small') : NULL;
    $big_cursor_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_magic_cursor_from_page_big') : NULL;
    $cursor_text_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_magic_cursor_text_color_from_page') : NULL;

    if ($magic_cursor_from_page == 'default') {
        $magic_cursor = $magic_cursor_switcher_theme;
        $small_cursor = $small_cursor_from_global;
        $big_cursor = $big_cursor_from_global;
        $text_color = $cursor_text_from_global;
    } elseif ($magic_cursor_from_page == 'on') {
        $magic_cursor = true;
        $small_cursor = $small_cursor_from_page;
        $big_cursor = $big_cursor_from_page;
        $text_color = $cursor_text_from_page;
    } else {
        $magic_cursor = false;
        $small_cursor = $small_cursor_from_global;
        $big_cursor = $big_cursor_from_global;
        $text_color = $cursor_text_from_global;
    }


    ?>

    <!-- Begin magic cursor -->
    <?php if ($magic_cursor): ?>
        <div id="magic-cursor" class="cursor-white-bg">
            <div id="ball" data-text-color="<?php echo esc_attr($text_color); ?>"
                style="background-color: <?php echo esc_attr($small_cursor); ?>"
                data-small-cursor="<?php echo esc_attr($small_cursor); ?>"
                data-big-cursor="<?php echo esc_attr($big_cursor); ?>"></div>
        </div>
    <?php endif; ?>
    <!-- End magic cursor -->

    <?php if ($agntix_preloader): ?>
        <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($agntix_backtotop): ?>
        <div class="back-to-top-wrapper">
            <button id="back_to_top" type="button" class="back-to-top-btn">
                <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    <?php endif; ?>

    <!-- header start -->
    <?php do_action('agntix_header_style'); ?>
    <!-- header end -->

    <?php if ($enable_smooth_scroll == 'on'): ?>
        <div id="smooth-wrapper">
            <div id="smooth-content">
            <?php endif; ?>
            <?php do_action('agntix_before_main_content'); ?>