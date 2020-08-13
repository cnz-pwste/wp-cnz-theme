<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CNZ_Theme
 */

get_header();
?>
<div class="inner-page-wrap default-page-wrap default-page-s1">
    <?php
    /**
	* Hook - cnz_title_breadcrumb.
	*
	* @hooked cnz_title_breadcrumb_action - 10
	*/
	do_action( 'cnz_title_breadcrumb' );
	?>
    <div class="__os-container__">
        <div class="os-row">
            <div class="<?php cnz_content_container_class(); ?>">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                    	<?php
                    	while( have_posts() ) :

                    		the_post();

                    		get_template_part( 'template-parts/content', 'single' );

                    		/**
	                        * Hook - cnz_post_navigation.
	                        *
	                        * @hooked cnz_post_navigation_action - 10
	                        */
	                        do_action( 'cnz_post_navigation' );

                    		// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

                    	endwhile;
                    	?>
                    </main><!-- #main.site-main -->
                </div><!-- #primary.content-area -->
            </div><!-- .col -->
            <?php get_sidebar(); ?>
        </div><!-- .row -->
    </div><!-- .os-container -->
</div><!-- .inner-page-wrap.default-page-wrap.default-page-s1 -->
<?php
get_footer();
