<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>

	<div class="modal-body">

		<div class="woocommerce-mini-cart cart_list product_list_widget cart-items-list">
			<?php
			do_action('woocommerce_before_mini_cart_contents');

			foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
				$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

				if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
					$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
					$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
					$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
					$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

					$post_thumbnail_id = get_post_thumbnail_id($product_id);
					if (!empty($post_thumbnail_id)) {
						$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
						$image_src = $post_thumbnail_src[0];
					} else {
						$image_src = '';
					}




			?>




					<div class="cart-item woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="btn-remove-form-cart remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
								esc_url(wc_get_cart_remove_url($cart_item_key)),
								esc_attr__('Remove this item', 'woocommerce'),
								esc_attr($product_id),
								esc_attr($cart_item_key),
								esc_attr($_product->get_sku())
							),
							$cart_item_key
						);
						?> <div class="cart-item-media">
							<a href="<?php echo $product_permalink; ?>" class="cart-item-image">
								<?php 
								
							echo	 $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								?>
							</a>
						</div>
						<div class="cart-item-denote">
							<div class="cart-item-denote-header">
								<h6 class="cart-item-title">
									<a href="<?php echo $product_permalink; ?>"><?php echo $_product->get_name(); ?></a>
								</h6>

								<span class="cart-item-meta">
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

								
							</div>
							<div class="cart-item-quantity-prices">
								<div class="input-group product-quantity-default cart-quantity-small cart-quantity-default">
									<div class="input-group-prepend">
										<button type="button" cart_key="<?php echo $cart_item_key;?>" class="btn btn-quantity btn-minus"><i class="ti-minus"></i></button>
									</div>
									<input type="text" name="quantity" cart_key="<?php echo $cart_item_key;?>" class="form-control input-quantity" value="<?php echo $cart_item['quantity']; ?>">
									<div class="input-group-append">
										<button type="button" cart_key="<?php echo $cart_item_key;?>" class="btn btn-quantity btn-plus"><i class="ti-plus"></i></button>
									</div>
								</div>
								<div class="cart-item-price">
								<span class="cart-price-wrp">
												Price: <?php echo $product_price;?>
												</span>
												
								</div>
							</div>
						</div>
					</div>





			<?php
				}
			}

			do_action('woocommerce_mini_cart_contents');
			?>
		</div>
	</div>
	
	<div class="modal-footer">
		<ul class="cart-subcheckout">
			<li>
				<span class="subcheckout-title">Subtotal</span>
				<span class="subcheckout-text">$<?php echo WC()->cart->cart_contents_total; ?></span>
			</li>
		</ul>
		<p class="text-left m-0">
			<small>Shipping, taxes, and discounts codes calculated at checkout.</small>
		</p>
		<ul class="cart-checkout-buttons text-center">
			<li>
				<a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-site btn-primary border-0 rounded-0 he-rotate btn-block" tabindex="-1">
					<span class="btn__text">Checkout</span>
				</a>
			</li>
		</ul>
		<!-- <p class="woocommerce-mini-cart__total total">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			//do_action('woocommerce_widget_shopping_cart_total');
			?>
		</p> -->

		<?php //do_action('woocommerce_widget_shopping_cart_before_buttons'); 
		?>

		<!-- <p class="woocommerce-mini-cart__buttons buttons"><?php //do_action('woocommerce_widget_shopping_cart_buttons'); 
																?></p> -->

		<?php //do_action('woocommerce_widget_shopping_cart_after_buttons'); 
		?>

	<?php else : ?>

		<div class="card-body">
		<p class="text-left m-0">
			<?php esc_html_e('Your shopping bag is empty', 'woocommerce'); ?>
		</p>
		</div>

	<?php endif; ?>

	<?php // do_action('woocommerce_after_mini_cart'); 
	?>
	</div>
	