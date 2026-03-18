<?php

/**
 * Breadcrumbs for agntix theme.
 *
 * @package     agntix
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2025, Theme_Pure
 * @link        https://www.wphix.com
 * @since       agntix 1.0.0
 */

function agntix_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    $breadcrumb_layout = get_theme_mod('breadcrumb_layout', 'breadcrumb_1');

    $title = '';

    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'agntix'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'agntix'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    } elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'agntix') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'agntix');
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }

    $_id = get_the_ID() ?? NULL;

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") && is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    // hide breadcrumb from page
    $check_breadcrumb_from_page = function_exists('tpmeta_field') ? tpmeta_field('agntix_is_breadcrumb_on', $_id ? $_id : NULL) : '';

    // hide breadcrumb from globally
    $check_breadcrumb_from_customizer = get_theme_mod('breadcrumb_switch', true);


    // hide breadcrumb based on condition
    if ($check_breadcrumb_from_page == 'off' || $check_breadcrumb_from_customizer == false) {
        return;
    }

    if ($breadcrumb_show == 1) {
        //from page
        $tp_breadcrumb_tabs = function_exists('tpmeta_field') ? tpmeta_field('agntix_breadcrumb_meta_tabs', $_id ? $_id : NULL) : false;
        $elementor_breadcrumb_template_meta = function_exists('tpmeta_field') ? tpmeta_field('agntix_breadcrumb_meta_templates', $_id ? $_id : NULL) : false;

        // from customizer
        $agntix_breadcrumb_elementor_switch = get_theme_mod('agntix_breadcrumb_elementor_switch', false);
        $elementor_breadcrumb_templates_kirki = get_theme_mod('agntix_breadcrumb_templates_kirki');

        ?>
        <?php
        if (($tp_breadcrumb_tabs == 'elementor' || $agntix_breadcrumb_elementor_switch) && function_exists('elementor_fail_php_version')) {
            if ($elementor_breadcrumb_template_meta) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_breadcrumb_template_meta);
            } else {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_breadcrumb_templates_kirki);
            }
        } else {
            ?>
            <?php if ($breadcrumb_layout == 'breadcrumb_1'): ?>
                <section class="tp-breadcrumb-area tp-breadcrumb-ptb z-index-1 tp-breadcrumb-space tp-custom-breadcrumb-bg pb-40">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xxl-12">
                                <div class="tp-breadcrumb-content text-center">
                                    <h3 class="tp-breadcrumb-title tp-breadcrumb-title">
                                        <?php echo agntix_kses($title); ?>
                                    </h3>
                                    <?php if (function_exists('bcn_display')): ?>
                                        <div class="tp-breadcrumb-list">
                                            <?php bcn_display(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php } ?>

        <?php
    }
}

add_action('agntix_before_main_content', 'agntix_breadcrumb_func');
