<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CNZ_Theme
 */

get_header();
?>
<div class="inner-page-wrap error-404-wrap">
    <?php
    /**
    * Hook - CNZ_Theme_title_breadcrumb.
    *
    * @hooked CNZ_Theme_title_breadcrumb_action - 10
    */
    do_action( 'CNZ_Theme_title_breadcrumb' );
    ?>
    <div class="inner-entry">
        <div id="primary" class="content-area">
            <div id="main" class="site-main">
                <div class="__os-container__">
                    <div class="entry-404">
                        <div class="top-block">
                            <div class="title">
                                <h1 class="entry-title"><?php esc_html_e( '4', 'cnz-pwste' ); ?><span><?php esc_html_e( '0', 'cnz-pwste' ); ?></span><?php esc_html_e( '4', 'cnz-pwste' ); ?></h1>
                            </div><!-- .title -->
                            <div class="sub-title">
                                <h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cnz-pwste' ); ?></h2>
                            </div><!-- .sub-title -->
                            <div class="excerpt">
                                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cnz-pwste' ); ?></p>
                            </div><!-- .excerpt -->
                        </div><!-- .top-block -->
                        <div class="bottom-block">
                            <div class="search-form-entry">
                                <?php get_search_form(); ?>
                            </div>
                        </div><!-- .bottom-block -->
                    </div><!-- .entry-404 -->
                </div><!-- .__os-container__ -->
            </div><!-- #main.site-main -->
        </div><!-- #primary.content-area -->
    </div><!-- .inner-entry -->
</div><!-- .inner-page-wrap -->
<?php
get_footer();
