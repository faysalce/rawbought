<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */



get_header();
$category = get_queried_object();
                                        $page_term = $category->term_id;
                                        $current_term = get_term($category->term_id);
?>

<main id="main-content">
    <div class="has-fixed-navbar"></div>
    <section class="section section-sm has-col-mb">
        <div class="container-fluid container-xl-fluid">
            <div class="header-jumbotron">
                <div class="jumbotron-legend">
                    <h1 class="jumbotron-title h2"><?php
                    if($page_term && $current_term->taxonomy=='product_cat'){
                        echo $current_term->name ;

                    }else{

                    }
                       
                     
                     ?></h1>
                    <span class="jumbotron-label mt-3">
                        <span><?php echo $current_term->count;?> results</span>
                    </span>
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

            <?php
             $args = array(
                'post_type' => 'product_variation',
                'post_status' => array('private', 'publish'),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $current_term->term_id,
                    )
                )
                

                // 'posts_per_page' => -1,
                // 'post_type' => array('product_variation'),
                // 'post_status' => 'publish',

                // 'meta_query' => array(array(
                //     'key'     => '_show_shop_all',
                //     'value'   => 'yes',
                    
                // )),
                // 'tax_query' => array(
                //     array(
                //         'taxonomy' => 'product_cat',   // taxonomy name
                //         'field' => 'term_id',           // term_id, slug or name
                //         'terms' => $current_term->term_id,                  // term id, term slug or term name
                //     )
                // )
                
            );
                       
            $variations = new WP_Query($args);
            var_dump($variations);

                        $all_products = get_posts($args);
                        if (count($all_products) > 0) {

                    foreach ($all_products as $all_product) {
                        $product = wc_get_product($all_product->ID);
                        $product_id = $all_product->ID;
                        $images = $product->get_gallery_image_ids();
                        $post_thumbnail_id = get_post_thumbnail_id($all_product->ID);
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
                                    <a href="<?php echo get_permalink($all_product->ID); ?>" class="product-image">

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
                                        <button type="button" product_id="<?php echo $product_id;?>" class="btn btn-site btn-white border-0 rounded-0 ajax-quickview" tabindex="-1">
                                            Quick View
                                        </button>
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

                <?php }
                } ?>


            </div>
        </div>
    </section>
</main>




<?php get_footer(); ?>