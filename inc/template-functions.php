<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rawbought
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
// if (!is_user_logged_in()) {
//     add_action('init', 'ajax_login_init');
// } else {
//     add_action('init', 'ajax_logout_init');
// }

// function ajax_login_init()
// {


// }
// function ajax_logout_init()
// {


//     add_action('wp_ajax_ajax_logout', 'ajax_logout');
//     add_action('wp_ajax_nopriv_ajax_logout', 'ajax_logout');


// }
// add_action('wp_ajax_ajax_login', 'ajax_login');
//     add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
$args = array(
    'public'    => true,
    'label'     => __('Email Subscription', 'rawbought'),
    'menu_icon' => 'email-subscription',
);
register_post_type('email_subscribe', $args);

add_action('wp_ajax_email_subscription', 'email_subscription');
add_action('wp_ajax_nopriv_email_subscription', 'email_subscription');
function add_cors_http_header()
{
    header("Access-Control-Allow-Origin: *");
}
add_action('init', 'add_cors_http_header');
function email_subscription($email)
{
    $email_address = $email;
    if (!empty($email_address)) {


        if (!post_exists($email_address, '', '', 'email_subscribe')) {
            $id = wp_insert_post(array('post_title' => $email_address, 'post_type' => 'email_subscribe'));
        }
        $return['status'] = '1';
        $return['message'] = 'Thank you, you are on the list!';
    } else {
        $return['status'] = '0';
        $return['message'] = 'Please enter a email';
    }


    json_encode($return);
}



add_action('wp_ajax_ajax_register', 'ajax_register');
add_action('wp_ajax_nopriv_ajax_register', 'ajax_register');

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
// add_filter( 'woocommerce_cart_needs_shipping', 'filter_cart_needs_shipping' );
// function filter_cart_needs_shipping( $needs_shipping ) {
//     if ( is_cart() ) {
//         $needs_shipping = false;
//     }
//     return $needs_shipping;
// }
add_filter('woocommerce_default_address_fields', 'bbloomer_reorder_checkout_fields');

function bbloomer_reorder_checkout_fields($fields)
{

    // default priorities: 
    // 'first_name' - 10
    // 'last_name' - 20
    // 'company' - 30
    // 'country' - 40
    // 'address_1' - 50
    // 'address_2' - 60
    // 'city' - 70
    // 'state' - 80
    // 'postcode' - 90

    // e.g. move 'company' above 'first_name':
    // just assign priority less than 10
    $fields['company']['priority'] = 5;

    return $fields;
}

add_filter('woocommerce_billing_fields', 'bbloomer_move_checkout_email_field', 10, 1);

function bbloomer_move_checkout_email_field($address_fields)
{
    $address_fields['billing_country']['priority'] = 5;
    return $address_fields;
}

add_filter('woocommerce_shipping_fields', 'rawbought_shipping_move_checkout_email_field', 10, 1);

function rawbought_shipping_move_checkout_email_field($address_fields)
{
    $address_fields['shipping_country']['priority'] = 5;
    return $address_fields;
}
add_action('wp_ajax_ajax_login_checkout', 'ajax_login_checkout');
add_action('wp_ajax_nopriv_ajax_login_checkout', 'ajax_login_checkout');
add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');
function update_cart_quantity()
{

    global $woocommerce;

   $cartItem= $_REQUEST['cart_item_key'];
   $quantity= $_REQUEST['quantity'];
   WC()->cart->set_quantity( $cartItem, (float) $quantity);

    ob_start();
?>
        <?php woocommerce_mini_cart(); ?>
<?php
   echo  ob_get_clean();

die();
}

add_action('wp_ajax_get_minicart_total', 'get_minicart_total');
add_action('wp_ajax_nopriv_get_minicart_total', 'get_minicart_total');
function get_minicart_total()
{

  
   echo  WC()->cart->get_cart_contents_count();

die();
}



