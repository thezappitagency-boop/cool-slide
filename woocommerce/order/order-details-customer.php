<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.9.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();

?>
<div class="tp-woo-order-customer-details woocommerce-customer-details mt-40">
	<div class="row justify-content-center">
	
		<?php 
			$name 		= $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
			$email 		= $order->get_billing_email();
			$phone 		= $order->get_billing_phone();
			$company 	= $order->get_billing_company();
			$add_1 		= $order->get_billing_address_1();
			$add_2 		= $order->get_billing_address_2();
			$postcode 	= $order->get_billing_postcode();
			$city 		= $order->get_billing_city();
			$state 		= $order->get_billing_state();
			$country 	= $order->get_billing_country();
			$order_id   = $order->get_id();
		?>
		<div class="col-md-6 white-bg">
			<div class="tp-woo-order-customer-details-item profile__address-item d-sm-flex align-items-start">
				<div class="profile__address-content">
	
					<div class="profile__address-header d-sm-flex align-items-center ">
						<h3 class="profile__address-title mb-20"><?php echo esc_html__('Billing Address', 'agntix'); ?></h3>
					</div>
	
					<?php if(!empty($name)) :?>
					<p><span><?php esc_html_e( 'Name :', 'agntix' ); ?></span> <?php echo esc_html($name); ?></p>
					<?php endif; ?>
					
					<!-- street -->
					<?php if ( $email ) : ?>
					<p><span><?php esc_html_e( 'Email :', 'agntix' ); ?></span> <?php echo esc_html( $email ); ?></p>
					<?php endif; ?>
					<!-- phone -->
					<?php if ( $phone ) : ?>
					<p><span><?php esc_html_e( 'Phone number :', 'agntix' ); ?></span> <?php echo esc_html( $phone ); ?></p>
					<?php endif; ?>
					<!-- street -->
					<?php if ( $company ) : ?>
					<p><span><?php esc_html_e( 'Company :', 'agntix' ); ?></span> <?php echo esc_html( $company ); ?></p>
					<?php endif; ?>
					<!-- street -->
					<?php if ($add_1 ) : ?>
					<p><span><?php esc_html_e( 'Address 1 :', 'agntix' ); ?></span> <?php echo esc_html($add_1 ); ?></p>
					<?php endif; ?>
					<!-- street -->
					<?php if ( $add_2 ) : ?>
					<p><span><?php esc_html_e( 'Address 2 :', 'agntix' ); ?></span> <?php echo esc_html( $add_2 ); ?></p>
					<?php endif; ?>
					<!-- city -->
					<?php if ( $city ) : ?>
					<p><span><?php esc_html_e( 'City :', 'agntix' ); ?></span> <?php echo esc_html( $city ); ?></p>
					<?php endif; ?>

					<!-- order id -->
					<?php if ( $order_id ) : ?>
					<p><span><?php esc_html_e( 'Order ID :', 'agntix' ); ?></span> <?php echo esc_html( $order_id ); ?></p>
					<?php endif; ?>

					<!-- state -->
					<?php if ( $state ) : ?>
					<p><span><?php esc_html_e( 'State/province/area :', 'agntix' ); ?></span> <?php echo esc_html( $state ); ?></p>
					<?php endif; ?>
					<!-- zip code -->
					<?php if ( $postcode ) : ?>
					<p><span><?php esc_html_e( 'Zip code :', 'agntix' ); ?></span> <?php echo esc_html( $postcode ); ?></p>
					<?php endif; ?>
					<!-- country -->
					<?php if ( $country ) : ?>
					<p><span><?php esc_html_e( 'Country :', 'agntix' ); ?></span> <?php echo esc_html( $country ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php if ( $show_shipping ) :

			$name 		= $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name();
			$phone 		= $order->get_shipping_phone();
			$company 	= $order->get_shipping_company();
			$add_1 		= $order->get_shipping_address_1();
			$add_2 		= $order->get_shipping_address_2();
			$postcode 	= $order->get_shipping_postcode();
			$city 		= $order->get_shipping_city();
			$state 		= $order->get_shipping_state();
			$country 	= $order->get_shipping_country();
			
		?>
		<div class="col-md-6 white-bg">
			<div class="tp-woo-order-customer-details-item profile__address-item d-sm-flex align-items-start">
				<div class="profile__address-icon">
					<span>
						<svg viewBox="0 0 64 64"><g id="ad"><g><path d="m50 49c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3zm0 4c-.551 0-1-.448-1-1s.449-1 1-1 1 .448 1 1-.449 1-1 1z"></path><path d="m13 55c1.654 0 3-1.346 3-3s-1.346-3-3-3-3 1.346-3 3 1.346 3 3 3zm0-4c.551 0 1 .448 1 1s-.449 1-1 1-1-.448-1-1 .449-1 1-1z"></path><path d="m62 47.278v-8.653c0-.612-.184-1.203-.533-1.708l-7.452-10.763c-.933-1.349-2.47-2.154-4.111-2.154h-7.61l1.742-3.049c1.285-1.731 1.963-3.788 1.963-5.951 0-5.514-4.486-10-10-10-1.791 0-3.547.479-5.081 1.385-.476.281-.633.895-.352 1.37s.893.632 1.37.353c1.225-.725 2.63-1.107 4.063-1.107 4.411 0 8 3.589 8 8 0 1.748-.554 3.408-1.601 4.802-.025.033-.048.068-.069.104l-6.331 11.078-6.33-11.077c-.021-.036-.044-.071-.069-.104-1.047-1.394-1.601-3.055-1.601-4.803 0-1.897.676-3.736 1.902-5.179.358-.42.307-1.052-.114-1.409-.421-.358-1.052-.308-1.41.114-1.534 1.803-2.379 4.103-2.379 6.474 0 1.781.467 3.486 1.346 5h-23.343c-1.654 0-3 1.346-3 3v27c0 1.654 1.346 3 3 3h2.08c.488 3.386 3.401 6 6.92 6s6.432-2.614 6.92-6h9.223c.552 0 1-.447 1-1s-.448-1-1-1h-9.223c-.488-3.386-3.401-6-6.92-6s-6.432 2.614-6.92 6h-2.08c-.551 0-1-.448-1-1v-9h26c.552 0 1-.447 1-1s-.448-1-1-1h-26v-16.001c0-.552.449-1 1-1h24.563l6.569 11.496c.178.312.509.504.868.504s.69-.192.868-.504l1.132-1.981v7.485h-5c-.552 0-1 .447-1 1s.448 1 1 1h5v10h-5.5c-.552 0-1 .447-1 1s.448 1 1 1h10.58c.488 3.386 3.401 6 6.92 6s6.432-2.614 6.92-6h4.08c1.103 0 2-.897 2-2v-2c0-.737-.405-1.375-1-1.722zm-49-.278c2.757 0 5 2.243 5 5s-2.243 5-5 5-5-2.243-5-5 2.243-5 5-5zm46.784-9h-15.784v-8h10.245zm-18.632-12h8.753c.984 0 1.906.483 2.466 1.293l.49.707h-8.86c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h16v7h-5.111c-1.263-1.235-2.988-2-4.889-2s-3.627.765-4.889 2h-5.111v-18.985l1.152-2.015zm-1.152 23h3.685c-.297.622-.503 1.294-.605 2h-3.08zm10 8c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5zm11-6h-4.08c-.102-.706-.308-1.378-.605-2h4.685z"></path><path d="m36 21c3.309 0 6-2.691 6-6s-2.691-6-6-6-6 2.691-6 6 2.691 6 6 6zm0-10c2.206 0 4 1.794 4 4s-1.794 4-4 4-4-1.794-4-4 1.794-4 4-4z"></path><path d="m43 43h4c.552 0 1-.447 1-1s-.448-1-1-1h-4c-.552 0-1 .447-1 1s.448 1 1 1z"></path></g></g></svg>
					</span>
				</div>
				<div class="profile__address-content">
					<div class="profile__address-header d-sm-flex align-items-center">
						<h3 class="profile__address-title"><?php echo esc_html__('Shipping Address', 'agntix'); ?></h3>
					</div>

					<?php if(!empty($name)) :?>
					<p><span><?php esc_html_e( 'Name:', 'agntix' ); ?></span><?php echo esc_html($name); ?></p>
					<?php endif; ?>
					
					<!-- phone -->
					<?php if ( $phone ) : ?>
					<p><span><?php esc_html_e( 'Phone number:', 'agntix' ); ?></span><?php echo esc_html( $phone ); ?></p>
					<?php endif; ?>
					<!-- street -->
					<?php if ( $company ) : ?>
					<p><span><?php esc_html_e( 'Company:', 'agntix' ); ?></span><?php echo esc_html( $company ); ?></p>
					<?php endif; ?>
					<!-- street -->
					<?php if ($add_1 ) : ?>
					<p><span><?php esc_html_e( 'Address 1:', 'agntix' ); ?></span><?php echo esc_html($add_1 ); ?></p>
					<?php endif; ?>
					<!-- street -->
					<?php if ( $add_2 ) : ?>
					<p><span><?php esc_html_e( 'Address 2:', 'agntix' ); ?></span><?php echo esc_html( $add_2 ); ?></p>
					<?php endif; ?>
					<!-- city -->
					<?php if ( $city ) : ?>
					<p><span><?php esc_html_e( 'City:', 'agntix' ); ?></span><?php echo esc_html( $city ); ?></p>
					<?php endif; ?>
					<!-- state -->
					<?php if ( $state ) : ?>
					<p><span><?php esc_html_e( 'State/province/area:', 'agntix' ); ?></span><?php echo esc_html( $state ); ?></p>
					<?php endif; ?>
					<!-- zip code -->
					<?php if ( $postcode ) : ?>
					<p><span><?php esc_html_e( 'Zip code:', 'agntix' ); ?></span><?php echo esc_html( $postcode ); ?></p>
					<?php endif; ?>
					<!-- country -->
					<?php if ( $country ) : ?>
					<p><span><?php esc_html_e( 'Country:', 'agntix' ); ?></span><?php echo esc_html( $country ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

	</div>
	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</div>

