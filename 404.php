<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rawbought
 */

get_header();
?>
<main id="main-content">
	<section class="section hero-error" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/images/bg_coming.jpg)">
        <div class="container container-xl-fluid position-relative">
            <div class="section-error-header mx-auto">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="error-content text-center">
                            <h1 class="error-heading h3 text-uppercase text-light">404 Page Not Found</h1>
                            <div class="error-text text-light">
                                <p>
                                    We're sorry, the page you're looking for could not be found.
                                </p>
                            </div>
                            <div class="error-action">
                                <a href="<?php echo home_url();?>" class="btn btn-site btn-lg btn-white btn-arrow-right rounded-0 border-0 btn-error">Back to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
get_footer();
