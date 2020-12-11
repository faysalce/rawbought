<?php
/**
 * The Template for displaying products in a product tag. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_tag.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


get_header();
?>
<main id="main-content helllo">
    <div class="has-fixed-navbar"></div>
    <section class="block-py container-fluid container-xl-fluid">
        <div class="row aside-filterbar">
            <div class="col-md-3 col-lg-3 col-xl-2 col-xl-20 aside-filter-collapse">
                <aside class="aside-static">
                    <div class="collapse-group">
                        <?php
                        $category = get_queried_object();
                        $page_term = $category->term_id;
                        $current_term = get_term($category->term_id);

                        ?>
                        <div class="collapse-item">
                            <a class="link-collapse" data-toggle="collapse" href="#s_collapse_1" role="button" aria-expanded="true" aria-controls="s_collapse_1">
                                Categories
                            </a>
                            <div class="collapse show" id="s_collapse_1">
                                <div class="collapse-body">
                                    <ul class="list-checkbox checkbox-sm -column">

                                        <?php
                                        $productCats = get_terms('product_cat', array(
                                            'hide_empty' => false,
                                        ));
                                        if (count($productCats) > 0) {
                                            foreach ($productCats as $cat) {
                                        ?>
                                                <li class="list-item">
                                                    <a class="list-checkbox <?php if ($current_term->term_id == $cat->term_id) {
                                                                                echo "active";
                                                                            } ?>" href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name; ?></a>

                                                </li>
                                        <?php }
                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="collapse-item">
                                 <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_2" role="button" aria-expanded="false" aria-controls="s_collapse_2">
                                     Style
                                 </a>
                                 <div class="collapse" id="s_collapse_2">
                                     <div class="collapse-body">
                                         <ul class="list-checkbox checkbox-sm -column">
                                             <li class="list-item">
                                                 <a class="list-checkbox" href="#">Medium Impact</a>
                                             </li>
                                             <li class="list-item">
                                                 <a class="list-checkbox active" href="#">Normal Casual</a>
                                             </li>
                                             <li class="list-item">
                                                 <a class="list-checkbox" href="#">General</a>
                                             </li>
                                         </ul>
                                     </div>
                                 </div>
                             </div> -->
                        <div class="collapse-item">
                            <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_3" role="button" aria-expanded="false" aria-controls="s_collapse_3">
                                Size
                            </a>
                            <div class="collapse" id="s_collapse_3">
                                <div class="collapse-body">
                                    <ul class="sizes sizes-sm">
                                        <li>
                                            <button type="button" class="btn size">xxs</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn size">xs</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn size">s</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn size active">m</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn size">l</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn size">xl</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_4" role="button" aria-expanded="true" aria-controls="s_collapse_4">
                                Color
                            </a>
                            <div class="collapse" id="s_collapse_4">
                                <div class="collapse-body">
                                    <ul class="list-swatches swatches-sm  -column">
                                        <li class="list-item">
                                            <button type="button" class="btn swatch">
                                                <span class="colors">
                                                    <span class="color" style="background:red">Red</span>
                                                    <span class="color" style="background:green">Green</span>
                                                </span>
                                                <span class="color-name">Red & Green</span>
                                            </button>
                                        </li>
                                        <li class="list-item">
                                            <button type="button" class="btn swatch active">
                                                <span class="colors">
                                                    <span class="color" style="background:#000">Black</span>
                                                    <span class="color" style="background:gray">Gray</span>
                                                </span>
                                                <span class="color-name">Black & Gray</span>
                                            </button>
                                        </li>
                                        <li class="list-item">
                                            <button type="button" class="btn swatch">
                                                <span class="colors">
                                                    <span class="color" style="background:#000">Black</span>
                                                    <span class="color" style="background:#fff">White</span>
                                                </span>
                                                <span class="color-name">Black & White</span>
                                            </button>
                                        </li>
                                        <li class="list-item">
                                            <button type="button" class="btn swatch">
                                                <span class="colors">
                                                    <span class="color" style="background:yellow">Animal Print</span>
                                                </span>
                                                <span class="color-name">Animal Print</span>
                                            </button>
                                        </li>
                                        <li class="list-item">
                                            <button type="button" class="btn swatch">
                                                <span class="colors">
                                                    <span class="color" style="background:brown">Brown</span>
                                                </span>
                                                <span class="color-name">Brown</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_5" role="button" aria-expanded="false" aria-controls="s_collapse_5">
                                Featured
                            </a>
                            <div class="collapse" id="s_collapse_5">
                                <div class="collapse-body">
                                    <ul class="list-checkbox checkbox-sm -column">
                                        <li class="list-item">
                                            <a class="list-checkbox" href="#">Activewear</a>
                                        </li>
                                        <li class="list-item">
                                            <a class="list-checkbox active" href="#">Loungewear</a>
                                        </li>
                                        <li class="list-item">
                                            <a class="list-checkbox active" href="#">Cashmere</a>
                                        </li>
                                        <li class="list-item">
                                            <a class="list-checkbox active" href="#">Work from Home</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="collapse-item">
                            <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_6" role="button" aria-expanded="false" aria-controls="s_collapse_6">
                                Price
                            </a>
                            <div class="collapse" id="s_collapse_6">
                                <div class="collapse-body">
                                    <form action="">
                                        <!-- <div class="formgroup-price formgroup-sm">
                                               <input type="number" step="1" placeholder="Min price" class="form-control ">
                                               <span class="price-to">to</span>
                                               <input type="number" step="1" placeholder="Max price" class="form-control">
                                               <button class="btn btn-primary btn-price">Go</button>
                                            </div> -->
                                        <div class="rangeslider">
                                            <input id="priceRange" type="text" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-9 col-lg-9 col-xl-10 col-xl-80 filter-collapse-content">
                <div>
                    <div class="header-jumbotron">
                        <div class="jumbotron-legend">
                            <h1 class="jumbotron-title h5">All Categroies </h1>
                            <span class="jumbotron-label">
                                <span><?php echo $current_term->count; ?> total results</span>
                            </span>
                        </div>

                        <div class="products-filterbar products-filters">
                            <div class="d-flex justify-content-between justify-content-md-end">
                                <div class="panel-filter filters-only-mobile">
                                    <div class="filter-header">
                                        <a href="javascript:void(0)" class="filter-link filter-toggle collapsed">
                                            <span class="filter-bars">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </span>
                                            Filters
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown dropdown-sort">
                                    <a href="#" class="dropdown-toggle" role="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Sort By:</span>
                                        <span class="dropdown-toggle-text">
                                            Price: High to Low
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                                        <a class="dropdown-item" href="#">Price: Low to High</a>
                                        <a class="dropdown-item active" href="#">Price: High to Low</a>
                                        <a class="dropdown-item" href="#">New Arrivals</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gutters-16 category-products">

                        <?php
                        $args = array(
                            'posts_per_page' => 9,
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
                                $product = wc_get_product($all_product->ID);
                                $post_thumbnail_id = get_post_thumbnail_id($all_product->ID);

                               // $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                                // $image_src = $post_thumbnail_src[0];
                                $sale_price = $product->get_sale_price();
                                $regular_price = $product->get_price();

                                $images = $product->get_gallery_image_ids();
                        ?>

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-4 col-mb">
                                    <div class="product product-standard text-center">
                                        <div class="product-media">
                                            <a href="<?php echo get_permalink($all_product->ID); ?>" class="product-image">

                                                <?php $post_thumbnail_id = get_post_thumbnail_id($all_product->ID);
if(!empty($post_thumbnail_id )){
                                                $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                                                $image_src = $post_thumbnail_src[0];
                                                ?>


                                                <img src="<?php echo $image_src; ?>" alt="" class="product-static-img">


                                                <?php
}
                                                if (count($images) > 0) {



                                                    $post_thumbnail_src = wp_get_attachment_image_src($images[0], 'full'); //get thumbnail image url			
                                                    $image_src = $post_thumbnail_src[0];
                                                ?>


                                                    <img src="<?php echo $image_src; ?>" alt="" class="product-hover-img">


                                                <?php
                                                } ?>
                                            </a>
                                            <div class="product-quickview">
                                                <a href="quickview/quickview1.html" class="btn btn-site btn-light border-0 rounded-0 he-rotate ajax-quickview" tabindex="-1">
                                                    <span class="btn__text">Quick View</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h6 class="product-title"><a href="<?php echo get_permalink($all_product->ID); ?>"><?php echo $product->get_name(); ?></a></h6>
                                            <div class="product-price">
                                            <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <nav class="nav-pagination justify-content-center pagination-border-top">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span class="ion ion-ios-arrow-back" aria-hidden="true"></span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span class="ion ion-ios-arrow-forward" aria-hidden="true"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>