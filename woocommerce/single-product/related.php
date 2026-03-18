<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
	<div class="tp-product-details-bottom mt-100"></div>
	<section class="related-slider-area products pt-100 ">
		<div class="container container-1750">
		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'agntix' ) );

		if ( $heading ) :
			?>
			<div class="tp-product-related-heading mb-40">
			<h2 class="tp-product-related-title"><?php echo esc_html( $heading ); ?></h2>
			</div>
		<?php endif; ?>

			<?php if (count($related_products) > 4): ?>
				<div class="tp-woo-related-product-active swiper-container">
					<div class="swiper-wrapper">
					<?php foreach ( $related_products as $related_product ) : ?>
						<div class="swiper-slide">
							<?php
							$post_object = get_post( $related_product->get_id() );
							setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
							wc_get_template_part( 'content', 'product' );
							?>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
				<?php else: ?>
				<div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-3 row-cols-1">
					<?php foreach ($related_products as $related_product): ?>
						<?php
						$post_object = get_post($related_product->get_id());
						setup_postdata($GLOBALS['post'] = &$post_object);
						wc_get_template_part('content', 'product');
						?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
	</section>
	<?php
endif;

wp_reset_postdata();
