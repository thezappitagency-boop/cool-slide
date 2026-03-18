<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );


?>
<div class="container container-1750">
	<div class="row">
		<div class="col-lg-12">
			<div class="tp-product-heading mb-50">
				<div class="tp-shop-category-title-box">
					<span class="tp-shop-section-subtitle mb-10">[ Shop ]</span>
					<h4 class="tp-shop-section-title">Our products</h4>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="tp-product-cats pb-40">
			<?php
			// Only show on the main shop page
			if (is_shop()) {
				$args = array(
					'taxonomy'   => 'product_cat',
					'number'     => 4, // Limit to 4 categories
					'orderby'    => 'name',
					'order'      => 'ASC',
					'hide_empty' => true,
				);

				$product_categories = get_terms($args);

				if (!empty($product_categories) && !is_wp_error($product_categories)) : ?>
					<?php foreach ($product_categories as $category) : ?>
						<a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a>
					<?php endforeach; ?>
				<?php endif;	
			}
			?>

			</div>
		</div>
		<div class="col-lg-6">
			<div class="tp-product-filter-wrap d-flex justify-content-lg-end align-items-center pb-40">
				<div class="tp-product-filter-select">
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>
		</div>
	</div>
</div>	
<?php


/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action( 'woocommerce_shop_loop_header' );

?>
<div class="container container-1750">
<?php

if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
?>
</div>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
