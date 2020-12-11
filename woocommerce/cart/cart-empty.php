<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
do_action('woocommerce_cart_is_empty');

if (wc_get_page_id('shop') > 0) : ?>





	<main id="main-content">
		<div class="has-fixed-navbar"></div>
		<section class="section">
			<div class="container-fluid container-xl-fluid">
				<div class="row">

					<div class="col-md-12">

						<div class="mt-4">
							<a type="button" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>" class="btn btn-site btn-lg btn-primary border-0 rounded-0 he-rotate btn-block">
								<span class="btn-text"><?php
														/**
														 * Filter "Return To Shop" text.
														 *
														 * @since 4.6.0
														 * @param string $default_text Default text.
														 */
														echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce')));
														?>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php endif; ?>