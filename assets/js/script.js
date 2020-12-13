// Global variables
var $root = $('html, body');
var $document = $(document);
var $window = $(window);
var $body = $('body');
var $navbar = $('.navbar');
var win_width = $window.width();

$(document).ready(function () {
	"use strict";
	$(this).scrollTop(0);
	Rawbought_NavbarFixedDesktop();
	Rawbought_NavbarFixedMobile();
	heroSlider();
	footerDarkDefault();
	init__productImgZoomSlider();
	init__productImgSliderMobile();
	Rawbought_ajaxQuickview();
	init__footerCollapse();
	Rawbought_Quantity();
	Rawbought_QuantityMini();
	init__priceRange();
	init__accordionGutenberg();

	/*if($('#accordionFaq').length > 0) {
		$('#accordionFaq .collapse').on('shown.bs.collapse', function(e) {
			var $panel = $(this).closest('.card');
			$('html,body').animate({
				scrollTop: $panel.offset().top - 65
			}, 500);
		});
	}*/

	/*$('input[type="radio"]').click(function(){
		if($(this).attr("value")=="creditcard"){
			$(".review-collapse").addClass('open');
		}else if($(this).attr("value")=="paypal"){
			$(".review-collapse").addClass('open');
		}else {
			$(".review-collapse").removeClass('open');
		}       
	});
	$('input[type="radio"]').trigger('click');*/

	$('.navbar__only_mobile .navbar-collapse').on('show.bs.collapse', function () {
		$(this).closest('body').addClass('open-navbar-collapse');
	});
	$('.navbar__only_mobile .navbar-collapse').on('hide.bs.collapse', function () {
		$(this).closest('body').removeClass('open-navbar-collapse');
	});
	$('.btn-collapse-close').on('click', function(e) {
		$('.navbar__only_mobile .navbar-collapse').collapse('hide');
	});


	$('#shipping_city_field > .optional').html('*');
	$('#billing_city_field >  .optional').html('*');
	$('#billing_city_field > label > span').html('*')
	$('#shipping_city_field > label > span').html('*')


	
	$('.link-size-guide > a').click(function (e) {
e.preventDefault();
		$('#sizeGuideModal').modal();

	});
	console.log($('#billing_city_field > label > span').html());
	$('#billing_city_field > label > span').removeClass('optional');
	$('#shipping_city_field > label > span').removeClass('optional');


	$(".edit-tb_shipping").click(function () {
		$('.nav-checkout-step').find('#tb_shipping-tab').trigger('click');
	});
	$(".edit-tb_billing").click(function () {
		$('.nav-checkout-step').find('#tb_billing-tab').trigger('click');
	});
	$('.promo-code-txt').keyup(function () {
		$('#coupon_code').val($(this).val());

	});
	$('.promo-code-btn').click(function () {

		timeout = setTimeout(function () {
			$('.apply_coupon_btn').trigger('click');


		}, 1000);

	});

	$(document).on("click", ".checkout-login-btn", function (e) {
		console.log('login');

		var emailCheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

		var username = $('form#checkout-login #checkout-username');
		var password = $('form#checkout-login #checkout-password');
		var valid=true;
		if (username.val() == '' || password.val() == '' || !emailCheck.test(username.val())  ) {
			valid = false;
		}
		if (valid) {
		//e.preventDefault();
		//$('form#checkout-login p.status').show().text(ajax_login_object.loadingmessage);
		$('form#checkout-login button.checkout-login-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Signing In...</span>		');
		$('form#checkout-login button.checkout-login-btn').attr("disabled", true);
		username.attr("disabled", true);
		password.attr("disabled", true);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajax_login_object.ajaxurl,
			data: {
				'action': 'ajax_login_checkout', //calls wp_ajax_nopriv_ajaxlogin
				'username': username.val(),
				'password': password.val(),
				'security': $('form#checkout-login #checkout-security').val()
			},
			success: function (data) {
				username.attr("disabled", false);
				password.attr("disabled", false);

				$('form#checkout-login button.checkout-login-btn').html('Sign In');
				$('form#checkout-login button.checkout-login-btn').attr("disabled", false);
				$('form#checkout-login button.checkout-login-btn').html('Sign In');
				if (data.status == 1) {
					window.location.href = ajax_login_object.redirecturl+'/my-account';
				} else if(data.status == 0){
					$('.login-status-msg').html('<div class="alert alert-site alert-dismissible fade show text-center" role="alert"><div class="text-danger">Incorrect email or password.</div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}, error: function (request, status, error) {
				username.attr("disabled", false);
				password.attr("disabled", false);

				$('form#checkout-login button.checkout-login-btn').html('Sign In');
				$('form#checkout-login button.checkout-login-btn').attr("disabled", false);
			}
		});


	} else {
		if (username.val() == '') {
			username.addClass('field-invalid');
		} else {
			username.removeClass('field-invalid');

		}
		if (password.val() == '') {
			password.addClass('field-invalid');
		} else {
			password.removeClass('field-invalid');

		}
		if (!emailCheck.test(username.val())) {
			username.addClass('field-invalid');
		} else {
			username.removeClass('field-invalid');

		}
		
		return false;
	}

	});



	$(document).on("click", ".signup-btn", function (e) {
		e.preventDefault();
		var emailCheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

		console.log('signup');
		var fname = $('form#checkout-signup #fname');
		var lname = $('form#checkout-signup #lname');
		var email = $('form#checkout-signup #signup-email');
		var pass = $('form#checkout-signup #signup-password');
		console.log('password length: '+ pass.length);
		var valid = true;
		if (fname.val() == '' || lname.val() == '' || email.val() == '' ||  pass.val().length  < 5 || pass.val().length  > 20 || pass.val() == '' || !emailCheck.test(email.val())   ) {
			valid = false;
		}
		if (valid) {
			fname.removeClass('field-invalid');
			lname.removeClass('field-invalid');
			email.removeClass('field-invalid');
			pass.removeClass('field-invalid');
			$('form#checkout-signup button.signup-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Account creating...</span>		');
			$('form#checkout-signup button.signup-btn').attr("disabled", true);
			fname.attr("disabled", true);
			lname.attr("disabled", true);
			email.attr("disabled", true);
			pass.attr("disabled", true);


			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: {
					'action': 'ajax_register', //calls wp_ajax_nopriv_ajaxlogin
					'register_username': email.val(),
					'register_email': email.val(),
					'register_first_name': fname.val(),
					'register_last_name': lname.val(),

					'register_password': pass.val(),
					'security': $('form#checkout-signup #security').val()
				},
				success: function (data) {
					$('form#checkout-signup button.signup-btn').attr("disabled", false);
					$('form#checkout-signup #fname').attr("disabled", false);
					$('form#checkout-signup #lname').attr("disabled", false);
					$('form#checkout-signup #signup-email').attr("disabled", false);
					$('form#checkout-signup #signup-password').attr("disabled", false);


					$('form#checkout-signup button.signup-btn').html('Create an account');

					if (data.status == 1) {
						window.location.href = ajax_login_object.redirecturl+'/my-account';
					} else if(data.status == 0) {
						$('.signup-status-msg').html('<div class="alert alert-site alert-dismissible fade show text-center" role="alert"><div class="text-danger">There is already an account with this email address. If you are sure that it is your email address, <a href="/my-account/lost-password">click here </a> to get your password and access your account.</div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					}
				}, error: function (request, status, error) {
					$('form#checkout-signup button.signup-btn').attr("disabled", false);
					fname.attr("disabled", false);
					lname.attr("disabled", false);
					email.attr("disabled", false);
					pass.attr("disabled", false);


					$('form#checkout-signup button.signup-btn').html('Sign Create an account');
				}
			});

		} else {
			if (fname.val() == '') {
				fname.addClass('field-invalid');
			} else {
				fname.removeClass('field-invalid');

			}
			if (lname.val() == '') {
				lname.addClass('field-invalid');
			} else {
				lname.removeClass('field-invalid');

			}
			if (email.val() == '') {
				email.addClass('field-invalid');
			} else {
				email.removeClass('field-invalid');

			}
			if (pass.val() == '') {
				pass.addClass('field-invalid');
			} else {
				pass.removeClass('field-invalid');

			}
			if (pass.val().length <5 || pass.val().length > 20) {
				pass.addClass('field-invalid');
			} else {
				pass.removeClass('field-invalid');

			}
			if (!emailCheck.test(email.val())) {
				email.addClass('field-invalid');
			} else {
				email.removeClass('field-invalid');

			}
			
			
			return false;
		}
		//e.preventDefault();
		//$('form#checkout-login p.status').show().text(ajax_login_object.loadingmessage);


	});


	$('.btn-stepnext').click(function (e) {
		e.preventDefault();
		var currentActive = $('.nav-checkout-step > li > .active').attr('aria-controls');
		console.log(currentActive);
		if ('tb_shipping' == currentActive) {

			var fname = $('#shipping_first_name');
			var lname = $('#shipping_last_name');
			var adderss1 = $('#shipping_address_1');
			var adderss2 = $('#shipping_address_2');
			var country = $('#shipping_country');
			var city = $('#shipping_city');
			var post = $('#shipping_postcode');
			var phone = $('#shipping_phone');
			var email = $('#shipping_email');
			console.log(lname.val());
			var addreess = '';
             addreess += fname.val() + ' ' + lname.val();

            adderss1!==''? addreess += ' <br/> ' + adderss1.val():'' ;
            adderss2!==''? addreess += adderss2.val():'' ;
            addreess +=' <br/> '+city.val() + '<br/> ' + post.val() + ', ' + $( "#billing_country option:selected" ).text();
			// $('.billing-address-wrp-plain').html(addreess);
			var valid = true;
			if (fname.val() == '' || lname.val() == '' || adderss1.val() == '' || country.val() == '' || city.val() == '' || post.val() == '' || phone.val() == ''|| email.val() == '') {
				valid = false;
			}
			if (valid) {
				$('.woocommerce-shipping-fields__field-wrapper  .form-control').removeClass('field-invalid');

				$('.shipping-address-wrp-plain').html(addreess);
				$('.nav-checkout-step > li > .active').closest('li').next('li').find('a').trigger('click');
				$('.nav-checkout-step > li > .active').closest('li').prev('li').addClass('item-step-completed');

			} else {
				if (fname.val() == '') {
					fname.addClass('field-invalid');
				} else {
					fname.removeClass('field-invalid');

				}
				if (lname.val() == '') {
					lname.addClass('field-invalid');
				} else {
					lname.removeClass('field-invalid');

				}
				if (adderss1.val() == '') {
					adderss1.addClass('field-invalid');
				} else {
					adderss1.removeClass('field-invalid');

				}
				if (country.val() == '') {
					country.addClass('field-invalid');
				} else {
					country.removeClass('field-invalid');

				}
				if (city.val() == '') {
					city.addClass('field-invalid');
				} else {
					city.removeClass('field-invalid');

				}
				if (post.val() == '') {
					post.addClass('field-invalid');
				} else {
					post.removeClass('field-invalid');

				}
				if (phone.val() == '') {
					phone.addClass('field-invalid');
				} else {
					phone.removeClass('field-invalid');

				}
				if (email.val() == '') {
					email.addClass('field-invalid');
				} else {
					email.removeClass('field-invalid');

				}
				return false;
			}

		} else if ('tb_billing' == currentActive) {
			var fname = $('#billing_first_name');
			var lname = $('#billing_last_name');
			var adderss1 = $('#billing_address_1');
			var adderss2 = $('#billing_address_2');
			var country = $('#billing_country');
			var city = $('#billing_city');
			var post = $('#billing_postcode');
			var phone = $('#billing_phone');
			var email = $('#billing_email');
			console.log(lname.val());
			var addreess = '';
             addreess += fname.val() + ' ' + lname.val();

            adderss1!==''? addreess += ' <br> ' + adderss1.val():'' ;
            adderss2!==''? addreess += adderss2.val():'' ;
            addreess +=' <br/> '+city.val() + '<br/> ' + post.val() + ', ' + $( "#billing_country option:selected" ).text();
			// $('.billing-address-wrp-plain').html(addreess);
			var valid = true;
			if (fname.val() == '' || lname.val() == '' || adderss1.val() == '' || country.val() == '' || city.val() == '' || post.val() == '' || phone.val() == ''|| email.val() == '') {
				valid = false;
			}
			if (valid) {
				$('.woocommerce-billing-fields__field-wrapper .form-control').removeClass('field-invalid');

				$('.billing-address-wrp-plain').html(addreess);

				$('.nav-checkout-step > li > .active').closest('li').next('li').find('a').trigger('click');
				$('.nav-checkout-step > li > .active').closest('li').prev('li').addClass('item-step-completed');

			} else {
				if (fname.val() == '') {
					fname.addClass('field-invalid');
				} else {
					fname.removeClass('field-invalid');

				}
				if (lname.val() == '') {
					lname.addClass('field-invalid');
				} else {
					lname.removeClass('field-invalid');

				}
				if (adderss1.val() == '') {
					adderss1.addClass('field-invalid');
				} else {
					adderss1.removeClass('field-invalid');

				}
				if (country.val() == '') {
					country.addClass('field-invalid');
				} else {
					country.removeClass('field-invalid');

				}
				if (city.val() == '') {
					city.addClass('field-invalid');
				} else {
					city.removeClass('field-invalid');

				}
				if (post.val() == '') {
					post.addClass('field-invalid');
				} else {
					post.removeClass('field-invalid');

				}
				if (phone.val() == '') {
					phone.addClass('field-invalid');
				} else {
					phone.removeClass('field-invalid');

				}
				if (email.val() == '') {
					email.addClass('field-invalid');
				} else {
					email.removeClass('field-invalid');

				}
				return false;
			}

		}

		e.preventDefault();
	});
	$('.btn-stepprev').click(function (e) {
		$('.nav-checkout-step > li > .active').closest('li').prev('li').find('a').trigger('click');
		$('.nav-checkout-step > li > .active').closest('li').next('li').removeClass('item-step-completed');
		e.preventDefault();
	});


	$('#checkBillingAddress').change(function () {
		if ($('input#checkBillingAddress').is(':checked')) {


			console.log('checked');

			//$(this).closest('.sec-billing-address').find('#billing-address-block').slideUp();
			var fname = $('#shipping_first_name').val();
			var lname = $('#shipping_last_name').val();
			var adderss1 = $('#shipping_address_1').val();
			var adderss2 = $('#shipping_address_2').val();
			var country = $('#shipping_country').val();
			var city = $('#shipping_city').val();
			var post = $('#shipping_postcode').val();
			var phone = $('#shipping_phone').val();

			$('#billing_first_name').val(fname);
			$('#billing_last_name').val(lname);
			$('#billing_address_1').val(adderss1);
			$('#billing_address_2').val(adderss2);
			$('#billing_country').val(country);
			$('#billing_city').val(city);
			$('#billing_postcode').val(post);
			$('#billing_phone').val(phone);


		}
		else {
			console.log('unchecked');
			//$(this).closest('.sec-billing-address').find('#billing-address-block').slideDown();
			$('#billing_first_name').val('');
			$('#billing_last_name').val('');
			$('#billing_address_1').val('');
			$('#billing_address_2').val('');
			$('#billing_country').val('');
			$('#billing_city').val('');
			$('#billing_postcode').val('');
			$('#billing_phone').val('');
		}

	});


	$('#imageZoomModal').on('shown.bs.modal', function (e) {
		$('.imagezoom-slider').slick();
	})
	$('#imageZoomModal').on('hide.bs.modal', function (e) {
		$('.imagezoom-slider').slick("unslick");
	})

	$('.navbar__only_mobile.bg-transparent-fixed-top #navbarCollapse').on('show.bs.collapse', function (e) {
		$(this).closest('.navbar__only_mobile')
			.addClass('bg-white navbar-light bg-solid-fixed-top')
			.removeClass('navbar-dark bg-transparent-fixed-top bg-transparent');
	})
	$('.navbar__only_mobile.bg-transparent-fixed-top #navbarCollapse').on('hidden.bs.collapse', function (e) {
		$(this)
			.closest('.navbar__only_mobile')
			.removeClass('bg-white navbar-light bg-solid-fixed-top n-open')
			.addClass('navbar-dark bg-transparent-fixed-top bg-transparent');
	});

	$('.dropdown-search').on('show.bs.dropdown', function () {
		$(this).closest('body').addClass('open-search');
		$(this).closest('body').append('<div class="navbar-overlay"></div>');
	})
	$('.dropdown-search').on('hidden.bs.dropdown', function () {
		$(this).closest('body').removeClass('open-search');
		$(this).closest('body').find('.navbar-overlay').remove();
	})

	if ($(window).width() > 992) {
		$('.nav-sitemain > .dropdown').hover(function () {
			$(this).find('.dropdown-menu').stop(true, true).fadeIn(300);
			$(this).closest('.fixed-top').addClass('n-open');
			$(this).closest('body').append('<div class="navbar-overlay"></div>');
		}, function () {
			$(this).find('.dropdown-menu').stop(true, true).fadeOut(300);
			$(this).closest('.fixed-top').removeClass('n-open');
			$(this).closest('body').find('.navbar-overlay').remove();
		});
	}
});


