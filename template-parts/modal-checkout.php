<div class="modal fade modal-address modal-checkout" id="modalCheckout" tabindex="-1" role="dialog" aria-labelledby="modalCheckoutTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="position-relative">
                        <div class="modal-closewrap">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="ti-close"></span>
                            </button>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                            <p class="login-status"></p>

                                <h5 class="modal-title text-uppercase text-center">Sign In</h5>
                                <form id="checkout-login" method="post">
                                    <div class="form-group static-group">
                                        <input type="email" id="checkout-username" name="username" class="form-control username floating-field" placeholder="Enter email address" required="required">
                                    </div>
                                    <div class="form-group static-group">
                                        <input type="password" id="checkout-password" name="password" class="form-control password floating-field" placeholder="Enter password" required="required">
                                    </div>
                                    <div class="form-group static-group mb-1">
                                        <button type="button" class="btn btn-site btn-block btn-primary checkout-login-btn">Sign In</button>
                                    </div>
                                    <div class="form-group static-group text-right mb-1">
                                        <a href="forgot-password.html" class="text-underline">Forgot password?</a>
                                    </div>
                                    <div class="form-group static-group">
                                        <button class="btn btn-facebook btn-site  btn-block"><i class="fab fa-facebook-f"></i> Sign In With Facebook</button>
                                    </div>
                                    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

                                </form>
                            </div>
                            <div class="col-md-6">
                                <h5 class="modal-title text-uppercase text-center">GUEST CHECKOUT</h5>
                                <div class="guest-wrap">
                                    <form action="">
                                        <div class="form-group static-group text-center">
                                            Fast checkout without creating an account.
                                        </div>
                                        <div class="form-group static-group text-center">
                                            <a href="<?php echo wc_get_checkout_url(); ?>" class="btn btn-site btn-primary">Continue Checkout</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    No account? <a href="<?php echo get_permalink(get_page_by_path('signup'));?>">Register now.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>