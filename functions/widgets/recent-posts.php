<?php
class recentPostsWidget extends WP_Widget {
	
function recentPostsWidget() {
		$widget_ops = array( 'description' => __('Display your latest blog posts.') );
		parent::WP_Widget(false, __('Shaken - Recent Posts'), $widget_ops );
	} #recentPostsWidget
	
function form($instance) {
		$title = esc_attr($instance['title']);
		$number = esc_attr($instance['number']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		                
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts (default = 5):'); ?></label>
        <input size="3" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
	<?php
	}// #form
	
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		return $new_instance;
	} //#update
	
function widget($args, $instance) {
	
		extract( $args );
		
		global $post;
		$post_old = $post; // Save the post object.
		
		// outputs the content of the widget
		if( !$instance["title"] )
		$instance["title"] = "Recent Posts";
		
		if( !$instance["number"] )
		$instance["number"] = "5";
		
		$title = $instance['title'];
		$number = $instance['number'];

		?>
        
		<?php 
			$args=array(
				'showposts'=> $number, // Number of related posts that will be shown.
				'caller_get_posts'=>1,
				);
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() )
			{
				echo $before_widget;
	
				// Widget title
				echo $before_title . $instance["title"] . $after_title;
				
				echo "<ul>\n";
				while ($my_query->have_posts())
				{
					$my_query->the_post();
					
					$soy_video_url = get_post_meta($post->ID, 'soy_video_url', true);
					if($soy_video_url){
						$vid_src = shaken_get_image_url($soy_video_url);
					} else{
						$vid_src = false;
					}
					$soy_continue = false;
					
					?>
					<li class="related-post-item">
						
						<?php
						global $wpdb; $attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' 
						AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
						
						if(wp_get_attachment_image($attachment_id) || $vid_src || has_post_thumbnail()){
							$soy_continue = true;	
						}
						
						if ($soy_continue) :
						?>
						<div class="post-thumb">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php 
							if(has_post_thumbnail()){
								the_post_thumbnail('sidebar');
							} else if($vid_src){
								echo "<img src='$vid_src' />";
							}
							else {
								echo wp_get_attachment_image($attachment_id, 'sidebar');
							}
							?>
							</a>
						</div>
						<?php endif; ?>
						
						<div class="post-info">
							<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<p><?php the_time('F jS, Y') ?></p>
						</div>
						
						<div class="clearfix"></div>
					</li>
					<?php
				}
				echo "</ul>\n";
				
				echo $after_widget;
			}

		$post = $post_old; // Restore the post object.
        ?>
            
        
    <?php
	} // #widget
	
} // class

register_widget('recentPostsWidget');
?>