function heroSlider() {
	var $heroSlider = $('.hero-slider');
	if($heroSlider.length > 0) {
		$('.hero-slider').slick({
			dots: true,
			arrows: false,
			infinite: true,
		    autoplay: true,
		    autoplaySpeed: 8000,
			speed: 1000,
			slidesToShow: 1,
			pauseOnHover: false
		});
	}
}

function footerDarkDefault() {
	var bodyHeight = $('body.page, body.theme-rawbought').innerHeight();
	var docHeight = $window.innerHeight();

	if (bodyHeight <= docHeight) {
		$('#footer').css({
			"background-color": "#010101",
			"color": "white"
		}).addClass('footer-styled');
	}
}

function updateCartItems(key, num) {

	$.ajax({
		type: 'POST',

		url: ajax_login_object.ajaxurl,
		data: {
			'action': 'update_cart_quantity', //calls wp_ajax_nopriv_ajaxlogin
			'cart_item_key': key,
			'quantity': num

		},
		success: function (data) {
			$('.minicart-container-main').html(data);

			// //$(document.body).trigger('wc_fragment_refresh');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajax_login_object.ajaxurl,
				data: {
					'action': 'get_minicart_total', //calls wp_ajax_nopriv_ajaxlogin

				},
				success: function (response) {

					$('.minicart-total-count').html(response);


					$('.full-page-loader').removeClass('optional-overlay');


				},
				error: function (request, status, error) {

				}
			});

		},
		error: function (request, status, error) {

		}
	});



}

