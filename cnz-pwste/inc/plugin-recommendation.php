<?php

/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'cnz_recommended_plugins' ) ) :
    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function cnz_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'Elementor Page Builder', 'cnz-pwste' ),
                'slug'     => 'elementor',
                'required' => false,
            ),
        );

        tgmpa( $plugins );
    }

endif;
add_action( 'tgmpa_register', 'cnz_recommended_plugins' );