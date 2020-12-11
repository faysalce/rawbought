<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>

<?php

// if(isset($_REQUEST['reset-link-sent']) && $_REQUEST['reset-link-sent']==true){

// wp_redirect(get_permalink(get_page_by_path('login')).'?reset-link-sent=true');
// die;
// }
?>

<div class="col-md-12 col-lg-12 col-xl-12">
	<form method="post" action="<?php echo get_permalink(get_page_by_path('login')) . '?reset-link-sent=true'; ?>" class="woocommerce-ResetPassword lost_reset_password">


		<div class="container">
			<div class="box-auth auth-login">
				<div class="auth-container">
					<div class="auth-heading">
						<h3 class="auth-title">Reset Password</h3>
					</div>
					<p>

						<?php echo apply_filters('woocommerce_lost_password_message', esc_html__('You will receive an email with a link to reset your password.', 'woocommerce')); ?>
					</p>
					<div class="form-group floating-static-group floating-static-style-2">
						<label for="user_login" class="floating-label f-required">Email</label>

						<input type="text" name="user_login" id="user_login" autocomplete="username" class="form-control floating-field">
					</div>
					<input type="hidden" name="wc_reset_password" value="true" />

					<div class="form-group">
						<button type="button" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg forgot-button" tabindex="-1">
							<span class="btn__text">Submit</span>
						</button>
						<a href="<?php echo home_url(); ?>" class="btn btn-site btn-link btn-lg">Cancel</a>
					</div>
				</div>
			</div>
		</div>






		<?php do_action('woocommerce_lostpassword_form'); ?>


		<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

	</form>
</div>
<script>
	jQuery(document).ready(function($) {

				$('.forgot-button').click(function() {



					var username = $('#user_login');
					var emailCheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

					console.log('forgot');
					var valid = true;
					if (username.val() == '' || !emailCheck.test(username.val())) {
						valid = false;
					}
					if (valid) {

						var form = $('.lost_reset_password');
						var url = form.attr('action');

						$.ajax({
							type: "POST",
							url: url,
							data: form.serialize(), // serializes the form's elements.
							success: function(data) {
								window.location.href = '/login/?reset-link-sent=true';





							}
						});


					} else {
						if (username.val() == '') {
							username.addClass('field-invalid');
						} else {
							username.removeClass('field-invalid');

						}

						if (!emailCheck.test(username.val())) {
							username.addClass('field-invalid');
						} else {
							username.removeClass('field-invalid');

						}
					}


				});








				// 		$('.lost_reset_password').submit(function(e){

				// var username=$('#user_login');
				// var emailCheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

				// console.log('forgot');
				// var valid=true;
				// if (username.val() == '' || !emailCheck.test(username.val())  ) {
				// 	valid = false;
				// }
				// if (valid) {

				// 	return
				// }else{
				// 	if (username.val() == '') {
				// 			username.addClass('field-invalid');
				// 		} else {
				// 			username.removeClass('field-invalid');

				// 		}

				// 		if (!emailCheck.test(username.val())) {
				// 			username.addClass('field-invalid');
				// 		} else {
				// 			username.removeClass('field-invalid');

				// 		}
				// }
				// e.preventDefault();
				// });
					});
</script>
<?php
do_action('woocommerce_after_lost_password_form');
