<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer username */ ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#e9e8e9">
            <tr>
                <td valign="top" bgcolor="#e9e8e9" width="100%">
                    <table width="100%" role="content-container" class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="100%">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td>
                                           
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
																						<a href="<?php echo home_url();?>" target="_blank">
                                                                                                <img src="<?php echo get_template_directory_uri();?>/assets/images/logo-dark.png" alt="Rawbought" style="width: 260px; display: block; margin-left: auto;margin-right:auto;">
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
                                                                                <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="width:100%; max-width:100%;background:#ffffff">
                                                                                    <tr>
                                                                                        <td width="15" style="width:15px"></td>
                                                                                        <td>
                                                                                            <table cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:100%">
                                                                                                <tr><td height="25" style="height:25px"></td></tr>
                                                                                                <tr>
                                                                                                    <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                        <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                            <strong><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $user_login ) ); ?></strong>
                                                                                                        </p> 
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr><td height="15" style="height: 15px"></td></tr>
                                                                                                <tr>
                                                                                                    <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                        <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                            Per your request, please <a style="color:#777777;text-decoration:underline;" href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'id' => $user_id ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ); ?>" target="_blank" >
																											<?php esc_html_e( 'Click here ', 'woocommerce' ); ?>                                                                                                            </a> to reset and select your new password. 
                                                                                                            If you did not initiate this request, feel free to safely ignore this email.
                                                                                                        </p> 
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr><td height="30px" style="height: 30px;"></td></tr>
                                                                                                <tr>
                                                                                                    <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                        <p style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;">
                                                                                                            For any other queries, pls contact us at <a href="mailto:admin@rawbought.com">admin@rawbought.com</a> or WhatsApp at +65 8725 6066.
                                                                                                        </p> 
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr><td height="25" style="height:25px"></td></tr>
                                                                                            </table>
                                                                                        </td>
                                                                                        <td width="15" style="width:15px"></td>
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
                                                                                                                <td style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101;text-align:center;">
                                                                                                                    <p style="font-family:'Maison Neue','Helvetica Neue',Helvetica,Arial,Verdana,sans-serif;font-size: 12px; line-height: 16px; font-weight: normal; font-style: normal; color:#777777;text-align:center;">
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
                                                                                                                        <a href="https://www.facebook.com/rawboughtshop" target="_blank"><img src="<?php echo get_template_directory_uri();?>/assets/images/facebook-f-brands.png" alt="facebook" width="22" style="max-width:22px;"></a>
                                                                                                                    </td>
                                                                                                                    <td width="15" style="width:15px;"></td>
                                                                                                                    <td width="32" style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 16px; line-height: 24px; font-weight: normal; font-style: normal; color:#010101; text-align: center;max-width: 22px;">
                                                                                                                        <a href="https://www.instagram.com/rawboughtshop/" target="_blank"><img src="<?php echo get_template_directory_uri();?>/assets/images/instagram-brands.png" alt="instagram" width="22" style="max-width:22px;"></a>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr><td height="20px" style="height: 20px;"></td></tr>
                                                                                                    <tr>
                                                                                                        <td style="font-family:Maison Neue,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;font-size: 13px; line-height: 18px; font-weight: normal; font-style: normal; color:#010101; text-align: center;">
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
                                                                        <tr><td height="30px" style="height: 30px"></td></tr>
                                                                    </table>
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
        </table>







	

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */


do_action( 'woocommerce_email_footer', $email );