function Rawbought_QuantityMini() {
	var incrementPlus;
	var incrementMinus;

	var buttonPlus = $(".btn-plus-mini");
	var buttonMinus = $(".btn-minus-mini");

	var incrementPlus = $(document).on("click", '.btn-plus-mini', function () {
		$('.full-page-loader').addClass('optional-overlay');
		var $n = $(this)
			.closest(".product-quantity-default")
			.find(".input-quantity");
			var cart_key = $n.attr('cart_key');
		//$n.val(Number($n.val()) + 1);
		$( 'input[cart_key="'+cart_key+'"]' ).val(Number($n.val()) + 1);
		
		$n.siblings('.main-qt-wrp').find('.qty').val($n.val()).trigger('change');

		

		//console.log($n.siblings('.main-qt-wrp').find('.qty').val());
		updateCartItems(cart_key, $n.val());
		$('.full-page-loader').removeClass('optional-overlay');

		timeout = setTimeout(function () {

			jQuery("[name='update_cart']").prop("disabled", false);
			jQuery('[name="update_cart"]').trigger('click');
		}, 1000);
		//$( ".update_cart_btn" ).trigger( "click" );

		// var qty = $n.val();
		// var cart_item_key = $(this).attr("cart-item-key");






		//	$( document.body ).trigger( 'updated_cart_totals' );

	});

	var incrementMinus = $(document).on("click", '.btn-minus-mini', function () {
		
		$('.full-page-loader').addClass('optional-overlay');
		var $n = $(this)
			.closest(".product-quantity-default")
			.find(".input-quantity");
		var amount = Number($n.val());
		if (amount > 0) {
			var cart_key = $n.attr('cart_key');
			$( 'input[cart_key="'+cart_key+'"]' ).val(Number(amount - 1));

			//$n.val(amount - 1);
			$n.siblings('.main-qt-wrp').find('.qty').val($n.val()).trigger('change');


			//	console.log($n.siblings('.main-qt-wrp').find('.qty').val());
			updateCartItems(cart_key, $n.val());
			$('.full-page-loader').removeClass('optional-overlay');

			timeout = setTimeout(function () {
				jQuery("[name='update_cart']").prop("disabled", false);
				jQuery('[name="update_cart"]').trigger('click');
			}, 500);

		}
	});
}

