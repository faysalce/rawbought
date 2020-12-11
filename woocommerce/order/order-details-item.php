<?php

/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
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

if (!defined('ABSPATH')) {
	exit;
}

if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
	return;
}
?>
<div class="cart-item <?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">

	<?php
	$is_visible        = $product && $product->is_visible();
    $thumbnail = $product->get_image('large');

	$post_thumbnail_id = get_post_thumbnail_id($item->get_id());
	$product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);

	if (!empty($post_thumbnail_id)) {
		//$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'medium'); //get thumbnail image url			
		//$image_src = $post_thumbnail_src[0];
		$image_src = $thumbnail;
	} else {
		$image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
	}

	?>
	<div class="cart-item-media">

		<a image="" href="<?php echo $product_permalink; ?>" class="cart-item-image">
			<?php echo  $thumbnail;?>
		</a>
	</div>
	<div class="cart-item-denote">
		<div class="cart-item-denote-header">
			
			
					<a href="<?php echo $product_permalink; ?>">
						<?php

						$productParent = wc_get_product($product->get_parent_id());

						echo $productParent->get_name();
						
						?>
					</a>
					<span class="cart-item-meta">
					<span class="cart-price-wrp">


						<?php echo $product->get_price_html() . ' / ' ?>

						<?php 
						$orderAttr=$item->get_meta_data();


					
						
						if (count($orderAttr) > 0) {

							foreach ($orderAttr as $metaData) {
								$attribute = $metaData->get_data();
							
								// attribute value
								if($attribute['key']=='pa_colour' || $attribute['key']=='pa_size'){
									echo $attribute['value'].' / ';

								}
							
							
								// attribute slug
							//	$slug = $attribute['key'];
							  }
							
						}
						?>



					</span>
					


				</span>
				
		</div>




		
		<div class="cart-item-quantity-prices">
			<div class="ci-qp-cell">
				<div class="ci-qp-cell-label">Quantity</div>
				<?php
				$qty          = $item->get_quantity();
				$refunded_qty = $order->get_qty_refunded_for_item($item_id);

				if ($refunded_qty) {
					$qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
				} else {
					$qty_display = esc_html($qty);
				}

				echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('%s', $qty_display) . '</strong>', $item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


				?>
			</div>
			<div class="ci-qp-cell">
				<div class="ci-qp-cell-label">Subtotal</div>
				<div class="cart-item-price">
					<?php echo $order->get_formatted_line_subtotal($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?>
				</div>
			</div>

			<?php if ($show_purchase_note && $purchase_note) : ?>
				<div class="ci-qp-cell">
					<div class="ci-qp-cell-label">Purchase note</div>
					<div class="cart-item-price">
						<?php echo wpautop(do_shortcode(wp_kses_post($purchase_note))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
						?> </div>
				</div>


			<?php endif; ?>

		</div>
	</div>
</div>