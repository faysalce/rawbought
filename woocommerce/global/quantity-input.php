<?php

/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined('ABSPATH') || exit;

if ($max_value && $min_value === $max_value) {
?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr($input_id); ?>" class="qty" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($min_value); ?>" />
	</div>
<?php
} else {
	/* translators: %s: Quantity. */
	$label = "Qty:";
?>
	<div class="product-variants-option-name">
		<?php do_action('woocommerce_before_quantity_input_field'); ?>
		<label class="" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>

	</div>
	<div class="product-var-qty">

		<select id="<?php echo esc_attr($input_id); ?>" class="qty <?php echo esc_attr(join(' ', (array) $classes)); ?>" step="<?php echo esc_attr($step); ?>"  			name="<?php echo esc_attr( $input_name ); ?>"
 >
			<option value="1" <?php if(!empty($input_value) && $input_value==1 ){echo "selected='selected'";} ?>>1</option>
			<option value="2"<?php if(!empty($input_value) && $input_value==2 ){echo "selected='selected'";} ?>>2</option>
			<option value="3" <?php if(!empty($input_value) && $input_value==3 ){echo "selected='selected'";} ?>>3</option>
			<option value="4" <?php if(!empty($input_value) && $input_value==4 ){echo "selected='selected'";} ?>>4</option>
			<option value="5" <?php if(!empty($input_value) && $input_value==5 ){echo "selected='selected'";} ?>>5</option>
			<option value="6" <?php if(!empty($input_value) && $input_value==6 ){echo "selected='selected'";} ?>>6</option>
			<option value="7" <?php if(!empty($input_value) && $input_value==7 ){echo "selected='selected'";} ?>>7</option>
			<option value="8" <?php if(!empty($input_value) && $input_value==8 ){echo "selected='selected'";} ?>>8</option>
			<option value="9" <?php if(!empty($input_value) && $input_value==9 ){echo "selected='selected'";} ?>>9</option>
			<option value="10" <?php if(!empty($input_value) && $input_value==10 ){echo "selected='selected'";} ?>>10</option>
		</select>


		<?php do_action('woocommerce_after_quantity_input_field'); ?>
	</div>

<?php
}
