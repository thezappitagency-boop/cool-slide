<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined('ABSPATH') || exit;

$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>

<div class="tp-order-area woocommerce-order">
	<?php
	if ($order):
		do_action('woocommerce_before_thankyou', $order->get_id());
		?>

		<div class="tp-order-message">
			<div class="row gx-0 align-items-center justify-content-center">
				<?php if ($order->has_status('failed')): ?>

					<div class="col-xl-12">
						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
							<?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'agntix'); ?>
						</p>

						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
								class="button pay"><?php esc_html_e('Pay', 'agntix'); ?></a>
							<?php if (is_user_logged_in()): ?>
								<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
									class="button pay"><?php esc_html_e('My account', 'agntix'); ?></a>
							<?php endif; ?>
						</p>
					</div>

				<?php else: ?>
					<div class="col-lg-9">
						<div class="tp-order-message text-center">
							<h3 class="tp-order-message-title">
								<?php esc_html_e('Thank you, order has been successfully processed.', 'agntix'); ?>
							</h3>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

	<?php else: ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
			<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'agntix'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</p>

	<?php endif; ?>
</div>

<?php
if ($show_customer_details) {
	wc_get_template('order/order-details-customer.php', array('order' => $order));
}
?>