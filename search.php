<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package rawbought
 */

get_header();
?>



	<main id="main-content">
    <div class="has-fixed-navbar"></div>
    <section class="section section-sm has-col-mb">
        <div class="container-fluid container-xl-fluid">
            <div class="header-jumbotron">
                <div class="jumbotron-legend">
                    <h1 class="jumbotron-title h2"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'rawbought' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
                    
                </div>
                <div class="products-filterbar products-filters">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="panel-filter">
                            <div class="filter-header">
                                <a href="#" role="button" data-toggle="modal" data-target="#filterModal" class="filter-link filter-toggle collapsed">
                                    <span class="filter-icon d-none">
                                        <i class="fas fa-filter"></i>
                                    </span>
                                    Filters
                                </a>
                            </div>
                        </div>
                        <div class="dropdown dropdown-sort">
                            <a href="#" class="dropdown-toggle" role="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="dropdown-toggle-text">
                                    Sort By
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                                <a class="dropdown-item" href="#">New Arrivals</a>
                                <a class="dropdown-item" href="#">Price: Low to High</a>
                                <a class="dropdown-item active" href="#">Price: High to Low</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row category-products">
			<?php if ( have_posts() ) : ?>
                <?php
				while ( have_posts() ) :
					the_post();

                        $product = wc_get_product(get_the_ID());
                        $product_id = get_the_ID();
                        $images = $product->get_gallery_image_ids();
                        $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        if (!empty($post_thumbnail_id)) {
                            $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                            $image_src = $post_thumbnail_src[0];
                        } else {
                            $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                        }

                        $sale_price = $product->get_sale_price();
                        $regular_price = $product->get_price();


                ?>


                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-mb">
                            <div class="product product-standard text-center">
                                <div class="product-media">
                                    <a href="<?php echo get_permalink(get_the_ID()); ?>" class="product-image">

                                        <?php

                                        $post_thumbnail_id = get_post_thumbnail_id($product_id);


                                        if (!empty($post_thumbnail_id)) {
                                            $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'full'); //get thumbnail image url			
                                            $image_src = $post_thumbnail_src[0];
                                        } else {
                                            $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                        }


                                        ?>


                                        <img src="<?php echo $image_src; ?>" alt="" class="product-static-img">


                                        <?php
                                        if (count($images) > 0) {



                                            $post_thumbnail_src = wp_get_attachment_image_src($images[0], 'full'); //get thumbnail image url			
                                            $image_src = $post_thumbnail_src[0];



                                        ?>


                                            <img src="<?php echo $image_src; ?>" alt="" class="product-hover-img">


                                        <?php
                                        } ?>
                                    </a>
                                    <div class="product-quickview">
                                        <a href="<?php echo admin_url( 'admin-ajax.php' );?>" product_id="<?php echo $product_id;?>" class="btn btn-site btn-white border-0 rounded-0 ajax-quickview" tabindex="-1">
                                            <span class="btn__text">Quick View</span>
                                        </a>
                                    </div>
                                </div>





                                <div class="product-content">
                                    <h6 class="product-title"><a href="<?php echo get_permalink($product_id); ?>"><?php echo $product->get_name(); ?></a></h6>
                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                            </div>




                        </div>

				<?php 
				
			
			endwhile;
				
				wp_reset_query();
			endif;
				?>

            </div>
        </div>
    </section>
</main>


<?php

get_footer();