function ajax_login_checkout()
{
    // check_ajax_referer('ajax-login-nonce', 'security');

    // echo $_POST['username'];
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    // $info['remember'] = $_POST['remember'];

    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        wp_send_json(array('status' => 0, 'message' => $user_signon->get_error_message()));
    } else {
        wp_send_json(array('status' => 1, 'message' => __('you currectly logined')));;
    }
}
function ajax_register()
{
    check_ajax_referer('ajax-register-nonce', 'security');
    // Post values
    $username = sanitize_text_field($_POST['register_username']);
    $password = sanitize_text_field($_POST['register_password']);
    $email = sanitize_text_field($_POST['register_email']);
    $fname = sanitize_text_field($_POST['register_first_name']);
    $lname = sanitize_text_field($_POST['register_last_name']);
    $name = $fname . ' ' . $lname;
    $nick = $name;

    $userdata = array(
        'user_login' => $email,
        'user_pass' => $password,
        'user_password' => $password,
        'user_email' => $email,
        'first_name' => $fname,
        'last_name' => $lname,
        'display_name' => $name,
        'nickname' => $nick,
        'role' => 'customer'
    );
if(!email_exists($email)){
    $user_id = wp_insert_user($userdata);

    $emailBody = '<!doctype html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" name="viewport">
        <title>Rawbought &#8211; </title>
            <style type="text/css">
            .ReadMsgBody {
                width: 100%;
                background-color: #ffffff;
            }
            
            .ExternalClass {
                width: 100%;
                background-color: #ffffff;
            }
            
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            
            html {
                width: 100%;
            }
            
            body {
                -webkit-text-size-adjust: none;
                -ms-text-size-adjust: none;
                margin: 0;
                padding: 0;
            }
            p {
                margin-top: 0;
                margin-bottom: 0;
            }
            img {
                width: 100%;
                height: auto;
                display: block !important;
            }
            
            a, a[href] {
                color: #010101;
                text-decoration: none;
            }
            .ii a[href] {
                color: #010101;
            }
            a:hover, a:focus, a[href]:hover, a[href]:focus {
                color: #010101;
            }
            .btn_primary {
                font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;
                font-size:14px;
                line-height:20px;font-weight:600; font-style: normal; 
                color:#010101;
                background:#ededed;
                border:0;
                padding:12px 15px;
                display:inline-block;
                text-transform:uppercase;
                text-align:center;
                min-width: 180px;
            }
            
            hr {
                margin-top: 20px;
                margin-bottom: 20px;
                border: 0;
                border-top: 1px solid #eee;
            }
            @media (max-width: 575.98px) {
                .email-heading {
                    font-size: 30px !important;
                    line-height: 34px !important;
                }
                .align-center {
                    text-align: center !important;
                    margin-left: auto !important;
                    margin-right: auto !important;
                }
                .align-center img {
                    margin-left: auto !important;
                    margin-right: auto !important;
                }
                .align-center td {
                    padding-bottom: 15px;
                }
                .padding-0 {
                    padding: 0 !important;
                }
                .w-100 {
                    width: 100% !important;
                    max-width: 100% !important;
                }
                .text-center {
                    text-align: center !important;
                }
            }
        </style>
    </head>
    
    <body style="background:#ffffff" style="margin:0; padding:0; -webkit-text-size-adjust: 100%; background-color: #ffffff;">
        <div class="webkit">
           <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#ffffff">
    <tr>
        <td valign="top" bgcolor="#ffffff" width="100%">
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
                                                                <tr><td height="30" style="height: 30px"></td></tr>
                                                                <tr>
                                                                    <td>
                                                                       <table width="100%" cellpadding="0" cellspacing="0" border="0" style="min-width: 100%; max-width: 100%;">
                                                                            <tr>
                                                                                <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 14px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;">
                                                                                    <a href="" target="_blank">
                                                                                        <img src="http://webmamu.com/static/email/assets/img/logo-dark.png" alt="Rawbought" style="width: 260px; display: block; margin-left: auto;margin-right:auto;">
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
                                                                    <td>
                                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" background="http://webmamu.com/static/email/assets/img/bg_account_activation.jpg" style="width:100%;max-width:100%;background: url("http://webmamu.com/static/email/assets/img/bg_account_activation.jpg");background-repeat:no-repeat;background-size:cover;background-position:center;">
                                                                            <tr>
                                                                                <td>
                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%;">
                                                                                        <tr><td height="70" colspan="3" style="height:70px"></td></tr>
                                                                                        <tr>
                                                                                            <td width="10%" style="width:10%"></td>
                                                                                            <td align="center">
                                                                                                <table cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%;background:rgba(237,237,237,.6);">
                                                                                                    <tr><td height="35" style="height:35px"></td></tr>
                                                                                                    <tr>
                                                                                                        <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;text-align:center;">
                                                                                                            <h1 class="email-heading" style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:24px;line-height:30px; font-weight:700;font-style: normal; color:#010101;margin:0;">
                                                                                                                YOU&apos;RE IN THE LIST!
                                                                                                            </h1> 
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr><td height="35" style="height:35px"></td></tr>
                                                                                                </table> 
                                                                                            </td>
                                                                                            <td width="10%" style="width:10%"></td>
                                                                                        </tr>
                                                                                        <tr><td height="70" colspan="3" style="height:70px"></td></tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table  width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%;">
                                                                            <tr>
                                                                                <td width="10" style="width:10px"></td>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">
                                                                                        <tr><td height="20" style="height:20px"></td></tr>
                                                                                        <tr>
                                                                                            <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101">
                                                                                                <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101">
                                                                                                    <strong>Hi ' . $fname . ' ' . $lname . ',</strong>
                                                                                                </p> 
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101">
                                                                                                <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101">
                                                                                                    Thank you for signing up with us, you are only one tiny step away from slipping into your most comfortable Rawbought PJs.
                                                                                                </p> 
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr><td height="20" style="height: 20px;"></td></tr>
                                                                                        <tr>
                                                                                            <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;text-align:center;">
                                                                                                <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;text-align:center;">
                                                                                                    <a class="btn_primary" href="' . get_permalink(get_page_by_path("shop-all")) . '" target="_blank" style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size:14px;line-height:20px;font-weight:600; font-style: normal;color:#ededed;background:#010101;border:0;padding-top:12px;padding-right:15px;padding-bottom:12px;padding-left:15px;display:inline-block;margin-left:auto;margin-right:auto;text-transform:uppercase;text-align:center;width:180px;">
                                                                                                        Shop Now
                                                                                                    </a>
                                                                                                </p> 
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr><td height="20" style="height: 20px;"></td></tr>
                                                                                        
                                                                                        <tr>
                                                                                            <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal;color:#010101">
                                                                                                <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal;color:#010101">
                                                                                                    For any other queries, pls contact us at <a href="mailto:admin@rawbought.com" style="color:#010101;text-decoration:underline;">admin@rawbought.com</a> or WhatsApp at +65 8725 6066.
                                                                                                </p> 
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td width="10" style="width:10px"></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>      
                                                                <tr><td height="30" style="height:30"></td></tr>
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
                                                                                                        <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;text-align:center;">
                                                                                                            <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 12px; line-height: 16px; font-weight: normal; font-style: normal; color:#777777;text-align:center;">
                                                                                                                Follow us on:
                                                                                                            </p> 
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr><td height="5" style="height:5px"></td></tr>
                                                                                                    <tr>
                                                                                                        <td valign="middle">
                                                                                                            <table cellpadding="0" cellspacing="0" border="0" align="center">
                                                                                                                <tr>
                                                                                                                    <td width="32" style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;max-width: 22px;">
                                                                                                                        <a href="https://www.facebook.com/rawboughtshop" target="_blank"><img src="http://webmamu.com/static/email/assets/img/facebook-f-brands.png" alt="facebook" width="22" style="max-width:22px;"></a>
                                                                                                                    </td>
                                                                                                                    <td width="15" style="width:15px;"></td>
                                                                                                                    <td width="32" style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;max-width: 22px;">
                                                                                                                        <a href="https://www.instagram.com/rawboughtshop/" target="_blank"><img src="http://webmamu.com/static/email/assets/img/instagram-brands.png" alt="instagram" width="22" style="max-width:22px;"></a>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr><td height="20px" style="height: 20px;"></td></tr>
                                                                                                    <tr>
                                                                                                        <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 13px; line-height: 18px; font-weight: normal; font-style: normal; color:#010101; text-align: center;">
                                                                                                            <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 13px; line-height: 18px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                                &copy; 2020 Rawbought. All Rights Reserved <br>
                                                                                                                <a href="'.get_permalink(get_page_by_path('privacy-policy')).'" style="color:#010101">Privacy Policy&nbsp;</a><span>/</span>
                                                                                                                <a href="'.get_permalink(get_page_by_path('contact')).'" style="color:#010101">Contact us&nbsp;</a><span>/</span>
                                                                                                                <a href="'.get_permalink(get_page_by_path('email-preferences')).'" style="color:#010101">Email Preferences&nbsp;</a>
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
                                                                <tr><td height="30px" style="height: 30px"></td></tr>
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
</table></div>
</body>

</html>
';
    //$emailBody .= file_get_contents(get_template_directory() . '/inc/account-email-footer.php');

    $to = $email;
    $subject = 'Thank you for signing up with us!';
    $body = $emailBody;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
 // Return
 if (!is_wp_error($user_id)) {
    $user_signon = wp_signon($userdata, false);
    if (!is_wp_error($user_signon)) {
        wp_send_json(array('status' => 1, 'message' => __('your registration is successfuled and logined.'), 'email' => $emailBody));
    } else {
        wp_send_json(array('status' => 0, 'message' => __('your registration is faild')));
    }
} else {
    wp_send_json(array('status' => 0, 'message' => __($user_id->get_error_message())));
}
}else{
    wp_send_json(array('status' => 0, 'message' => __('your registration is faild')));

}
    
   
}

function ajax_logout()
{
    check_ajax_referer('ajax-logout-nonce', 'ajaxsecurity');

    wp_logout();
    ob_clean(); // probably overkill for this, but good habit
    echo 'adios!!';
    wp_die();
}

add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
    wp_redirect(home_url());
    exit();
}
function rawbought_remove_cart_notice_on_checkout()
{
    if (function_exists('wc_cart_notices')) {
        remove_action('woocommerce_before_checkout_form', array(wc_cart_notices(), 'add_cart_notice'));
    }
}
add_action('init', 'rawbought_remove_cart_notice_on_checkout');




