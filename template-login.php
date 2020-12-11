<?php
/**
* Template name: Login page
 * 
 */
if(is_user_logged_in()){

wp_redirect(get_permalink(get_page_by_path('my-account')));

die;
}
 get_header();
?>
     <main id="main-content">
        <div class="has-fixed-navbar"></div>
        <section class="section has-col-mb">
          <div class="container-fluid container-xl-fluid">
            <div class="row no-gutters align-items-md-center">
                <div class="col-md-12 mx-auto c-mb">
                    <div class="box-auth auth-login box-auth-single mx-auto">
                        <div class="auth-container">
                        <?php if(isset($_REQUEST['reset-link-sent']) && $_REQUEST['reset-link-sent']==true){?>
                                
                            
                            <div class="alert alert-default alert-dismissible fade show" role="alert">
                        You will receive an email with a link to reset your password.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                            
                           <?php }?>
                            <div class="auth-heading">
                                <h4 class="auth-title text-uppercase"><?php echo get_the_title();?></h4>
                           
                            </div>

                            

                            <form id="checkout-login" method="post">  
                                <div class="form-group floating-static-group floating-static-style-2">
                                    <label for="email" class="floating-label f-required">Email</label>
                                    <input type="email" id="checkout-username" name="username" class="form-control username floating-field" required="required">

                                </div>
                                <div class="form-group floating-static-group floating-static-style-2">
                                    <label for="password" class="floating-label f-required">Password</label>
                                    <input type="password" id="checkout-password" name="password" class="form-control password floating-field"  required="required">

                                </div>
                                <div class="form-group text-right">
                                    <a href="/my-account/lost-password" class="text-underline">Forgot your password?</a>
                                </div>
                                <div class="form-group">
                                    <!-- <button type="submit" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg btn-block" tabindex="-1">
                                        <span class="btn__text">Sign In</span>
                                    </button> -->
                                    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

                                    <button type="button" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg btn-block checkout-login-btn">Sign In</button>

                                    <!-- <a href="profile.html" class="btn btn-site btn-primary rounded-0 he-rotate btn-lg btn-block" tabindex="-1">
                                        <span class="btn__text">Sign In</span>
                                    </a> -->
                                </div>
                                <div class="sign-or text-center"><span>Or</span></div>
                                <div class="signsocials-wrap">
                                    <ul class="sign-socials">
                                        <li>                                           
                                            <button class="btn btn-facebook btn-site btn-block">
                                                <i class="fab fa-facebook-f"></i> 
                                                <span class="btn-text">Facebook</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn btn-google btn-site btn-block">
                                                <i class="fab fa-google"></i> 
                                                <span class="btn-text">Google</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div> 
                                <div class="text-center sign-bottometa">
                                    Need to create an account? <a href="<?php echo get_permalink(get_page_by_path('signup'));?>">Sign up here.</a>
                                </div>                              
                            </form>
                        </div>            
                    </div>
                </div>
            </div> 
          </div>
        </section>
    </main>

<?php get_footer();?>