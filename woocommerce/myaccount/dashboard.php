<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
$customer_id = get_current_user_id();

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
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
		<?php 
		
do_action( 'woocommerce_before_edit_account_form' ); 
$user=wp_get_current_user();

?>



<?php do_action( 'woocommerce_after_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
			<div class="row">
				<div class="col-md-4 col-lg-3">
					<div class="profile-mediawrap">
<?php 

$user_id      = get_current_user_id();
$profile_img	= @json_decode(get_user_meta($user_id, 'profile_image', true));
$profile_img  = !$profile_img ? '' : $profile_img;
?>


					
						<div class="profile-media">
							<div class="profile-avater upload-thumb profile_image">
								<span class="avater-placeholder"><i class="far fa-user"></i></span>
								<img src="<?php echo $profile_img->thumb; ?>">

							</div>
							<div class="media-change-action">
								<button class="btn btn-change">

									<input data-type="image" type="file" data-ajaxed="Y" data-cont=".profile_image" name="image" class="upload media-upload-file" />
      <input type="hidden" name="image_aid" value="" />
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
									<label for="account_last_name" class="static-label "><?php esc_html_e( 'Last name', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
									<input type="text" class="form-control floating-field" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />

								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="form-group static-group">
									<label for="account_email" class="static-label "><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>

									<input type="email" class="form-control floating-field" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />

								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">

			
								<div class="form-group static-group">
									<label for="" class="static-label f-required">Mobile </label>
									<input type="text" class="form-control floating-field" name="billing_mobile_phone" id="billing_mobile_phone" value="<?php echo esc_attr( $user->billing_mobile_phone ); ?>" />

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
		
		<h5 class="heading-hr-top">Addresses</h5>
		<div class="row">
			<div class="col-md-6">
				<?php 
						$addressBilling = wc_get_account_formatted_address('billing');
						$addressShipping = wc_get_account_formatted_address('shipping');


				?>
				<div class="card address-card active">
					<div class="card-header">
						<div>
							<span class="address-status">Billing</span>
						</div>
						<div>
						<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'billing' ) ); ?>" class="btn btn-link"><?php echo $addressBilling ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>

						</div>
					</div>
					<div class="card-body">
					<?php
					echo $addressBilling ? wp_kses_post($addressBilling) : esc_html_e('You have not set up this type of address yet.', 'woocommerce');
					?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card address-card">
					<div class="card-header">
						<div>
							<span class="address-status">Shipping</span>
						</div>
						<div>
						<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping' ) ); ?>" class="btn btn-link"><?php echo $addressShipping ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>
						</div>
					</div>
					<div class="card-body">
					<?php
					echo $addressShipping ? wp_kses_post($addressShipping) : esc_html_e('You have not set up this type of address yet.', 'woocommerce');
					?>
					</div>
				</div>
			</div>
		</div>
		<h5 class="heading-hr-top">Password</h5>
			<div class="profile-fieldwrap">
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group static-group">
							<label for="password_current" class="static-label f-required"><?php esc_html_e( 'Current Password ', 'woocommerce' ); ?></label>

							<input type="password" class="form-control floating-field " name="password_current" id="password_current" autocomplete="off" />

						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12">
						<div class="form-group static-group">
						<label for="password_1" class="static-label f-required"><?php esc_html_e( 'New Password ', 'woocommerce' ); ?></label>

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
	</div>






<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
?>
<script>
(function($){

$('input[type=file][data-ajaxed=Y]').on('change', function(event) {

	files = event.target.files;
	var cont = $(this).attr('data-cont');
	var name = $(this).attr('name');

	var data = new FormData();
	$.each(files, function(key, value)
	{
		data.append(key, value);
	});

	//data.append('partner_info_post_id', $(this).closest('form').find("#partner_info_post_id").val() );
	//data.append('type', $(this).data('type'));

	$(cont).html('<img src="/assets/images/preloader.gif" />');

	$.ajax({
		url: '/wp-admin/admin-ajax.php?action=file_upload&fname='+name, // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			console.log(data);
			if(data.error)
			{
				alert(data.error);
			}
			else
			{
				$(cont).html('<span class="avater-placeholder"><i class="far fa-user"></i></span><img src="'+data.src+'" style="max-width:100%;" />');
				$('[name='+name+'_aid]').val(data.aid);
			}
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			// Handle errors here
			console.log('ERRORS: ' + textStatus);
			alert('ERRORS: ' + textStatus);
			$(cont).html('error');
			// STOP LOADING SPINNER
		}
	});

});


})(jQuery);

</script>