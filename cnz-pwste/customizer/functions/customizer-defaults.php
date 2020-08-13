<?php

if ( ! function_exists( 'cnz_get_option' ) ) {

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function cnz_get_option( $key ) {

        if ( empty( $key ) ) {
            return;
        }

        $fullkey = 'cnz_field_'. $key;

        $value = '';

        $default = cnz_get_default_theme_options();

        $default_value = null;

        if ( is_array( $default ) && isset( $default[ $key ] ) ) {
            $default_value = $default[ $key ];
        }

        if ( null !== $default_value ) {
            $value = get_theme_mod( $fullkey, $default_value );
        }
        else {
            $value = get_theme_mod( $fullkey );
        }

        return $value;
    }
}


if ( ! function_exists( 'cnz_get_default_theme_options' ) ) {

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function cnz_get_default_theme_options() {

        $defaults = array(

            'site_layout' => 'fullwidth',

            'logo_mobile' => '',

            'display_top_header' => false,
            'display_menu_or_login_register_link' => 'login_register',
            'top_header_social_links' => '',

            'display_special_menu' => false,
            'special_menu_title' => esc_html__( 'Special Menu', 'cnz-pwste' ),

            'display_product_search_form' => true,
            'select_search_form' => 'product_search',
            'display_product_search_form_on_mobile' => false,
            'display_mini_cart' => true,
            'display_wishlist' => true,

            'blog_featured_image' => false,
            'blog_display_cats' => true,
            'blog_display_excerpt' => true,
            'blog_display_date' => true,
            'blog_display_author' => true,
            'blog_sidebar_position' => 'right',

            'archive_featured_image' => false,
            'archive_display_cats' => true,
            'archive_display_excerpt' => true,
            'archive_display_date' => true,
            'archive_display_author' => true,
            'archive_sidebar_position' => 'right',

            'search_featured_image' => false,
            'search_display_cats' => true,
            'search_display_excerpt' => true,
            'search_display_date' => true,
            'search_display_author' => true,
            'search_sidebar_position' => 'right',

            'blog_archive_search_col_align' => 'feat_img_content',

            'enable_sticky_sidebar' => true,
            'enable_sidebar_small_devices' => true,
            'enable_global_sidebar_position' => false,
            'global_sidebar_position' => 'right',

            'display_post_featured_image' => false,
            'display_post_cats' => true,
            'display_post_date' => true,
            'display_post_author' => true,
            'display_post_tags' => true,
            'enable_post_common_sidebar_position' => false,
            'post_sidebar_position' => 'right',

            'display_page_featured_image' => false,
            'enable_page_common_sidebar_position' => false,
            'page_sidebar_position' => 'right',

            'display_page_header' => true,
            'display_breadcrumb' => true,
            'enable_parallax_page_header_background' => false,

            'display_footer_widget_area' => false,
            'footer_widgets_area_columns' => '4',
            'display_scroll_top_button' => true,

            'copyright_text' => '',
            'payments_image' => '',

            'excerpt_length' => 30,

            'primary_color' => '#0286E7',
            'secondary_color' => '#E26143',

            'disable_ouline_on_focus' => false,
        );

        $defaults['cnz_field_enable_home_content'] = false;

        return $defaults;
    }
}