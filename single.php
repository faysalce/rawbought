<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rawbought
 */

get_header();
?>

<main id="main-content">
		<div class="has-fixed-navbar"></div>
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
        <section class="section section-sm article-single">
            <div class="container container-md-fluid">
                <div class="article-head text-center">
                    <div class="header-jumbotron">
                        <div class="jumbotron-legend">
                            <h1 class="jumbotron-title h2"><?php the_title();?></h1>
                        </div>
                        <div class="article-image">
                            <figure>
                                <img src="<?php echo $image_src;?>" alt="" class="img-fluid">
                            </figure>
                        </div>
                    </div>               
                </div>
                <div class="article-widget">
                    <?php the_content();?>
                </div>
            </div>
		</section>
		<?php 
		endwhile; // End of the loop.
		?>
	
    </main>


		
			

		

<?php
get_footer();
