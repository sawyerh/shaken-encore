<?php
/*
Plugin Name: Related Posts Widget
Plugin URI: http://jameslao.com/2010/01/01/related-posts-widget-1-0/
Description: Adds a widget that shows a list of related posts.
Author: James Lao	
Version: 1.1
Author URI: http://jameslao.com/
*/

// Register thumbnail sizes.
if ( function_exists('add_image_size') )
{
	$sizes = get_option('jlao_related_post_thumb_sizes');
	if ( $sizes )
	{
		foreach ( $sizes as $id=>$size )
			add_image_size( 'related_post_thumb_size' . $id, $size[0], $size[1], true );
	}
}

class RelatedPosts extends WP_Widget {

function RelatedPosts() {
	$widget_ops = array('classname' => 'rel-post-widget', 'description' => __('List related posts'));
	$this->WP_Widget('related-posts', __('Shaken - Related Posts'), $widget_ops);
}

/**
 * Displays a list of related posts on single post pages.
 */
function widget($args, $instance) {
	// Only show widget if on a post page.
	if ( !is_single() ) return;

	global $post;
	$post_old = $post; // Save the post object.
	
	extract( $args );
	
	if( !$instance["title"] )
		$instance["title"] = "Related Posts";
		
	$tags = wp_get_post_tags($post->ID);

	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'showposts'=> $instance['num'], // Number of related posts that will be shown.
			'caller_get_posts'=>1,
			'orderby' => 'rand'
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
	}

	$post = $post_old; // Restore the post object.
}

/**
 * Form processing... Dead simple.
 */
function update($new_instance, $old_instance) {
	/**
	 * Save the thumbnail dimensions outside so we can
	 * register the sizes easily. We have to do this
	 * because the sizes must registered beforehand
	 * in order for WP to hard crop images (this in
	 * turn is because WP only hard crops on upload).
	 * The code inside the widget is executed only when
	 * the widget is shown so we register the sizes
	 * outside of the widget class.
	 */
	
    return $new_instance;
}

/**
 * The configuration form.
 */
function form($instance) {
?>
		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of posts to show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
			</label>
		</p>
		
<?php

}

}

add_action( 'widgets_init', create_function('', 'return register_widget("RelatedPosts");') );

?>
