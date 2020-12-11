<?php
/**
 * Template name: About Page
 * 
 */

 get_header();
?>

<main id="main-content">
        <div class="has-fixed-navbar"></div>
        <!-- <section class="section hero-page d-flex align-items-center" style="background-image: url('assets/images/bg/3.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-11 col-xl-10 mx-auto text-center block-text-light">
                        <h1 class="hero-heading">We are Rawbought</h1>
                    </div>
                </div>
            </div>
        </section> -->
        <?php
		while ( have_posts() ) :
			the_post();
			$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            if (!empty($post_thumbnail_id)) {
                $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                $image_src = $post_thumbnail_src[0];
            } else {
                $image_src = '';
            }
?>
        
        <section class="section hero-default-lg hero-blank-page d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="hero-heading"><?php the_title();?></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container container-md-fluid">
                <div class="flexions">
                    <?php the_content();?>
                    <!-- <div class="row align-items-center flexion">
                        <div class="col-md-5 order-md-2">
                            <div class="flexion-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/ab/1.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7 order-md-1">
                            <div class="flexion-content pr-md-4 pr-xl-5">
                                <h3 class="flexion-title">Behind the Seams</h3>
                                <div class="flexion-text">
                                    <p>
                                        Our designs sit just as comfortably on your body as it does with your conscious. As a brand, it’s no longer enough to offer clothes that just look beautiful. We believe that where they’re produced and how they’re produced are just as important.
                                    </p>
                                    <p>
                                        Each and every one of our products are cut, stitched and packed in our own manufacturing facilities. Before Rawbought was born, we started out as manufacturers and this is still our greatest strength. Over the years we’ve worked with some of the largest retailers around the world and have gained a tone of experience.
                                    </p>
                                    <p>
                                        At Rawbought, we only use our own supply base to ensure that our values are never compromised, from the moment the materials are sourced from the earth till they reach your hands.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center flexion">
                        <div class="col-md-5">
                            <div class="flexion-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/ab/2.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="flexion-content pl-md-4 pl-xl-5">
                                <h3 class="flexion-title">Face of the Mannequin</h3>
                                <div class="flexion-text">
                                    <p>
                                        Rawbought is the brainchild of three sisters who grew up behind the scenes of the fashion industry. We want to dress strong, powerful women navigating through everything life throws at us. We are our customer just as much as you are.
                                    </p>
                                    <p>
                                        We believe that balancing work, family and our personal life should be done while dressed comfortably and consciously.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center flexion">
                        <div class="col-md-5 order-md-2">
                            <div class="flexion-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/ab/3.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7 order-md-1">
                            <div class="flexion-content pr-md-4 pr-xl-5">
                                <h3 class="flexion-title">Glacial Fashion</h3>
                                <div class="flexion-text">
                                    <p>
                                        At Rawbought, we’re fighting Fast Fashion and striving for Glacial Fashion – the slower the better. Our products are made to last wear after wear and season after season. We want you to get your money’s worth, and the planet to get a fighting chance.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center flexion">
                        <div class="col-md-5">
                            <div class="flexion-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/ab/4.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="flexion-content pl-md-4 pl-xl-5">
                                <h3 class="flexion-title">Behind the Seams</h3>
                                <div class="flexion-text">
                                    <p>
                                        Our designs sit just as comfortably on your body as it does with your conscious. As a brand, it’s no longer enough to offer clothes that just look beautiful. We believe that where they’re produced and how they’re produced are just as important.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center flexion">
                        <div class="col-md-5 order-md-2">
                            <div class="flexion-image">
                                <img src="<?php echo get_template_directory_uri();?>/assets/images/ab/5.jpg" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7 order-md-1">
                            <div class="flexion-content pr-md-4 pr-xl-5">
                                <h3 class="flexion-title">Face of the Mannequin</h3>
                                <div class="flexion-text">
                                    <p>
                                        Rawbought is the brainchild of three sisters who grew up behind the scenes of the fashion industry. We want to dress strong, powerful women navigating through everything life throws at us. We are our customer just as much as you are.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <?php 
		endwhile; // End of the loop.
		?>
    </main>

<?php get_footer();?>