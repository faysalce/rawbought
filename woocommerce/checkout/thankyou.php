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
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>




<main id="main-content">
	<div class="has-fixed-navbar"></div>
	<?php
	if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id());
	?>
		<section class="section">
			<div class="container-fluid container-xl-fluid">
				<?php if ($order->has_status('failed')) : ?>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
						<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
						<?php if (is_user_logged_in()) : ?>
							<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
						<?php endif; ?>
					</p>

				<?php else : ?>
					<div class="header-jumbotron profile-header-jumbotron">




						<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"></p>

						<div class="jumbotron-legend">
							<h1 class="jumbotron-title h2">We have your order!</h1>
						</div>
						<div class="jumbotron-navwrap journal-navwrapper">
							<p>
								<?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 c-mb">
							<div class="card card-orderedinfo">
								<div class="card-body">
									<div class="orderedinfo-item">
										<div class="section-orderedinfo-item">


											<div class="orderedinfo-label"><?php esc_html_e('Order number:', 'woocommerce'); ?></div>
											<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
													?></strong>
										</div>
										<div class="section-orderedinfo-item">

											<div class="orderedinfo-label"> <?php esc_html_e('Date:', 'woocommerce'); ?>
											</div>
											<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
													?></strong>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 c-mb">
							<div class="card card-orderedinfo">
								<div class="card-body">
									<div class="orderedinfo-item">
										<div class="section-orderedinfo-item">
											<div class="orderedinfo-label">ORDERED BY</div>
											<?php echo wp_kses_post($order->get_formatted_billing_address(esc_html__('N/A', 'woocommerce'))); ?>

											<?php if ($order->get_billing_phone()) : ?>
												<p class="woocommerce-customer-details--phone"><?php echo esc_html($order->get_billing_phone()); ?></p>
											<?php endif; ?>

											<?php if ($order->get_billing_email()) : ?>
												<p class="woocommerce-customer-details--email"><?php echo esc_html($order->get_billing_email()); ?></p>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 c-mb">
							<div class="card card-orderedinfo">
								<div class="card-body">
									<div class="orderedinfo-item">
										<div class="section-orderedinfo-item">
											<div class="orderedinfo-label">SHIPPED TO</div>
											<?php echo wp_kses_post($order->get_formatted_shipping_address(esc_html__('N/A', 'woocommerce'))); ?>

										</div>
										<div class="section-orderedinfo-item">
											<div class="orderedinfo-label"> <?php esc_html_e('Payment method:', 'woocommerce'); ?>
											</div>
											<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="cart-items-list cart-page-items-list cart-items-listview cart-items-list-checkout">
						<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
						<?php do_action('woocommerce_thankyou', $order->get_id()); ?>
					</div>
				<?php endif; ?>



			<?php else : ?>

				<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'woocommerce'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																												?></p>

			<?php endif; ?>
			</div>
		</section>
</main>