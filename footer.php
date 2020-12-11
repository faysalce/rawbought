<!-- 'footer-contact' => esc_html__( 'Footer Contact', 'rawbought' ),
				'footer-customer' => esc_html__( 'Footer For Customer', 'rawbought' ),
				'footer-company' => esc_html__( 'Footer For Company', 'rawbought' ), -->

<footer id="footer" class="footer footer-style2">
    <div class="container container-xl-fluid">
        <div class="foowrap">
            <div class="footer-navs-wrap">
                <div class="row">
                    <div class="col-12 col-sm-4 col-navwarp">
                        <div class="footer-navwrap">
                            <div class="footernav-header">
                                <h6 class="footer-title">Contact Us</h6>
                            </div>
                            <div class="footernav-body">

                                <?php


                                wp_nav_menu(array(
                                    'theme_location'  => 'footer-contact',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'footer-nav',
                                ));

                                ?>
                                <!-- <ul class="footer-nav">
                                        <li><a href="mailto:hi@rawbought.com" title="hi@rawbought.com">hi@rawbought.com</a></li>
                                        <li><a href="tel:012 524 2114" title="012 524 2114">012 524 2114</a></li>
                                        <li><a title="">(Mon-Fri 9am to 5pm PT)</a></li>
                                    </ul> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-navwarp">
                        <div class="footer-navwrap">

                            <div class="footernav-body">
                                <?php


                                wp_nav_menu(array(
                                    'theme_location'  => 'footer-customer',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'footer-nav',
                                ));

                                ?>
                                <!-- <ul class="footer-nav text-uppercase">
                                        <li><a href="" title="">Account</a></li>
                                        <li><a href="" title="">Fefer a friend</a></li>
                                        <li><a href="" title="">Size Guide</a></li>
                                        <li><a href="" title="">Faq</a></li>
                                        <li><a href="" title="">Shipping</a></li>
                                        <li><a href="" title="">Returns</a></li>
                                    </ul> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-navwarp">
                        <div class="footer-navwrap">

                            <div class="footernav-body">

                                <?php


                                wp_nav_menu(array(
                                    'theme_location'  => 'footer-company',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => 'footer-nav',
                                ));

                                ?>
                                <div class="footer-newsletter">
                                    <div class="footer-newsletter-block">
                                        <div class="footer-newsletter-title">Sign Up for Our Newsletter</div>
                                        <div class="thanks-text thanks-text-footer d-none">Thank you for signing up.</div>

                                        <form place="footer" method="post" class="newsletter-form" action="https://staging.rawbought.com/?na=s">
                                            <div class="footer-newsletter-form">

                                                <input type="hidden" name="nlang" value="">
                                                <input class="form-control form-control-sm newsletter-email-footer" type="text" name="ne" value="" >
                                                <button type="submit" value="Subscribe" class="btn btn-nttr-submit ">
                                                    <i class="ti-angle-right"></i>
                                                </button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-brand">
            <a href="<?php echo home_url(); ?>" class="foologo">
                <img src="<?php echo ot_get_option('footer_logo_gray'); ?>" alt="Rawbought" class="logo-primary">
                <img src="<?php echo ot_get_option('footer_logo'); ?>" alt="Rawbought" class="logo-light">
            </a>
        </div>
    </div>
    </div>
</footer>

<div class="full-page-loader "></div>

<!-- Optional JavaScript -->
<?php wp_footer(); ?>
<?php
if (wp_is_mobile()) {


?>


        <style>
            .menu-login-item-mobile-hide {
                display: block;

            }
        </style>

    <?php  
} else { ?>
    <style>
        .menu-login-item-mobile-hide {
            display: none;

        }
    </style>
<?php }

?>

<script>

$(document).ready(function() {
$(".newsletter-form").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.
var form = $(this);
var url = form.attr('action');
var place = form.attr('place');

var newsletterEmail = $('.newsletter-email-' + place).val();
var emailCheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

var emailadd = newsletterEmail;
if (emailadd === "") {
    $('.thanks-text-' + place).removeClass('d-none');

    $('.thanks-text-' + place).html('Please enter a email address');
    setTimeout(function() {
        $('.thanks-text-' + place).addClass('d-none');

    }, 5000);
} else {
    if (emailCheck.test(emailadd)) {

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                form.addClass('d-none');
                $('.thanks-text-' + place).removeClass('d-none');
                $('.thanks-text-' + place).html('Thank you for signing up.');



            }
        });
    } else {


        $('.thanks-text-' + place).removeClass('d-none');

        $('.thanks-text-' + place).html('Sorry, please enter a valid email address');
        setTimeout(function() {
            $('.thanks-text-' + place).addClass('d-none');

        }, 5000);
    }
}

});

});

</script>
<?php if (is_home()) { ?>
    <script>
        $(document).ready(function() {




            $('.hero-slider').slick({
                autoplay: true,
                autoplaySpeed: 4000,
                lazyLoad: 'ondemand',
                arrows: false,
                dots: true,
            });
        });
    </script>
<?php } ?>

