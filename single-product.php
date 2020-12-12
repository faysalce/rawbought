<?php get_header(); ?>
<?php get_template_part('template-parts/modal-size-guide'); ?>
<?php
while (have_posts()) :
    the_post();
    $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
    if ($post_thumbnail_id) {
        $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
        $image_src = $post_thumbnail_src[0];
    } else {
        $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
    }


    $product_id = get_the_ID();
    $product = wc_get_product($product_id);
    $upsellIds = $product->get_upsell_ids();
    $product->get_image_id();
    $product->get_image();
    $images = $product->get_gallery_image_ids();
    $product_attributes = $product->get_attributes();
?>
    <main id="main-content">
        <div class="has-fixed-navbar"></div>

        <!-- Need only desktop -->
        <div class="modal fade modal-imagezoom" id="imageZoomModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="imageZoomModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ion ion-ios-close"></i>
                    </button>
                    <div class="modal-body">
                        <div class="imagezoom-slider">

                            <?php $post_thumbnail_id = get_post_thumbnail_id($product_id);

                            $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                            $image_src = $post_thumbnail_src[0];
                            ?>

                            <div class="slide-item">
                                <img src="<?php echo $image_src; ?>" alt="">
                            </div>

                            <?php
                            if (count($images) > 0) {
                                foreach ($images as $image) {

                                    if (!empty($image)) {
                                        $post_thumbnail_src = wp_get_attachment_image_src($image, 'full'); //get thumbnail image url			
                                        $image_src = $post_thumbnail_src[0];
                                    } else {
                                        $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                    }


                            ?>

                                    <div class="slide-item">
                                        <img src="<?php echo $image_src; ?>" alt="">
                                    </div>

                            <?php }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section sec-pt-sm">
            <div class="container container-md-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-11 mx-auto">
                        <div class="row">
                            <div class="col-sm-12 col-md-7">

                                <div class="d-block product-main-imgwrap">
                                    <div class="product-main-images">
                                        <div id="productMainSlider" class="product-main-slider-styled">


                                            <?php $post_thumbnail_id = get_post_thumbnail_id($product_id);


                                            if (!empty($post_thumbnail_id)) {
                                                $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                                                $image_src = $post_thumbnail_src[0];
                                            } else {
                                                $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                            }
                                            ?>

                                            <div class="slide-item">
                                                <div class="zoom-proimg" data-src="<?php echo $image_src; ?>">

                                                    <img src="<?php echo $image_src; ?>" alt="">
                                                </div>
                                            </div>

                                            <?php
                                            if (count($images) > 0) {
                                                foreach ($images as $image) {


                                                    if ($image) {
                                                        $post_thumbnail_src = wp_get_attachment_image_src($image, 'full'); //get thumbnail image url			
                                                        $image_src = $post_thumbnail_src[0];
                                                    } else {
                                                        $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                                    }
                                            ?>

                                                    <div class="slide-item">
                                                        <div class="zoom-proimg" data-src="<?php echo $image_src; ?>">

                                                            <img src="<?php echo $image_src; ?>" alt="">
                                                        </div>
                                                    </div>

                                            <?php }
                                            } ?>



                                        </div>
                                        <div id="productMainSliderNav">

                                            <?php $post_thumbnail_id = get_post_thumbnail_id($product_id);
                                            if ($post_thumbnail_id) {
                                                $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                                                $image_src = $post_thumbnail_src[0];
                                            } else {
                                                $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                            }

                                            ?>

                                            <div class="slide-item">
                                                <img src="<?php echo $image_src; ?>" alt="">
                                            </div>

                                            <?php
                                            if (count($images) > 0) {
                                                foreach ($images as $image) {

                                                    if ($image) {
                                                        $post_thumbnail_src = wp_get_attachment_image_src($image, 'full'); //get thumbnail image url			
                                                        $image_src = $post_thumbnail_src[0];
                                                    } else {
                                                        $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                                    }

                                            ?>

                                                    <div class="slide-item">
                                                        <img src="<?php echo $image_src; ?>" alt="">
                                                    </div>

                                            <?php }
                                            } ?>

                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="col-sm-12 col-md-5">
                                <div class="product-single-information vp-single-info-wrap">
                                    <div class="vp-single-info-top">

                                        <div class="vp-top-top">
                                            <h1 class="product-single-information-title h3 d-none"><?php echo $product->get_name(); ?></h1>
                                            <div class="product-single-information-price d-none product-price mb-3">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>

                                            <?php
                                            $variations = $product->get_available_variations();
                                            $imagesVars = [];
                                            if (count($variations) > 0) {
                                                foreach ($variations as $variation) {
                                                    $variationKey = $variation['attributes']['attribute_pa_colour'];
                                                    $imageVar = array();
                                                    if (count($variation['image']) > 0) {
                                                        $imageVar[] = $variation['image']['url'];
                                                    }
                                                    if ($variation['variation_gallery_images'] && count($variation['variation_gallery_images']) > 0) {

                                                        foreach ($variation['variation_gallery_images'] as $varimgGal) {
                                                            $imageVar[] = $varimgGal['url'];
                                                        }
                                                    }

                                                    $imagesVar[$variationKey] = $imageVar;
                                                }
                                                $imagesVars = $imagesVar;
                                            }


                                            ?>
                                            <span class="variation-color-image-data " json-image="<?php echo htmlspecialchars(wp_json_encode($imagesVar)) ?>">


                                                <?php
                                                /**
                                                 * Hook: woocommerce_single_product_summary.
                                                 *
                                                 * @hooked woocommerce_template_single_title - 5
                                                 * @hooked woocommerce_template_single_rating - 10
                                                 * @hooked woocommerce_template_single_price - 10
                                                 * @hooked woocommerce_template_single_excerpt - 20
                                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                                 * @hooked woocommerce_template_single_meta - 40
                                                 * @hooked woocommerce_template_single_sharing - 50
                                                 * @hooked WC_Structured_Data::generate_product_data() - 60
                                                 */
                                                do_action('woocommerce_single_product_summary');
                                                ?>

                                            </span>











                                        </div>


                                    </div>
                                    <div class="vp-single-info-bottom">
                                        <div class="accordion product-accordion" id="productAccordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            Details
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#productAccordion">
                                                    <div class="card-body">

                                                        <?php

                                                        //the_content();
                                                        $post = get_post($product->get_id());
                                                        //    echo "<pre>";
                                                        //    print_r($post);
                                                        //    echo "</pre>";
                                                        echo "<pre>";
                                                        echo $post->post_content;
                                                        echo "</pre>";
                                                        // echo  apply_filters( 'the_content', $product->get_description() );
                                                        // echo  get_details_desc();
                                                        // the_content()
                                                        // echo $product->get_description(); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Delivery & Returns
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#productAccordion">
                                                    <div class="card-body">
                                                        <?php echo get_post_meta($product->get_id(), 'return_delivery', true); ?> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section pt-0 has-col-mb">
            <div class="container container-md-fluid">
                <div class="row">
                    <div class="col-lg-11 mx-auto product-description">
                        <?php
                        if (count($upsellIds) > 0) {
                        ?>
                            <h4 class="heading-border-top text-center">Wear it with</h4>
                            <div class="row justify-content-center">
                                <?php
                                foreach ($upsellIds as $upsellId) {


                                    $product = wc_get_product($upsellId);
                                    $product_id = $product->get_id();
                                    $images = $product->get_gallery_image_ids();
                                    $post_thumbnail_id = get_post_thumbnail_id($product_id);
                                    if (!empty($post_thumbnail_id)) {
                                        $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                                        $image_src = $post_thumbnail_src[0];
                                    } else {
                                        $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                                    }

                                    $sale_price = $product->get_sale_price();
                                    $regular_price = $product->get_price();


                                ?>


                                    <div class="col-xs-6 col-sm-4 col-md-4 col-mb">
                                        <div class="product product-standard text-center">
                                            <div class="product-media">
                                                <a href="<?php echo get_permalink($product_id); ?>" class="product-image">

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
                                                    <a href="<?php echo admin_url('admin-ajax.php'); ?>" product_id="<?php echo $product_id; ?>" class="btn btn-site btn-white border-0 rounded-0 ajax-quickview" tabindex="-1">
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
                                };
                                ?>



                            </div>

                        <?php

                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
endwhile; // End of the loop.
?>
<?php get_footer(); ?>

<script>
    jQuery(document).ready(function($) {
        $('.attr-wrp-pa_colour').on('click', '.item_attribute_pa_colour', function () {
            $('html,body').stop().animate({
                scrollTop: 0
            }, 'linear');
        });
        var selectedColor = $('input[type="radio"][name="attribute_pa_colour"]:checked').val();
        console.log(selectedColor);
        if (selectedColor) {

            $('.item_attribute_pa_colour').removeClass('is-selected');
            var allimages;
            var checkedRadio = $('input[type="radio"][name="attribute_pa_colour"]:checked');
            var name = checkedRadio.attr('proper-name');
            var colorName = checkedRadio.val();
            $('.product-name-pa_colour').html(name);
            checkedRadio.closest('.item_attribute_pa_colour').addClass('is-selected');
            allimages = JSON.parse($('.variation-color-image-data').attr('json-image'));
            //console.log(allimages);
            var slideImages, sliderImageNave;
            if (Object.keys(allimages).length > 0) {
                if (allimages[selectedColor].length > 0) {
                    let uniqueArr = allimages[colorName].filter((v, i, a) => a.indexOf(v) === i);
                    //console.log(uniqueArr);
                    uniqueArr.forEach(function(item, index) {
                        slideImages += ' <div class="slide-item"><div class="zoom-proimg" data-src="' + item + '"><img src="' + item + '" alt=""></div></div>';
                        sliderImageNave += ' <div class="slide-item"><img src="' + item + '" alt=""></div>';

                    });

                    jQuery('#productMainSlider').slick("unslick");
                    <?php if (!wp_is_mobile()) { ?>
                        jQuery('#productMainSliderNav').slick("unslick");
                    <?php } ?>

                    jQuery('#productMainSlider').html(slideImages);
                    <?php if (!wp_is_mobile()) { ?>
                        jQuery('#productMainSliderNav').html(sliderImageNave);
                    <?php } ?>

                    <?php if (wp_is_mobile()) { ?>

                        init__productImgSliderMobile();
                    <?php } else { ?>
                        init__productImgZoomSlider();

                    <?php } ?>

                }

            }










        }
        // console.log(arraydata);
        $('input[type="radio"][name="attribute_pa_colour"]').on('click', function() {
            if ($(this).is(':checked')) {
                $('.item_attribute_pa_colour').removeClass('is-selected');
                var allimages;
                var name = $(this).attr('proper-name');
                var colorName = $(this).val();
                $('.product-name-pa_colour').html(name);
                $(this).closest('.item_attribute_pa_colour').addClass('is-selected');
                allimages = JSON.parse($('.variation-color-image-data').attr('json-image'));
                //console.log(allimages);
                var slideImages, sliderImageNave;
                if (Object.keys(allimages).length > 0) {
                    if (allimages[colorName].length > 0) {
                        let uniqueArr = allimages[colorName].filter((v, i, a) => a.indexOf(v) === i);
                        uniqueArr.forEach(function(item, index) {
                            slideImages += ' <div class="slide-item"><div class="zoom-proimg" data-src="' + item + '"><img src="' + item + '" alt=""></div></div>';
                            sliderImageNave += ' <div class="slide-item"><img src="' + item + '" alt=""></div>';

                        });
                    }

                }


                jQuery('#productMainSlider').slick("unslick");
                    <?php if (!wp_is_mobile()) { ?>
                        jQuery('#productMainSliderNav').slick("unslick");
                    <?php } ?>

                    jQuery('#productMainSlider').html(slideImages);
                    <?php if (!wp_is_mobile()) { ?>
                        jQuery('#productMainSliderNav').html(sliderImageNave);
                    <?php } ?>

                    <?php if (wp_is_mobile()) { ?>

                        init__productImgSliderMobile();
                    <?php } else { ?>
                        init__productImgZoomSlider();

                    <?php } ?>

            }


        });
        $('input[type="radio"][name="attribute_pa_size"]').on('click', function() {
            if ($(this).is(':checked')) {
                $('.item_attribute_pa_size').removeClass('is-selected');

                var name = $(this).attr('proper-name');
                console.log(name);
                $('.product-name-pa_size').html(name);
                $(this).closest('.item_attribute_pa_size').addClass('is-selected');
            }

        });
        // $('.add-to-cart-btn').click(function() {
        //     console.log($('#pa_colour').val());
        //     console.log($('#pa_size').val());


        //     $('.single_add_to_cart_button').trigger('click');
        // });

        $(".variations_form").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('.full-page-loader').addClass('optional-overlay');

            console.log('hello');
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    $(document.body).trigger('wc_fragment_refresh');

                    console.log('hello');

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: ajax_login_object.ajaxurl,
                        data: {
                            'action': 'get_minicart_total', //calls wp_ajax_nopriv_ajaxlogin

                        },
                        success: function(response) {

                            $('.minicart-total-count').html(response);




                        },
                        error: function(request, status, error) {

                        }
                    });
                    $.ajax({
                        type: 'POST',

                        url: ajax_login_object.ajaxurl,
                        data: {
                            'action': 'get_minicart', //calls wp_ajax_nopriv_ajaxlogin

                        },
                        success: function(response) {
                            $('.full-page-loader').removeClass('optional-overlay');

                            $('.minicart-container-main').html(response);



                            jQuery('#cartModal').modal('show');




                        },
                        error: function(request, status, error) {

                        }
                    });


                }
            });


        });

    });
</script>