<?php

/**
 * Boxes Widget Class
 *
 * @package CNZ_Theme
 */

if (!class_exists('CNZ_Theme_Boxes_Widget')) {
  class CNZ_Theme_Boxes_Widget extends WP_Widget
  {
    function __construct()
    {
      parent::__construct(
        'cnz-pwste-boxes-widget',
        esc_html__('Boxes', 'cnz-pwste'),
        array(
          'classname' => '',
          'description' => esc_html__('Displays boxes.', 'cnz-pwste'),
        )
      );
    }

    public function widget($args, $instance)
    {

      $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
      $box_category = isset($instance['box_category']) ? $instance['box_category'] : '';
      $no_of_boxes = isset($instance['no_of_boxes']) ? $instance['no_of_boxes'] : 4;
      $display_layout = isset($instance['display_layout']) ? $instance['display_layout'] : 'grid';

      $boxes_query_args = array(
        'post_type' => 'box-widget',
      );

      if ($no_of_boxes > 0) {
        $boxes_query_args['posts_per_page'] = $no_of_boxes;
      } else {
        $boxes_query_args['posts_per_page'] = 4;
      }

      /*            if( $box_category != '0' ) {
uzupelnic
            }
*/
      $boxes_query = new WP_Query($boxes_query_args);
      if ($boxes_query->have_posts()) {
        $mobile_cols_no = get_theme_mod('cnz_field_product_cols_in_mobile', 1);
        $mobile_col_class = 'os-mobile-col-' . $mobile_cols_no;
        if ($display_layout == 'grid') {
?>
          <section class="product-widget product-widget-style-1 section-spacing">
            <div class="section-inner">
              <div class="__os-container__">
                <div class="widget-entry">
                  <?php
                  if (!empty($title)) {
                  ?>
                    <div class="section-title">
                      <h2><?php echo esc_html($title); ?></h2>
                    </div><!-- .section-title -->
                  <?php
                  }
                  ?>
                  <div class="product-entry">
                    <div class="woocommerce columns-4 <?php echo esc_attr($mobile_col_class); ?>">

                      <ul class="products">
                      <?php
                        while ($boxes_query->have_posts()) {

                          $boxes_query->the_post();
                        ?>

                        <li class="product type-product post-1723 status-publish first instock product_cat-bez-kategorii product_cat-cnz product_tag-moodle featured shipping-taxable purchasable product-type-simple">

                          <div class="bg-white product-main-wrap">
                            <div class="product-info-wrap">
<?php
$url=get_post_meta( get_the_ID(), 'box_url', true );
if (!$url) $url='#';

?>

                              <a href="<?php echo $url;?>" >
                                <h3>
                                <?php the_title(); ?>
                                </h3>
                              </a>
                              <?php
                                  the_content();
                              ?>
                            </div>
                          </div><!-- .bg-white product-main-wrap -->
                        </li>
                        <?php
                        }
                   wp_reset_postdata();
                        ?>
                      </ul>

                    </div><!-- .woocommerce.columns-4 -->
                  </div><!-- .product-entry -->
                </div><!-- .widget-entry -->
              </div><!-- .__os-container__ -->
            </div><!-- .section-inner -->
          </section><!-- .product-widget.product-widget-style-1.section-spacing -->
        <?php
        }

        if ($display_layout == 'slider') {
        ?>
          <section class="product-widget product-widget-style-3 section-spacing">
            <div class="section-inner">
              <div class="__os-container__">
                <?php
                if (!empty($title)) {
                ?>
                  <div class="section-title">
                    <h2><?php echo esc_html($title); ?></h2>
                  </div>
                <?php
                }
                ?>
                <div class="product-entry">
                  <div class="owl-carousel owl-carousel-2">
                    <?php
                    while ($boxes_query->have_posts()) {

                      $boxes_query->the_post();
                    ?>
                      <div class="item">
                        <div class="woocommerce columns-1 <?php echo esc_attr($mobile_col_class); ?>">
                          <ul class="products">
                            <?php wc_get_template_part('content', 'product'); ?>
                          </ul>
                        </div><!-- .woocommerce.columns-1 -->
                      </div>
                    <?php
                    }
                    //                                        woocommerce_reset_loop();

                    wp_reset_postdata();
                    ?>
                  </div><!-- .owl-carousel -->
                </div><!-- .product-entry -->
              </div><!-- .__os-container__ -->
            </div><!-- .section-inner -->
          </section><!-- .product-widget -->
      <?php
        }
      }
    }

    public function form($instance)
    {

      $defaults = array(
        'title' => '',
        'box_category' => '',
        'no_of_boxes' => 4,
        'display_layout' => 'grid',
      );

      $instance = wp_parse_args((array) $instance, $defaults);
      ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
          <strong><?php esc_html_e('Title', 'cnz-pwste'); ?></strong>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('box_category')); ?>">
          <strong><?php esc_html_e('Box Category', 'cnz-pwste'); ?></strong>
        </label>
        <?php
        wp_dropdown_categories(array(
          'taxonomy' => 'box_cat',
          'show_option_all' => esc_html__('Select Category', 'cnz-pwste'),
          'name' => $this->get_field_name('box_category'),
          'id' => $this->get_field_id('box_category'),
          'class' => 'widefat',
          'value_field' => 'slug',
          'hide_empty' => 1,
          'selected' => isset($instance['box_category']) ? $instance['box_category'] : '',
        ));
        ?>
        <span class="sldr-elmnt-desc"><?php esc_html_e('If no category is selected, then latest products are displayed.', 'cnz-pwste'); ?></span>
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('no_of_boxes')); ?>">
          <strong><?php esc_html_e('No of Boxes', 'cnz-pwste'); ?></strong>
        </label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('no_of_boxes')); ?>" name="<?php echo esc_attr($this->get_field_name('no_of_boxes')); ?>" type="number" value="<?php echo esc_attr(absint($instance['no_of_boxes'])); ?>" />
      </p>

      <p>
        <label for="<?php echo esc_attr($this->get_field_id('display_layout')); ?>">
          <strong><?php esc_html_e('Display Layout', 'cnz-pwste'); ?></strong>
        </label>
        <?php
        $product_types = array(
          'slider' => esc_html__('Slider', 'cnz-pwste'),
          'grid' => esc_html__('Grid', 'cnz-pwste'),
        );
        ?>
        <select class="widefat" name="<?php echo esc_attr($this->get_field_name('display_layout')); ?>" id="<?php echo esc_attr($this->get_field_id('display_layout')); ?>">
          <?php
          foreach ($product_types as $key => $value) {
          ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $instance['display_layout']); ?>><?php echo esc_html($value); ?></option>
          <?php
          }
          ?>
        </select>
      </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
      $instance = $old_instance;
      $instance['title'] = sanitize_text_field($new_instance['title']);
      $instance['box_category'] = sanitize_text_field($new_instance['box_category']);
      $instance['no_of_boxes'] = absint($new_instance['no_of_boxes']);
      $instance['display_layout'] = sanitize_text_field($new_instance['display_layout']);
      return $instance;
    }
  }
}
