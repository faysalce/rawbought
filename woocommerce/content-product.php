<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}

//do_action('woocommerce_before_shop_loop_item');

$images = $product->get_gallery_image_ids();

?>


<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-mb">
	<div class="product product-standard text-center">
		<div class="product-media">
			<a href="<?php echo get_permalink($product->get_id()); ?>" class="product-image">

				<?php $post_thumbnail_id = get_post_thumbnail_id($product->get_id());

				$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
				$image_src = $post_thumbnail_src[0];
				?>


				<img src="<?php echo $image_src; ?>" alt="" class="product-static-img">


				<?php
				if (count($images) > 0) {



					$post_thumbnail_src = wp_get_attachment_image_src($images[0], 'full'); //get thumbnail image url			
					$image_src = $post_thumbnail_src[0];
				?>


					<img src="<?php echo $image_src; ?>" alt="" class="product-hover-img">


				<?php
				} ?>
		</div>


		</a>
		<div class="product-quickview">
			<a href="quickview/quickview1.html" class="btn btn-site btn-white border-0 rounded-0 ajax-quickview" tabindex="-1">
				<span class="btn__text">Quick View</span>
			</a>
		</div>
	</div>
	<div class="product-content">
		<?php //do_action('woocommerce_before_shop_loop_item_title');
		?>
		<h6 class="product-title"><a href="product-single.html"><?php echo $product->get_name(); ?></a></h6>
		<?php //do_action('woocommerce_after_shop_loop_item_title');
		?>
		<div class="product-price">
			<?php echo $product->get_price_html(); ?>

		</div>
	</div>
</div>
</div>
<?php
//do_action('woocommerce_after_shop_loop_item');
