<?php
class fb_like_box_Widget extends WP_Widget {
	
function fb_like_box_Widget() {
		$widget_ops = array( 'description' => __('Display a Facebook Page "like box" with optional news stream and optional fan profile photos') );
		parent::WP_Widget(false, __('Shaken - Facebook Like Box'), $widget_ops );
	} #fb_like_box_Widget
	
function form($instance) {
		$page = esc_attr($instance['page']);
		$show_stream = esc_attr($instance['show_stream']);
		$show_fans = esc_attr($instance['show_fans']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('page'); ?>"><?php _e('Facebook Page URL:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('page'); ?>" name="<?php echo $this->get_field_name('page'); ?>" type="text" value="<?php echo $page; ?>" /></p>
                
        <p><label for="<?php echo $this->get_field_id('show_stream'); ?>"><?php _e('Display News Stream'); ?></label>
        <input id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" type="checkbox" value="true"<?php checked(TRUE, (bool) $instance["show_stream"]); ?> /></p>
        
        <p><label for="<?php echo $this->get_field_id('show_fans'); ?>"><?php _e('Display Fan Profile Photos'); ?></label>
        <input id="<?php echo $this->get_field_id('show_fans'); ?>" name="<?php echo $this->get_field_name('show_fans'); ?>" type="checkbox" value="true"<?php checked(TRUE, (bool) $instance["show_fans"]); ?> /></p>
	<?php
	}// #form
	
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		return $new_instance;
	} //#update
	
function widget($args, $instance) {
	
		extract( $args );
		
		// outputs the content of the widget
				
		if( !$instance["page"] )
		$instance["page"] = "http://www.facebook.com/platform";
		
		if( !$instance["show_stream"] ){
			$instance["show_stream"] = "false";
		} else {
			$instance["show_stream"] = "true";
		}
		
		if( !$instance["show_fans"] ){
			$instance["show_fans"] = "false";
		} else {
			$instance["show_fans"] = "true";
		}
		
		$page = $instance['page'];
		$show_stream = $instance['show_stream'];
		$show_fans = $instance['show_fans'];

		?>
        
        <div class="widget widget_like_box">
            <div class="fb-like-box">                
                <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                <fb:like-box href="<?php echo $page; ?>" width="260" show_faces="<?php echo $show_fans; ?>" stream="<?php echo $show_stream; ?>" header="false"></fb:like-box>
            </div>
        </div>
        
    <?php
	} // #widget
	
} // class

register_widget('fb_like_box_Widget');
?>
