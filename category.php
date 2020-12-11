<?php
die();
get_header();
?>
<main id="main-content">
    <div class="has-fixed-navbar"></div>
    <section class="section section-sm">
        <div class="container container-md-fluid">
            <div class="header-jumbotron profile-header-jumbotron">
                <div class="jumbotron-legend">
                    <h1 class="jumbotron-title h2"><?php single_cat_title(); ?></h1>
                </div>
                <div class="jumbotron-navwrap journal-navwrapper">
                    <ul class="nav-journal">
                        <?php

                        $postCategorys = get_categories();
                        if (count($postCategorys) > 0) {
                            foreach ($postCategorys as $category) {
                        ?>
                                <li><a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a></li>
                        <?php }
                        } ?>
                    </ul>
                    <div class="journal-searchwrap">
                        <form action="/" method="get">
                            <div class="journal-search">
                                <input type="text" class="form-control" name="s" placeholder="Search Articles">

                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row journal-posts">
                <?php
                while (have_posts()) :
                    the_post();
                    $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                    if (!empty($post_thumbnail_id)) {
                        $post_thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'large'); //get thumbnail image url			
                        $image_src = $post_thumbnail_src[0];
                    } else {
                        $image_src = get_template_directory_uri() . '/assets/images/product-placeholder.jpg';
                    }
                ?>

                    <div class="col-sm-6 col-lg-4 col-mb">
                        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="post post-standard">
                            <div class="post-media">
                                <div class="post-image">
                                    <img src="<?php echo $image_src; ?>" alt="">
                                </div>
                            </div>
                            <div class="post-content">
                                <h6 class="post-title"><?php the_title();?></h6>
                                <div class="post-text">
                                    <?php echo substrwords(get_the_excerpt(), 20, ''); ?> </div>
                            </div>
                            <div class="post-footer">
                                <div class="post-actions">
                                    <span class="a-linked">Read More <i class="ti-angle-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                <?php
                endwhile; // End of the loop.
                ?>

                <?php wp_reset_postdata(); ?>



            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>