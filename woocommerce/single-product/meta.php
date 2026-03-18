<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if (!defined('ABSPATH')) {
	exit;
}

global $product;

$post_cats = get_the_terms(get_the_ID(), 'product_cat');
$post_tags = get_the_terms(get_the_ID(), 'product_tag');
?>

<div class="tp-product-details-query">
	<?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type(ProductType::VARIABLE))): ?>
		<div class="tp-product-details-query-item d-flex align-items-center">
			<span><?php esc_html_e('SKU:', 'agntix'); ?> </span>
			<p>
				<?php
				$sku = $product->get_sku();
				if ($sku) {
					echo esc_html($sku);
				} else {
					echo esc_html__('N/A', 'agntix');
				}
				?>
			</p>

		</div>
	<?php endif; ?>

	<?php if (!empty($post_cats)): ?>
		<div class="tp-product-details-query-item d-flex align-items-center">
			<span><?php echo esc_html(_n('Category:', 'Categories:', count($post_cats), 'agntix')); ?> </span>
			<p>
				<?php
				$html = '';
				foreach ($post_cats as $key => $cat) {
					$html .= '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>,';
				}
				echo rtrim($html, ',');
				?>
			</p>
		</div>
	<?php endif; ?>

	<?php if (!empty($post_tags)): ?>
		<div class="tp-product-details-query-item d-flex align-items-center">
			<span><?php echo esc_html(_n('Tag:', 'Tags:', count($post_tags), 'agntix')); ?> </span>
			<p><?php echo wc_get_product_tag_list($product->get_id()); ?></p>
		</div>
	<?php endif; ?>

</div>