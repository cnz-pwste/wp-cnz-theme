<?php
/**
 * Display Featured Courses Widget Class
 *
 * @package CNZ_Theme
 */

if( ! class_exists( 'CNZ_Theme_Featured_Courses_Widget' ) ) {

    class CNZ_Theme_Featured_Courses_Widget extends WP_Widget {
     
        function __construct() { 

            parent::__construct(
                'cnz-pwste-featured-product-categories-widget',
                esc_html__( 'OS: Featured Courses', 'cnz-pwste' ),
                array(
                    'classname'     => '',
                    'description'   => esc_html__( 'Displays featured Courses.', 'cnz-pwste' ), 
                )
            );     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $Courses = isset( $instance['Courses'] ) ? $instance['Courses'] : array();

            if( !empty( $Courses ) ) {
                ?>
                <section class="cats-widget-styles cats-widget-style-1 section-spacing">
                    <div class="section-inner">
                        <div class="__os-container__">
                            <div class="cats-widget-entry">
                                <div class="os-row">
                                    <?php
                                    foreach( $Courses as $product_category ) {

                                        $category_term = get_term_by( 'slug', $product_category, 'product_cat' );

                                        $term_img_url = '';

                                        if( !empty( $category_term ) ) {

                                            $thumbnail_id   = get_term_meta( $category_term->term_id, 'thumbnail_id', true );
                                
                                            $image_url      = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );


                                            if( !empty( $image_url ) ){

                                                $term_img_url = $image_url[0];

                                            } else {

                                                $term_img_url = wc_placeholder_img_src();
                                                
                                            } 
                                        }
                                        ?>
                                        <div class="os-col">
                                            <div class="card wow osfadeInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                                                <div class="box">
                                                    <div class="left">
                                                        <div class="thumb">
                                                            <a href="<?php echo esc_url( get_term_link( $category_term->term_id, 'product_cat' ) ); ?>"><img src="<?php echo esc_url( $term_img_url ); ?>" alt="<?php echo esc_attr( $category_term->name ); ?>"></a>
                                                        </div><!-- // thumb -->
                                                    </div><!-- // left -->
                                                    <div class="right">
                                                        <div class="title">
                                                            <h3><a href="<?php echo esc_url( get_term_link( $category_term->term_id, 'product_cat' ) ); ?>"><?php echo esc_html( $category_term->name ); ?></a></h3>
                                                        </div><!-- .title -->
                                                        <div class="product-numbers">
                                                            <p>
                                                                <?php
                                                                printf(
                                                                    /* translators: %s: products count */
                                                                    wp_kses_post( _n( '%s Product', '%s Products', $category_term->count, 'cnz-pwste' ) ), '<span class="count">' .
                                                                    esc_html( number_format_i18n( $category_term->count ) ) . '</span>'
                                                                );
                                                                ?>   
                                                            </p>
                                                        </div><!-- // product-numbers -->
                                                    </div><!-- .right -->
                                                </div><!-- box -->
                                            </div><!-- // card -->
                                        </div><!-- .col -->
                                        <?php
                                    }
                                    ?>
                                </div><!-- .row -->
                            </div><!-- .cats-widget-entry -->
                        </div><!-- .__os-container__ -->
                    </div><!-- .section-inner -->
                </section><!-- .cats-widget-styles.cats-widget-style-1.section-spacing -->
                <?php
            }     
        }
     
        public function form( $instance ) {

            $instance['title'] = isset( $instance['title'] ) ? $instance['title'] : '';

            $instance['Courses'] = isset( $instance['Courses'] ) ? $instance['Courses'] : array();
    		?>
    		<p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e( 'Title', 'cnz-pwste' ); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <span class="sldr-elmnt-title"><strong><?php esc_html_e( 'Courses', 'cnz-pwste' ); ?></strong></span>
                <span class="sldr-elmnt-desc"><?php esc_html_e( 'Below are the list of Courses. Check on a category to set is as a filter item.', 'cnz-pwste' ) ?></span>

                <span class="widget_multicheck">
                <?php

                $Courses = cnz_all_Courses();

                if( !empty( $Courses ) ) {

                    foreach( $Courses as $index => $product_category ) {
                        ?>
                        <span class="sldr-elmnt-cntnr">

                            <label for="<?php echo esc_attr( $this->get_field_id( 'Courses' ) . $product_category->term_id ); ?>">
                                <input id="<?php echo esc_attr( $this->get_field_id( 'Courses' ) . $product_category->term_id ); ?>" name="<?php echo esc_attr( $this->get_field_name('Courses') ); ?>[]" type="checkbox" value="<?php echo esc_attr( $product_category->slug ); ?>" <?php if( !empty( $instance['Courses'] ) ) { checked( in_array( $product_category->slug, $instance['Courses'] ), true ); } ?>>
                                <strong><?php echo esc_html( $product_category->name ); ?></strong>
                            </label>
                        </span><!-- .sldr-elmnt-cntnr -->
                        <?php
                    }
                } else {
                    ?>
                    <input id="<?php echo esc_attr( $this->get_field_id( 'Courses' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('Courses') ); ?>[]" type="hidden" value="" checked>
                    <small><?php echo esc_html__( 'There are no Courses to select.', 'cnz-pwste' ); ?></small>
                    <?php                        
                }   
                ?>
                </span>
            </p>
    		<?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']                  = sanitize_text_field( $new_instance['title'] );

            $instance['Courses'] 	= isset( $new_instance['Courses'] ) ? array_map( 'sanitize_text_field', $new_instance['Courses'] ) : array();

            return $instance;
        } 
    }
}