function Rawbought_Quantity() {
	var incrementPlus;
	var incrementMinus;

	var buttonPlus = $(".btn-plus");
	var buttonMinus = $(".btn-minus");

	var incrementPlus = $(document).on("click", '.btn-plus', function () {
		$('.full-page-loader').addClass('optional-overlay');
		var $n = $(this)
			.closest(".product-quantity-default")
			.find(".input-quantity");
		$n.val(Number($n.val()) + 1);
		$n.siblings('.main-qt-wrp').find('.qty').val($n.val()).trigger('change');

		var cart_key = $n.attr('cart_key');

		//console.log($n.siblings('.main-qt-wrp').find('.qty').val());
		updateCartItems(cart_key, $n.val());
		$('.full-page-loader').removeClass('optional-overlay');

		timeout = setTimeout(function () {

			jQuery("[name='update_cart']").prop("disabled", false);
			jQuery('[name="update_cart"]').trigger('click');
		}, 1000);
		//$( ".update_cart_btn" ).trigger( "click" );

		// var qty = $n.val();
		// var cart_item_key = $(this).attr("cart-item-key");






		//	$( document.body ).trigger( 'updated_cart_totals' );

	});

	var incrementMinus = $(document).on("click", '.btn-minus', function () {
		
		$('.full-page-loader').addClass('optional-overlay');
		var $n = $(this)
			.closest(".product-quantity-default")
			.find(".input-quantity");
		var amount = Number($n.val());
		if (amount > 0) {
			$n.val(amount - 1);
			$n.siblings('.main-qt-wrp').find('.qty').val($n.val()).trigger('change');

			var cart_key = $n.attr('cart_key');

			//	console.log($n.siblings('.main-qt-wrp').find('.qty').val());
			updateCartItems(cart_key, $n.val());
			$('.full-page-loader').removeClass('optional-overlay');

			timeout = setTimeout(function () {
				jQuery("[name='update_cart']").prop("disabled", false);
				jQuery('[name="update_cart"]').trigger('click');
			}, 500);

		}
	});
}


