<?php


new \Kirki\Panel(
    'agntix_panel',
    [
        'priority' => 10,
        'title' => esc_html__('Agntix Customizer', 'agntix'),
        'description' => esc_html__('agntix Theme Customizer.', 'agntix'),
    ]
);

function agntix_theme_settings()
{

    new \Kirki\Section(
        'agntix_theme_settings_section',
        [
            'title' => esc_html__('Theme Settings', 'agntix'),
            'description' => esc_html__('Theme Controls.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 100,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_header_sticky',
            'label' => esc_html__('Header Sticky Switcher', 'agntix'),
            'description' => esc_html__('Header Sticky On/Off', 'agntix'),
            'section' => 'agntix_theme_settings_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_theme_smooth_scroll_switch',
            'label' => esc_html__('Smooth Scroll Switcher', 'agntix'),
            'description' => esc_html__('Smooth Scroll On/Off', 'agntix'),
            'section' => 'agntix_theme_settings_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_theme_magic_cursor_switch',
            'label' => esc_html__('Magic Cursor Switcher', 'agntix'),
            'description' => esc_html__('Smooth Scroll On/Off', 'agntix'),
            'section' => 'agntix_theme_settings_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_theme_magic_cursor_small_pointer',
            'label' => __('Small Pointer Color', 'agntix'),
            'description' => esc_html__('Select Color For Small Pointer', 'agntix'),
            'section' => 'agntix_theme_settings_section',
            'default' => '#000000',
            'active_callback' => [
                [
                    'setting' => 'agntix_theme_magic_cursor_switch',
                    'operator' => '==',
                    'value' => true,
                ]
            ]
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_theme_magic_cursor_big_pointer',
            'label' => __('Big Pointer Color', 'agntix'),
            'description' => esc_html__('Select Color For Big Pointer', 'agntix'),
            'section' => 'agntix_theme_settings_section',
            'default' => '#ffffff',
            'active_callback' => [
                [
                    'setting' => 'agntix_theme_magic_cursor_switch',
                    'operator' => '==',
                    'value' => true,
                ]
            ]
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_theme_magic_cursor_text_color',
            'label' => __('Text Color', 'agntix'),
            'description' => esc_html__('Select Color For Big Pointer', 'agntix'),
            'section' => 'agntix_theme_settings_section',
            'default' => '#000000',
            'active_callback' => [
                [
                    'setting' => 'agntix_theme_magic_cursor_switch',
                    'operator' => '==',
                    'value' => true,
                ]
            ]
        ]
    );


}
agntix_theme_settings();


function agntix_header_settings()
{

    new \Kirki\Section(
        'header_main_section',
        [
            'title' => esc_html__('Header Main Settings', 'agntix'),
            'description' => esc_html__('Header Main Controls.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 101,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_header_elementor_switch',
            'label' => esc_html__('Header Custom/Elementor Switch', 'agntix'),
            'description' => esc_html__('Header Custom/Elementor On/Off', 'agntix'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'header_layout_custom',
            'label' => esc_html__('Chose Header Style', 'agntix'),
            'section' => 'header_main_section',
            'priority' => 10,
            'choices' => [
                'header_1' => get_template_directory_uri() . '/inc/img/header/header-1.jpg',
            ],
            'default' => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'agntix_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_buildertype = array(
        'post_type' => 'tp-header',
        'posts_per_page' => -1,
    );
    $header_buildertype_loop = get_posts($header_buildertype);

    $header_post_obj_arr = array();
    foreach ($header_buildertype_loop as $post) {
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_query();


    new \Kirki\Field\Select(
        [
            'settings' => 'agntix_header_templates',
            'label' => esc_html__('Elementor Header Template', 'agntix'),
            'section' => 'header_main_section',
            'placeholder' => esc_html__('Choose an option', 'agntix'),
            'choices' => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'agntix_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'header_right_switch',
            'label' => esc_html__('Header Right Switch', 'agntix'),
            'description' => esc_html__('Header Right On/Off', 'agntix'),
            'section' => 'header_main_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_header_btn_text',
            'label' => esc_html__('Button Title', 'agntix'),
            'section' => 'header_main_section',
            'default' => esc_html__('Get in Touch', 'agntix'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'header_right_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'agntix_header_btn_url',
            'label' => esc_html__('Button URL', 'agntix'),
            'section' => 'header_main_section',
            'default' => '#',
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'header_right_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

}
agntix_header_settings();

function agntix_logo_settings()
{
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title' => esc_html__('Header Logo', 'agntix'),
            'description' => esc_html__('Header Logo Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 101,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings' => 'header_logo_black',
            'label' => esc_html__('Header Logo', 'agntix'),
            'description' => esc_html__('Theme Default/Primary Logo Here', 'agntix'),
            'section' => 'header_logo_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/logo-white.png',
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'agntix_header_logo_width',
            'label' => __('Logo Width', 'agntix'),
            'section' => 'header_logo_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'width' => '120px',
                ],
                'tablet' => [
                    'width' => '90px',
                ],
                'mobile' => [
                    'width' => '85px',
                ],
            ],
            'output' => [
                [
                    'element' => '.tp-logo img',
                    'property' => 'width',
                    'value_pattern' => '$ !important',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );
}
agntix_logo_settings();


function agntix_offcanvas_settings()
{

    new \Kirki\Section(
        'agntix_offcanvas_section',
        [
            'title' => esc_html__('Offcanvas Settings', 'agntix'),
            'description' => esc_html__('Offcanvas Controls.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 102,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'agntix_offcanvas_logo',
            'label' => esc_html__('Offcanvas Logo', 'agntix'),
            'section' => 'agntix_offcanvas_section',
            'default' => get_template_directory_uri() . '/assets/img/logo/logo-white.png',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Dimension(
        [
            'settings' => 'agntix_offcanvas_logo_width',
            'label' => __('Logo Width', 'agntix'),
            'section' => 'agntix_offcanvas_section',
            'responsive' => true,
            'default' => [
                'desktop' => '135px',
                'tablet' => '135px',
                'mobile' => '135px',
            ],
            'output' => [
                [
                    'element' => '.tp-offcanvas-logo img',
                    'property' => 'width',
                    'value_pattern' => '$ !important',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_offcanvas_content_switch',
            'label' => esc_html__('Offcanvas Content Switch', 'agntix'),
            'description' => esc_html__('Offcanvas Content On/Off', 'agntix'),
            'section' => 'agntix_offcanvas_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_offcanvas_title',
            'label' => esc_html__('Offcanvas Title', 'agntix'),
            'section' => 'agntix_offcanvas_section',
            'default' => esc_html__('Hello There!', 'agntix'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'agntix_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings' => 'agntix_offcanvas_content',
            'label' => esc_html__('Offcanvas Content', 'agntix'),
            'section' => 'agntix_offcanvas_section',
            'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, ', 'agntix'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'agntix_offcanvas_content_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}

agntix_offcanvas_settings();

function agntix_back_to_top_section()
{

    new \Kirki\Section(
        'back_to_top_section',
        [
            'title' => esc_html__('Back To Top Settings', 'agntix'),
            'description' => esc_html__('Back To Top Controls.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 103,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_backtotop_switch',
            'label' => esc_html__('Back To Top Switch', 'agntix'),
            'description' => esc_html__('Back To Top On/Off', 'agntix'),
            'section' => 'back_to_top_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'back_to_top_bg',
            'label' => __('Back To Top BG Color', 'agntix'),
            'description' => esc_html__('You can change Back To Top bg color from here.', 'agntix'),
            'section' => 'back_to_top_section',
            'default' => '#fff',
            'output' => [
                [
                    'element' => '.back-to-top-btn',
                    'property' => 'background',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'agntix_backtotop_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'back_to_top_icon_color',
            'label' => __('Back To Top Icon Color', 'agntix'),
            'description' => esc_html__('You can change Back To Top icon color from here.', 'agntix'),
            'section' => 'back_to_top_section',
            'default' => '#141414',
            'output' => [
                [
                    'element' => '.back-to-top-btn',
                    'property' => 'color',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'agntix_backtotop_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}
agntix_back_to_top_section();


function agntix_preloader_settings()
{

    new \Kirki\Section(
        'preloader_section',
        [
            'title' => esc_html__('Preloader Settings', 'agntix'),
            'description' => esc_html__('Preloader Controls.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 104,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_preloader_switch',
            'label' => esc_html__('Preloader Switch', 'agntix'),
            'description' => esc_html__('Preloader On/Off', 'agntix'),
            'section' => 'preloader_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Background(
        [
            'settings' => 'agntix_preloader_loading_bg',
            'label' => __('Background', 'agntix'),
            'description' => esc_html__('Background conrols are pretty complex! (but useful if used properly)', 'agntix'),
            'section' => 'preloader_section',
            'default' => [
                'background-color' => '#A0FF27',
                'background-image' => '',
                'background-repeat' => 'repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '#preloader',
                ],
            ],
            'active_callback' => [
                [
                    'setting' => 'agntix_preloader_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );
}

agntix_preloader_settings();



function agntix_breadcrumb_settings()
{

    new \Kirki\Section(
        'agntix_breadcrumb_section',
        [
            'title' => esc_html__('Breadcrumb Settings', 'agntix'),
            'description' => esc_html__('Breadcrumb Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 105,
        ]
    );



    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'breadcrumb_switch',
            'label' => esc_html__('Show Breadcrumb Globally', 'agntix'),
            'description' => esc_html__('Breadcrumb On/Off', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'default' => true,
            'choices' => [
                'on' => esc_html__('Show', 'agntix'),
                'off' => esc_html__('Hide', 'agntix'),
            ],

        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_breadcrumb_elementor_switch',
            'label' => esc_html__('Breadcrumb Custom/Elementor Switch', 'agntix'),
            'description' => esc_html__('Breadcrumb Custom/Elementor On/Off', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    $breadcrumb_buildertype = array(
        'post_type' => 'tp-breadcrumb',
        'posts_per_page' => -1,
    );
    $breadcrumb_buildertype_loop = get_posts($breadcrumb_buildertype);

    $breadcrumb_post_obj_arr = array();
    foreach ($breadcrumb_buildertype_loop as $post) {
        $breadcrumb_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_query();

    new \Kirki\Field\Select(
        [
            'settings' => 'agntix_breadcrumb_templates_kirki',
            'label' => esc_html__('Elementor Breadcrumb Template', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'placeholder' => esc_html__('Choose an option', 'agntix'),
            'choices' => $breadcrumb_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'agntix_breadcrumb_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );


    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'breadcrumb_layout',
            'label' => esc_html__('Choose Default Breadcrumb', 'agntix'),
            'description' => esc_html__('Choose Breadcrumb For Single Blog Post page', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'priority' => 10,
            'choices' => [
                'breadcrumb_1' => get_template_directory_uri() . '/inc/img/breadcrumb/b-1.jpg',
            ],
            'default' => 'breadcrumb_1',
            'active_callback' => [
                [
                    'setting' => 'agntix_breadcrumb_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    new \Kirki\Field\Radio_Buttonset(
        [
            'settings' => 'breadcrumb_typography_responsive_control',
            'label' => esc_html__('Typography Control', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'default' => 'desktop',
            'priority' => 10,
            'choices' => [
                'desktop' => esc_html__('Desktop', 'agntix'),
                'tablet' => esc_html__('Tablet', 'agntix'),
                'mobile' => esc_html__('Mobile', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_desktop',
            'label' => esc_html__('Typography Control', 'agntix'),
            'description' => esc_html__('Set typography for desktop', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#ffffff',
                'font-size' => '',
                'line-height' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'desktop'
                ]
            ],
            'output' => [
                [
                    'element' => '.tp-breadcrumb-title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_tablet',
            'label' => esc_html__('Typography Control', 'agntix'),
            'description' => esc_html__('Set typography for tablet', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#ffffff',
                'font-size' => '',
                'line-height' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'tablet'
                ]
            ],
            'output' => [
                [
                    'element' => '.tp-breadcrumb-title',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'breadcrumb_typography_mobile',
            'label' => esc_html__('Typography Control', 'agntix'),
            'description' => esc_html__('Set typography for mobile', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '#ffffff',
                'font-size' => '',
                'line-height' => '',
            ],
            'active_callback' => [
                [
                    'setting' => 'breadcrumb_typography_responsive_control',
                    'operator' => '==',
                    'value' => 'mobile'
                ]
            ],
            'output' => [
                [
                    'element' => '.tp-breadcrumb-title',
                ],
            ],
        ]
    );


    new \Kirki\Field\Background(
        [
            'settings' => 'breadcrumb_background_setting',
            'label' => esc_html__('Breadcrumb Background', 'agntix'),
            'description' => esc_html__('Background conrols for breadcrumb', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'default' => [
                'background-color' => '#0E0F11',
                'background-image' => '',
                'background-repeat' => 'no-repeat',
                'background-position' => 'center center',
                'background-size' => 'cover',
                'background-attachment' => 'scroll',
            ],
            'transport' => 'auto',
            'output' => [
                [
                    'element' => '.tp-custom-breadcrumb-bg',
                ],
            ],
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings' => 'agntix_breadcrumb_padding',
            'label' => __('Padding', 'agntix'),
            'section' => 'agntix_breadcrumb_section',
            'responsive' => true,
            'default' => [
                'desktop' => [
                    'padding-top' => '180px',
                    'padding-bottom' => '20px',
                ],
                'tablet' => [
                    'padding-top' => '160px',
                    'padding-bottom' => '10px',
                ],
                'mobile' => [
                    'padding-top' => '150px',
                    'padding-bottom' => '10px',
                ],
            ],
            'output' => [
                [
                    'element' => '.tp-breadcrumb-space',
                    'media_query' => [
                        'desktop' => '@media (min-width: 1024px)',
                        'tablet' => '@media (min-width: 768px) and (max-width: 1023px)',
                        'mobile' => '@media (max-width: 767px)',
                    ],
                ],
            ],
        ]
    );
}
agntix_breadcrumb_settings();

function agntix_blog_settings()
{
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title' => esc_html__('Blog Settings', 'agntix'),
            'description' => esc_html__('Blog Section Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 106,
        ]
    );


    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'agntix_blog_single_layout',
            'label' => esc_html__('Choose Blog Layout', 'agntix'),
            'section' => 'blog_section',
            'priority' => 10,
            'choices' => [
                'blog_single_default' => get_template_directory_uri() . '/inc/img/blog/blog-standard.jpg',
                'blog_single_full_width' => get_template_directory_uri() . '/inc/img/blog/blog-classic.jpg',
            ],
            'default' => 'blog_single_default',
        ]
    );

    new \Kirki\Field\Radio_Buttonset(
        [
            'settings' => 'agntix_blog_sidebar_system',
            'label' => esc_html__('Sidebar Controls', 'agntix'),
            'section' => 'blog_section',
            'default' => 'right',
            'priority' => 10,
            'choices' => [
                'right' => esc_html__('Right', 'agntix'),
                'left' => esc_html__('Left', 'agntix'),
                'no_sidebar' => esc_html__('No Sidebar', 'agntix'),
            ],
            'active_callback' => [
                [
                    'setting' => 'agntix_blog_single_layout',
                    'operator' => '==',
                    'value' => 'blog_single_default'
                ]
            ],
        ]
    );

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_blog_button',
            'label' => esc_html__('Blog Read more Button On/Off', 'agntix'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,

        ]
    );

    // blog_section BTN text
    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_blog_button_text',
            'label' => esc_html__('Button Text', 'agntix'),
            'section' => 'blog_section',
            'default' => esc_html__('Read More', 'agntix'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'agntix_blog_button',
                    'operator' => '==',
                    'value' => true
                ]
            ],
        ]
    );

    // blog_section category Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_blog_cat',
            'label' => esc_html__('Blog Category Meta On/Off', 'agntix'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_blog_author',
            'label' => esc_html__('Blog Author Meta On/Off', 'agntix'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_blog_date',
            'label' => esc_html__('Blog Date Meta On/Off', 'agntix'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_blog_tags',
            'label' => esc_html__('Blog Tags Meta On/Off', 'agntix'),
            'section' => 'blog_section',
            'default' => true,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_blog_single_social',
            'label' => esc_html__('Single Blog Social Share', 'agntix'),
            'section' => 'blog_section',
            'default' => false,
            'priority' => 10,
        ]
    );
}
agntix_blog_settings();

function error_404_section()
{
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title' => esc_html__('404 Page', 'agntix'),
            'description' => esc_html__('404 Page Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 107,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings' => 'agntix_error_thumb',
            'label' => esc_html__('Error Image', 'agntix'),
            'description' => esc_html__('rror Image Here', 'agntix'),
            'section' => 'error_404_section',
            'default' => get_template_directory_uri() . '/assets/img/error/error.png',
        ]
    );

    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_error_title',
            'label' => esc_html__('Not Found Title', 'agntix'),
            'section' => 'error_404_section',
            'default' => "Oops!",
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_error_title_sm',
            'label' => esc_html__('Something went Wrong...', 'agntix'),
            'section' => 'error_404_section',
            'default' => "Oops! Page not found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'agntix_error_desc',
            'label' => esc_html__('Not Found description', 'agntix'),
            'section' => 'error_404_section',
            'default' => "Sorry, we couldn\'t find your page.",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_error_link_text',
            'label' => esc_html__('Error Link Text', 'agntix'),
            'section' => 'error_404_section',
            'default' => "Back To Home",
            'priority' => 10,
        ]
    );
}
error_404_section();

function woo_product_section()
{
    new \Kirki\Section(
        'woo_product_section',
        [
            'title' => esc_html__('WooCommerce Section', 'agntix'),
            'description' => esc_html__('Single Product Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 107,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_buy_now_switch',
            'label' => esc_html__('Buy Now Button Switch', 'agntix'),
            'description' => esc_html__('Buy Now Button On/Off', 'agntix'),
            'section' => 'woo_product_section',
            'default' => 'on',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    // woo_product_section BTN text
    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_buy_now_text',
            'label' => esc_html__('Buy Now Button Text', 'agntix'),
            'section' => 'woo_product_section',
            'default' => esc_html__('Buy Now', 'agntix'),
            'priority' => 10,
            'active_callback' => [
                [
                    'setting' => 'agntix_buy_now_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

}
woo_product_section();

function full_site_typography()
{
    new \Kirki\Section(
        'full_site_typography',
        [
            'title' => esc_html__('Typography', 'agntix'),
            'description' => esc_html__('Typography Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h1',
            'label' => esc_html__('H1 Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h1',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h2',
            'label' => esc_html__('H2 Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h2',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h3',
            'label' => esc_html__('H3 Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h3',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h4',
            'label' => esc_html__('H4 Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h4',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h5',
            'label' => esc_html__('H5 Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h5',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_h6',
            'label' => esc_html__('H6 Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'h6',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_body',
            'label' => esc_html__('Body Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'body',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings' => 'full_site_typography_settings_p',
            'label' => esc_html__('Paragraph Typography Control', 'agntix'),
            'description' => esc_html__('The full set of options.', 'agntix'),
            'section' => 'full_site_typography',
            'priority' => 10,
            'transport' => 'auto',
            'default' => [
                'font-family' => '',
                'variant' => '',
                'color' => '',
                'font-size' => '',
                'line-height' => '',
                'text-align' => '',
            ],
            'output' => [
                [
                    'element' => 'p',
                ],
            ],
        ]
    );
}
full_site_typography();

function agntix_footer_settings()
{

    new \Kirki\Section(
        'agntix_footer_section',
        [
            'title' => esc_html__('Footer', 'agntix'),
            'description' => esc_html__('Footer Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings' => 'footer_widget_number',
            'label' => esc_html__('Footer Widget Number', 'agntix'),
            'section' => 'agntix_footer_section',
            'default' => '4',
            'placeholder' => esc_html__('Choose an option', 'agntix'),
            'choices' => [
                '1' => esc_html__('1', 'agntix'),
                '2' => esc_html__('2', 'agntix'),
                '3' => esc_html__('3', 'agntix'),
                '4' => esc_html__('4', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'agntix_footer_elementor_switch',
            'label' => esc_html__('Footer Custom/Elementor Switch', 'agntix'),
            'description' => esc_html__('Footer Custom/Elementor On/Off', 'agntix'),
            'section' => 'agntix_footer_section',
            'default' => 'off',
            'choices' => [
                'on' => esc_html__('Enable', 'agntix'),
                'off' => esc_html__('Disable', 'agntix'),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings' => 'footer_layout_custom',
            'label' => esc_html__('Footer Layout Control', 'agntix'),
            'section' => 'agntix_footer_section',
            'priority' => 10,
            'choices' => [
                'footer_1' => get_template_directory_uri() . '/inc/img/footer/footer-1.jpg',

            ],
            'default' => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'agntix_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_buildertype = array(
        'post_type' => 'tp-footer',
        'posts_per_page' => -1,
    );
    $footer_buildertype_loop = get_posts($footer_buildertype);
    $footer_post_obj_arr = array();
    foreach ($footer_buildertype_loop as $post) {
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings' => 'agntix_footer_templates',
            'label' => esc_html__('Elementor Footer Template', 'agntix'),
            'section' => 'agntix_footer_section',
            'placeholder' => esc_html__('Choose an option', 'agntix'),
            'choices' => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'agntix_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'agntix_copyright',
            'label' => esc_html__('Footer Copyright', 'agntix'),
            'section' => 'agntix_footer_section',
            'default' => esc_html__('© Copyright 2025 | Allright Reserved Agntix', 'agntix'),
            'priority' => 10,
        ]
    );
}
agntix_footer_settings();

function agntix_theme_colors()
{
    new \Kirki\Section(
        'agntix_theme_color_section',
        [
            'title' => esc_html__('Theme Colors', 'agntix'),
            'description' => esc_html__('Theme Color Settings.', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_1',
            'label' => __('Color 1', 'agntix'),
            'description' => esc_html__('This is Modern Agency Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#FF5722',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_2',
            'label' => __('Color 2', 'agntix'),
            'description' => esc_html__('This is Digital Marketing Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#C1ED00',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_3',
            'label' => __('Color 3', 'agntix'),
            'description' => esc_html__('This is Creative Studio Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#D0FF71',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_4',
            'label' => __('Color 4', 'agntix'),
            'description' => esc_html__('This is Creative Agency Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#FF4851',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_5',
            'label' => __('Color 5', 'agntix'),
            'description' => esc_html__('This is Architecture Hub Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#FF481F',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_6',
            'label' => __('Color 6', 'agntix'),
            'description' => esc_html__('This is Corporate Agency Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#E9FF48',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_7',
            'label' => __('Color 7', 'agntix'),
            'description' => esc_html__('This is It Solution Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#7463FF',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_8',
            'label' => __('Color 8', 'agntix'),
            'description' => esc_html__('This is Startup Agency Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#453030',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_9',
            'label' => __('Color 9', 'agntix'),
            'description' => esc_html__('This is Personal Portfolio Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#FFF669',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_10',
            'label' => __('Color 10', 'agntix'),
            'description' => esc_html__('This is Shop  Page Primary Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#4d3d30',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_11',
            'label' => __('Color 11', 'agntix'),
            'description' => esc_html__('This is Heading Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#141414',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_12',
            'label' => __('Color 12', 'agntix'),
            'description' => esc_html__('This is Body Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#2e2d2d',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings' => 'agntix_color_13',
            'label' => __('Color 13', 'agntix'),
            'description' => esc_html__('This is White Color', 'agntix'),
            'section' => 'agntix_theme_color_section',
            'default' => '#fff',
        ]
    );

}

agntix_theme_colors();


// agntix_post_type_slug_section
function agntix_post_type_slug_section()
{
    $options = get_option('agntix_options');
    if (isset($options['agntix_portfolios_slug']) && !empty($options['agntix_portfolios_slug'])) {
        $portfolios_slug = $options['agntix_portfolios_slug'];
    } else {
        $portfolios_slug = 'tp-portfolios';
    }
    if (isset($options['agntix_services_slug']) && !empty($options['agntix_services_slug'])) {
        $services_slug = $options['agntix_services_slug'];
    } else {
        $services_slug = 'tp-services';
    }
    new \Kirki\Section(
        'agntix_post_type_slug_section',
        [
            'title' => esc_html__('Slug Settings', 'agntix'),
            'panel' => 'agntix_panel',
            'priority' => 190,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'agntix_portfolios_slug',
            'label' => esc_html__('Portfolios Slug', 'agntix'),
            'section' => 'agntix_post_type_slug_section',
            'default' => $portfolios_slug,
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'agntix_services_slug',
            'label' => esc_html__('Services Slug', 'agntix'),
            'section' => 'agntix_post_type_slug_section',
            'default' => $services_slug,
            'priority' => 10,
        ]
    );

}
// agntix_post_type_slug_section();