<?php if(is_page('shop-all')){?>


    <script>
    // jQuery(document).ready(function($) {




    //     var selectedColor = $('input[type="radio"][name="attribute_pa_colour"]:checked').val();
    //    // console.log(selectedColor);
    //     if (selectedColor) {

    //         $('.item_attribute_pa_colour').removeClass('is-selected');
    //         var allimages;
    //         var checkedRadio = $('input[type="radio"][name="attribute_pa_colour"]:checked');
    //         var name = checkedRadio.attr('proper-name');
    //         var colorName = checkedRadio.val();
    //         $('.product-name-pa_colour').html(name);
    //         checkedRadio.closest('.item_attribute_pa_colour').addClass('is-selected');
    //         allimages = JSON.parse($('.variation-color-image-data').attr('json-image'));
    //         //console.log(allimages);
    //         var slideImages, sliderImageNave;
    //         if (Object.keys(allimages).length > 0) {
    //             if (allimages[selectedColor].length > 0) {

    //                 allimages[selectedColor].forEach(function(item, index) {
    //                     slideImages += ' <div class="slide-item"><div class="zoom-proimg" data-src="' + item + '"><img src="' + item + '" alt=""></div></div>';
    //                     sliderImageNave += ' <div class="slide-item"><img src="' + item + '" alt=""></div>';

    //                 });

    //                 jQuery('#productMainSlider').slick("unslick");
    //                 jQuery('#productMainSliderNav').slick("unslick");

    //                 jQuery('#productMainSlider').html(slideImages);
    //                 jQuery('#productMainSliderNav').html(sliderImageNave);


    //                 init__productImgZoomSlider();

    //             }

    //         }



    //     }
    //     // console.log(arraydata);
    //     $(document).on('change','input[type="radio"][name="attribute_pa_colour"]', function() {
    //         if ($(this).is(':checked')) {
    //             $('.item_attribute_pa_colour').removeClass('is-selected');
    //             var allimages;
    //             var name = $(this).attr('proper-name');
    //             var colorName = $(this).val();
    //             $('.product-name-pa_colour').html(name);
    //             $(this).closest('.item_attribute_pa_colour').addClass('is-selected');
    //             allimages = JSON.parse($(document).find('.variation-color-image-data').attr('json-image'));
    //             //console.log(allimages);
    //             var slideImages, sliderImageNave;
    //             if (Object.keys(allimages).length > 0) {
    //                 if (allimages[colorName].length > 0) {

    //                     allimages[colorName].forEach(function(item, index) {
    //                         slideImages += ' <div class="slide-item"><div class="zoom-proimg" data-src="' + item + '"><img src="' + item + '" alt=""></div></div>';
    //                         sliderImageNave += ' <div class="slide-item"><img src="' + item + '" alt=""></div>';

    //                     });
    //                 }

    //             }


    //             jQuery('#productMainSlider').slick("unslick");
    //             jQuery('#productMainSliderNav').slick("unslick");

    //             jQuery('#productMainSlider').html(slideImages);
    //             jQuery('#productMainSliderNav').html(sliderImageNave);


    //             init__productImgZoomSlider();







    //         }


    //     });
    //     $(document).on('change','input[type="radio"][name="attribute_pa_size"]', function() {
    //         if ($(this).is(':checked')) {
    //             $('.item_attribute_pa_size').removeClass('is-selected');

    //             var name = $(this).attr('proper-name');
    //             console.log(name);
    //             $('.product-name-pa_size').html(name);
    //             $(this).closest('.item_attribute_pa_size').addClass('is-selected');
    //         }

    //     });
        

    //     $(document).on('submit',".variations_form",function(e) {

    //         e.preventDefault(); // avoid to execute the actual submit of the form.
    //         $('.full-page-loader').addClass('optional-overlay');

    //         console.log('hello');
    //         var form = $(this);
    //         var url = form.attr('action');

    //         $.ajax({
    //             type: "POST",
    //             url: url,
    //             data: form.serialize(), // serializes the form's elements.
    //             success: function(data) {
    //                 $(document.body).trigger('wc_fragment_refresh');

    //                 console.log('hello');

    //                 $.ajax({
    //                     type: 'POST',
    //                     dataType: 'json',
    //                     url: ajax_login_object.ajaxurl,
    //                     data: {
    //                         'action': 'get_minicart_total', //calls wp_ajax_nopriv_ajaxlogin

    //                     },
    //                     success: function(response) {

    //                         $('.minicart-total-count').html(response);




    //                     },
    //                     error: function(request, status, error) {

    //                     }
    //                 });
    //                 $.ajax({
    //                     type: 'POST',

    //                     url: ajax_login_object.ajaxurl,
    //                     data: {
    //                         'action': 'get_minicart', //calls wp_ajax_nopriv_ajaxlogin

    //                     },
    //                     success: function(response) {
    //                         $('.full-page-loader').removeClass('optional-overlay');

    //                         $('.minicart-container-main').html(response);

                           

    //                             jQuery('#cartModal').modal('show');

                          


    //                     },
    //                     error: function(request, status, error) {

    //                     }
    //                 });


    //             }
    //         });


    //     });

    // });
</script>
<?php } ?>

</html>