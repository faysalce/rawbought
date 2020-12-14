<?php

/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined('ABSPATH') || exit;

$notes = $order->get_customer_order_notes();



$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

$customer_id = get_current_user_id();

$get_addresses = apply_filters(
	'woocommerce_my_account_get_addresses',
	array(
		'billing'  => __('Billing address', 'woocommerce'),
		'shipping' => __('Shipping address', 'woocommerce'),
	),
	$customer_id
);
?>





<div class="profile-content-block">
	<div class="order-header">
		<div class="o-header-cell">
			<h5 class="order-invno text-uppercase">Invoice: <?php echo $order->get_order_number(); ?></h5>
			<span><?php echo wc_format_datetime($order->get_date_created()); ?></span>
		</div>
		<div class="o-header-cell">
			<ul class="order-header-actons">
				<li>
					<button class="btn btn-light"><i class="fas fa-print"></i> Print</button>
				</li>
				<li>
					<button class="btn btn-light"><i class="fas fa-print"></i> PDF Invoice</button>
				</li>
				<li>
					<span class="status status-<?php echo $order->get_status(); ?> like-btn-status"><?php echo wc_get_order_status_name($order->get_status()); ?></span>
				</li>
			</ul>
		</div>
	</div>

	<div class="order-billship mt-4">
		<?php if ($notes) : ?>
			<h2><?php esc_html_e('Order updates', 'woocommerce'); ?></h2>
			<ol class="woocommerce-OrderUpdates commentlist notes">
				<?php foreach ($notes as $note) : ?>
					<li class="woocommerce-OrderUpdate comment note">
						<div class="woocommerce-OrderUpdate-inner comment_container">
							<div class="woocommerce-OrderUpdate-text comment-text">
								<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																				?></p>
								<div class="woocommerce-OrderUpdate-description description">
									<?php echo wpautop(wptexturize($note->comment_content)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-6 col-mb">
				<div class="card card-billship card-bill">
					<div class="card-body">
						<h6 class="card-title text-uppercase">BILLING ADDRESS</h6>
						<address>
							<?php echo wc_get_account_formatted_address('billing'); ?>
						</address>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-mb">
				<div class="card card-billship card-ship">
					<div class="card-body">
						<h6 class="card-title text-uppercase">Shipping ADDRESS</h6>
						<address>
							<?php echo wc_get_account_formatted_address('shipping'); ?>

						</address>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-site table-order">
			<thead>
				<tr>
					<th>Product</th>
					<th class="text-center">Quantity</th>
					<th class="text-center">Price</th>
					<th class="text-right">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($order_items as $item_id => $item) {
					$product = $item->get_product();
if($product){

	$is_visible        = $product && $product->is_visible();



					$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
					$product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);

					if (!empty($post_thumbnail_id)) {
						$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'medium'); //get thumbnail image url			
						$image_src = $post_thumbnail_src[0];
					} else {
						$image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
					}
				}else{
					$image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';

				}
				?>


					<tr>
						<td>
							<a href="<?php echo $product_permalink; ?>" class="order-product">
								<div class="o-product-media">
									<div class="o-product-image">
										<img src="<?php echo $image_src; ?>" alt="">
									</div>
								</div>
								<div class="o-product-content">

								
									<h6 class="o-product-title">
										<?php

										echo $item->get_name(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped



										?> </h6>
									<span><?php

											do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);

											wc_display_item_meta($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

											do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
											?></span>
								</div>
							</a>
						</td>
						<td class="text-center"><?php
												$qty          = $item->get_quantity();
												$refunded_qty = $order->get_qty_refunded_for_item($item_id);

												if ($refunded_qty) {
													$qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
												} else {
													$qty_display = esc_html($qty);
												}

												echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('%s', $qty_display) . '</strong>', $item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped


												?>
						</td>
						<td class="text-center"> <?php echo $product->get_price_html(); ?></td>

						<td class="text-right">
							<?php echo $order->get_formatted_line_subtotal($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="cart-totals order-totals text-right">


		<?php
		foreach ($order->get_order_item_totals() as $key => $total) {
		?>
			<div>
				<span class="cart-totals-label"><?php echo esc_html($total['label']); ?></span>
				<h4 class="cart-total-price"><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
												?></h4>
			</div>
		<?php
		}
		?>
		<?php if ($order->get_customer_note()) : ?>
			<div>
				<span class="cart-totals-label"><?php esc_html_e('Note:', 'woocommerce'); ?></span>
				<h4 class="cart-total-price"><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></h4>
			</div>
		<?php endif; ?>

	</div>
</div>




<?php //do_action( 'woocommerce_view_order', $order_id ); 
?>