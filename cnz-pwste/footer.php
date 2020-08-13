<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CNZ_Theme
 */

?>
    </div><!-- #content.site-title -->

	<footer class="footer secondary-widget-area">
        <div class="footer-inner">
            <div class="footer-mask">
                <div class="__os-container__">
                    <div class="footer-entry">
                    	<?php 
                        if( cnz_get_option( 'display_footer_widget_area' ) == true ) {

                            $cnz_footer_widget_area_no = cnz_get_option( 'footer_widgets_area_columns' ); 
                            ?>
                            <div class="footer-top columns-<?php echo esc_attr( $cnz_footer_widget_area_no ); ?>">
                                <div class="row">
                                	<?php
                                	if( !empty( $cnz_footer_widget_area_no ) ) {

                                		for( $cnz_count = 1; $cnz_count <= $cnz_footer_widget_area_no; $cnz_count++ ) {
                                			$cnz_sidebar_id = 'footer-'.$cnz_count;
                                			?>
                                			<div class="os-col column">
        		                                <?php 
        		                                if( is_active_sidebar( $cnz_sidebar_id ) ) {
        		                                	dynamic_sidebar( $cnz_sidebar_id );
        		                                }
        		                                ?>
        		                            </div><!-- .col -->
                                			<?php
                                		}
                                	}
                                	?>
                                </div><!-- .row -->
                            </div><!-- .footer-top -->
                            <?php
                        }
                        ?>
                        <div class="footer-bottom">
                            <div class="os-row">
                                <div class="os-col copyrights-col">
                                    <?php
                                    /**
    		                        * Hook - cnz_footer_left.
    		                        *
    		                        * @hooked cnz_footer_left_action - 10
    		                        */
    		                        do_action( 'cnz_footer_left' );
                                    ?>
                                </div><!-- .os-col -->
                                <div class="os-col">
                                    <?php
                                    /**
    		                        * Hook - cnz_footer_right.
    		                        *
    		                        * @hooked cnz_footer_right_action - 10
    		                        */
    		                        do_action( 'cnz_footer_right' );
                                    ?>
                                </div><!-- .os-col -->
                            </div><!-- .os-row -->
                        </div><!-- .footer-bottom -->
                    </div><!-- .footer-entry -->
                </div><!-- .__os-container__ -->
            </div><!-- .footer-mask -->
        </div><!-- .footer-inner -->
    </footer><!-- .footer -->
    
    <?php  
    if( cnz_get_option( 'display_scroll_top_button' ) == true ) {
        ?>
        <div class="cnz-backtotop"><span><i class="bx bx-chevron-up"></i></span></div>
        <?php
    }
    ?>

</div><!-- .__os-page-wrap__ -->

<?php wp_footer(); ?>

</body>
</html>
