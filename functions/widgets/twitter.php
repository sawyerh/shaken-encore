<?php
class twitterWidget extends WP_Widget {
	
function twitterWidget() {
		$widget_ops = array( 'description' => __('Display your latest Twitter updates.') );
		parent::WP_Widget(false, __('Shaken - Twitter'), $widget_ops );
	} #twitterWidget
	
function form($instance) {
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$number = esc_attr($instance['number']);
		$follow_text = esc_attr($instance['follow_text']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
        <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></p>
                
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tweets to show (default = 5):'); ?></label>
        <input size="3" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('follow_text'); ?>"><?php _e('Follow text (default = Follow Me):'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('follow_text'); ?>" name="<?php echo $this->get_field_name('follow_text'); ?>" type="text" value="<?php echo $follow_text; ?>" /></p>
	<?php
	}// #form
	
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		return $new_instance;
	} //#update
	
function widget($args, $instance) {
	
		extract( $args );
		
		// outputs the content of the widget
		if( !$instance["title"] )
		$instance["title"] = "Recent Tweets";
		
		if( !$instance["username"] )
		$instance["username"] = "sawyerh";
		
		if( !$instance["follow_text"] )
		$instance["follow_text"] = "Follow Me";
		
		if( !$instance["number"] )
		$instance["number"] = "5";
		
		$title = $instance['title'];
		$username = $instance['username'];
		$number = $instance['number'];

		?>
        
        <div class="widget widget_twitter">
			<?php echo $before_title . $title . $after_title; ?>
            
            <div class="tweets-box">
                <ul id="twitter_update_list">
                <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
   				<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $number; ?>"></script>
                <script type="text/javascript">
					(function($){
						$('#twitter_update_list li').prepend('<a href="http://twitter.com/<?php echo $username; ?>" class="twitter-profile-image"><img src="http://api.twitter.com/1/users/profile_image/<?php echo $username; ?>.json?size=mini" alt="Follow Me" width="24" height="24" /></a>');
					})(jQuery);
				</script>
                </ul>
                <a href="http://twitter.com/<?php echo $username; ?>" title="Follow" class="button twitter-btn"><?php echo $instance["follow_text"]; ?></a>
            </div>
        </div>
        
    <?php
	} // #widget
	
} // class

register_widget('twitterWidget');
?>
