<?php

// tp metabox 
add_filter('tp_meta_boxes', 'themepure_metabox');

function themepure_metabox($meta_boxes)
{
	$prefix = 'agntix';

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_meta_service_icon_meta',
		'title' => esc_html__('Service SVG Icon', 'agntix'),
		'post_type' => ['tp-services'],
		'context' => 'normal',
		'priority' => 'core',

		'fields' => array(

			array(
				'label' => 'Enter Svg Code',
				'id' => "{$prefix}_meta_service_icon",
				'type' => 'textarea',
				'placeholder' => 'Type...',
				'default' => '',
				'conditional' => array()
			)
		),
	);


	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_page_option_settings',
		'title' => esc_html__('TP Page Info', 'agntix'),
		'post_type' => ['page', 'tp-portfolios', 'tp-services', 'product', 'shop', 'post', 'tp-career'],
		'context' => 'normal',
		'priority' => 'core',
		'columns' => 3,
		'fields' => array(

			array(

				'label' => esc_html__('Smooth Scroll Controls', 'agntix'),
				'id' => "{$prefix}_smooth_scroll",
				'type' => 'select',
				'options' => array(
					'default' => esc_html__('Default', 'agntix'),
					'on' => esc_html__('On', 'agntix'),
					'off' => esc_html__('Off', 'agntix'),
				),
				'placeholder' => 'Select an item',
				'conditional' => array(),
				'default' => 'default',
				'multiple' => false,

			),

			// theme bg color 
			array(
				'label' => esc_html__('Theme Background Color', 'agntix'),
				'id' => "{$prefix}_theme_bg_color" ,
				'type' => 'select',
				'options' => array(
					'default' => esc_html__('Default', 'agntix'),
					'dark' => esc_html__('Dark', 'agntix'),
					'light' => esc_html__('Light', 'agntix'),
				),
				'placeholder' => 'Select an item',
				'conditional' => array(),
				'default' => 'default',
				'multiple' => false,

			),

			array(

				'label' => esc_html__('Magic Cursor Color', 'agntix'),
				'id' => "{$prefix}_magic_cursor_from_page",
				'type' => 'select',
				'options' => array(
					'default' => esc_html__('Default', 'agntix'),
					'on' => esc_html__('On', 'agntix'),
					'off' => esc_html__('Off', 'agntix'),
				),
				'placeholder' => 'Select an item',
				'conditional' => array(),
				'default' => 'default',
				'multiple' => false,
			),

			//small cursor color
			array(
				'label' => 'Samll Cursor Color',
				'id' => "{$prefix}_magic_cursor_from_page_small",
				'type' => 'colorpicker',
				'placeholder' => '',
				'default' => '#000',
				'conditional' => array(
					"{$prefix}_magic_cursor_from_page",
					"==",
					"on"
				),
			),
			//big cursor color
			array(
				'label' => 'Big Cursor Color',
				'id' => "{$prefix}_magic_cursor_from_page_big",
				'type' => 'colorpicker',
				'placeholder' => '',
				'default' => '#fff',
				'conditional' => array(
					"{$prefix}_magic_cursor_from_page",
					"==",
					"on"
				),
			),
			//big cursor color
			array(
				'label' => 'Cursor Text Color',
				'id' => "{$prefix}_magic_cursor_text_color_from_page",
				'type' => 'colorpicker',
				'placeholder' => '',
				'default' => '#fff',
				'conditional' => array(
					"{$prefix}_magic_cursor_from_page",
					"==",
					"on"
				),
			)

		),
	);

	// Breadcrumb 
	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_page_breadcumb_meta',
		'title' => esc_html__('Bradcrumb', 'agntix'),
		'post_type' => ['page', 'tp-portfolios', 'tp-services', 'product', 'shop', 'post', 'tp-career'],
		'context' => 'normal',
		'priority' => 'core',
		'columns' => 2,
		'fields' => array(
			array(
				'label' => esc_html__('Show Breadcrumb ?', 'agntix'),
				'id' => "{$prefix}_is_breadcrumb_on",
				'type' => 'switch',
				'default' => 'on',
				'conditional' => array()
			),
			array(
				'label' => esc_html__('Breadcrumb', 'agntix'),
				'id' => "{$prefix}_breadcrumb_meta_tabs",
				'desc' => '',
				'type' => 'tabs',
				'choices' => array(
					'default' => esc_html__('Default', 'agntix'),
					'elementor' => esc_html__('Elementor', 'agntix'),
				),
				'default' => 'default',
				'conditional' => array(
					"{$prefix}_is_breadcrumb_on",
					"==",
					"on"
				),
			),

			array(
				'label' => esc_html__('Select Breadcrumb Template', 'agntix'),
				'id' => "{$prefix}_breadcrumb_meta_templates",
				'type' => 'select_posts',
				'placeholder' => esc_html__('Select a template', 'agntix'),
				'post_type' => 'tp-breadcrumb',
				'conditional' => array(
					"{$prefix}_breadcrumb_meta_tabs",
					"==",
					"elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_breadcrumb_meta_tabs"
			),



		),
	);


	//for header and footer
	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_page_header_footer_meta_box',
		'title' => esc_html__('Header & Footer', 'agntix'),
		'post_type' => ['page', 'tp-portfolios', 'tp-services', 'post', 'tp-career', 'product'],
		'context' => 'normal',
		'priority' => 'core',
		'columns' => 2,
		'fields' => array(

			array(
				'label' => esc_html__('Header', 'agntix'),
				'id' => "{$prefix}_header_tabs",
				'desc' => '',
				'type' => 'tabs',
				'choices' => array(
					'default' => esc_html__('Default', 'agntix'),
					'elementor' => esc_html__('Elementor', 'agntix'),
				),
				'default' => 'default',
				'conditional' => array()
			),

			// select field dropdown
			array(

				'label' => esc_html__('Select Header Template', 'agntix'),
				'id' => "{$prefix}_header_templates",
				'type' => 'select_posts',
				'placeholder' => esc_html__('Select a template', 'agntix'),
				'post_type' => 'tp-header',
				'conditional' => array(
					"{$prefix}_header_tabs",
					"==",
					"elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_header_tabs"
			),

			array(
				'label' => esc_html__('Footer', 'agntix'),
				'id' => "{$prefix}_footer_tabs",
				'desc' => '',
				'type' => 'tabs',
				'choices' => array(
					'default' => esc_html__('Default', 'agntix'),
					'elementor' => esc_html__('Elementor', 'agntix'),
				),
				'default' => 'default',
				'conditional' => array()
			),

			// select field dropdown
			array(

				'label' => esc_html__('Select Footer Template', 'agntix'),
				'id' => "{$prefix}_footer_templates",
				'type' => 'select_posts',
				'placeholder' => esc_html__('Select a template', 'agntix'),
				'post_type' => 'tp-footer',
				'conditional' => array(
					"{$prefix}_footer_tabs",
					"==",
					"elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_footer_tabs"
			),
			array(
				'label' => esc_html__('Sticky Footer ?', 'agntix'),
				'id' => "{$prefix}_is_sticky_on",
				'type' => 'switch',
				'default' => 'off',
				'conditional' => array(
					"{$prefix}_footer_tabs",
					"==",
					"elementor"
				),
				'parent' => "{$prefix}_footer_tabs"
			),

		),
	);


	// blog mesonary Image 

	$meta_boxes[] = array(
		'metabox_id' => "{$prefix}_post_mesonary_image_tab",
		'title' => esc_html__('Upload Mesonary Image', 'agntix'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Upload', 'agntix'),
				'id' => "{$prefix}_post_mesonary_image",
				'type' => 'image', // specify the type field
				'default' => '',
				'conditional' => array()
			)
		),
	);


	// post single layout
	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_single_layout_meta',
		'title' => esc_html__('Post Single Layout', 'agntix'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(

				'label' => esc_html__('Select Single Layout', 'agntix'),
				'id' => "{$prefix}_post_single_layout",
				'type' => 'select',
				'options' => array(
					'blog_single_standard' => esc_html__('Standard', 'agntix'),
					'blog_single_classic' => esc_html__('Full Width', 'agntix'),
				),
				'placeholder' => 'Select an item',
				'conditional' => array(),
				'default' => '',
				'multiple' => false,

			)
		),
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_gallery_meta',
		'title' => esc_html__('TP Gallery Post', 'agntix'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Gallery', 'agntix'),
				'id' => "{$prefix}_post_gallery",
				'type' => 'gallery',
				'default' => '',
				'conditional' => array(),
			),
		),
		'post_format' => 'gallery'
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_video_meta',
		'title' => esc_html__('TP Video Post', 'agntix'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Video', 'agntix'),
				'id' => "{$prefix}_post_video",
				'type' => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder' => esc_html__('Place your video url.', 'agntix'),
			),
		),
		'post_format' => 'video'
	);

	$meta_boxes[] = array(
		'metabox_id' => $prefix . '_post_audio_meta',
		'title' => esc_html__('TP Audio Post', 'agntix'),
		'post_type' => 'post',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'label' => esc_html__('Audio', 'agntix'),
				'id' => "{$prefix}_post_audio",
				'type' => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder' => esc_html__('Place your audio url..', 'agntix'),
			),
		),
		'post_format' => 'audio'
	);

	return $meta_boxes;
}

function add_user_metas()
{
	$meta = array(
		'id' => 'agntix_user_meta_sec',
		'label' => 'User Social Information',
		'fields' => array(

			array(
				'id' => 'agntix_facebook',
				'label' => 'Facebook URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Facebook URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'agntix_twitter',
				'label' => 'Twitter URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Twitter URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'agntix_dribbble',
				'label' => 'Dribbble URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Dribbble URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'agntix_instagram',
				'label' => 'Instagram URL',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Instagram URL...',
				'show_in_admin_table' => 1
			),
			array(
				'id' => 'agntix_dasignation',
				'label' => 'User Dasignation',
				'type' => 'text',
				'default' => '',
				'placeholder' => 'Administrator',
				'show_in_admin_table' => 1
			),
			array(
				'label' => esc_html__('Avater', 'agntix'),
				'id' => "agntix_author_avater",
				'type' => 'image', // specify the type field
				'default' => '',
				'show_in_admin_table' => 1
			)
		)
	);

	return $meta;
}
add_filter('tp_user_meta', 'add_user_metas');
