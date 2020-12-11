<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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

if (!defined('ABSPATH')) {
    exit;
}


// // If checkout registration is disabled and not logged in, the user cannot checkout.
// if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
// 	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
// 	return;
// }

?>



<main id="main-content">
    <div class="has-fixed-navbar"></div>

    <section class="section">
        <div class="container-fluid container-xl-fluid">
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-8">
                        <div class="pr-md-4 pr-lg-5">
                            <!-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-checkout">
                                    <li class="breadcrumb-item"><a href="cart.html">Cart</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Shipping</li>
                                    <li class="breadcrumb-item">Billing</li>
                                    <li class="breadcrumb-item">Payment</li>
                                </ol>
                            </nav> -->
                            <div id="checkout-process-wrapper">
                                <ul class="nav nav-pills nav-checkout-step" id="checkout-tab" role="tablist">
                                    <li class="nav-item item-step-completed" role="presentation">
                                        <a class="nav-link" href="<?php echo wc_get_cart_url(); ?>">Cart</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tb_shipping-tab" data-toggle="pill" href="#tb_shipping" role="tab" aria-controls="tb_shipping" aria-selected="false">Shipping</a>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link " id="tb_billing-tab" data-toggle="pill" href="#tb_billing" role="tab" aria-controls="tb_billing" aria-selected="true">Billing</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tb_payment-tab" data-toggle="pill" href="#tb_payment" role="tab" aria-controls="tb_payment" aria-selected="false">Payment</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="checkout-tabContent">

                                    <div class="tab-pane fade show active" id="tb_shipping" role="tabpanel" aria-labelledby="tb_shipping-tab">
                                        <div class="tab-content-block">

                                            <?php do_action('woocommerce_checkout_shipping'); ?>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade  " id="tb_billing" role="tabpanel" aria-labelledby="tb_billing-tab">
                                        <div class="tab-content-block">
                                            <div class="step-section border-bottom">
                                                <div class="step-section-header">
                                                    <h6 class="step-section-title">Shipping ADDRESS</h6>
                                                    <a href="javascript:void(0)" class="edit-tb_shipping"><span aria-hidden="true">Edit</span></a>
                                                </div>
                                                <div class="step-body">
                                                    <div>
                                                        <address class="shipping-address-wrp-plain">

                                                        </address>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="step-section">
                                                <div class="step-section-header">
                                                    <h6 class="step-section-title">Billing ADDRESS</h6>
                                                </div>
                                                <div class="step-section-body">
                                                    <div class="sec-billing-address">
                                                        <div class="custom-control custom-checkbox text-uppercase mb-4">
                                                            <input type="checkbox" id="checkBillingAddress" class="custom-control-input">
                                                            <label class="custom-control-label" for="checkBillingAddress">Use Shipping Address for Billing</label>
                                                        </div>
                                                        <div id="billing-address-block" class="sec-billing-address-body">

                                                        <?php do_action('woocommerce_checkout_billing'); ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tb_payment" role="tabpanel" aria-labelledby="tb_payment-tab">
                                        <div class="tab-content-block">
                                        <div class="step-section border-bottom">
                                                <div class="step-section-header">
                                                    <h6 class="step-section-title">Shipping ADDRESS</h6>
                                                    <a href="javascript:void(0)" class="edit-tb_shipping"><span aria-hidden="true">Edit</span></a>
                                                </div>
                                                <div class="step-section-body">
                                                    <div>
                                                        <address class="shipping-address-wrp-plain">

                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="step-section border-bottom">
                                                <div class="step-section-header">
                                                    <h6 class="step-section-title"> Billing ADDRESS</h6>
                                                    <a href="javascript:void(0)" class="edit-tb_billing"><span aria-hidden="true">Edit</span></a>


                                                </div>
                                                <div class="step-body">
                                                    <div>
                                                        <address class="billing-address-wrp-plain">

                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="step-section">
                                                <div class="step-section-header">
                                                    <h6 class="step-section-title">Payment Method</h6>

                                                </div>
                                                <div class="step-section-body">
                                                    <div class="wc-payment-list">


                                                        <div id="payment" class="woocommerce-checkout-payment">
                                                            <?php if (WC()->cart->needs_payment()) : ?>
                                                                <ul class="wc_payment_methods payment_methods methods">
                                                                    <?php
                                                                    if (!empty($available_gateways)) {
                                                                        foreach ($available_gateways as $gateway) {
                                                                            wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                                                                        }
                                                                    } else {
                                                                        echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                            <div class="form-row place-order">
                                                                <noscript>
                                                                    <?php
                                                                    /* translators: $1 and $2 opening and closing emphasis tags respectively */
                                                                    printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
                                                                    ?>
                                                                    <br /><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
                                                                </noscript>

                                                                <?php wc_get_template('checkout/terms.php'); ?>

                                                                <?php do_action('woocommerce_review_order_before_submit'); ?>

                                                                <?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class=" alt btn btn-site btn-primary he-rotate" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine 
                                                                ?>

                                                                <?php do_action('woocommerce_review_order_after_submit'); ?>

                                                                <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if (!is_ajax()) {
                                                            do_action('woocommerce_review_order_after_payment');
                                                        }
                                                        ?>












                                                    </div>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="step-footer">
                                        <ul class="step-footer-actions">
                                            <li>
                                                <a href="#" class="btn btn-site btn-link btn-return-cart btn-stepprev">
                                                    <i class="ion ion-ios-arrow-back"></i>
                                                    Back
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="btn btn-site btn-primary he-rotate btn-stepnext">
                                                    <span class="btn__text">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-order-details">
                            <div class="card-body">

                                <?php
                                do_action('woocommerce_before_checkout_form', $checkout); ?>

                                <div class="section-order-summary border-top-0 pt-0 mb-0 pb-0 right-side-checkout">
                                    <?php do_action('woocommerce_checkout_order_review'); ?>
                                    <?php do_action('woocommerce_checkout_after_order_review'); ?>

                                </div>
                                <?php do_action('woocommerce_after_checkout_form', $checkout); ?>



                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
</main>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>