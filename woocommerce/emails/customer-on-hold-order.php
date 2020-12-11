<?php
/**
 * Customer on-hold order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-on-hold-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<!-- <p><?php //printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<p><?php //esc_html_e( 'Thanks for your order. It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:', 'woocommerce' ); ?></p> -->

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#e9e8e9">
    <tr>
        <td valign="top" bgcolor="#e9e8e9" width="100%">
            <table width="100%" role="content-container" class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td width="100%">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                                    <!--[if mso]>
                                            <center>
                                              <table>
                                                <tr>
                                                  <td width="600">
                                                    <![endif]-->

                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px;" align="center">
                                        <tr>
                                            <td>
                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td height="30" style="height: 30px"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; max-width: 100%;">
                                                                <tr>
                                                                    <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 14px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;">
                                                                        <a href="<?php echo home_url();?>" target="_blank">
                                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dark.png" alt="Rawbought" style="width: 260px; display: block; margin-left: auto;margin-right:auto;">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="30" style="height: 30px"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background:#ffffff">
                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="width:100%; max-width:100%;background:#ffffff">
                                                                <tr>
                                                                    <td width="20" style="width:20px"></td>
                                                                    <td>
                                                                        <table width="100" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">
                                                                            <!-- TR FOR TABLE INNER SPACEING -->
                                                                            <tr>
                                                                                <td height="20" style="height:20px"></td>
                                                                            </tr>
                                                                            <!-- TR FOR TABLE INNER SPACEING -->

                                                                            <tr>
                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:16px;line-height:24px; font-weight:normal; font-style:normal;color:#010101">
                                                                                    <h1 class="email-heading" style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:24px;line-height:30px; font-weight:normal;font-style: normal; color:#010101;margin:0;">
                                                                                        We have your order! It’s on-hold until we confirm that payment has been received. In the meantime, here’s a reminder of what you ordered:
                                                                                    </h1>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="20" style="height:20px"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                        <strong><?php printf(esc_html__('Hi %s,', 'woocommerce'), esc_html($order->get_billing_first_name())); ?></strong>
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                        Thank you for your order! We’re stoked to know that in a few days time, you’d be resting soundly with our Rawbought sleepwear! You can check your order status <a href="<?php echo $order->get_edit_order_url(); ?>" style="text-decoration:underline;">here</a>.
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="20" style="height:20px"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">
                                                                                        <td style="background:#f8f9fa;border:1px solid #d9d9d9;padding:20px">
                                                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">
                                                                                                <tr>

                                                                                                    <td valign="middle">
                                                                                                        <table cellpadding="0" cellspacing="0" border="0" class="align-center w-100" align="left" style="width:100%;max-width:162px">
                                                                                                            <tr>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style:normal;color:#010101;">
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:500;font-style:normal;color:#010101;text-transform:uppercase;">
                                                                                                                        Date Ordered
                                                                                                                    </p>
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:600;font-style:normal;color:#010101">
                                                                                                                        <?php echo  wc_format_datetime($order->get_date_created()); ?>
                                                                                                                    </p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td height="10" style="height:10px"></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style:normal;color:#010101;">
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:500;font-style:normal;color:#010101;text-transform:uppercase;">
                                                                                                                        Order no
                                                                                                                    </p>
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:600;font-style:normal;color:#010101">
                                                                                                                        <?php echo $order->get_order_number(); ?>
                                                                                                                    </p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <table class="table-hrmobile" align="left" style="width:15px">
                                                                                                            <tr>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style: normal;color:#010101">&nbsp;</td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <?php
                                                                                                        $address    = $order->get_formatted_billing_address();
                                                                                                        $shipping   = $order->get_formatted_shipping_address();
                                                                                                        ?>
                                                                                                        <table cellpadding="0" cellspacing="0" border="0" class="align-center w-100" align="left" style="width:100%;max-width:162px">
                                                                                                            <tr>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style:normal;color:#010101;">
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:500;font-style:normal;color:#010101;text-transform:uppercase;">
                                                                                                                        Ordered by
                                                                                                                    </p>

                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style:normal;color:#010101">
                                                                                                                        <?php echo $address; ?>
                                                                                                                    </p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <table class="table-hrmobile" align="left" style="width:15px">
                                                                                                            <tr>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style: normal;color:#010101">&nbsp;</td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <table cellpadding="0" cellspacing="0" border="0" class="align-center w-100" align="left" style="width:100%;max-width:162px">
                                                                                                            <tr>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:normal;font-style:normal;color:#010101;">
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:500;font-style:normal;color:#010101;text-transform:uppercase;">
                                                                                                                        Shipped To
                                                                                                                    </p>
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:600;font-style:normal;color:#010101">
                                                                                                                        <?php echo $shipping; ?> 

                                                                                                                    </p>

                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td height="10" style="height:10px"></td>
                                                                                                            </tr>
                                                                                                            <tr>

                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="20px" style="height: 20px"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">

                                                                                        <?php
                                                                                        $items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));

                                                                                        foreach ($items as $item_id => $item) :
                                                                                            $product       = $item->get_product();
                                                                                            $sku           = '';
                                                                                            $purchase_note = '';
                                                                                            $image         = '';

                                                                                            if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
                                                                                                continue;
                                                                                            }

                                                                                            if (is_object($product)) {
                                                                                                $sku           = $product->get_sku();
                                                                                                $purchase_note = $product->get_purchase_note();
                                                                                                $image         = $product->get_image($image_size);
                                                                                            }

                                                                                        ?>
                                                                                            <tr>
                                                                                                <td style="border-bottom:1px solid #d9d9d9;">
                                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; max-width: 100%;">
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:100%">
                                                                                                                    <tr>
                                                                                                                        <td style="width:80px;">
                                                                                                                            <?php
                                                                                                                            echo wp_kses_post(apply_filters('woocommerce_order_item_thumbnail', $image, $item));

                                                                                                                            ?>
                                                                                                                        </td>
                                                                                                                        <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:16px;line-height:24px;font-weight:normal;font-style: normal;color:#010101;padding-left:15px;">
                                                                                                                            <table width="100%" style="width:100%;max-width:100%">
                                                                                                                                <tr>
                                                                                                                                    <td>
                                                                                                                                        <h5 style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:16px;line-height:24px;font-weight:500;font-style:normal; color:#010101;text-transform: uppercase;margin:0 0 4px">
                                                                                                                                            <?php
                                                                                                                                            // Product name.
                                                                                                                                            echo wp_kses_post(apply_filters('woocommerce_order_item_name', $item->get_name(), $item, false));

                                                                                                                                            // SKU.
                                                                                                                                            if ($show_sku && $sku) {
                                                                                                                                                echo wp_kses_post(' (#' . $sku . ')');
                                                                                                                                            }

                                                                                                                                            ?> </h5>
                                                                                                                                        <div style="font-size:11px;line-height:15px;text-transform:uppercase;"><?php do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text);

                                                                                                                                                                                                                wc_display_item_meta(
                                                                                                                                                                                                                    $item,
                                                                                                                                                                                                                    array(
                                                                                                                                                                                                                        'label_before' => '<strong class="wc-item-meta-label" style="float: ' . esc_attr($text_align) . '; margin-' . esc_attr($margin_side) . ': .25em; clear: both">',
                                                                                                                                                                                                                    )
                                                                                                                                                                                                                );

                                                                                                                                                                                                                // allow other plugins to add additional product information here.
                                                                                                                                                                                                                do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text);

                                                                                                                                                                                                                ?></div>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </table>
                                                                                                                            <table width="100%" style="width:100%;max-width:100%">
                                                                                                                                <tr>
                                                                                                                                    <td colspan="2" height="15" style="height:15px"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:13px;line-height:18px;font-weight:normal">
                                                                                                                                        <?php
                                                                                                                                        $qty          = $item->get_quantity();
                                                                                                                                        $refunded_qty = $order->get_qty_refunded_for_item($item_id);

                                                                                                                                        if ($refunded_qty) {
                                                                                                                                            $qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
                                                                                                                                        } else {
                                                                                                                                            $qty_display = esc_html($qty);
                                                                                                                                        }
                                                                                                                                        echo wp_kses_post(apply_filters('woocommerce_email_order_item_quantity', $qty_display, $item));
                                                                                                                                        ?> </td>
                                                                                                                                    <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:13px;line-height:18px;font-weight:normal;text-align:right;">
                                                                                                                                        <?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </table>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td height="15" style="height:15px"></td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td height="15" style="height:15px"></td>
                                                                                            </tr>
                                                                                        <?php endforeach; ?>


                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">
                                                                                        <td>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width:100%;max-width:100%">


                                                                                                        <?php
                                                                                                        $item_totals = $order->get_order_item_totals();

                                                                                                        if ($item_totals) {
                                                                                                            $i = 0;
                                                                                                            foreach ($item_totals as $total) {
                                                                                                                $i++;
                                                                                                        ?>
                                                                                                                <tr>
                                                                                                                    <th class="td" scope="row" colspan="2" style="border: 0;text-align:<?php echo esc_attr($text_align); ?>; <?php echo (1 === $i) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post($total['label']); ?></th>
                                                                                                                    <td class="td" style="border: 0;text-align:<?php echo esc_attr($text_align); ?>; <?php echo (1 === $i) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post($total['value']); ?></td>
                                                                                                                </tr>
                                                                                                            <?php
                                                                                                            }
                                                                                                        }
                                                                                                        if ($order->get_customer_note()) {
                                                                                                            ?>
                                                                                                            <tr>
                                                                                                                <th style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:15px; line-height:20px;font-weight:500;font-style:normal;color:#010101;text-transform: uppercase; text-align: left;border:0;"><?php esc_html_e('Note:', 'woocommerce'); ?></th>
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size:15px; line-height:20px;font-weight:normal;font-style:normal;color:#010101;text-align:right;border:0;"><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></td>
                                                                                                            </tr>
                                                                                                        <?php
                                                                                                        }
                                                                                                        ?>

                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </td>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="30" style="height:30px"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="1" style="height:1px;border-top: 1px solid #dddddd"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10" style="height:10px"></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                        For any other queries, pls contact us at <a href="mailto:admin@rawbought.com">admin@rawbought.com</a> or WhatsApp at +65 8725 6066.
                                                                                    </p>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- TR FOR TABLE INNER SPACEING -->
                                                                            <tr>
                                                                                <td height="20" style="height:20px"></td>
                                                                            </tr>
                                                                        </table>

                                                                    </td>
                                                                    <td width="20" style="width:20px"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30" style="height:30"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; max-width: 100%;">
                                                                <tr>
                                                                    <td>
                                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                                                                        <tr>
                                                                                            <td valign="middle">
                                                                                                <table cellpadding="0" cellspacing="0" border="0" align="center">
                                                                                                    <tr>
                                                                                                        <td width="32" style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;max-width: 22px;">
                                                                                                            <a href="https://www.facebook.com/rawboughtshop" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-f-brands.png" alt="facebook" width="22" style="max-width:22px;"></a>
                                                                                                        </td>
                                                                                                        <td width="15" style="width:15px;"></td>
                                                                                                        <td width="32" style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;max-width: 22px;">
                                                                                                            <a href="https://www.instagram.com/rawboughtshop/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-brands.png" alt="instagram" width="22" style="max-width:22px;"></a>
                                                                                                        </td>
                                                                                                        <td width="15" style="width:15px;"></td>

                                                                                                    </tr>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                            <td height="20px" style="height: 20px;"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 13px; line-height: 18px; font-weight: normal; font-style: normal; color:#010101; text-align: center;">
                                                                                                <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 13px; line-height: 18px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                    &copy; 2020 Rawbought. All Rights Reserved <br>
                                                                                                    <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>" style="color:#010101">Privacy Policy&nbsp;</a><span>/</span>
                                                                                                    <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" style="color:#010101">Contact us&nbsp;</a><span>/</span>
                                                                                                    <a href="<?php echo get_permalink(get_page_by_path('email-preferance')); ?>" style="color:#010101">Email Preferences&nbsp;</a>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30px" style="height: 30px"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>

                                    <!--[if mso]>
                                                  </td>
                                                </tr>
                                              </table>
                                            </center>
                                            <![endif]-->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php
do_action('woocommerce_email_footer', $email);