add_filter('wc_add_to_cart_message_html', 'remove_add_to_cart_message');

if (class_exists('woocommerce')) {

    function wp_wc_my_account_shortcode_handler($atts)
    {

        $whichClass = new WC_Shortcodes();
        $wrapper = array(
            'class'  => '',
            'before' => '<div class="row">',
            'after'  => '</div>'
        );

        return $whichClass->shortcode_wrapper(array('WC_Shortcode_My_Account', 'output'), $atts, $wrapper);
    }

    add_shortcode('new_woocommerce_my_account', 'wp_wc_my_account_shortcode_handler');
}


function my_account_menu_order()
{
    $menuOrder = array(
        //'edit-account'        => __('Account Details', 'woocommerce'),
        'dashboard'          => __('Profile', 'woocommerce'),
        'orders'             => __('Orders', 'woocommerce'),
        //'edit-address'       => __('Addresses', 'woocommerce'),

        'customer-logout'    => __('Logout', 'woocommerce'),
    );
    return $menuOrder;
}
add_filter('woocommerce_account_menu_items', 'my_account_menu_order');

add_filter('woocommerce_account_menu_items', 'misha_remove_my_account_links');
function misha_remove_my_account_links($menu_links)
{

    //unset( $menu_links['edit-address'] ); // Addresses


    unset($menu_links['edit-address']); // Remove Dashboard
    unset($menu_links['payment-methods']); // Remove Payment Methods
    //unset( $menu_links['orders'] ); // Remove Orders
    unset($menu_links['downloads']); // Disable Downloads
    //unset( $menu_links['edit-account'] ); // Remove Account details tab
    //unset( $menu_links['customer-logout'] ); // Remove Logout link

    return $menu_links;
}
add_filter('woocommerce_save_account_details_required_fields', 'wc_save_account_details_required_fields');
function wc_save_account_details_required_fields($required_fields)
{
    unset($required_fields['account_display_name']);
    return $required_fields;
}
add_filter('woocommerce_checkout_fields', 'remove_company_name');
// Display the mobile phone field
// add_action( 'woocommerce_edit_account_form_start', 'add_billing_mobile_phone_to_edit_account_form' ); // At start


// Check and validate the mobile phone
add_action('woocommerce_save_account_details_errors', 'billing_mobile_phone_field_validation', 20, 1);
function billing_mobile_phone_field_validation($args)
{
    if (isset($_POST['billing_mobile_phone']) && empty($_POST['billing_mobile_phone']))
        $args->add('error', __('Please fill in your Mobile phone', 'woocommerce'), '');
}

// Save the mobile phone value to user data
add_action('woocommerce_save_account_details', 'my_account_saving_billing_mobile_phone', 20, 1);
function my_account_saving_billing_mobile_phone($user_id)
{
    if (isset($_POST['billing_mobile_phone']) && !empty($_POST['billing_mobile_phone']))
        update_user_meta($user_id, 'billing_mobile_phone', sanitize_text_field($_POST['billing_mobile_phone']));
}

function remove_company_name($fields)
{
    unset($fields['billing']['billing_company']);
    return $fields;
}

add_filter('woocommerce_billing_fields', 'misha_remove_billing_fields');

function misha_remove_billing_fields($fields)
{

    unset($fields['billing_company']); // or shipping_address_2 for woocommerce_shipping_fields hook
    return $fields;
}
add_filter('woocommerce_shipping_fields', 'misha_remove_shipping_fields');

function misha_remove_shipping_fields($fields)
{

    unset($fields['shipping_company']); // or shipping_address_2 for woocommerce_shipping_fields hook
    return $fields;
}

function get_order_first_image($order)
{


    $images = array();
    $order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
    foreach ($order_items as $item_id => $item) {

        $product = $item->get_product();

        $post_thumbnail_id = get_post_thumbnail_id($product->get_id());

        if (!empty($post_thumbnail_id)) {
            $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'medium'); //get thumbnail image url			
            $image_src = $post_thumbnail_src[0];
        } else {
            $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
        }

        $images[] = $image_src;
    }


    return $images;
}

function remove_add_to_cart_message()
{
    return;
}


function checkProductCart($product_id)
{
    foreach (WC()->cart->get_cart() as $item) {
        if ($product_id === $item['product_id']) {
            return true;
        }
    }
    return false;
}

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);




add_action('wp_ajax_get_minicart', 'get_minicart');
add_action('wp_ajax_nopriv_get_minicart', 'get_minicart');
function get_minicart()
{

    woocommerce_mini_cart();
    
    die();
}

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    
?>

    <span class="minicart-total-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>

<?php
    $fragments['span.minicart-total-count'] = ob_get_clean();
    return $fragments;
}

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment_minicart');

