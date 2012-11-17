<?php
/**
 * Footer content
 *
 * @since 1.0
 */
function get_shaken_footer(){ ?>
    <footer class="primary">
    	<?php if( function_exists( 'social_bartender' ) ){ ?>
        <ul class="social-links">
            <?php social_bartender('<li>', '</li>'); ?>
        </ul>
        <?php } ?>
        <p class="copyright">&copy; <?php _e( 'Copyright', 'shaken' ); ?> <?php echo date('Y'); ?><br /><?php _e( 'Powered by', 'shaken' ); ?> <a href="http://www.audiotheme.com" target="_blank">Shaken Encore</a></p>
    </footer>
<?php
}

/**
 * Audio player
 *
 * @since 1.0
 */
function get_audio_player($record_id, $sidebar = true, $unique_id = ''){
    global $post;
    global $shaken_jplayer; $shaken_jplayer = true;
        
        $css_id = $record_id.'_'.$unique_id;
        $first_song_title = '';
        
        $record_query = array(
            'p' => $record_id,
            'post_type' => 'audiotheme_record'
        );
        $record = new WP_Query( $record_query );
        if( $record->have_posts() ): while ( $record->have_posts() ) : $record->the_post();
            $tracks = get_audiotheme_record_tracks( $post->ID );
            if( $tracks ):
            ?>
            
            <script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready(function($) {
			
				new jPlayerPlaylist({
					jPlayer: "#jquery_jplayer_<?php echo $css_id; ?>",
					cssSelectorAncestor: "#jp_container_<?php echo $css_id; ?>",
					loop: true
				}, [
					<?php // Loop and output each track
					$track_count = 0;
					foreach($tracks as $k => $t): 
                        $track = get_post($t->ID);
                        
                        if($k == 0){
                            $first_song_title = $track->post_title;
                        }
                        
						$artist = get_audiotheme_track_artist( $t->ID );
						$artist = ( !$artist ) ? '' : $artist;
						
						$track_file = get_audiotheme_track_file_url( $t->ID );

					?>
						{
							title: 		"<?php echo $track->post_title; ?>",
							mp3:		"<?php echo $track_file; ?>",
							track_num:	<?php echo $track_count + 1; ?>,
							artist:     "<?php echo $artist; ?>"
						}<?php if( count($tracks) - 1 != $track_count ) echo ',';
						
						$track_count++;
					endforeach; 
					?>
					
				], {
				    playlistOptions: {
				        loopOnPrevious: true,
				        enableRemoveControls: false
				    },
					swfPath: "<?php echo get_template_directory_uri(); ?>/js/jplayer/",
					supplied: "mp3",
					wmode: "window"
				});

			});
			//]]>
			</script>
    
    <div id="jquery_jplayer_<?php echo $css_id; ?>" class="jp-jplayer"></div>
    
    <div id="jp_container_<?php echo $css_id; ?>">
        
        <ul class="jp-controls">
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
            <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
            <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
        </ul><!-- #controls -->
        
        <?php if($sidebar){ ?>
    		<a href="#" class="toggle-playlist">Playlist</a>
		<?php } ?>
        
        <div class="jp-progress">
			<div class="jp-seek-bar">
			    <p class="song-title"><?php echo $first_song_title; ?></p>
				<div class="jp-play-bar"></div>
			</div>
		</div><!-- #progress -->
		
		<?php if(!$sidebar){ ?>
    		<a href="#" class="toggle-playlist">Playlist</a>
		<?php } ?>
		
		<div class="clearfix"></div>
		
		<div class="jp-playlist"> <ul> <li></li> </ul> </div><!-- #playlist -->
			
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div><!-- #no-solution -->
	</div>
	<?php endif; endwhile; endif;
}

/**
 * Title tag
 *
 * @since 1.0
 */
function shaken_title_tag() {
	if (is_home() || is_front_page()) {
		echo bloginfo('name');
	} elseif (is_404()) {
		_e('404 Not Found','shaken');
	} elseif (is_category()) {
		_e('Category:','shaken'); wp_title('');
	} elseif (is_tag()) {
		_e('Tag:','shaken'); wp_title('');
	} elseif (is_search()) {
		_e('Search Results','shaken');
	} elseif ( is_day() || is_month() || is_year() ) {
		_e('Archives:','shaken'); wp_title('');
	} else {
		echo wp_title('');
	}
}

/**
 * Custom comment display
 *
 * @since 1.0
 */
if ( ! function_exists( 'shaken_comments' ) ) :
function shaken_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?>>
        <div id="comment-<?php comment_ID(); ?>">
        	<?php $comment_author = get_comment_author_url(); ?>
        	<div class="author-avatar">
        		<?php if($comment_author): ?>
        			<a href="<?php echo $comment_author; ?>">
        			<?php echo get_avatar( $comment, 100 ); ?>
        			</a>
        		<?php else: 
        			echo get_avatar( $comment, 100 );
        		endif; ?>
        	</div>
            
            <div class="comment-content">
	            <p class="author-name"><?php printf( __( '%s', 'shaken' ), sprintf( '%s', get_comment_author_link() ) ); ?>
	            <?php if ($comment->comment_parent>0){
	               _e('replied:' ,'shaken'); 
	           } else {
	               _e('commented:' ,'shaken');
	           } ?></p>
	            <time datetime="<?php echo get_comment_date('Y-m-d'); ?>"><?php printf( __( '%1$s at %2$s', 'shaken' ), get_comment_date('M j') , get_comment_time() ); ?> <?php edit_comment_link( __( '(Edit)', 'shaken' ), ' | ' );?></time>
	            
				<?php if ( $comment->comment_approved == '0' ) : ?>
	                <p><strong><?php _e( 'Your comment is awaiting moderation.', 'shaken' ); ?></strong></p>
	            <?php endif; ?>
				
				<?php comment_text(); ?>
                
            	<p class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<img src="'.get_template_directory_uri().'/images/comment-ic.png" alt="Reply" /> Reply' ) ) ); ?></p>
            	
            </div><!-- #comment-content -->
            
            <div class="clearfix"></div>
        </div><!-- #comment -->  
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( 'Pingback:', 'shaken' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'shaken'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
} endif; 
?>