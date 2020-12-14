<style>
        .has-modal-comingsoon {
            overflow: hidden;
        }
        .modal-comingsoon  {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2000;
            overflow: hidden;
        }
        .modal-comingsoon .navbar {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .modal-comingsoon .hero-comingsoon {
            position: relative;
            background-color: #fff;
            background-image: url('<?php echo get_template_directory_uri();?>/assets/images/bg_coming2.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100%;
            overflow: hidden;
        }
        .modal-comingsoon .hero-comingsoon:before {
            content: " ";
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: #010101;
            opacity: .25;
        }
        .modal-comingsoon .btn-emailus {
            font-size: 1.125rem !important;
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(0,0,0,.2);
        }
        .modal-comingsoon .btn-emailus:hover, .modal-comingsoon .btn-emailus:focus {
            background-color: rgba(0,0,0,.5);
        }
        .modal-comingsoon .comingsoon-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
        }
        .modal-comingsoon .group-common-header {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .modal-comingsoon .comingsoon-heading {
            font-size: 1.125rem;
            letter-spacing: .063rem;
            margin-bottom: .75rem !important;
        }
        .modal-comingsoon .navbar-brand img {
            width: 100%;
            max-width: 35px;
            height: auto;
        }
        .modal-comingsoon .brand-logo {
            width: 100%;
            max-width: 340px;
            margin-left: auto;
            margin-right: auto;
        }
        .modal-comingsoon .brand-logo img {
            width: 100%;
            height: auto;
        }
        .modal-comingsoon .launching-date {
            font-size: 2.5rem;
            font-weight: bold;
            line-height: 1.2;
            text-align: center;
            position: relative;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            width: 100%;
            flex: 0 0 100%;
        }
        .modal-comingsoon .launching-date:before {
            content: " ";
            display: block;
            width: 60px;
            height: 3px;
            background-color: #e9e8e9;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
        }
        .modal-comingsoon #countdown-clock {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            line-height: 1.2;
            position: relative;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
        }
        .modal-comingsoon #countdown-clock:before {
            content: " ";
            display: block;
            width: 60px;
            height: 3px;
            background-color: #e9e8e9;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
        }
        .modal-comingsoon .countdown-item {
            flex: 1;
            text-align: center;  
         }
        .modal-comingsoon .countdown-item span {
            display: block;
        }
        .modal-comingsoon .countdown-item span:nth-child(2) {
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: .063rem;
            text-transform: uppercase;
        }
        .modal-comingsoon .comingsoon-newsletter {
            background-color: transparent;
            padding: 0;
            min-height: auto;
            display: block;
        }
        .modal-comingsoon .footer {
            width: 100%;
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            padding: 1rem;
            z-index: 99;
        }
        .modal-comingsoon .social-lists {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
            display: flex;
            justify-content: center;
            text-align: center;
        }
        .modal-comingsoon .social-lists li:not(:last-child) {
            margin-right: 1.25rem;
        }
        .modal-comingsoon .social-lists a {
            font-size: 1.125rem;
            color: #e9e8e9;
            transition: all .3s ease;
        }
        .modal-comingsoon .social-lists a:hover, .modal-comingsoon .social-lists a:focus {
            color: #fff;
        }
        .modal-comingsoon .modal-emailnewsletter .modal-content {
            border: 2px solid #010101;
            border-radius: 0;
            -webkit-box-shadow: 0 0 50px rgba(1, 1, 1, 0.15);
            box-shadow: 0 0 50px rgba(1, 1, 1, 0.15);
        }
        .modal-comingsoon .modal-emailnewsletter .modal-header, 
        .modal-comingsoon .modal-emailnewsletter .modal-body {
            padding: 1.875rem 1.875rem;
        }
        .modal-comingsoon .modal-emailnewsletter .modal-header {
            padding-bottom: 0;
            border-bottom: 0;
        }
        .modal-comingsoon .comingsoon-newsletter-outside {
            margin-top: 1.5rem
        }
        .modal-comingsoon .comingsoon-newsletter-outside .common-text {
            margin-bottom: .75rem;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .form-control {
            border-color: #e9e8e9;
            color: #fff;
            transition: all .3s ease;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .form-control:focus {
            border-color: #fff;
            box-shadow: none;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .form-control:focus::placeholder {
            opacity: 0;
            color: transparent;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .form-control::placeholder {
            color: #e9e8e9;
            opacity: 1;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .form-control:-ms-input-placeholder {
            color: #e9e8e9;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .form-control::placeholder {
            color: #e9e8e9;
        }
        .modal-comingsoon .comingsoon-newsletter-outside .btn-light:hover, 
        .modal-comingsoon .comingsoon-newsletter-outside .btn-light:focus {
            background-color: #010101;
            border-color: #010101;
            color: #fff;
        }
        .modal-comingsoon .modal-thanks .modal-content {
            border: 2px solid #010101;
            border-radius: 0;
            box-shadow: 0 0 50px rgba(0,0,0, 0.15);
        }
        .modal-comingsoon .modal-thanks .modal-body {
            padding-top: 3rem;
            padding-bottom: 2rem;
        }
        .modal-comingsoon .modal-thanks .close {
            font-size: 2.5rem;
            line-height: 1;
            font-weight: 300;
            position: absolute;
            right: .75rem;
            top: .5rem;
        }
        .modal-comingsoon .box-thanks {
            width: 100%;
        }
        .modal-comingsoon .thanks-icon svg {
            width: 60px;
            margin: 0 auto 1.5rem;
        }
        .modal-comingsoon .thanks-text p:last-child {
            margin-bottom: 0;
        }
        @media (min-width: 768px) {
            .modal-comingsoon .modal-thanks .modal-body {
                padding-left: 3rem;
                padding-right: 3rem;
            }
            .modal-comingsoon .navbar-brand img {
                max-width: 50px;
            }
        }
        @media (min-width: 768px) and (max-width: 1199px) {
            .modal-comingsoon .hero-comingsoon {
                background-position: 22% center;
            }
        }
        @media (max-width: 575.98px) {
            .modal-comingsoon .hero-comingsoon {
                background-image: url('<?php echo get_template_directory_uri();?>/assets/images/bg_coming2_mobile.jpg') !important;
            }
            .modal-comingsoon .launching-date {
                font-size: 1.75rem;
            }
            .modal-comingsoon .comingsoon-newsletter-outside .form-control {
                font-size: .875rem;
            }
            .modal-comingsoon .comingsoon-newsletter-outside .btn-newsletter {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .modal-comingsoon .modal-cominsoon .navbar, .modal-comingsoon .modal-cominsoon #footer {
                padding-left: 0;
                padding-right: 0;
            }
        }
        @media (max-width: 298.98px) {
            .modal-comingsoon .comingsoon-newsletter-outside .form-control {
                font-size: .75rem;
                padding-left: .5rem;
                padding-right: .5rem;
            }
            .modal-comingsoon .comingsoon-newsletter-outside .btn-newsletter {
                font-size: .75rem;
                padding: .75rem;
            }
        }
    </style>

<div id="modal-comingsoon" class="modal-comingsoon ">
        <div class="section hero-comingsoon d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="comingsoon-container">
                            <div class="group-common-header block-text-light mb-0 text-center">
                                <div>
                                    <div class="brand-logo">
                                        <img src="<?php echo get_template_directory_uri();?>/assets/images/logo-light.svg" alt="">
                                    </div>
                                    <div class="launching-countdown-wrap">
                                        <div id="countdown-clock"></div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <ul class="social-lists">
                        <li><a href="https://www.facebook.com/rawboughtshop" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/rawboughtshop/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {

            jQuery('#countdown-clock').countdown('2020/12/14 22:00', function(event) {
              var $this = jQuery(this).html(event.strftime(''
                //+ '<div class="countdown-item"><span>%D</span> <span>Days</span></div> '
                + '<div class="countdown-item"><span>%H</span> <span>Hours</span></div> '
                + '<div class="countdown-item"><span>%M</span> <span>Minutes</span></div> '
                + '<div class="countdown-item"><span>%S</span> <span>Seconds</span></div>'));
            });
        });
    </script>
    