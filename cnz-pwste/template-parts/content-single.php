<?php
/**
 * Template part for displaying post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CNZ_Theme
 */
$cnz_show_tags 		= cnz_get_option( 'display_post_tags' );
$cnz_show_categories	= cnz_get_option( 'display_post_cats' );
$cnz_show_author		= cnz_get_option( 'display_post_author' );
$cnz_show_date			= cnz_get_option( 'display_post_date' );
$cnz_show_featured_img	= cnz_get_option( 'display_page_featured_image' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	if( cnz_get_option( 'display_page_header' ) == false ) {
		?>
		<h1 class="entry-title page-title"><?php the_title(); ?></h1>
		<?php
	} 

	if( $cnz_show_featured_img == true && has_post_thumbnail() && ! post_password_required() ) {
		?>
		<div class="thumb featured-thumb">
	       	<?php
	       	the_post_thumbnail( 'full', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
	       	?>
	    </div><!-- .thumb.featured-thumb -->
	    <?php
	}

	?>

	<div class="inner-content-metas">

	<?php 

	if( $cnz_show_categories == true ) {
        /**
        * Hook - cnz_post_categories.
        *
        * @hooked cnz_post_categories_action - 10
        */
        do_action( 'cnz_post_categories' );
    }

    if( $cnz_show_date == true || $cnz_show_author == true ) {
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

	</div><!-- // inner-content-metas -->
	<div class="<?php cnz_content_entry_class(); ?>">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cnz-pwste' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .editor-entry -->
	<?php
	if( $cnz_show_tags == true ) {
		/**
	    * Hook - cnz_post_tags.
	    *
	    * @hooked cnz_post_tags_action - 10
	    */
	    do_action( 'cnz_post_tags' );
	}

    if ( get_edit_post_link() ) :
	    edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cnz-pwste' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->