function Rawbought_NavbarFixedMobile() {
	jQuery(window).scroll(function () {
		var $ww = jQuery(window).width();
		if ($ww <= 991.98) {
			var sTop = jQuery(window).scrollTop();
			if (sTop > 60) {
				jQuery('.navbar__only_mobile.bg-transparent-fixed-top').addClass('-stucked bg-white navbar-light bg-solid-fixed-top').removeClass('navbar-dark bg-transparent-fixed-top bg-transparent');
			}
			else if (sTop <= 59 && ($('.navbar__only_mobile').hasClass('bg-transparent-fixed-top'))) {
				jQuery('.navbar__only_mobile').find('.collapse').collapse('hide')
			}
			else {
				jQuery('.navbar__only_mobile.bg-solid-fixed-top').removeClass('-stucked bg-white navbar-light bg-solid-fixed-top').addClass('navbar-dark bg-transparent-fixed-top bg-transparent');
			}
		}
	});
}



function init__productPreviewSliderMobile() {
	if ($('.product-preview-slider').length) {
		$('.product-preview-slider').slick({
			dots: true,
			arrows: false,
			slidesToShow: 1,
			centerMode: true,
			centerPadding: "100px",
			draggable: true,
			responsive: [
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						centerMode: false,
						centerPadding: "0px"
					}
				}
			]
		});
	}
}
function init__productPreviewMainSlider() {
	var $ww = $(window).width();
	if ($('#productMainSlider').length > 0) {
		if ($ww <= 767.98) {
			$('#productMainSlider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				dots: false,
				asNavFor: '#productMainSliderNav'
			});
			$('#productMainSliderNav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '#productMainSlider',
				dots: false,
				arrows: false,
				centerMode: true,
				focusOnSelect: true
			});
		}
	}
}
function init__productSliderNav() {
	if ($('.product-slider-nav').length > 0) {
		$('.product-slider-nav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			dots: false,
			arrows: false,
			centerMode: true,
			focusOnSelect: true
		});
	}
}

