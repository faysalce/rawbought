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
                                                    if ($page_term && $current_term->taxonomy == 'product_cat') {
                                                        echo $current_term->name;
                                                    } else {
                                                    }


                                                    ?></h1>
                    <span class="jumbotron-label mt-3">
                        <span class="total-count-top"><?php echo $current_term->count; ?> results</span>
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
                    'posts_per_page' => -1,
                    'post_type' => 'product',
                    'post_status' => 'publish',       // name of post type.
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',   // taxonomy name
                            'field' => 'term_id',           // term_id, slug or name
                            'terms' => $current_term->term_id,                  // term id, term slug or term name
                        )
                    )
                );

                $all_products = get_posts($args);
                if (count($all_products) > 0) {

                    foreach ($all_products as $all_product) {

$count=0;

                        $args2 = array(
                            'posts_per_page' => -1,
                            'post_type' => array('product_variation'),
                            'post_status' => 'publish',
                            'post_parent' => $all_product->ID,
                            'meta_query' => array(array(
                                'key'     => '_show_shop_all',
                                'value'   => 'yes',

                            )),

                        );

                        $all_productsVarient = get_posts($args2);

                        if (count($all_productsVarient) > 0) {


                            foreach ($all_productsVarient as $productVarieant) {
$count++;
                                $product = wc_get_product($productVarieant->ID);
                                $product_id = $productVarieant->ID;
                                $images = $product->get_gallery_image_ids();
                                $post_thumbnail_id = get_post_thumbnail_id($productVarieant->ID);
                                if (!empty($post_thumbnail_id)) {
                                    $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                                    $image_src = $post_thumbnail_src[0];
                                } else {
                                    $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                }
                                $produtimages = get_post_meta($product_id, 'woo_variation_gallery_images', true);

                                //$post_thumbnail_id_secound = get_post_thumbnail_id($produtimages[0]);
                                if (!empty($produtimages[0])) {
                                    $post_thumbnail_src_sec = wp_get_attachment_image_src($produtimages[0], 'large'); //get thumbnail image url			
                                    $image_src_sec = $post_thumbnail_src_sec[0];
                                } else {
                                    $image_src_sec = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                }
                                $productParent = wc_get_product( $product->get_parent_id() );

                                $sale_price = $product->get_sale_price();
                                $regular_price = $product->get_price();
                ?>


                                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-mb">
                                    <div class="product product-standard text-center">
                                        <div class="product-media">
                                            <a href="<?php echo get_permalink($productVarieant->ID); ?>" class="product-image">

                                                <img src="<?php echo $image_src; ?>" alt="" class="product-static-img">





                                                <img src="<?php echo $image_src_sec; ?>" alt="" class="product-hover-img">



                                            </a>
                                            <div class="product-quickview">
                                                <button type="button" product_id="<?php echo $product_id; ?>" class="btn btn-site btn-white border-0 rounded-0 ajax-quickview" tabindex="-1">
                                                    Quick View
                                                </button>
                                            </div>
                                        </div>





                                        <div class="product-content">
                                            <h6 class="product-title"><a href="<?php echo get_permalink($product_id); ?>"><?php echo $productParent->get_name(); ?></a></h6>
                                            <div class="product-price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                    </div>




                                </div>

                <?php }
                        }
                    }
                } ?>
<input type="hidden" name="total_product_count" class="total_product_count" value="<?php echo $count;?>" />

            </div>
        </div>
    </section>
</main>




<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($){

        $('.total-count-top').html($('.total_product_count').val());
    });
</script>