function woocommerce_header_add_to_cart_fragment_minicart($fragments)
{
    global $woocommerce;
    ob_start();
?>
    <span class="minicart-container-main">
        <?php woocommerce_mini_cart(); ?>
    </span>
<?php
    $fragments['span.minicart-container-main'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_update_order_review_fragments', 'my_custom_shipping_table_update');

function my_custom_shipping_table_update($fragments)
{


    ob_start();
?>
    <table class="checkout-review-order-total-rawbought table table-cart-total mb-0">

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
                <td><?php wc_cart_totals_coupon_html($coupon); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_review_order_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_review_order_after_shipping'); ?>

        <?php endif; ?>

        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <tr class="fee">
                <th><?php echo esc_html($fee->name); ?></th>
                <td><?php wc_cart_totals_fee_html($fee); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
            <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
                ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                        <th><?php echo esc_html($tax->label); ?></th>
                        <td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="tax-total">
                    <th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
                    <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action('woocommerce_review_order_before_order_total'); ?>

        <tr class="order-total">
            <th><?php esc_html_e('Total', 'woocommerce'); ?></th>
            <td><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action('woocommerce_review_order_after_order_total'); ?>


    </table>
<?php
    $woocommerce_shipping_methods = ob_get_clean();

    $fragments['.checkout-review-order-total-rawbought'] = $woocommerce_shipping_methods;


    return $fragments;
}





function get_product_quickview_modal_content()
{

    $product_id = $_POST['product_id'];

    // echo "Hello";
    // 	echo $product_id;
    // 	die;
    $product = wc_get_product($product_id);

    $images = $product->get_gallery_image_ids();

    $post_thumbnail_id = get_post_thumbnail_id($product_id);

    $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
    $image_src = $post_thumbnail_src[0];

    $product_id = $product_id;
    $product = wc_get_product($product_id);
    $upsellIds = $product->get_upsell_ids();
    $product->get_image_id();
    $product->get_image();
    $images = $product->get_gallery_image_ids();
    $product_attributes = $product->get_attributes();






    
?>


    <div class="row no-gutters">
        <div class="col-md-5">
            <div class="product-single-images">
                <div class="product-main-slider-styled image-preview-main product-quickview-imageslider">
                    <?php $post_thumbnail_id = get_post_thumbnail_id($product_id);

                    $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                    $image_src = $post_thumbnail_src[0];
                    ?>

                    <div class="slide-item">
                        <img src="<?php echo $image_src; ?>" alt="">
                    </div>

                    <?php
                    if (count($images) > 0) {
                        foreach ($images as $image) {

                            if (!empty($image)) {
                                $post_thumbnail_src = wp_get_attachment_image_src($image, 'full'); //get thumbnail image url			
                                $image_src = $post_thumbnail_src[0];
                            } else {
                                $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                            }


                    ?>

                            <div class="slide-item">
                                <img src="<?php echo $image_src; ?>" alt="">
                            </div>

                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="quickview-product-information">
                <div class="product-single-information">


                    <h1 class="product-single-information-title h3"><?php echo $product->get_name(); ?> </h1>
                    <div class="product-single-information-price product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    <div class="product-variants product-information-variants">


                    <?php
                                            $variations = $product->get_available_variations();
                                            $imagesVars = [];
                                            if (count($variations) > 0) {
                                                foreach ($variations as $variation) {
                                                    $variationKey = $variation['attributes']['attribute_pa_colour'];
                                                    $imageVar = array();
                                                    if (count($variation['image']) > 0) {
                                                        $imageVar[] = $variation['image']['url'];
                                                    }
                                                    if ($variation['variation_gallery_images'] && count($variation['variation_gallery_images']) > 0) {

                                                        foreach ($variation['variation_gallery_images'] as $varimgGal) {
                                                            $imageVar[] = $varimgGal['url'];
                                                        }
                                                    }

                                                    $imagesVar[$variationKey] = $imageVar;
                                                }
                                                $imagesVars = $imagesVar;
                                            }


                                            ?>
                                            <span class="variation-color-image-data " json-image="<?php echo htmlspecialchars(wp_json_encode($imagesVars)) ?>">
                                            </span>
                        




                        
<?php echo do_shortcode( '[add_to_cart_form id='.$product_id.']' );?>
                        
                        

                        <div class="pro-more">
                            <a href="<?php echo get_permalink($product->get_id()); ?>" class="more-linked">See More <i class="ion ion-ios-arrow-forward"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php

die;

}
add_action('wp_ajax_get_product_quickview_modal_content', 'get_product_quickview_modal_content');
add_action('wp_ajax_nopriv_get_product_quickview_modal_content', 'get_product_quickview_modal_content');
add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields');
/**
 * @param $fields
 * @return mixed
 */
function addBootstrapToCheckoutFields($fields)
{
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group';

            // add form-control to the actual input
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}
/*
 * Custom form field function for Bootstrap 3
 */

function update_item_from_cart()
{
    $cart_item_key = $_POST['cart_item_key'];
    $quantity = $_POST['qty'];

    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item_key == $_POST['cart_item_key']) {
            WC()->cart->set_quantity($cart_item_key, $quantity, $refresh_totals = true);
        }
    }
    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    return true;
}

add_action('wp_ajax_update_item_from_cart', 'update_item_from_cart');
add_action('wp_ajax_nopriv_update_item_from_cart', 'update_item_from_cart');


add_filter( 'woocommerce_default_address_fields', 'customising_checkout_fields', 1000, 1 );
function customising_checkout_fields( $address_fields ) {
  
    $address_fields['city']['required'] = true;


    return $address_fields;
}


add_filter('woocommerce_default_address_fields', 'override_default_address_fields');
function override_default_address_fields($address_fields)
{

    // @ for city
    $address_fields['country']['label'] = __('Country', 'woocommerce');
    $address_fields['address_1']['label'] = __('Address 1', 'woocommerce');
    $address_fields['address_2']['label'] = __('Address 2', 'woocommerce');
    $address_fields['city']['label'] = __('City / Town', 'woocommerce');
    $address_fields['postcode']['required'] = true;
    $address_fields['city']['required'] = true;

    $address_fields['state']['required'] = false;

    // @ for postcode

    return $address_fields;
}
add_filter( 'woocommerce_checkout_fields', 'bbloomer_shipping_phone_checkout' );
 
function bbloomer_shipping_phone_checkout( $fields ) {
   $fields['shipping']['shipping_phone'] = array(
      'label' => 'Phone',
      'required' => true,
      'class' => array( 'form-row-wide' ),
      'priority' => 90,
   );
   $fields['billing']['billing_phone'] = array(
    'label' => 'Phone',
    'required' => true,
    'class' => array( 'form-row-wide' ),
    'priority' => 90,
 );
   return $fields;
}
  
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'bbloomer_shipping_phone_checkout_display' );
 
function bbloomer_shipping_phone_checkout_display( $order ){
    echo '<p><b>Shipping Phone:</b> ' . get_post_meta( $order->get_id(), '_shipping_phone', true ) . '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'bbloomer_billing_phone_checkout_display' );
 
function bbloomer_billing_phone_checkout_display( $order ){
    echo '<p><b>Billing Phone:</b> ' . get_post_meta( $order->get_id(), '_billing_phone', true ) . '</p>';
}
function bootstrap_woocommerce_form_field($key, $args, $value = null)
{
    $defaults = array(
        'type'              => 'text',
        'label'             => '',
        'placeholder'       => '',
        'maxlength'         => false,
        'required'          => false,
        'class'             => array(),
        'label_class'       => array(),
        'input_class'       => array(),
        'return'            => false,
        'options'           => array(),
        'custom_attributes' => array(),
        'validate'          => array(),
        'default'           => '',
    );

    $args = wp_parse_args($args, $defaults);

    if ((!empty($args['clear']))) $after = '<div class="clear"></div>';
    else $after = '';

    if ($args['required']) {
        $args['class'][] = 'validate-required';
        $required = ' <abbr class="required" title="' . esc_attr__('required', 'woocommerce') . '">*</abbr>';
    } else {
        $required = '';
    }

    $args['maxlength'] = ($args['maxlength']) ? 'maxlength="' . absint($args['maxlength']) . '"' : '';

    if (is_string($args['label_class']))
        $args['label_class'] = array($args['label_class']);

    if (is_null($value))
        $value = $args['default'];

    // Custom attribute handling
    $custom_attributes = array();

    if (!empty($args['custom_attributes']) && is_array($args['custom_attributes']))
        foreach ($args['custom_attributes'] as $attribute => $attribute_value)
            $custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';

    if (!empty($args['validate']))
        foreach ($args['validate'] as $validate)
            $args['class'][] = 'validate-' . $validate;

    switch ($args['type']) {
        case "country":

            $countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

            if (sizeof($countries) == 1) {

                $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

                if ($args['label'])
                    $field .= '<label class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label']  . '</label>';

                $field .= '<strong>' . current(array_values($countries)) . '</strong>';

                $field .= '<input type="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" value="' . current(array_keys($countries)) . '" ' . implode(' ', $custom_attributes) . ' class="country_to_state" />';

                $field .= '</div></div>' . $after;
            } else {

                $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">'
                    . '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required  . '</label>'
                    . '<select name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" class="country_to_state  custom-select country_select" ' . implode(' ', $custom_attributes) . '>'
                    . '<option value="">' . __('Select a country&hellip;', 'woocommerce') . '</option>';

                foreach ($countries as $ckey => $cvalue)
                    $field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . __($cvalue, 'woocommerce') . '</option>';

                $field .= '</select>';

                $field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __('Update country', 'woocommerce') . '" /></noscript>';

                $field .= '</div></div>' . $after;
            }

            break;
        case "state":

            /* Get Country */
            $country_key = $key == 'billing_state' ? 'billing_country' : 'shipping_country';

            if (isset($_POST[$country_key])) {
                $current_cc = wc_clean($_POST[$country_key]);
            } elseif (is_user_logged_in()) {
                $current_cc = get_user_meta(get_current_user_id(), $country_key, true);
                if (!$current_cc) {
                    $current_cc = apply_filters('default_checkout_country', (WC()->customer->get_billing_country()) ? WC()->customer->get_billing_country() : WC()->countries->get_base_country());
                }
            } elseif ($country_key == 'billing_country') {
                $current_cc = apply_filters('default_checkout_country', (WC()->customer->get_billing_country()) ? WC()->customer->get_billing_country() : WC()->countries->get_base_country());
            } else {
                $current_cc = apply_filters('default_checkout_country', (WC()->customer->get_shipping_country()) ? WC()->customer->get_shipping_country() : WC()->countries->get_base_country());
            }

            $states = WC()->countries->get_states($current_cc);

            if (is_array($states) && empty($states)) {

                $field  = '<div class="form-row  ' . esc_attr($key) . '"> <div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field" style="display: none">';

                if ($args['label'])
                    $field .= '<label for="' . esc_attr($key) . '" class="' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';
                $field .= '<input type="hidden" class="hidden" name="' . esc_attr($key)  . '" id="' . esc_attr($key) . '" value="" ' . implode(' ', $custom_attributes) . '  />';
                $field .= '</div> </div>' . $after;
            } elseif (is_array($states)) {

                $field  = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

                if ($args['label'])
                    $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';
                $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" class="state_select form-control " ' . implode(' ', $custom_attributes) . ' >
                <option value="">' . __('Select a state&hellip;', 'woocommerce') . '</option>';

                foreach ($states as $ckey => $cvalue)
                    $field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . __($cvalue, 'woocommerce') . '</option>';

                $field .= '</select>';
                $field .= '</div> </div>' . $after;
            } else {

                $field  = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

                if ($args['label'])
                    $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';
                $field .= '<input type="text" class="form-control input-text ' . implode(' ', $args['input_class']) . '" value="' . esc_attr($value) . '"   name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" ' . implode(' ', $custom_attributes) . ' />';
                $field .= '</div> </div>' . $after;
            }

            break;
        case "textarea":

            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

            if ($args['label'])
                $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required  . '</label>';

            $field .= '<textarea name="' . esc_attr($key) . '" class="form-control input-text ' . implode(' ', $args['input_class']) . '" id="' . esc_attr($key) . '" ' . (empty($args['custom_attributes']['rows']) ? ' rows="2"' : '') . (empty($args['custom_attributes']['cols']) ? ' cols="5"' : '') . implode(' ', $custom_attributes) . '>' . esc_textarea($value) . '</textarea>
            </div> </div>' . $after;

            break;
        case "checkbox":

            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="checkbox  ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">
                <label for="' . esc_attr($key) . '" class="static-label checkbox ' . implode(' ', $args['label_class']) . '" ' . implode(' ', $custom_attributes) . '>
                    <input type="' . esc_attr($args['type']) . '" class="input-checkbox" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" value="1" ' . checked($value, 1, false) . ' />'
                . $args['label'] . $required . '</label>
            </div> </div>' . $after;

            break;
        case "password":

            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

            if ($args['label'])
                $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';

            $field .= '<input type="password" class="form-control input-text ' . implode(' ', $args['input_class']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '"  value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />
            </div></div>' . $after;

            break;
        case "text":
            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group  ' . esc_attr(implode(' ', str_replace('form-row-first', '', $args['class']))) . '" id="' . esc_attr($key) . '_field">';


            if ($args['label'])
                $field .= '<label for="' . esc_attr($key) . '" class="static-label' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';

            $field .= '<input type="text" class="form-control input-text ' . implode(' ', $args['input_class']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '"  ' . $args['maxlength'] . ' value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />
            </div></div>' . $after;

            break;
        case "email":

            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

            if ($args['label'])
                $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';

            $field .= '<input type="email" class="form-control input-text ' . implode(' ', $args['input_class']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '"  ' . $args['maxlength'] . ' value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />
                </div></div>' . $after;

            break;
        case "tel":

            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group  ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

            if ($args['label'])
                $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';

            $field .= '<input type="tel" class="form-control input-text ' . implode(' ', $args['input_class']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($key) . '"  ' . $args['maxlength'] . ' value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />
                    </div></div>' . $after;

            break;
        case "select":

            $options = '';

            if (!empty($args['options']))
                foreach ($args['options'] as $option_key => $option_text)
                    $options .= '<option value="' . esc_attr($option_key) . '" ' . selected($value, $option_key, false) . '>' . esc_attr($option_text) . '</option>';

            $field = '<div class="form-item  ' . esc_attr($key) . '"><div class="form-group  ' . esc_attr(implode(' ', $args['class'])) . '" id="' . esc_attr($key) . '_field">';

            if ($args['label'])
                $field .= '<label for="' . esc_attr($key) . '" class="static-label ' . implode(' ', $args['label_class']) . '">' . $args['label'] . $required . '</label>';

            $field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($key) . '" class="select form-control" ' . implode(' ', $custom_attributes) . '>
                    ' . $options . '
                </select>
            </div></div>' . $after;

            break;
        default:

            $field = apply_filters('woocommerce_form_field_' . $args['type'], '', $key, $args, $value);

            break;
    }

    if ($args['return']) return $field;
    else echo $field;
}

if( ! function_exists( 'kia_add_to_cart_form_shortcode' ) ) {
	/**
	 * Display a single product with single-product/add-to-cart/$product_type.php template.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	function kia_add_to_cart_form_shortcode( $atts ) {

		if ( empty( $atts ) ) {
			return '';
		}

		if ( ! isset( $atts['id'] ) && ! isset( $atts['sku'] ) ) {
			return '';
		}

		$atts = shortcode_atts( array(
			'id'				  => '',
			'sku'				  => '',
			'status'			  => 'publish',
			'show_price'		  => 'true',
			'hide_quantity'		  => 'false'
		), $atts, 'product_add_to_cart_form' );

		$query_args = array(
			'posts_per_page'      => 1,
			'post_type'           => 'product',
			'post_status'         => $atts['status'],
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1
		);

		if ( ! empty( $atts['sku'] ) ) {
			$query_args['meta_query'][] = array(
				'key'     => '_sku',
				'value'   => sanitize_text_field( $atts['sku'] ),
				'compare' => '=',
			);

			$query_args['post_type'] = array( 'product', 'product_variation' );
		}

		if ( ! empty( $atts['id'] ) ) {
			$query_args['p'] = absint( $atts['id'] );
		}

		// Hide quantity input if desired.		
		if( $atts['hide_quantity'] == 'true' ) {
			add_filter( 'woocommerce_quantity_input_min', 'kia_add_to_cart_form_return_one' );
			add_filter( 'woocommerce_quantity_input_max', 'kia_add_to_cart_form_return_one' );
		}

		// Change form action to avoid redirect.
		add_filter( 'woocommerce_add_to_cart_form_action', '__return_empty_string' );

		$single_product = new WP_Query( $query_args );

		$preselected_id = '0';

		// Check if sku is a variation.
		if ( ! empty( $atts['sku'] ) && $single_product->have_posts() && 'product_variation' === $single_product->post->post_type ) {

			$variation  = new WC_Product_Variation( $single_product->post->ID );
			$attributes = $variation->get_attributes();

			// Set preselected id to be used by JS to provide context.
			$preselected_id = $single_product->post->ID;

			// Get the parent product object.
			$query_args = array(
				'posts_per_page'      => 1,
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 1,
				'no_found_rows'       => 1,
				'p'                   => $single_product->post->post_parent,
			);

			$single_product = new WP_Query( $query_args );
		?>
			<script type="text/javascript">
				jQuery( document ).ready( function( $ ) {
					var $variations_form = $( '[data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>"]' ).find( 'form.variations_form' );

					<?php foreach ( $attributes as $attr => $value ) { ?>
						$variations_form.find( 'select[name="<?php echo esc_attr( $attr ); ?>"]' ).val( '<?php echo esc_js( $value ); ?>' );
					<?php } ?>
				});
			</script>
		<?php
		}

		// For "is_single" to always make load comments_template() for reviews.
		$single_product->is_single = true;

		ob_start();

		global $wp_query;

		// Backup query object so following loops think this is a product page.
		$previous_wp_query = $wp_query;
		// @codingStandardsIgnoreStart
		$wp_query          = $single_product;
		// @codingStandardsIgnoreEnd

		wp_enqueue_script( 'wc-single-product' );

		while ( $single_product->have_posts() ) {
			$single_product->the_post();

			?>
			<div class="product single-product add_to_cart_form_shortcode" data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">

				<?php 
				if ( wc_string_to_bool( $atts['show_price'] ) ) {
					woocommerce_template_single_price();
				}
				?>

				<?php woocommerce_template_single_add_to_cart() ?>
			</div>
			<?php
		}

		// Restore $previous_wp_query and reset post data.
		// @codingStandardsIgnoreStart
		$wp_query = $previous_wp_query;
		// @codingStandardsIgnoreEnd
		wp_reset_postdata();

		// Remove filters.
		remove_filter( 'woocommerce_add_to_cart_form_action', '__return_empty_string' );
		remove_filter( 'woocommerce_quantity_input_min', 'kia_add_to_cart_form_return_one' );
		remove_filter( 'woocommerce_quantity_input_max', 'kia_add_to_cart_form_return_one' );

		return '<div class="woocommerce">' . ob_get_clean() . '</div>';
	}
}
add_shortcode( 'add_to_cart_form', 'kia_add_to_cart_form_shortcode' );

if( ! function_exists( 'kia_add_to_cart_form_redirect' ) ) {
	/**
	 * Redirect to same page
	 *
	 * @return string
	 */
	function kia_add_to_cart_form_redirect( $url ) {
		return get_permalink();
	}
}



if( ! function_exists( 'kia_add_to_cart_form_return_one' ) ) {
	/**
	 * Return integer
	 *
	 * @return int
	 */
	function kia_add_to_cart_form_return_one() {
		return 1;
	}
}
add_action('wp_ajax_file_upload', 'dg_file_upload_handler');
add_action('wp_ajax_nopriv_file_upload', 'dg_file_upload_handler');

function dg_file_upload_handler()
{
    //Get the file
    $f = 0;
    $_FILES[$f] = $_FILES[0];
    
    $user = new WP_User(get_current_user_id());
    $json['status'] = 'error';
  
    //Check if the file is available && the user is logged in
    if (!empty($_FILES[$f]) && $user->ID > 0) {
      
        $json = array();
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
       
        //Handle the media upload using WordPress helper functions
        $attachment_id = media_handle_upload($f, 0);
        $json['aid']   = $attachment_id;
        
        //If error
        if (is_wp_error($attachment_id)) {
            $json['error'] = "Error.";
        } else {
            //delete current
            $profile_image = get_user_meta($user->ID, 'profile_image', true);
            if ($profile_image) {
                $profile_image = json_decode($profile_image);
                if (isset($profile_image->attachment_id)) {
                    wp_delete_attachment($profile_image->attachment_id, true);
                }
            }
            
            //Generate attachment in the media library
            $attachment_file_path = get_attached_file($attachment_id);
            $data                 = wp_generate_attachment_metadata($attachment_id, $attachment_file_path);
            
            //Get the attachment entry in media library
            $image_full_attributes  = wp_get_attachment_image_src($attachment_id, 'full');
            $image_thumb_attributes = wp_get_attachment_image_src($attachment_id, 'smallthumb');
            
            $arr = array(
                'attachment_id' => $attachment_id,
                'url' => $image_full_attributes[0],
                'thumb' => $image_thumb_attributes[0]
            );
            
            //Save the image in the user metadata
            update_user_meta($user->ID, 'profile_image', json_encode($arr));
            
            $json['src']    = $arr['thumb'];
            $json['status'] = 'ok';
        }
    }
    //Output the json
    die(json_encode($json));
}

// Add Variation Custom fields
//Display Fields in admin on product edit screen
add_action( 'woocommerce_product_after_variable_attributes', 'woo_variable_fields', 10, 3 );
//Save variation fields values
add_action( 'woocommerce_save_product_variation', 'save_variation_fields', 10, 2 );
// Create new fields for variations
function woo_variable_fields( $loop, $variation_data, $variation ) {
  echo '<div class="variation-custom-fields">';
    
    //   // Text Field
    //   woocommerce_wp_text_input( 
    //     array( 
    //       'id'          => '_text_field['. $loop .']', 
    //       'label'       => __( 'Custom Variation Text Field', 'woocommerce' ), 
    //       'placeholder' => 'http://',
    //       //'desc_tip'    => true,
    //       'wrapper_class' => 'form-row form-row-first',
    //       //'description' => __( 'Enter the custom value here.', 'woocommerce' ),
    //       'value'       => get_post_meta($variation->ID, '_text_field', true)
    //     )
    //   );
      
    //   // Number Field
    //   woocommerce_wp_text_input( 
    //     array( 
    //       'id'          => '_number_field['. $loop .']', 
    //       'label'       => __( 'Custom Variation Number Field ', 'woocommerce' ), 
    //       //'desc_tip'    => true,
    //       'wrapper_class' => 'form-row form-row-last',
    //       //'description' => __( 'Enter the custom number here.', 'woocommerce' ),
    //       'type'              => 'number', 
    //       'value'       => get_post_meta($variation->ID, '_number_field', true),
    //       'custom_attributes' => array(
    //               'step'  => '2',
    //               'min' => '0'
    //             ) 
    //     )
    //   );
      // Checkbox
      woocommerce_wp_checkbox( 
      array( 
        'id'            => '_show_shop_all['. $loop .']', 
        'label'         => __('Show Shop ALL', 'woocommerce' ), 
        'desc_tip'    => true,
        'description'   => __( 'Show Shop ALL', 'woocommerce' ),
        //'wrapper_class' => 'form-row form-row-first',
        'value'         => get_post_meta($variation->ID, '_show_shop_all', true)
        )
      );
    //   // Checkbox
    //   woocommerce_wp_radio( 
    //   array( 
    //     'id'            => '_radio['. $loop .']', 
    //     'label'         => __('Custom Variation Radio ', 'woocommerce' ), 
    //     //'desc_tip'    => true,
    //     //'description'   => __( 'Check me!', 'woocommerce' ),
    //     //'wrapper_class' => 'form-row form-row-last',
    //     'value'         => get_post_meta($variation->ID, '_radio', true),
    //     'options' => array(
    //       'one'   => __( 'Radio 1', 'woocommerce' ),
    //       'two'   => __( 'Radio 2', 'woocommerce' ),
    //       'three' => __( 'Radio 3', 'woocommerce' )
    //       )
    //     )
    //   );
    //   // Textarea
    //   woocommerce_wp_textarea_input( 
    //     array( 
    //       'id'          => '_textarea['. $loop .']', 
    //       'label'       => __( 'Custom Variation Textarea ', 'woocommerce' ), 
    //       //'desc_tip'    => true,
    //       // 'wrapper_class' => 'form-row',
    //       'placeholder' => '', 
    //       //'description' => __( 'Enter the custom value here.', 'woocommerce' ),
    //       'value'       => get_post_meta($variation->ID, '_textarea', true)
    //     )
    //   );
    //   // Select
    //   woocommerce_wp_select( 
    //   array( 
    //     'id'          => '_select['. $loop .']', 
    //     'label'       => __( 'Custom Variation Select ', 'woocommerce' ), 
    //     'desc_tip'    => true,
    //     // 'wrapper_class' => 'form-row',
    //     'description' => __( 'Choose a value.', 'woocommerce' ),
    //     'value'       => get_post_meta($variation->ID, '_select', true),
    //     'options' => array(
    //       'one'   => __( 'Select Option 1', 'woocommerce' ),
    //       'two'   => __( 'Select Option 2', 'woocommerce' ),
    //       'three' => __( 'Select Option 3', 'woocommerce' )
    //       )
    //     )
    //   );
      // Hidden field
    //   woocommerce_wp_hidden_input(
    //   array( 
    //     'id'    => '_hidden_field['. $loop .']', 
    //     'value' => 'hidden_value'
    //     )
    //   );
   
  echo "</div>"; 
}
/** Save new fields for variations */
function save_variation_fields( $variation_id, $i) {
    
    // // Text Field
    // $text_field = stripslashes( $_POST['_text_field'][$i] );
    // update_post_meta( $variation_id, '_text_field', esc_attr( $text_field ) );
    
    // // Number Field
    // $number_field = $_POST['_number_field'][$i];
    // update_post_meta( $variation_id, '_number_field', esc_attr( $number_field ) );
    
    // // Textarea
    // $textarea = $_POST['_textarea'][$i];
    // update_post_meta( $variation_id, '_textarea', esc_html( $textarea ) );
    
    // // Select
    // $select = $_POST['_select'][$i];
    // update_post_meta( $variation_id, '_select', esc_attr( $select ) );
    
    // Checkbox
    $checkbox = isset( $_POST['_show_shop_all'][$i] ) ? 'yes' : 'no';
    update_post_meta( $variation_id, '_show_shop_all', $checkbox );
    // // Radio
    // $radio = $_POST['_radio'][$i];
    // update_post_meta( $variation_id, '_radio', esc_attr( $radio ) );
        
    // // Hidden field
    // $hidden = $_POST['_hidden_field'][$i];
    // if( ! empty( $hidden ) ) {
    //   update_post_meta( $variation_id, '_hidden_field', esc_attr( $hidden ) );
    // }
}
add_action(
    'rest_api_init',
    function () {
        register_rest_route(
            'api',
            'update-tracking-status',
            array(
                'methods'  => 'POST',
                'callback' => 'trackingStatusUpdate',
                'permission_callback'=>'__return_true'
            )
        );
    }
);
//rbTrackingUpdateJanio is : 0302f3f6d5372b6863d808105b5a3b1c
//rbTrackingUpdateJanioSecret is : 54ef600e21371612bd024d88e9a11033
define( 'WP_CONSUMER_KEY', 'rb_0302f3f6d5372b6863d808105b5a3b1c' );
define( 'WP_CONSUMER_SECRET', 'rb_54ef600e21371612bd024d88e9a11033' );
//cmJfMDMwMmYzZjZkNTM3MmI2ODYzZDgwODEwNWI1YTNiMWM6cmJfNTRlZjYwMGUyMTM3MTYxMmJkMDI0ZDg4ZTlhMTEwMzM=
function validate_authorization_header() {
    $headers = apache_request_headers();
    if ( isset( $headers['authorization'] ) ) {
        $wc_header = 'Basic ' . base64_encode( WP_CONSUMER_KEY . ':' . WP_CONSUMER_SECRET );
        if ( $headers['authorization'] == $wc_header ) {
            return true;
        }
    }
    return false;
}
function trackingStatusUpdate( WP_REST_Request $request ) {
        $arr_request = json_decode( $request->get_body() );
 

        $updateType=$arr_request->update_type;
        $orderID=$arr_request->data->order_id;
        $trackingNo=$arr_request->data->tracking_no;
        $trackingStatus=$arr_request->data->status;
        $trackingStatusTime=$arr_request->data->updated_on;
        
        $trackingNumber=get_post_meta($orderID,'order_tracking_id',true);
        if ( get_post_type($orderID) == "shop_order" && $trackingNumber== $trackingNo ) {
            
            $order = wc_get_order( $orderID);

        // get the ID of the order
        $order_id = $order->get_id(); //> 35
        update_post_meta( $order_id, 'order_tracking_status',$trackingStatus );
        update_post_meta( $order_id, 'tracking_status_time',$trackingStatusTime );
        $note = __("Tracking Status: ".$trackingStatus);
        $note2 = __("Tracking Date: ".$trackingStatusTime);
        // Add the note
        $order->add_order_note( $note );
        $order->add_order_note( $note2 );
            return [
                'success' => true,
                'message' => 'credentials are correct.',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Invalid credentials.',
            ];
        }
    
}
add_action( 'woocommerce_admin_order_data_after_order_details', 'misha_editable_order_meta_general' );
 
function misha_editable_order_meta_general( $order ){  ?>
 
		<br class="clear" />
		<h4>Tracking Info <a href="#" class="edit_address">Edit</a></h4>
		<?php 
			/*
			 * get all the meta data values we need
			 */ 
			$order_tracking_id = get_post_meta( $order->get_id(), 'order_tracking_id', true );
            $tracking_status = get_post_meta( $order->get_id(), 'order_tracking_status', true );
            $tracking_status_time = get_post_meta( $order->get_id(), 'tracking_status_time', true );

			
		?>
		<div class="address">
			
					<p><strong>Tracking ID:</strong> <?php echo $order_tracking_id ; ?></p>
                    <p><strong>Tracking Status:</strong> <?php echo ucwords(strtolower(str_replace('_',' ',$tracking_status))); ?></p>
                    <p><strong>Tracking Status Updated on:</strong> <?php echo date('F j, Y, g:i a',strtotime($tracking_status_time)); ?></p>

				
		</div>
		<div class="edit_address"><?php
 
			
 woocommerce_wp_text_input( array(
    'id' => 'order_tracking_id',
    'label' => 'Tracking ID:',
    'value' => $order_tracking_id,
    'wrapper_class' => 'form-field-wide'
) );
			woocommerce_wp_text_input( array(
				'id' => 'order_tracking_status',
				'label' => 'Tracking Status:',
				'value' => $tracking_status,
				'wrapper_class' => 'form-field-wide'
			) );
 
			woocommerce_wp_text_input( array(
				'id' => 'tracking_status_time',
				'label' => 'Tracking Updated on:',
				'value' => $tracking_status_time,
				'wrapper_class' => 'form-field-wide'
			) );
 
		?></div>
 
 
<?php }
 
add_action( 'woocommerce_process_shop_order_meta', 'misha_save_general_details' );
 
function misha_save_general_details( $ord_id ){
	update_post_meta( $ord_id, 'order_tracking_id', wc_clean( $_POST[ 'order_tracking_id' ] ) );
	update_post_meta( $ord_id, 'order_tracking_status', wc_clean( $_POST[ 'order_tracking_status' ] ) );
    update_post_meta( $ord_id, 'tracking_status_time', wc_clean( $_POST[ 'tracking_status_time' ] ) );

	// wc_clean() and wc_sanitize_textarea() are WooCommerce sanitization functions
}


add_action( 'woocommerce_payment_complete', 'janio_api_call');
function janio_api_call( $order_id ){

	// Order Setup Via WooCommerce

	$order = new WC_Order( $order_id );

	// Iterate Through Items
$orderItems=array();
	$items = $order->get_items(); 
	foreach ( $items as $item ) {	

		// Store Product ID

        $product_id = $item['product_id'];
        $product = new WC_Product($item['product_id']);

        // Check for "API" Category and Run
        $orderItem["item_desc"]=apply_filters('woocommerce_order_item_name', $item->get_name(), $item,true);
        $orderItem["item_quantity"] =$item->get_quantity();
        $orderItem["item_product_id"]=$item['product_id'];
        $orderItem["item_sku"]=$product->get_sku();
        $orderItem["item_category"]='Fashion Accessories';
        
        $orderItem["item_price_value"]=$order->get_line_subtotal($item);

        $orderItem["item_price_currency"]=$order->get_order_currency();



        $orderItems[]= $orderItem;



    }
    $orderShippingCountry=ucwords(strtolower(WC()->countries->countries[ $order->get_shipping_country() ]));
$serviceList=array
(
    "China" => 197,
    "Hong Kong" => 111,
    "Indonesia" => 1,
    "Malaysia" => 7777,
    "Philippines" => 29,
    "Singapore" => 10,
    "Taiwan" => 105,
    "Thailand" => 17,
    "Vietnam" => 30,
);
$apiPayload=array(
    "shipper_order_id"=> $order_id,
    "service_id"=> $serviceList[$orderShippingCountry],
    "order_length"=> 400,
    "order_width"=> 300,
    "order_height"=> 120,
    "order_weight"=> 12,
    "payment_type"=> "prepaid",
    "consignee_name"=> $order->shipping_first_name. ''.$order->shipping_last_name,
    "consignee_number" => $order->shipping_phone,
    "consignee_country"=>'Singapore',
    "consignee_address"=> $order->get_formatted_shipping_address(),
    "consignee_postal"=> $order->shipping_postcode,
    "consignee_city"=> ucfirst(WC()->countries->countries[ $order->shipping_city]),
    "consignee_email"=> $order->billing_email,
    "pickup_contact_name"=> ot_get_option('pickup_contact_name'),
    "pickup_contact_number"=> ot_get_option('pickup_contact_number'),
    "pickup_country"=> "Singapore",
    "pickup_address"=> ot_get_option('pickup_address'),
    "pickup_postal"=> ot_get_option('pickup_postal'),
    "pickup_state"=> ot_get_option('pickup_state'),
    "pickup_city"=> null,
    "pickup_province"=> null,
    "pickup_date"=> null,
    "pickup_notes"=> null,
    "items"=> $orderItems
);



     // API Callout to URL

     $url = ot_get_option('janio_api_url');

     $body = $apiPayload;
     $response = wp_remote_post( $url, 
         array(
             'headers'   => array('Content-Type' => 'application/json; charset=utf-8'),
             'method'    => 'POST',
             'timeout' => 75,				    
             'body'		=> json_encode($body),
         )
     );

     $vars = json_decode($response['body'],true);

                 // API Response Stored as Post Meta
                 $note = __("Janieo Tracking ID: ".$vars['tracking_no']);

                 // Add the note
                 $order->add_order_note( $note );
       update_post_meta( $order_id, 'order_tracking_id', $vars['tracking_no'] );

   

}
add_filter( 'woocommerce_variation_is_active', 'bbloomer_grey_out_variations_out_of_stock', 10, 2 );
 
function bbloomer_grey_out_variations_out_of_stock( $is_active, $variation ) {
    if ( ! $variation->is_in_stock() ) return false;
    return $is_active;
}
function nl2p($string, $line_breaks = true, $xml = true) {
    $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);
    // It is conceivable that people might still want single line-breaks
    // without breaking into a new paragraph.
    if ($line_breaks == true)
        return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'), trim($string)).'</p>';
    else 
        return '<p>'.preg_replace(
        array("/([\n]{2,})/i", "/([\r\n]{3,})/i","/([^>])\n([^<])/i"),
        array("</p>\n<p>", "</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'),
        trim($string)).'</p>'; 
    }


    add_action("admin_init", "rawbought_meta_add");

function rawbought_meta_add() {
    add_meta_box("return_delivery-meta", "Delivery & Return", "return_delivery", "product", "normal", "high");
}

function return_delivery() {
    global $post;
    $return_delivery = get_post_meta($post->ID,'product_return_delivery',true);
    $content   = $return_delivery ;
$editor_id = 'product_return_delivery';
$settings  = array( 'media_buttons' => false, 'textarea_name' => 'product_return_delivery','tinymce'       => array(
    'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo',
    'toolbar2'      => '',
    'toolbar3'      => '',
) );
 ?>
 
<div class='inside'>
	<h3><?php _e( 'Delivery & Return', 'food_example_plugin' ); ?></h3>
	<p>
		<textarea name="product_return_delivery" ><?php echo $return_delivery; ?></textarea>
	</p>
</div>
<?php
   
}

add_action('save_post', 'save_fields_values_for_job_apply');

function save_fields_values_for_job_apply() {
    global $post;

    update_post_meta($post->ID, "product_return_delivery", $_POST["product_return_delivery"]);
}