function init__zoomImage() {
	var $ww = $(window).width();
	var $zoomSel = $('.xzoom');
	if ($zoomSel.length > 0) {
		if ($ww >= 768) {
			$('.xzoom, .xzoom-gallery').xzoom();
		}
	}
}


function Rawbought_NavbarFixedDesktop() {
	$(window).scroll(function () {
		var $ww = $(window).width();
		if ($ww >= 768) {
			var sTop = $(window).scrollTop();
			if (sTop > 15) {
				$('.navbar__only_desktop.bg-transparent-fixed-top')
					.addClass('-stucked bg-white navbar-light')
					.removeClass('navbar-dark bg-transparent');
			} else {
				$('.navbar__only_desktop.bg-transparent-fixed-top')
					.removeClass('-stucked bg-white navbar-light')
					.addClass('navbar-dark bg-transparent');
			}
		}
	});
}
$('.nav-sitemain .dropdown').mouseenter(function (e) {
	var $this = $(this).closest('.navbar');
	if ($this.hasClass('bg-transparent') && ($(window).scrollTop() < 14)) {
		$(this).closest('.navbar')
			.removeClass('bg-transparent navbar-dark')
			.addClass('bg-white navbar-light');
	}
});
$('.nav-sitemain .dropdown').mouseleave(function (e) {
	var $this = $(this).closest('.navbar');
	if ($this.hasClass('bg-transparent-fixed-top') && ($(window).scrollTop() < 1)) {
		$(this).closest('.navbar')
			.addClass('bg-transparent navbar-dark')
			.removeClass('bg-white navbar-light');
	}
});

