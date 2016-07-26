<?php

class Farost_Subscribe_Widget extends WP_Widget
{

    public $name = 'Newsletter Subscribe';

    public static function register()
    {
        register_widget(get_class());
    }

    function __construct()
    {
        $option = array(
            'classname' => 'subscribe',
            'description' => 'Display the Newsletter Subscribe',
        );
        parent::__construct('Farost_Subscribe_Widget', $this->name, $option);
    }

    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array(
            'title'              => '',
            'input_submit'       => '',
            'input_submit_class' => '',
            'class'              => '',
        ));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'farost_starter'); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $instance['title']; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('input_submit'); ?>"><?php _e('Text Button Sumit:', 'farost_starter'); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('input_submit') ?>" value="<?php echo $instance['input_submit']; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('input_submit_class'); ?>"><?php _e('Custom Button class:', 'farost_starter'); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('input_submit_class') ?>" value="<?php echo $instance['input_submit_class']; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Extra Class:', 'farost_starter'); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('class') ?>" value="<?php echo $instance['class']; ?>"/>
        </p>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance                       = $old_instance;
        $instance['title']              = strip_tags($new_instance['title']);
        $instance['input_submit']       = $new_instance['input_submit'];
        $instance['input_submit_class'] = $new_instance['input_submit_class'];
        $instance['class']              = esc_attr($new_instance['class']);
        return $instance;
    }

    function widget($args, $instance)
    {
        extract($args);
        $title  = empty($instance['title']) ? '' : $instance['title'];
        echo $before_widget;
        if ($title){
            echo $before_title . $title . $after_title;
        }
        farost_subscribe_form($instance);
        echo $after_widget;
    }
}

add_action('widgets_init', array('Farost_Subscribe_Widget', 'register'));