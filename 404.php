<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rawbought
 */

get_header();
?>
<main id="main-content">
	<div class="has-fixed-navbar"></div>
	<section class="section has-col-mb">
		<div class="container container-xl-fluid">
			<div class="section-error-header mx-auto">
				<div class="row align-items-center">
					<div class="col-sm-6 col-md-6">
						<div class="error-image">
							<div class="error-image-img">
								<img src="<?php echo get_template_directory_uri();?>/assets/images/404.svg" alt="404">
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="error-content pl-lg-3">
							<h1 class="error-heading h3 text-uppercase">404 Page Not Found</h1>
							<div class="error-text">
								<p>
									We’re sorry, the page you’re looking for cannot be found.
								</p>
							</div>
							<div class="error-action">
								<a href="<?php echo home_url();?>" class="btn btn-site btn-lg btn-primary btn-arrow-right rounded-0 btn-error">Back to home</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="section-error-recommended">
				<div class="group-common-header text-center">
					<h2 class="h5 mb-0">RECOMMENDED FOR YOU</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<?php
				$args = array(
					'posts_per_page' => 4,
					'post_type' => 'product',
					'post_status' => 'publish',       // name of post type.
					'orderby' => 'rand',
					'order'    => 'DESC'
				);

				$all_products = get_posts($args);
				if (count($all_products) > 0) {

					foreach ($all_products as $all_product) {
						$product = wc_get_product($all_product->ID);
						$product_id = $all_product->ID;
						$images = $product->get_gallery_image_ids();
						$post_thumbnail_id = get_post_thumbnail_id($all_product->ID);
						if (!empty($post_thumbnail_id)) {
							$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
							$image_src = $post_thumbnail_src[0];
						} else {
							$image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
						}

						$sale_price = $product->get_sale_price();
						$regular_price = $product->get_price();


				?>
						<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-mb">
							<div class="product product-standard text-center">


								<div class="product-media">
									<a href="<?php echo get_permalink($all_product->ID); ?>" class="product-image">

										<?php

										$post_thumbnail_id = get_post_thumbnail_id($product_id);


										if (!empty($post_thumbnail_id)) {
											$post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'full'); //get thumbnail image url			
											$image_src = $post_thumbnail_src[0];
										} else {
											$image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
										}


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
									</a>
									<div class="product-quickview">
										<a href="javascript:void(0);" product_id="<?php echo $product_id; ?>" class="btn btn-site btn-white border-0 rounded-0 ajax-quickview" tabindex="-1">
											<span class="btn__text">Quick View</span>
										</a>
									</div>
								</div>
								<div class="product-content">
									<h6 class="product-title"><a href="<?php echo get_permalink($product_id); ?>"><?php echo $product->get_name(); ?></a></h6>
									<div class="product-price">
										<?php echo $product->get_price_html(); ?>
									</div>
								</div>


							</div>
						</div>

				<?php }
				} ?>


			</div>
		</div>
	</section>
</main>


<?php
get_footer();
