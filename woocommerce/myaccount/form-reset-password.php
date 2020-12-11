<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>




<div class="col-md-12 col-lg-12 col-xl-12">

<form method="post" class="woocommerce-ResetPassword lost_reset_password">


		<div class="container">
			<div class="box-auth auth-login">
				<div class="auth-container">
					<div class="auth-heading">
						<h3 class="auth-title">Reset Password</h3>
					</div>
					<p>

					</p>
					<div class="form-group floating-static-group floating-static-style-2">

						<label for="password_1" class="floating-label f-required">New password'</label>
						<input type="password" class="form-control floating-field" name="password_1" id="password_1" autocomplete="new-password" />

					</div>
					<div class="form-group floating-static-group floating-static-style-2">
						<label for="password_2" class="floating-label f-required">Re-enter new password</label>
						<input type="password" class="form-control floating-field" name="password_2" id="password_2" autocomplete="new-password" />

					</div>
					<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
	<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />
	<input type="hidden" name="wc_reset_password" value="true" />

					<div class="form-group">
						<button type="submit" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg forgot-button" tabindex="-1">
							<span class="btn__text">Submit</span>
						</button>
						<a href="<?php echo home_url(); ?>" class="btn btn-site btn-link btn-lg">Cancel</a>
					</div>
				</div>
			</div>
		</div>
		<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>






		<?php do_action('woocommerce_resetpassword_form'); ?>



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




					});
</script>

<?php
do_action( 'woocommerce_after_reset_password_form' );

