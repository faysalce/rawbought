<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
			<div class="row">
				<div class="col-md-4 col-lg-3">
					<div class="profile-mediawrap">
						<div class="profile-media">
							<div class="profile-avater">
								<span class="avater-placeholder"><i class="far fa-user"></i></span>
								<img src="" alt="">
							</div>
							<div class="media-change-action">
								<button class="btn btn-change">
									<input type="file" class="media-upload-file">
									Change
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-lg-9">
					<div class="profile-fieldwrap">
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group static-group">
									<label for="account_first_name" class="static-label"><?php esc_html_e( 'First name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
									<input type="text" class="form-control floating-field" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group static-group">
									<label for="account_last_name" class="static-label f-required"><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
									<input type="text" class="form-control floating-field" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />

								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group static-group">
									<label for="account_email" class="static-label f-required"><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

									<input type="email" class="form-control floating-field" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />

								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group static-group">
									<label for="" class="static-label f-required">Mobile </label>
									<input type="text" value="088+ 06254 215412" class="form-control floating-field" required="">
								</div>
							</div>
						</div>
						<?php do_action( 'woocommerce_edit_account_form' ); ?>

						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group static-group mb-0">
								<button type="submit" class="btn btn-site btn-light btn-block" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		
		<h5 class="heading-hr-top">Password</h5>
			<div class="profile-fieldwrap">
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group static-group">
							<label for="password_current" class="static-label"><?php esc_html_e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>

							<input type="password" class="form-control floating-field" name="password_current" id="password_current" autocomplete="off" />

						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group static-group">
						<label for="password_1"><?php esc_html_e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>

							<input type="password" class="form-control floating-field" name="password_1" id="password_1" autocomplete="off" />

						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group static-group">
						<label for="password_2" class="static-label f-required"><?php esc_html_e( 'Confirm New Password', 'woocommerce' ); ?></label>

							<input type="password" class="form-control floating-field" name="password_2" id="password_2" autocomplete="off" />
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-6">
					<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<input type="hidden" name="action" value="save_account_details" />

						<div class="form-group static-group">
						<button type="submit" class="btn btn-site btn-light btn-block" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
						</div>
					</div>
				</div>
			</div>
			<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
