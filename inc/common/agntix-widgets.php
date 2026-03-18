<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function agntix_widgets_init()
{
    /**
     * blog sidebar
     */
    register_sidebar([
        'name'          => esc_html__('Blog Sidebar', 'agntix'),
        'id'            => 'blog-sidebar',
        'description'   => esc_html__('Set Your Blog Widget', 'agntix'),
        'before_widget' => '<div id="%1$s" class="sidebar-widget tp-blog-sidebar-widget mb-45 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar-widget-title">',
        'after_title'   => '</h3>',
    ]);  

    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    // footer default
    for ($num = 1; $num <= $footer_widgets; $num++) {
        register_sidebar([
            'name'          => sprintf(esc_html__('Footer %1$s', 'agntix'), $num),
            'id'            => 'footer-' . $num,
            'description'   => sprintf(esc_html__('Footer column %1$s', 'agntix'), $num),
            'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-50 tp-footer-col-' . $num . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="tp-footer-widget-title-sm tp-default-footer-widget-title mb-20">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'agntix_widgets_init');
