<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php 

		//wp_redirect(get_permalink(get_page_by_path('login')));

?>
		<div class="col-md-12 col-lg-12 col-xl-12">



		<div class="container">
			<div class="box-auth auth-login">
				<div class="auth-container">
					<form id="checkout-login" method="post">
						<div class="form-group floating-static-group floating-static-style-2">
							<label for="email" class="floating-label f-required">Email</label>
							<input type="email" id="checkout-username" name="username" class="form-control username floating-field" required="required">
	
						</div>
						<div class="form-group floating-static-group floating-static-style-2">
							<label for="password" class="floating-label f-required">Password</label>
							<input type="password" id="checkout-password" name="password" class="form-control password floating-field" required="required">
	
						</div>
						<div class="form-group text-right">
							<a href="/my-account/lost-password" class="text-underline">Forgot your password?</a>
						</div>
						<div class="form-group">
							<!-- <button type="submit" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg btn-block" tabindex="-1">
											<span class="btn__text">Sign In</span>
										</button> -->
							<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
	
							<button type="button" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg btn-block checkout-login-btn">Sign In</button>
	
							<!-- <a href="profile.html" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg btn-block" tabindex="-1">
											<span class="btn__text">Sign In</span>
										</a> -->
						</div>
						<div class="sign-or text-center"><span>Or</span></div>
						<div class="signsocials-wrap">
							<ul class="sign-socials">
								<li>
									<button class="btn btn-facebook btn-site btn-block">
										<i class="fab fa-facebook-f"></i>
										<span class="btn-text">Facebook</span>
									</button>
								</li>
								<li>
									<button class="btn btn-google btn-site btn-block">
										<i class="fab fa-google"></i>
										<span class="btn-text">Google</span>
									</button>
								</li>
							</ul>
						</div>
						<div class="text-center sign-bottometa">
							Need to create an account? <a href="<?php echo get_permalink(get_page_by_path('signup')); ?>">Sign up here.</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php //do_action( 'woocommerce_after_customer_login_form' ); ?>