function init__priceRange() {
	if ($('#priceRange').length) {
		var priceRange = $("#priceRange").slider();
		var min = priceRange.data('slider').options.value[0];
		var max = priceRange.data('slider').options.value[1];
		var _minvalue = $('.minval-value');
		var _maxvalue = $('.maxval-value');
		_minvalue.text(min);
		_maxvalue.text(max);
		priceRange.on("slide", function(slideEvtMin) {
			_minvalue.text(slideEvtMin.value[0]);
			_maxvalue.text(slideEvtMin.value[1]);
		});
	}
}
function Rawbought_add_to_cart() {


}
function destroyCarousel() {
	if ($('.product-quickview-imageslider').hasClass('slick-initialized')) {
		$('.product-quickview-imageslider').slick('destroy');
	}
}
function Rawbought_ajaxQuickview() {


	$('.attribute_color_btn').click(function (event) {
		var selectedcolor = $(this).val();
		$('.attribute_color').val(selectedcolor);
		$('.attribute_color_btn').removeClass('active');
		$(this).addClass('active');
	});

	$('.attribute_size_btn').click(function (event) {
		var selectedcolor = $(this).val();
		$('.attribute_size').val(selectedcolor);
		$('.attribute_size_btn').removeClass('active');
		$(this).addClass('active');
	});

	$('.ajax-quickview').click(function (event) {
		var product_id = $(this).attr('product_id');
		console.log(product_id);
		var buttonthis = $(this);
		buttonthis.attr("disabled", true);

		$(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Quick View');


		$.ajax({
			type: 'POST', url: ajax_login_object.ajaxurl, data: {
				'action': 'get_product_quickview_modal_content', //calls wp_ajax_nopriv_ajaxlogin
				product_id: product_id,

			}, success: function (result) {
				buttonthis.attr("disabled", false);
				buttonthis.html('Quick View');
				$('.quickview-content').html(result);
				$('#quickviewModal').modal();
				$('#quickviewModal').on('shown.bs.modal', function (e) {
					$('.product-quickview-imageslider').slick();
				});
				$('#quickviewModal').on('hide.bs.modal', function (e) {
					$('.product-quickview-imageslider').slick("unslick");
				});

				var customQty = $('.custom-select-quantity').val();
				console.log(customQty);
				$('.product-var-qty > select')
					.val(customQty)
					.trigger('change');

				var activeQuantityval = $('.attribute_colour_btn.active').attr('color-name');

				var activeColorName = $('.attribute_colour_btn.active').attr('color-name');
				var activeColorNameVal = $('.attribute_colour_btn.active').val();
				var activeSizeName = $('.attribute_size_btn.active').attr('size-name');
				var activeSizeNameVal = $('.attribute_size_btn.active').val();
				$('.product-color-name').html(activeColorName);
				$('.product-size-name').html(activeSizeName);

				$('#pa_colour')
					.val(activeColorNameVal)
					.trigger('change');

				$('#pa_size')
					.val(activeSizeNameVal)
					.trigger('change');

				$('.custom-select-quantity').change(function () {
					$('.product-var-qty > select')
						.val($(this).val())
						.trigger('change');
					console.log($(this).val());
				});
				$('.attribute_colour_btn').click(function () {
					$('.attribute_colour_btn').removeClass('active');
					$(this).addClass('active');
					$('.product-color-name').html($(this).attr('color-name'));
					$('#pa_colour')
						.val($(this).val())
						.trigger('change');
				});
				$('.attribute_size_btn').click(function () {
					$('.attribute_size_btn').removeClass('active');
					$(this).addClass('active');
					$('.product-size-name').html($(this).attr('size-name'));
					$('#pa_size')
						.val($(this).val())
						.trigger('change');
				});
				$('.add-to-cart-btn').click(function () {
					console.log($('#pa_colour').val());
					console.log($('#pa_size').val());


					$('.single_add_to_cart_button').trigger('click');
				});

				$(".variations_form").submit(function (e) {

					e.preventDefault(); // avoid to execute the actual submit of the form.

					var form = $(this);
					var url = form.attr('action');

					$.ajax({
						type: "POST",
						url: url,
						data: form.serialize(), // serializes the form's elements.
						success: function (data) {
							console.log(data);
							$(document.body).trigger('wc_fragment_refresh');
							jQuery('#cartModal').modal('show');


							$.ajax({
								type: 'POST',
								dataType: 'json',
								url: ajax_login_object.ajaxurl,
								data: {
									'action': 'get_minicart', //calls wp_ajax_nopriv_ajaxlogin

								},
								success: function (response) {
									setTimeout(function () {

										$('#cartModal > .modal-content').html(response);


									}, 2000);


								},
								error: function (request, status, error) {

								}
							});


						}
					});


				});






			}
		});


		// $('.ajax-quickview').magnificPopup({
		// 	type: 'ajax',
		// 	ajax: {
		// 		settings: {
		// 			type: 'POST',
		// 			data: {
		// 				action: 'get_product_quickview_modal_content',
		// 				product_id: product_id
		// 			}
		// 		}, // Ajax settings object that will extend default one - http://api.jquery.com/jQuery.ajax/#jQuery-ajax-settings
		// 		// For example:
		// 		// settings: {cache:false, async:false}

		// 		//cursor: 'mfp-ajax-cur', // CSS class that will be added to body during the loading (adds "progress" cursor)
		// 		//tError: '<a href="%url%">The content</a> could not be loaded.' //  Error message, can contain %curr% and %total% tags if gallery is enabled
		// 	},
		// 	callbacks: {
		// 		parseAjax: function (mfpResponse) {
		// 			console.log('Ajax content loaded:', mfpResponse);
		// 		},
		// 		ajaxContentAdded: function () {
		// 			// Ajax content is loaded and appended to DOM
		// 			$('#productMainSliderQuickview').slick({
		// 				slidesToShow: 1,
		// 				slidesToScroll: 1,
		// 				arrows: true,
		// 				dots: false,
		// 				fade: true,
		// 			});
		// 		}
		// 	}
		// });
	});
}
/*function init__productImgZoomSlider() {
	if ($('#productMainSlider').length > 0) {
		$('#productMainSlider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			swipe: false,
			dots: false,
			asNavFor: '#productMainSliderNav'
		});

		$('#productMainSliderNav').slick({
			slidesToShow: 3,
			slidesToScroll: 1,
			asNavFor: '#productMainSlider',
			dots: false,
			arrows: false,
			centerMode: true,
			focusOnSelect: true
		});

		$('.zoom-proimg').zoom({ magnify: 2 });
	}
}*/

function init__footerCollapse() {
	var $ww = $(window).width();
	if ($ww <= 575.98) {
		$('.foo-collapse').slideUp();
		$('.foo-collapse-item').on('click', '.foo-title', function (e) {
			$(this).closest('.foo-collapse-item').toggleClass('f-uncollapsed').find('.foo-collapse').toggleClass('show').slideToggle();
		});
	}
}

function init__productImgZoomSlider() {
	if (win_width >= 768) {
		if ($('#productMainSlider').length > 0) {
			$('#productMainSlider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				swipe: false,
				dots: false,
				asNavFor: '#productMainSliderNav'
			});
			$('#productMainSliderNav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '#productMainSlider',
				dots: false,
				arrows: false,
				centerMode: true,
				focusOnSelect: true
			});
		}
		if ($('.zoom-proimg').length > 0) {
			$('.zoom-proimg').zoom({ on: 'click', magnify: 2 });
		}
	}
}
function init__productImgSliderMobile() {
	if (win_width <= 767.98) {
		if ($('#productMainSlider').length > 0) {
			$('#productMainSlider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				swipe: true,
				dots: false,
			});
		}
	}
}

