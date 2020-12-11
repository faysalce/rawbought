<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.1
 *
 * Modified to use radio buttons instead of dropdowns
 * @author 8manos
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $woocommerce;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<div class="variations  product-colorQty-wrap product-colorQty-woowrapper">
			<?php foreach ( $attributes as $name => $options ) : ?>
				<?php $sanitized_name = sanitize_title( $name ); ?>
				<div class="product-variants-option attribute-<?php echo esc_attr( $sanitized_name ); ?>">
					<div class="label"><label for="<?php echo esc_attr( $sanitized_name ); ?>"><?php echo wc_attribute_label( $name ); ?>: <span class="product-name-<?php echo $sanitized_name; ?>"></span></label>
				<?php if($name=='pa_size'){?>
					<div class="product-size-guide d-none d-md-block">
                                                                <a class="link-size-guide" data-toggle="modal" data-target="#sizeGuideModal" href="#sizeGuideModal">What's my size?</a>
															</div>
				<?php } ?>
				</div>
					


					<?php
					if ( isset( $_REQUEST[ 'attribute_' . $sanitized_name ] ) ) {
						$checked_value = $_REQUEST[ 'attribute_' . $sanitized_name ];
					} elseif ( isset( $selected_attributes[ $sanitized_name ] ) ) {
						$checked_value = $selected_attributes[ $sanitized_name ];
					} else {
						$checked_value = '';
					}
					?>


					

					<div class="value">
					
<div class="attr-wrp-<?php echo $sanitized_name; ?>">
						<?php
						if ( ! empty( $options ) ) {
							if ( taxonomy_exists( $name ) ) {
								// Get terms if this is a taxonomy - ordered. We need the names too.
								$terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );

								foreach ( $terms as $term ) {
									if ( ! in_array( $term->slug, $options ) ) {
										continue;
									}
									print_attribute_radio( $checked_value, $term->slug, $term->name, $sanitized_name,$term->description );
								}
							} else {
								foreach ( $options as $option ) {
									print_attribute_radio( $checked_value, $option, $option, $sanitized_name,$term->description );
								}
							}
						}

						echo end( $attribute_keys ) === $name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
						?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
<div class="quantity-size-wrp product-variants-option">
	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

</div>
		</div>

		<?php
			if ( version_compare($woocommerce->version, '3.4.0') < 0 ) {
				do_action( 'woocommerce_before_add_to_cart_button' );
			}
		?>

		<div class="single_variation_wrap">
			<?php
				do_action( 'woocommerce_before_single_variation' );
				do_action( 'woocommerce_single_variation' );
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php
			if ( version_compare($woocommerce->version, '3.4.0') < 0 ) {
				do_action( 'woocommerce_after_add_to_cart_button' );
			}
		?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
