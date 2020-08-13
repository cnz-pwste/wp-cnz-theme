<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CNZ_Theme
 */
$cnz_show_featured_image   = cnz_get_option( 'search_featured_image' );
$cnz_show_categories       = cnz_get_option( 'search_display_cats' );
$cnz_show_excerpt          = cnz_get_option( 'search_display_excerpt' );
$cnz_show_author           = cnz_get_option( 'search_display_author' );
$cnz_show_date             = cnz_get_option( 'search_display_date' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="os-row">
        <?php
        if( has_post_thumbnail() && ! post_password_required() && $cnz_show_featured_image == true ) {
            ?>
            <div class="os-col thumb-col">
                <div class="thumb imghover">
                    <a href="<?php the_permalink(); ?>">
                    	<?php 
                    	the_post_thumbnail( 'cnz-pwste-thumbnail-extra-large', array(
    						'alt' => the_title_attribute( array(
    							'echo' => false,
    						) ),
    					) ); 
    					?>
    			</a>
                </div><!-- .thumb.imghover -->
            </div><!-- .os-col.thumb-col -->
            <?php
        }
        ?>
        <div class="os-col content-col">
            <div class="box">
                <?php
                if( $cnz_show_categories == true ) {
                    /**
                    * Hook - cnz_post_categories.
                    *
                    * @hooked cnz_post_categories_action - 10
                    */
                    do_action( 'cnz_post_categories' );
                }
                ?>
                <div class="title">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div><!-- .title -->
                <?php
                if( $cnz_show_excerpt == true ) {
                    /**
                    * Hook - cnz_excerpt.
                    *
                    * @hooked cnz_excerpt_action - 10
                    */
                    do_action( 'cnz_excerpt' );
                }

                if( $cnz_show_author == true || $cnz_show_date == true ) {
                    ?>
                    <div class="entry-metas">
                        <ul>
                            <?php
                            if( $cnz_show_author == true ) {
                                /**
                                * Hook - cnz_post_author.
                                *
                                * @hooked cnz_post_author_action - 10
                                */
                                do_action( 'cnz_post_author' );
                            }

                            if( $cnz_show_date == true ) {
                                /**
                                * Hook - cnz_post_date.
                                *
                                * @hooked cnz_post_date_action - 10
                                */
                                do_action( 'cnz_post_date' );
                            }
                            ?>
                        </ul>
                    </div><!-- .entry-metas -->
                    <?php
                }
                ?>
            </div><!-- .box -->
        </div><!-- .os-col -->
    </div><!-- .os-row -->
</article><!-- #post-<?php the_ID(); ?> -->