function init__accordionGutenberg() {
	var $acoItem = $(".schema-faq-section");
	var $acoQes = $(".schema-faq-question");
	var $acoAns = $(".schema-faq-answer");

	$acoItem.each(function () {
		$(".schema-faq-section:first-child").addClass('active').find('.schema-faq-answer').slideDown(200);
	});

	$acoItem.on("click", ".schema-faq-question", function () {
		if ($(this).closest('.schema-faq-section').hasClass('active')) {
			$(this).closest('.schema-faq-section').removeClass("active").find(".schema-faq-answer").slideUp(200);
		} else {
			$('.schema-faq-section').removeClass("active");
			$(this).closest('.schema-faq-section').addClass('active');
			$('.schema-faq-section').find('.schema-faq-answer').slideUp(200);
			$(this).closest('.schema-faq-section').find(".schema-faq-answer").slideDown(200);
		}
	});
}

/*$('.product-size-lists').on('click', '.btn', function() {
	$('.product-size-lists').find('.btn').removeClass('active');
	$(this).addClass('active')
});*/



$('.btn-quick-add').on('click', function () {
	$(this).closest('.raw-product').find('.product-quick').addClass('-showing');
});
$('.btn-quick-add--cancel').on('click', function () {
	$(this).closest('.raw-product').find('.product-quick').removeClass('-showing');
});


$("#navMobile").metisMenu();

$('#modalSearch').on('show.bs.modal', function (e) {
	$(this).closest('body').addClass('modal_search__open');
	$('.input-search').trigger('focus')
});
$('#modalSearch').on('shown.bs.modal', function (e) {
	$('.input-search').trigger('focus')
});
$('#modalSearch').on('hidden.bs.modal', function (e) {
	$(this).closest('body').removeClass('modal_search__open');
})

if ($(window).width() >= 768) {
	$('.dropdown-cart').hover(function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
	}, function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
	});
}

$(window).scroll(function () {
	var fooHeight = $('#footer').innerHeight() / 2;
	if ($(window).scrollTop() + $(window).height() > $(document).height() - fooHeight) {
		$('#footer').css({
			"background-color": "#010101",
			"color": "white"
		}).addClass('footer-styled');
	} else {
		$('#footer').css({
			"background-color": "",
			"color": ""
		}).removeClass('footer-styled');
	}
});

function init__rawbought__pageoffset() {
	var hash = window.location.hash
	if (hash == '' || hash == '#' || hash == undefined) return false;


	var target = $(hash);

	var n_Height = 66;

	target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

	if (target.length) {
		$('html,body').stop().animate({
			scrollTop: target.offset().top - n_Height //offsets for fixed header
		}, 'linear');
	}
}
init__rawbought__pageoffset();

// PAGE PRELOADER 
function init__preLoader() {
	$window.on('load', function ($) {
		var $preloaderHolder = jQuery('#site-preloader');
		var $preloader = jQuery('#preloader');
		$preloaderHolder.addClass('loaded');
		if ($preloaderHolder.hasClass('loaded')) {
			$preloader.delay(200).queue(function () {
				jQuery(this).closest('body').removeClass('is-preloader');
				jQuery(this).remove();
			});
		}
	})
}
init__preLoader();



