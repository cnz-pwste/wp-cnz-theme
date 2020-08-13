<?php
/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CNZ_Theme
 */


?>
<header class="masterheader desktop-header header-style-1">
    <div class="header-inner">
        <?php
        $cnz_display_top_header = cnz_get_option( 'display_top_header' );
        if( $cnz_display_top_header == true ) {
            ?>
            <div class="top-header">
                <div class="__os-container__">
                    <div class="os-row">
                        <div class="os-col left-col">
                           <div class="topbar-items">
                                <?php

                                $cnz_top_header_left_item = cnz_get_option( 'display_menu_or_login_register_link' );

                                if( $cnz_top_header_left_item == 'login_register' ) {
                                    /**
                                    * Hook - cnz_user_links.
                                    *
                                    * @hooked cnz_user_links_action - 10
                                    */
                                    do_action( 'cnz_user_links' );
                                } else {
                                    /**
                                    * Hook - cnz_top_header_menu.
                                    *
                                    * @hooked cnz_top_header_menu_action - 10
                                    */
                                    do_action( 'cnz_top_header_menu' );
                                }
                                ?>
                            </div><!-- .topbar-items -->
                        </div><!-- .os-col.left-col -->
                        <?php
                        $cnz_social_links = cnz_get_option( 'top_header_social_links' );

                        if( !empty( $cnz_social_links ) ) {

                            $cnz_social_links_array = explode( ',', $cnz_social_links );
                            ?>
                            <div class="os-col right-col">
                                 <div class="social-icons">
                                    <ul class="social-icons-list">
                                        <?php
                                        foreach( $cnz_social_links_array as $cnz_social_link ) {
                                            ?>
                                            <li>
                                                <a href="<?php echo esc_url( $cnz_social_link ); ?>"></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div><!-- // social-icons -->
                            </div><!-- .os-col.right-col -->
                            <?php
                        }
                        ?>
                    </div><!-- .os-row -->
                </div><!-- .__os-container__ -->
            </div><!-- .top-header -->
            <?php
        }
        ?>
        <div class="mid-header">
            <div class="__os-container__">
                <div class="os-row <?php cnz_logo_row_class(); ?>">
                    <div class="os-col logo-col">
                        <?php
                        /**
                        * Hook - cnz_desktop_site_identity.
                        *
                        * @hooked cnz_desktop_site_identity_action - 10
                        */
                        do_action( 'cnz_desktop_site_identity' );
                        ?>
                    </div><!-- .os-col.logo-col -->
                    <?php
                    $cnz_display_product_search = cnz_get_option( 'display_product_search_form' );
                    $cnz_display_wishlist_icon = cnz_get_option( 'display_wishlist' );
                    $cnz_display_minicart = cnz_get_option( 'display_mini_cart' );

                    if( $cnz_display_product_search == true || ( ( $cnz_display_minicart == true && class_exists( 'WooCommerce' ) ) || ( $cnz_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) ) {
                        ?>
                        <div class="os-col extra-col">
                            <div class="aside-right">
                                <?php
                                if( $cnz_display_product_search == true ) {

                                    if( class_exists( 'WooCommerce' ) ) {

                                        if( cnz_get_option( 'select_search_form' ) == 'product_search' ) {

                                            /**
                                            * Hook - cnz_product_search.
                                            *
                                            * @hooked cnz_product_search_action - 10
                                            */
                                            do_action( 'cnz_product_search' );
                                        } else {

                                            /**
                                            * Hook - cnz_default_search.
                                            *
                                            * @hooked cnz_default_search_action - 10
                                            */
                                            do_action( 'cnz_default_search' );
                                        }
                                    } else {

                                        /**
                                        * Hook - cnz_default_search.
                                        *
                                        * @hooked cnz_default_search_action - 10
                                        */
                                        do_action( 'cnz_default_search' );
                                    }                                    
                                }

                                if( ( $cnz_display_minicart == true && class_exists( 'WooCommerce' ) ) || ( $cnz_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) { 
                                    ?>
                                    <div class="wishlist-minicart-wrapper">
                                        <div class="wishlist-minicart-inner">
                                        <?php
                                        if( $cnz_display_wishlist_icon == true ) {

                                            /**
                                            * Hook - cnz_wishlist_icon.
                                            *
                                            * @hooked cnz_wishlist_icon_action - 10
                                            */
                                            do_action( 'cnz_wishlist_icon' );
                                        }

                                        if( $cnz_display_minicart == true ) {

                                            /**
                                            * Hook - cnz_mini_cart.
                                            *
                                            * @hooked cnz_mini_cart_action - 10
                                            */
                                            do_action( 'cnz_mini_cart' );
                                        }
                                        ?>
                                        </div><!-- . wishlist-minicart-inner -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- .aside-right -->
                        </div><!-- .os-col.extra-col -->
                        <?php
                    }
                    ?>
                </div><!-- .os-row -->
            </div><!-- .__os-container__ -->
        </div><!-- .mid-header -->
        <div class="bottom-header">
            <div class="main-navigation"> 
                <div class="__os-container__">
                    <div class="os-row os-nav-row <?php cnz_menu_row_class(); ?>">
                        <?php
                        $cnz_display_special_menu = cnz_get_option( 'display_special_menu' );
                        if( $cnz_display_special_menu == true ) {
                            ?>
                            <div class="os-col os-nav-col-left">
                                <div class="category-navigation">
                                    <button class="cat-nav-trigger">
                                        <?php
                                        $cnz_special_menu_title = cnz_get_option( 'special_menu_title' );
                                        if( !empty( $cnz_special_menu_title ) ) {
                                            ?>
                                            <span class="title"><?php echo esc_html( $cnz_special_menu_title ); ?></span>
                                            <?php
                                        }
                                        ?>
                                        <span class="icon">
                                            <span class="line"></span>
                                            <span class="line"></span>
                                            <span class="line"></span>
                                        </span>
                                    </button><!-- . cat-nav-trigger -->
                                    
                                    <?php
                                    /**
                                    * Hook - cnz_secondary_navigation.
                                    *
                                    * @hooked cnz_secondary_navigation_action - 10
                                    */
                                    do_action( 'cnz_secondary_navigation' );
                                    ?>
                                </div><!-- .site-navigation category-navigation -->
                            </div><!-- .os-col.os-nav-col-left -->
                            <?php
                        }
                        ?>
                        <div class="os-col os-nav-col-right">
                            <div class="menu-toggle">
                                <button class="mobile-menu-toggle-btn">
                                    <span class="hamburger-bar"></span>
                                    <span class="hamburger-bar"></span>
                                    <span class="hamburger-bar"></span>
                                </button>
                            </div><!-- .meu-toggle -->
                            <?php
                            /**
                            * Hook - cnz_primary_navigation.
                            *
                            * @hooked cnz_primary_navigation_action - 10
                            */
                            do_action( 'cnz_primary_navigation' );
                            ?>
                        </div><!-- // os-col os-nav-col-right -->
                    </div><!-- // os-row os-nav-row -->
                </div><!-- .__os-container__ -->
            </div><!-- .main-navigation -->
        </div><!-- .bottom-header -->
    </div><!-- .header-inner -->
</header><!-- .masterheader.header-style-1 -->