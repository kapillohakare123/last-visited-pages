<?php

// Creating the widget 
class last_visited_frontend extends WP_Widget {
    function __construct() {
        parent::__construct(
// Base ID of your widget
                'last_visited_frontend',
// Widget name will appear in UI
                __('Last Visited', 'last_visited_frontend_domain'),
// Widget description
                array('description' => __('Last Visited', 'last_visited_frontend_domain'),)
        );
    }
// Creating widget front-end
// This is where the action happens
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        $count = apply_filters('widget_title', $instance['count']);
        ?>
        <div class="recentPageViews"></div>
        <script>
            // Display recently visited pages in "recentPageViews" class HTML DIV
            //clearHistory("recentPageViews");
            checkHistory("recentPageViews", <?php echo $count; ?>);

        </script>
        <?php
        echo $args['after_widget'];
    }
// Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'last_visited_frontend_domain');
        }
        $count = ( isset($instance['count']) ) ? $instance['count'] : '';
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['count'] = (!empty($new_instance['count']) ) ? strip_tags($new_instance['count']) : '';
        return $instance;
    }

}
// Class last_visited_frontend ends here
// Register and load the widget
function last_visited_load_widget() {
    register_widget('last_visited_frontend');
}

add_action('widgets_init', 'last_visited_load_widget');
