<?php get_header(); ?>
<main id="main-content">
	<section class="section-hero">
		<div class="hero-slider stick-dots hero-home-slider">
			<?php

			$home_slider = ot_get_option('home_slider');
			if (!empty($home_slider) && count($home_slider) > 0) {
				foreach ($home_slider as $home_slide) {
			?>

					<div class="slide">
						<div class="slide-img">
							<picture class="banner-image">
								<source media="(max-width: 575.98px)" srcset="<?php echo $home_slide['image-mobile']; ?>" class="bimg-mobile">
								<img src="<?php echo $home_slide['image']; ?>" alt="<?php echo $home_slide['title']; ?>">
							</picture>
						</div>
						<div class="slide-content">
							<div class="container">
								<div class="row">
									<div class="col-md-10 col-lg-8 col-xl-7 mx-auto text-center">
										<div class="slide-content-block">
											<h2 class="hero-heading text-light"><?php echo $home_slide['title']; ?></h2>
											<div class="hero-text text-light text-lead">
												<?php echo $home_slide['desc']; ?>
											</div>
											<div class="hero-actions">
												<a href="<?php echo $home_slide['link']; ?>" class="btn btn-site btn-lg btn-white btn-arrow-right rounded-0">
													<span class="btn__text"><?php echo $home_slide['btn-txt']; ?></span>
													<i class="ion ion-ios-arrow-round-forward"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

			<?php
				}
			}
			?>

		</div>
	</section>


	<section class="section pb-0">
		<div class="container container-xl-fluid">
			<div class="row group-common-header home-about-common-header mb-0">
				<div class="col-md-6 col-lg-6 col-xl-6 text-md-right">
					<div class="pr-lg-4 pr-xl-5">
						<!-- <p class="mb-0 text-uppercase"><?php echo ot_get_option('home_about_title'); ?> </p> -->
						<h3 class="home-about-heading mb-0">
							<?php echo ot_get_option('home_about_sub_title'); ?> </h3>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-xl-6 ">
					<div class="home-about-common-text mb-0 pl-lg-5 pl-xl-5">
						<div class="common-text">
							<p>
								<?php echo ot_get_option('home_about_desc'); ?>
							</p>
						</div>
						<div class="common-actions pt-4">
							<a href="<?php echo ot_get_option('home_about_link'); ?>" class="btn btn-site btn-arrow-right rounded-0 btn-outline-primary"><?php echo ot_get_option('home_about_link_text'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="section has-col-mb">
		<div class="container container-xl-fluid">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<div class="group-common-header text-center">
						<h2 class="common-heading"><?php echo ot_get_option('home_cat_title'); ?></h2>
					</div>
				</div>
			</div>
			<div class="row">
				<?php

				$categories = ot_get_option('home_cat_list');

				if (!empty($categories) &&  count($categories) > 0) {
					foreach ($categories as $category) {
						if (!empty($category['category'])) {
							$allpost_array[] = $category['category'];
							$term = get_term($category['category']);

							$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
							$image        = wp_get_attachment_url($thumbnail_id);

							// $term_meta_data = get_term_meta($term_id);
							// $thumb_id = $term_meta_data['thumbnail_id'][0];


				?>

							<div class="col-sm-4 col-md-4 c-mb">
								<a href="<?php echo get_term_link($term); ?>" class="feat-category">
									<div class="category-media">
										<div class="category-image">
											<img src="<?php echo $image; ?>" alt="<?php echo $term->name; ?>">
										</div>
									</div>
									<div class="category-content">
										<h4 class="category-title"><?php echo $term->name; ?></h4>
									</div>
								</a>
							</div>
				<?php }
					}
				} ?>

			</div>
		</div>
	</section>
	<section class="section pt-0 section-last">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-md-6 col-lg-7">
					<div class="newsletter-img">
						<img src="<?php echo ot_get_option('home_newsletter_img'); ?>" alt="" class="img-fluid">
					</div>
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="newsletter">
						<div class="newsletter-inside">
							<p class="newsletter-text">
								<?php echo ot_get_option('home_newsletter_txt'); ?> </p>
								<div class="thanks-text thanks-text-home d-none">Thank you for signing up.</div>
							<form method="post" place="home" class="newsletter-form" action="https://staging.rawbought.com/?na=s">
								<input class="form-control newsletter-email-home" placeholder="Email" type="text" name="ne" value="" >

								<input type="hidden" name="nlang" value="">
								<button type="submit" value="Subscribe" class="btn btn-site btn-lg btn-primary btn-arrow-right rounded-0 he-rotate btn-newsletter">
									<span class="btn__text">Sign Up</span>
									<i class="ion ion-ios-arrow-round-forward"></i>
								</button>
							</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>