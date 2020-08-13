<?php
/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CNZ_Theme
 */
?>
<header class="masterheader mobile-header header-style-1 mobile-header-style-1">
    <div class="header-inner">
         <?php
            $cnz_display_top_header = cnz_get_option( 'display_top_header' );
            if( $cnz_display_top_header == true ) {
                ?>
                <div class="top-header top-block">
                    <div class="__os-container__">
                        <div class="block-entry os-row">
                            <?php
                                $cnz_social_links = cnz_get_option( 'top_header_social_links' );

                                if( !empty( $cnz_social_links ) ) {

                                    $cnz_social_links_array = explode( ',', $cnz_social_links );
                                    ?>
                                    <div class="social-icons flex-col">
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
                                    <?php 
                                }
                            ?>
                        </div><!-- // block-entry -->
                    </div><!-- // __os-container__ -->
                </div><!-- // top-block -->
                <?php 
            }
        ?>
        <div class="mid-block">
            <div class="__os-container__">
                <div class="block-entry os-row">
                    <div class="branding flex-col">
                        <?php
                        /**
                        * Hook - cnz_mobile_site_identity.
                        *
                        * @hooked cnz_mobile_site_identity_action - 10
                        */
                        do_action( 'cnz_mobile_site_identity' );
                        ?>
                    </div><!-- .branding flex-col -->
                    <?php 
                        $cnz_display_wishlist_icon = cnz_get_option( 'display_wishlist' );
                        $cnz_display_minicart = cnz_get_option( 'display_mini_cart' );

                         if( $cnz_display_minicart == true && class_exists( 'WooCommerce' )  || ( $cnz_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) {
                            ?>
                            <div class="header-items flex-col">
                                <div class="flex-row">
                                    <?php 

                                     if( ( $cnz_display_wishlist_icon == true && function_exists( 'YITH_WCWL' ) && class_exists( 'WooCommerce' ) ) ) { 
                                        ?>
                                        <div class="wishlist-column flex-col">
                                            <?php
                                            if( $cnz_display_wishlist_icon == true ) {

                                                /**
                                                * Hook - cnz_wishlist_icon.
                                                *
                                                * @hooked cnz_wishlist_icon_action - 10
                                                */
                                                do_action( 'cnz_wishlist_icon' );
                                            }
                                            ?>
                                        </div><!-- // wishlist-column flex-column -->
                                        <?php 
                                    }
                                    
                                    if( ( $cnz_display_minicart == true && class_exists( 'WooCommerce' ) ) ) { 
                                        ?>
                                        <div class="minicart-column flex-col">
                                            <?php
                            
                                            if( $cnz_display_minicart == true ) {

                                                /**
                                                * Hook - cnz_mini_cart.
                                                *
                                                * @hooked cnz_mini_cart_action - 10
                                                */
                                                do_action( 'cnz_mini_cart' );
                                            }
                                            ?>
                                        </div><!-- // mincart-column flex-col -->
                                        <?php 
                                        }
                                    ?>
                                </div><!-- // flex-row -->
                            </div><!-- // header-items -->
                            <?php 
                        }
                    ?>
                </div><!-- // block-entry -->
            </div><!-- // __os-container__ -->
        </div><!-- // mid-block -->
        <div class="bottom-block">
            <div class="__os-container__">
                <div class="block-entry">
                    <div class="flex-row">
                        <div class="flex-col left">
                        <div class="nav-col">
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
                        </div><!-- // nav-col -->
                        </div><!-- // flex-col left -->
                        <div class="flex-col right">
                            <div class="flex-row">
                                <?php 
                                $cnz_display_special_menu = cnz_get_option( 'display_special_menu' );
                                if( $cnz_display_special_menu == true ) {
                                    ?>
                                    <div class="cat-menu-col flex-col">
                                         <div class="special-cat-menu">
                                             <button class="cat-nav-trigger">
                                                <span class="icon">
                                                    <span class="line"></span>
                                                    <span class="line"></span>
                                                    <span class="line"></span>
                                                </span>
                                            </button>
                                        </div><!-- // special-cat-menu -->
                                    </div><!-- // cat-menu-col -->
                                    <?php 
                                }

                                if( cnz_get_option( 'display_product_search_form_on_mobile' ) == true && cnz_get_option( 'display_product_search_form' ) == true ) {
                                    ?>
                                    <div class="search-col flex-col">
                                        <button class="search-toggle"><i class='bx bx-search'></i></button>
                                    </div><!-- // search-col flex-col -->
                                    <?php
                                }
                                ?>
                            </div><!-- // flex-row -->
                        </div><!-- // flex-col right -->
                    </div><!-- // fex-row -->
                </div><!-- // block-entry -->
            </div><!-- // __os-container__ -->
            <?php
            if( cnz_get_option( 'display_product_search_form' ) == true && cnz_get_option( 'display_product_search_form_on_mobile' ) == true ) {
                ?>
                <div class="mobile-header-search">
                    <?php
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
                    ?>
                </div><!-- // mobile-header-search -->
                <?php
            }

            if( cnz_get_option( 'display_special_menu' ) ==  true ) {
                ?>
                <nav class="category-navigation special-navigation">
                    <?php
                    /**
                    * Hook - cnz_secondary_navigation.
                    *
                    * @hooked cnz_secondary_navigation_action - 10
                    */
                    do_action( 'cnz_secondary_navigation' );
                    ?>
                </nav><!-- // special-navigation -->
                <?php
            }
            ?>
        </div><!-- // bottom-block -->
    </div><!-- // header-inner -->
</header><!-- .mobile-header header-style-1 -->
<aside class="mobile-navigation canvas" data-auto-focus="true">
    <div class="canvas-inner">
        <div class="canvas-container-entry">
            <div class="canvas-close-container">
                <button class="trigger-mob-nav-close"><i class='bx bx-x'></i></button>
            </div><!-- // canvas-close-container -->
            <div class="top-header-menu-entry">
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
            </div><!-- // secondary-navigation -->
            <div class="mobile-nav-entry">
                <?php
                   /**
                    * Hook - cnz_secondary_navigation.
                    *
                    * @hooked cnz_secondary_navigation_action - 10
                    */
                    do_action( 'cnz_primary_navigation' );
                ?>
            </div><!-- // mobile-nav-entry -->
        </div><!-- // canvas-container-entry -->
    </div><!-- // canvas-inner -->
</aside><!-- // mobile-navigation-canvas -->
<div class="mobile-navigation-mask"></div><!-- // mobile-navigation-mask -->