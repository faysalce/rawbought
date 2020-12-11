<?php
get_header();

?>
  <main id="main-content">
        <div class="has-fixed-navbar"></div>
        <section class="section">
            <div class="container-fluid container-xl-fluid">   
                
                    
                
                <?php echo do_shortcode('[woocommerce_cart]');?>
                    
               
            </div>
        </section>
    </main>

<?php
get_footer();
?>