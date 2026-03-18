<?php

// Sample Config for single site (multiple zip).
add_filter('sd/edi/importer/config', 'sd_edi_single_site_config');
/**
 * Sample Config for single site (multiple zip).
 *
 * @return array
 */
function sd_edi_single_site_config()
{
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $url = 'https://wp.aqlova.com/agntix/source/';
    $base_url = 'https://wp.aqlova.com/agntix';
    $plugins = [
        'elementor' => [
            'name' => 'Elementor Page Builder',
            'source' => 'wordpress',
            'filePath' => 'elementor/elementor.php',
        ],
        'breadcrumb-navxt' => [
            'name' => 'Breadcrumb NavXT',
            'source' => 'wordpress',
            'filePath' => 'breadcrumb-navxt/breadcrumb-navxt.php',
        ],
        'classic-editor' => [
            'name' => 'WP Classic Editor',
            'source' => 'wordpress',
            'filePath' => 'classic-editor/classic-editor.php',
        ],
        'pure-metafields' => [
            'name' => 'Pure Metafields',
            'source' => 'wordpress',
            'filePath' => 'pure-metafields/pure-metafields.php',
        ],
        'contact-form-7' => [
            'name' => 'Contact Form 7',
            'source' => 'wordpress',
            'filePath' => 'contact-form-7/wp-contact-form-7.php',
        ],
        'kirki' => [
            'name' => 'Kirki Customizer Framework',
            'source' => 'wordpress',
            'filePath' => 'kirki/kirki.php',
        ],
        'agntix-core' => [
            'name' => 'Agntix Core',
            'source' => 'bundled',
            'filePath' => 'agntix-core/agntix-core.php',
            'location' => $url . 'agntix-core.zip',
        ],
        // Add more plugins as needed
    ];

    $woo_plugins = [
        'woocommerce' => [
            'name' => 'WooCommerce',
            'source' => 'wordpress',
            'filePath' => 'woocommerce/woocommerce.php',
        ],
        'shopbuild' => [
            'name' => 'StoreBuild',
            'source' => 'wordpress',
            'filePath' => 'shopbuild/shopbuild.php',
        ],
        'pure-wc-variations-swatches' => [
            'name' => 'Pure WC Variation Swatches',
            'source' => 'wordpress',
            'filePath' => 'pure-wc-variations-swatches/pure-wc-variation-swatches.php',
        ],
    ];

    $menu = [
        'main-menu' => 'Main Menu',
    ];

    return [
        'themeName' => 'Agntix',
        'themeSlug' => 'agntix',
        // Allow multiple zip files to true (for single site demo).
        'multipleZip' => true,
        // Array of demo data.
        'demoData' => [
            // Treat individual array as a separate demo.
            'modern-agency' => [
                'name' => esc_html__('Modern Agency', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-1.jpg',
                'previewUrl' => $base_url . '/modern-agency',
                'demoZip' => $base_url . '/sample-data/modern-agency/modern-agency.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                  
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'digital-marketing' => [
                'name' => esc_html__('Digital Marketing', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-3.jpg',
                'previewUrl' => $base_url . '/digital-marketing',
                'demoZip' => $base_url . '/sample-data/digital-marketing/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'design-studio' => [
                'name' => esc_html__('Design Studio', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-2.jpg',
                'previewUrl' => $base_url . '/design-studio',
                'demoZip' => $base_url . '/sample-data/design-studio/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'creative-agency' => [
                'name' => esc_html__('Creative Agency', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-6.jpg',
                'previewUrl' => $base_url . '/creative-agency',
                'demoZip' => $base_url . '/sample-data/creative-agency/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'creative-studio' => [
                'name' => esc_html__('Creative Studio', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-4.jpg',
                'previewUrl' => $base_url . '/creative-studio',
                'demoZip' => $base_url . '/sample-data/creative-studio/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'design-agency' => [
                'name' => esc_html__('Design Agency', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-5.jpg',
                'previewUrl' => $base_url . '/design-agency',
                'demoZip' => $base_url . '/sample-data/design-agency/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'corporate-agency' => [
                'name' => esc_html__('Corporate Agency', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-9.jpg',
                'previewUrl' => $base_url . '/corporate-agency',
                'demoZip' => $base_url . '/sample-data/corporate-agency/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'architecture-hub' => [
                'name' => esc_html__('Architecture Hub', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-7.jpg',
                'previewUrl' => $base_url . '/architecture-hub',
                'demoZip' => $base_url . '/sample-data/architecture/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'ai-image-genaretor' => [
                'name' => esc_html__('AI Image Genaretor', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-8.jpg',
                'previewUrl' => $base_url . '/ai-image-genaretor',
                'demoZip' => $base_url . '/sample-data/ai-image/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'mobile-app' => [
                'name' => esc_html__('Mobile App', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-10.jpg',
                'previewUrl' => $base_url . '/mobile-app',
                'demoZip' => $base_url . '/sample-data/mobile-app/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'cryptocurrency' => [
                'name' => esc_html__('Cryptocurrency', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-12.jpg',
                'previewUrl' => $base_url . '/cryptocurrency',
                'demoZip' => $base_url . '/sample-data/cryptocurrency/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'it-solutions' => [
                'name' => esc_html__('IT Solutions', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-11.jpg',
                'previewUrl' => $base_url . '/it-solutions',
                'demoZip' => $base_url . '/sample-data/it-solutions/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'personal-portfolio' => [
                'name' => esc_html__('Personal Portfolio', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-15.jpg',
                'previewUrl' => $base_url . '/personal-portfolio',
                'demoZip' => $base_url . '/sample-data/personal-portfolio/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'startup-agency' => [
                'name' => esc_html__('Startup Agency', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-13.jpg',
                'previewUrl' => $base_url . '/startup-agency',
                'demoZip' => $base_url . '/sample-data/startup-agency/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'fashion-studio' => [
                'name' => esc_html__('Fashion Studio', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-14.jpg',
                'previewUrl' => $base_url . '/fashion-studio',
                'demoZip' => $base_url . '/sample-data/fashion-studio/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'portfolios' => [
                'name' => esc_html__('Portfolios', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-20.jpg',
                'previewUrl' => $base_url . '/portfolios',
                'demoZip' => $base_url . '/sample-data/portfolio/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => $plugins,
            ],
            'modern-shop' => [
                'name' => esc_html__('Modern Shop', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/home-16.jpg',
                'previewUrl' => $base_url . '/modern-shop',
                'demoZip' => $base_url . '/sample-data/modern-shop/demo-import.zip',
                'blogSlug' => 'blog-standard',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => array_merge($plugins, $woo_plugins),
            ],
             'agntix-rtl' => [
                'name' => esc_html__('ALL RTL Demo', 'agntix'),
                'previewImage' => $base_url . '/sample-data/preview/homes-rtls.jpg',
                'previewUrl' => 'https://wp.storebuild.shop/agntix-rtl/',
                'demoZip' => $base_url . '/sample-data/agntix-rtl/agntix-rtl.zip',
                'urlToReplace' => 'https://wp.storebuild.shop/agntix-rtl/',
                'blogSlug' => 'blog-classic',
                'settingsJson' => [
                    
                ],
                'menus' => $menu,
                // Required plugins for this demo.
                'plugins' => array_merge($plugins, $woo_plugins),
            ],
        ],
    ];
}


/**
 * Updates some settings.
 *
 * @return void
 */
function sd_edi_after_import_actions( $impoter ) {

    $front_page_id = agntix_get_page('Home Light');

    $demoSlug = $impoter->demoSlug;

   switch ($demoSlug) {
        case 'modern-agency':
        case 'digital-marketing':
        case 'architecture-hub':
        case 'mobile-app':
        case 'it-solutions':
        case 'modern-shop':
            $front_page_id = agntix_get_page('Home Light');
            break;

        case 'design-studio':
        case 'creative-agency':
        case 'creative-studio':
        case 'design-agency':
        case 'corporate-agency':
        case 'ai-image-genaretor':
        case 'cryptocurrency':
        case 'personal-portfolio':
        case 'startup-agency':
        case 'fashion-studio':
            $front_page_id = agntix_get_page('Home Dark');
            break;

        case 'portfolios':
            $front_page_id = agntix_get_page('Home');
            break;
    }


    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    // Update posts per page.
    update_option( 'posts_per_page', 4 ); 

    // Flushing Permalink.
    flush_rewrite_rules(); 
    // Some other settings as per your need.
}
/**
 * Hook the function into the after import action hook.
 */
add_filter( 'sd/edi/after_import', 'sd_edi_after_import_actions' );

function agntix_get_page($agntix_page_name = 'Home')
{
  $posts = get_posts(
    array(
      'post_type' => 'page',
      'title' => $agntix_page_name,
      'post_status' => 'all',
      'posts_per_page' => 1,
      'no_found_rows' => true,
      'ignore_sticky_posts' => true,
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'orderby' => 'post_date ID',
      'order' => 'ASC',
    )
  );

  if (!empty($posts)) {
    $page_got_by_title = $posts[0];
  } else {
    $page_got_by_title = null;
  }

  return $page_got_by_title;

}