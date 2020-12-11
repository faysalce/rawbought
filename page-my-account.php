<?php 

get_header();
?>

<main id="main-content">
        <div class="has-fixed-navbar"></div>
        <div class="profile-page-block">
            <section class="section section-sm">
                <div class="container-fluid container-xl-fluid">
                    <?php echo do_shortcode('[new_woocommerce_my_account]');?>

                </div>
            </section>            
        </div>
    </main>





<?php
get_footer();
?>