<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon/site.webmanifest">


	<title><?php
			if (wp_title('', false)) {
			
			} else {
				echo bloginfo('description');
			}
			wp_title(''); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'is-preloader' ); ?>>
	<?php //wp_body_open(); ?>

	<div id="preloader">
		<div id="site-preloader" class="site-preloader">
			<div class="animation-preloader">
				<div class="brand-spinner">
					<svg id="spinnerSvg" x="0px" y="0px" viewBox="0 0 455 529">
						<g>
							<path class="st0" d="M403.4,512.9L295.5,302.9c35-11.3,62.1-30.9,81.3-58.8c19.2-27.8,28.8-57.3,28.8-88.3
                                c0-40.9-15.8-76.3-47.3-106.1C326.8,19.9,282.7,5,226,5H5v11.1h22.6c0.1,0,0.1,0.1,0.2,0.1c7.9,3.5,15,8.1,21.5,13.5
                                c16.7,14,28.8,225.9,35.8,253v3.4h1.1h1.3v-3.8c7-26.6,19.1-238.2,35.7-252.1c6.4-5.3,13.3-9.8,21-13.3h53.9
                                c40,2,72.1,15.3,95.5,41c25.4,27.9,38.1,60.7,38.1,98.7c0,38-12.3,71.6-37,100.9c-18,21.4-41.2,34.8-69.3,40.4l7.1,14.6h0.1
                                l96.8,200.3h-38.4V524H450v-11.1H403.4z" />
							<path class="st0" d="M150,512.9h-0.4c-0.8-0.4-1.5-1-2.4-1.3c-9-3.7-16.7-9.1-23.8-15.3c-16.1-14-27.9-33.8-34.8-60.4v-3.4h-1.1
                                h-1.3v3.9c-7.1,27.2-19.5,47.5-36.8,61.5c-6.9,5.6-14.3,10.3-22.8,13.8c-0.9,0.3-1.6,0.9-2.4,1.3h-0.5v0H5V524h162.6v-11.1
                                L150,512.9L150,512.9z" />
						</g>
					</svg>
				</div>
				<div class="preloader-text text-center">Loading</div>
			</div>
		</div>
	</div>
	<header id="header" class="header">
		<nav class="<?php if(is_home()){echo "navbar navbar-expand-lg navbar-dark bg-transparent navbar-align-bottom navbar-mega fixed-top bg-transparent-fixed-top navbar__only_desktop navbar-initial";}else{echo "navbar navbar-expand-lg navbar-light bg-white navbar-filled fixed-top navbar-align-bottom navbar-mega navbar__only_desktop";}?>">
			<div class="container container-xl-fluid">
				<div class="collapse navbar-collapse">


<?php 


wp_nav_menu( array(
    'theme_location'  => 'menu-1',
    'depth'           => 3, // 1 = no dropdowns, 2 = with dropdowns.
    'container'       => false,
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'navbar-nav nav-main nav-sitemain',
    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
    'walker'          => new WP_Bootstrap_Navwalker(),
) );

?>
				
					
					<ul class="navbar-nav mx-auto nav-center-logo">
						<li class="nav-item">
							<a class="nav-link nav-brand-image" href="<?php echo home_url(); ?>">
								<img src="<?php echo ot_get_option('logo')?>" alt="..." class="logo-light">
								<img src="<?php echo ot_get_option('logo_gray')?>" alt="..." class="logo-dark">
							</a>
						</li>
					</ul>
					<ul class="navbar-nav ml-auto nav-utility">
						<li class="nav-item">
							<?php if (is_user_logged_in()) { ?>
								<a class="nav-link" href="<?php echo get_permalink(get_page_by_path('my-account')); ?>">Profile</a>

							<?php } else { ?>
								<a class="nav-link" href="<?php echo get_permalink(get_page_by_path('signup')); ?>">Profile</a>

							<?php } ?>
						</li>
						<li class="nav-item dropdown dropdown-mega dropdown-search">
							<a class="nav-link dropdown-toggle nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>
							<div class="dropdown-menu">
								<div class="dropdown-menu-block">
									<div class="container-fluid">
										<div class="w-100">

										<?php get_search_form();?>

											
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link nav-link-icon nav-btn-cart" href="#" role="button" data-toggle="modal" data-target="#cartModal">
								<i class="ti-bag"></i>
								<span class="badge"><span  class="minicart-total-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<nav class="<?php if(is_home()){echo "navbar navbar-expand-lg navbar-light bg-white navbar-filled fixed-top navbar-mega navbar__only_mobile";}else{echo "navbar navbar-expand-lg navbar-light bg-white navbar-filled fixed-top navbar-mega navbar__only_mobile";}?>">
			<div class="container container-xl-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo home_url(); ?>">
					<img src="<?php echo ot_get_option('logo')?>" alt="..." class="logo-light">
								<img src="<?php echo ot_get_option('logo_gray')?>" alt="..." class="logo-dark">
					</a>
					<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<ul class="navbar-nav ml-auto w-nav nav-users nav-utility">
						<li class="nav-item dropdown dropdown-mega dropdown-search">
							<a class="nav-link dropdown-toggle nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>
							<div class="dropdown-menu">
								<div class="dropdown-menu-block">
									<div class="container-fluid">
										<div class="w-100">
										<?php get_search_form();?>

										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item nav-item-cart">

							<a class="nav-link nav-btn-cart" href="#" role="button"  data-toggle="modal" data-target="#cartModal">
								<i class="ti-bag"></i>
								<?php if(WC()->cart->get_cart_contents_count() >0){?>
								<span class="badge"><span  class="minicart-total-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></span>
								<?php }?>
							</a>
						</li>
					</ul>
				</div>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-collapse-block">
						<div class="navbar-close">
                            <button class="btn btn-collapse-close" type="button">
                                <i class="ti-close"></i>
                            </button>
                        </div>
						<div class="container-nav_mobile">
							<!-- <a href="<?php //echo home_url();?>" class="navbar-mobile-logo">
                                <img src="<?php //echo ot_get_option('logo_gray')?>" alt="">
                            </a> -->
							<div class="container-nav_mobile__block">

							<?php 


	wp_nav_menu( array(
	    'theme_location'  => 'menu-1',
	    'depth'           => 3, // 1 = no dropdowns, 2 = with dropdowns.
	    'container'       => false,
	    'container_class' => '',
		'container_id'    => '',
		'menu_id'      => 'navMobile',
	    'menu_class'      => 'nav-mobile',
	    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
	    'walker'          => new WP_Bootstrap_Navwalker(),
	) );

	?>
			
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<?php get_template_part('template-parts/modal-search'); ?>
	<?php 
	if(is_page('cart')){
		get_template_part('template-parts/modal-checkout');
	}
	
	?>
	<?php 
	if(is_single()){
	}else{
		get_template_part('template-parts/modal-quickview');

	}
	
	?>
	<?php get_template_part('template-parts/modal-cart'); ?>
	<?php get_template_part('template-parts/modal-filter'); ?>

	<?php get_template_part('template-parts/modal-size-guide'); ?>

