<?php
/**
* Template name: Signup page
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
                    <div class="box-auth auth-signup">
                        <div class="auth-container">
                            <div class="auth-heading d-block">
                                <h4 class="auth-title text-uppercase">Sign Up</h4>
                                <div class="sign-bottometa mt-3">
                                    Already have an account? <a href="<?php echo get_permalink(get_page_by_path('login'));?>">Sign in here.</a>
                                </div>
                            </div>
                            <span class="signup-status"></span>
                            <form id="checkout-signup" method="post">
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
                                <div class="sign-or text-center"><span>Or</span></div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group floating-static-group floating-static-style-2">
                                            <label for="fname" class="floating-label f-required">First Name</label>
                                            <input type="text" id="fname" class="form-control floating-field" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-static-group floating-static-style-2">
                                            <label for="lname" class="floating-label f-required">Last Name</label>
                                            <input type="text" id="lname" class="form-control floating-field" required="required" >
                                        </div>
                                    </div>
                                </div>
                                <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group floating-static-group floating-static-style-2">
                                            <label for="email" class="floating-label f-required">Email</label>
                                            <input type="email" id="signup-email" class="form-control floating-field" required="required" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group floating-static-group floating-static-style-2">
                                            <label for="password" class="floating-label f-required">Password</label>
                                            <input type="password" id="signup-password" class="form-control floating-field" required="required" placeholder="5-20 Characters">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <p>
                                                By choosing ‘Create an account’ below you accept our <u><a href="<?php echo get_permalink(get_page_by_path('privacy-policy'));?>"> Terms & Conditions</a></u>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-10 col-lg-6 mx-auto">
                                        <button type="submit" class="btn btn-site btn-primary signup-btn rounded-0 he-rotate btn-lg btn-block" tabindex="-1">
                                            <span class="btn__text">Create an account</span>
                                        </button>
                                    </div>
                                </div> 
                                
                            </form>
                        </div>            
                    </div>
                </div>
            </div> 
          </div>
        </section>
    </main>

<?php 

get_footer();
?>