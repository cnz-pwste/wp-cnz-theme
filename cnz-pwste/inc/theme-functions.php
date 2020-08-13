<?php
/**
 * Necessary functions for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CNZ_Theme
 */


/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'cnz_lite_fonts_url' ) ) {
    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function cnz_lite_fonts_url() {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Inter font: on or off', 'cnz-pwste')) {
            $fonts[] = 'Inter:400,500,600,700,800';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
}


/**
 * Fallback For Main Menu
 */
if ( !function_exists( 'cnz_navigation_fallback' ) ) {

    function cnz_navigation_fallback() {
        ?>
        <ul class="primary-menu">
            <?php 
            wp_list_pages( array( 
                'title_li' => '', 
                'depth' => 4,
            ) ); 
            ?>
        </ul><!-- .primary-menu -->
        <?php    
    }
}

/**
 * Fallback For Special Menu
 */
if ( !function_exists( 'cnz_special_menu_fallback' ) ) {

    function cnz_special_menu_fallback() {


            $product_categories = cnz_all_product_categories();

            if( ! empty( $product_categories ) ) {
                ?>
                <ul class="category-navigation-list">
                    <?php 
                    foreach( $product_categories as $product_category ) {
                        ?>
                        <li><a href="<?php echo esc_url( get_term_link( $product_category->term_id, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $product_category->name ); ?>"><?php echo esc_html( $product_category->name ); ?></a></li>
                        <?php
                    }
                    ?>
                </ul><!-- .primary-menu -->
                <?php  
            }
        
    }
}


/**
 * Function to get post thumbnail alt text value.
 */
if( !function_exists( 'cnz_thumbnail_alt_text' ) ) {

    function cnz_thumbnail_alt_text( $post_id ) {

        $post_thumbnail_id = get_post_thumbnail_id( $post_id );

        $alt_text = '';

        if( !empty( $post_thumbnail_id ) ) {

            $alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
        }

        if( !empty( $alt_text ) ) {

            echo esc_attr( $alt_text );
        } else {

            the_title_attribute();
        }
    }
}

if( !function_exists( 'cnz_sidebar_position' ) ) {

    function cnz_sidebar_position() {

        $sidebar_position = '';

        $is_global_sidebar = cnz_get_option( 'enable_global_sidebar_position' );

        if( !is_active_sidebar( 'sidebar-1' ) ) {

            $sidebar_position = 'none';

            return $sidebar_position;
        }  

        if( $is_global_sidebar == true ) {

            $sidebar_position = cnz_get_option( 'global_sidebar_position' );

            return $sidebar_position;
        }

        if( is_home() ) {

            $sidebar_position = cnz_get_option( 'blog_sidebar_position' );
        }

        if( is_archive() ) {

            $sidebar_position = cnz_get_option( 'archive_sidebar_position' );
        }

        if( is_search() ) {

            $sidebar_position = cnz_get_option( 'search_sidebar_position' );
        }

        if( is_single() ) {

            if( cnz_get_option( 'enable_post_common_sidebar_position' ) == true ) {

                $sidebar_position = cnz_get_option( 'post_sidebar_position' );
            } else {

                $sidebar_position = get_post_meta( get_the_ID(), 'cnz_sidebar_position', true );

                if( empty( $sidebar_position ) ) {

                    $sidebar_position = 'right';
                }
            }            
        }

        if( is_page() ) {

            if( cnz_get_option( 'enable_page_common_sidebar_position' ) == true ) {

                $sidebar_position = cnz_get_option( 'page_sidebar_position' );
            } else {

                $sidebar_position = get_post_meta( get_the_ID(), 'cnz_sidebar_position', true );

                if( empty( $sidebar_position ) ) {

                    $sidebar_position = 'right';
                }
            }
        }

        return $sidebar_position;
    }
} 

/**
 * Filters For Excerpt Length
 */
if( !function_exists( 'cnz_excerpt_length' ) ) :
    /*
     * Excerpt More
     */
    function cnz_excerpt_length( $length ) {

        if( is_admin() ) {

            return $length;
        }

        $excerpt_length = cnz_get_option( 'excerpt_length' );

        if ( absint( $excerpt_length ) > 0 ) {
            
            $excerpt_length = absint( $excerpt_length );
        }

        return $excerpt_length;
    }
endif;
add_filter( 'excerpt_length', 'cnz_excerpt_length' );


/**
 * Filter For Excerpt More
 */
if( !function_exists( 'cnz_excerpt_more' ) ) :

    function cnz_excerpt_more( $more ) {

        if ( is_admin() ) {

            return $more;
        }

        return '';
    }
endif;
add_filter( 'excerpt_more', 'cnz_excerpt_more' );


if( !function_exists( 'cnz_search_form' ) ) :
    /**
     * Search form of the theme.
     *
     * @since 1.0.0
     */
    function cnz_search_form( $form ) {

        $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '"><label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'cnz-pwste' ) . '</label><input type="search" name="s" placeholder="' . esc_html_x( 'Type here to search', 'placeholder', 'cnz-pwste' ) . '" value="' . get_search_query() . '"><button type="submit"><i class="bx bx-search"></i></button></form>';

        return $form;
    }
endif;
add_filter( 'get_search_form', 'cnz_search_form', 10 );


/**
* Filter for default archive widget
*/

function cnz_default_archive_widget($links) {

    $links = str_replace('</a>&nbsp;(', '</a> <span class="count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter('get_archives_link', 'cnz_default_archive_widget');


/**
 * Filter the default categories widget
 */

function cnz_cat_count_span( $links ) {

    $links = str_replace( '</a> (', '</a><span class="count">(', $links );
    $links = str_replace( ')', ')</span>', $links );
    return $links;
}
add_filter( 'wp_list_categories', 'cnz_cat_count_span' );
