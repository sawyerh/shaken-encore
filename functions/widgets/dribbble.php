<?php
class dribbbleWidget extends WP_Widget {
	
function dribbbleWidget() {
		$widget_ops = array( 'description' => __('Display your recent shots on Dribbble') );
		parent::WP_Widget(false, __('Shaken - Dribbble'), $widget_ops );
		
	} #flickrwidget
	
function form($instance) {
		$player_name = esc_attr($instance['player_name']);
		$number = esc_attr($instance['number']);
		
		?>
        <p><label for="<?php echo $this->get_field_id('player_name'); ?>"><?php _e('Player Name:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('player_name'); ?>" name="<?php echo $this->get_field_name('player_name'); ?>" type="text" value="<?php echo $player_name; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of shots to show:'); ?></label>
        <input size="3" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
	<?php
	}// #form
	
function update($new_instance, $old_instance) {
		// processes widget options to be saved
		return $new_instance;
	} //#update
	
function widget($args, $instance) {
	
		extract( $args );
		
		// outputs the content of the widget
		$player_name = $instance['player_name'];
		$number = $instance['number'];

		?>
        
        <div class="widget dribbble_widget">

		<?php if(function_exists('fetch_feed')):
                $rss = fetch_feed("http://dribbble.com/players/$player_name/shots.rss");
                add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 1800;' ) );
                if (!is_wp_error( $rss ) ) : 
                    $items = $rss->get_items(0, $rss->get_item_quantity($number)); 
                endif;
            endif;
        
            if (!empty($items)): ?>
        <ol class="dribbbles">
        <?php	
        foreach ( $items as $item ):
            $title = $item->get_title();
            $link = $item->get_permalink();
            $date = $item->get_date('F d, Y');
            $description = $item->get_description();
        
            preg_match("/src=\"(http.*(jpg|jpeg|gif|png))/", $description, $image_url);
            $image = $image_url[1];
            if(!$options['bigImage']) {
                $image = preg_replace('/.(jpg|jpeg|gif|png)/', '_teaser.$1',$image); #comment this out if you want to use the big 400x300 image
            }
        ?>
            <li class="group"> 
            <div class="dribbble"> 
                <div class="dribbble-shot"> 
                    <div class="dribbble-img"> 
                        <a href="<?php echo $link; ?>" class="dribbble-link"><img src="<?php echo $image; ?>" alt="<?php echo $title;?>"/></a> 
                        <a href="<?php echo $link; ?>" class="dribbble-over"><strong><?php echo $title; ?></strong> 
                            <span class="dim"><?php echo $player_name; ?></span>
                            <em><?php echo $date; ?></em> 
                        </a>
                    </div>
                </div>
            </div> 
            </li>
        <?php endforeach;?>
        </ol>
        <?php endif; ?>
        
        <a href="http://dribbble.com/players/<?php echo $player_name; ?>">
        <img src="<?php echo get_template_directory_uri(); ?>/images/dribbble-logo.png" alt="Dribbble" class="dribbble-logo" width="126" height="27" />
        </a>
        
        <?php echo $after_widget; ?>
    <?php
	} // #widget
	
} // class

register_widget('dribbbleWidget');
?>
