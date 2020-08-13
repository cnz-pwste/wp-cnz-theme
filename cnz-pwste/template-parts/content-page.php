<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CNZ_Theme
 */

$cnz_display_featured_image = cnz_get_option( 'display_page_featured_image' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

	if( cnz_get_option( 'display_page_header' ) == false ) {
		?>
		<h1 class="entry-title page-title"><?php the_title(); ?></h1>
		<?php
	} 

	if( $cnz_display_featured_image == true && has_post_thumbnail() && ! post_password_required() ) {
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