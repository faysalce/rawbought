<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<div class="row">
	<div class="col-md-8">
		<div class="pr-md-4 pr-lg-5">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-checkout">
					<li class="breadcrumb-item active" aria-current="page">Cart</li>
					<li class="breadcrumb-item">Shipping</li>
					<li class="breadcrumb-item">Billing</li>
					<li class="breadcrumb-item">Payment</li>
				</ol>
			</nav>

			<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
				<?php do_action('woocommerce_before_cart_table'); ?>

				<div class=" woocommerce-cart-form__contents" cellspacing="0">

					<div class="cart-items-list cart-page-items-list cart woocommerce-cart-form__contents">

						<?php do_action('woocommerce_before_cart_contents'); ?>
						<?php
						foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
							$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
							$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

							if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
								$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
								$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
								$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('large'), $cart_item, $cart_item_key);
								$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);

								$post_thumbnail_id = get_post_thumbnail_id($product_id);
								if (!empty($post_thumbnail_id)) {
									$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
									$image_src = $post_thumbnail_src[0];
								} else {
									$image_src = '';
								}



						?>

								<div class="cart-item woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
									<span class="product-remove">
										<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" role="button" class="remove btn-remove-form-cart" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url(wc_get_cart_remove_url($cart_item_key)),
												esc_html__('Remove this item', 'woocommerce'),
												esc_attr($product_id),
												esc_attr($_product->get_sku())
											),
											$cart_item_key
										);
										?>
									</span>
									<div class="cart-item-media">
										<a href="<?php echo $product_permalink; ?>" class="cart-item-image">
<?php 							echo	 $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('large'), $cart_item, $cart_item_key );
?>										</a>
									</div>
									<div class="cart-item-denote">
										<div class="cart-item-denote-header">
											<h6 class="cart-item-title">
												<a href="<?php echo $product_permalink; ?>">
													<?php
												
												$productParent = wc_get_product( $_product->get_parent_id() );
												
												echo $productParent->get_name();
										// 			if (!$product_permalink) {
										// 				echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
										// 			} else {
										// 				echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
										// 			}

										// 			do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

										// // 			// Meta data.
										// // //	echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.
										// // 			do_action('woocommerce_order_item_meta_start', $cart_item_key, $cart_item,  $cart_item, false);

										// // 			wc_display_item_meta($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										
										// // 			do_action('woocommerce_order_item_meta_end', $cart_item_key, $cart_item,  $cart_item, false);



										// 			// Backorder notification.
										// 			if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
										// 				echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
										// 			}
													?>
												</a>
											</h6>

											<span class="cart-item-meta">
												<span class="cart-price-wrp">

												
												<?php echo $product_price.' / '?>
												
									<?php if(count($cart_item['variation'])>0){
if(isset($cart_item['variation']['attribute_pa_colour'])){
echo $cart_item['variation']['attribute_pa_colour'].' / ';
}
if(isset($cart_item['variation']['attribute_pa_size'])){
	echo $cart_item['variation']['attribute_pa_size'];
	}
	

									}
										?>
							
							
							
												</span>
												<?php 
																				//print_r(wc_get_formatted_cart_item_data($cart_item));

																				?>


											</span>
										</div>
										<div class="cart-item-quantity-prices">
											<div class="ci-qp-cell">
												<div class="ci-qp-cell-label">Quantity</div>
												<div class="input-group product-quantity-default cart-quantity-small cart-quantity-default">
													<div class="input-group-prepend">
														<button cart-item-key="<?php echo $cart_item_key; ?>" type="button" class="btn btn-quantity btn-minus"><i class="ti-minus"></i></button>
													</div>


													<input type="text"  class="form-control input-quantity" value="<?php echo $cart_item['quantity']; ?>">



													<div class="input-group-append">
														<button type="button" cart-item-key="<?php echo $cart_item_key; ?>" class="btn btn-quantity btn-plus"><i class="ti-plus"></i></button>
													</div>

													<span class="d-none main-qt-wrp">
														<?php
														if ($_product->is_sold_individually()) {
															$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
														} else {
															$product_quantity = woocommerce_quantity_input(
																array(
																	'input_name'   => "cart[{$cart_item_key}][qty]",
																	'input_value'  => $cart_item['quantity'],
																	'max_value'    => $_product->get_max_purchase_quantity(),
																	'min_value'    => '0',
																	'product_name' => $_product->get_name(),
																),
																$_product,
																false
															);
														}

														echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
														
														?>
													</span>
												</div>
											</div>
											<div class="ci-qp-cell ">
												<div class="ci-qp-cell-label">Subtotal</div>
												<div class="cart-item-price">
													<?php
													echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
													?> </div>
											</div>
										</div>
									</div>
								</div>

						<?php
							}
						}
						?>
					</div>

					<?php do_action('woocommerce_cart_contents'); ?>


					<div class="hidden-cart-content d-none">
						<tr>
							<td colspan="6" class="actions">

								<?php if (wc_coupons_enabled()) { ?>
									<div class="coupon">
										<label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
										<button type="submit" class="button apply_coupon_btn" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
										<?php do_action('woocommerce_cart_coupon'); ?>
									</div>
								<?php } ?>


								<?php do_action('woocommerce_cart_actions'); ?>

								<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
							</td>
						</tr>
						<tr>
							<td>

							</td>
						</tr>

						<?php do_action('woocommerce_after_cart_contents'); ?>
						<button type="submit" class="button" name="update_cart" class="update_cart_btn" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

					</div>

					<?php do_action('woocommerce_after_cart_table'); ?>


				</div>

		</div>
		</form>
	</div>



	<div class="col-md-4">
		<div class="card card-order-details">
			<div class="card-body">
				<div class="section-order-summary have-coupon border-top-0 pt-0 mb-0">
					<div class="input-group">
						<div class="input-group-field">
							<div class="input-group-field-inside">
								<input type="text" class="form-control promo-code-txt" placeholder="Gift card or discount code" aria-describedby="coupon-addon">
							</div>
						</div>
						<div class="input-group-append">
							<button class="btn btn-site btn-light he-rotate promo-code-btn" type="button" id="coupon-addon"><span class="btn__text">Apply</span></button>
						</div>
					</div>
				</div>
				<?php do_action('woocommerce_before_cart_collaterals'); ?>

				<div class="section-order-summary pb-0">
					<?php
					/**
					 * Cart collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
					do_action('woocommerce_cart_collaterals');
					?>

				</div>
			</div>
		</div>
		<div class="mt-4">
			<?php //do_action('woocommerce_proceed_to_checkout'); 
			?>

			<?php if (!is_user_logged_in()) { ?>
				<button type="button" data-toggle="modal" data-target="#modalCheckout" class="btn btn-site btn-lg btn-primary border-0 rounded-0 he-rotate btn-block">
					<span class="btn-text">Checkout</span>
				</button>
			<?php } else { ?>
				<a type="button" href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-site btn-lg btn-primary border-0 rounded-0 he-rotate btn-block">
					<span class="btn-text">Checkout</span>
				</a>
			<?php } ?>

		</div>
	</div>
</div>
<?php do_action('woocommerce_after_cart'); ?>