<?php

$functions_path = TEMPLATEPATH . '/functions/';
$widgets_path = TEMPLATEPATH . '/functions/widgets/';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override shaken_setup() in a child theme, add your own shaken_setup to your child theme's
 * functions.php file.
 *
 * @since 1.0
 */
add_action( 'after_setup_theme', 'shaken_setup' );
function shaken_setup() {
	// Set the $content_width for things such as video embeds
	if ( ! isset( $content_width ) )
	$content_width = 550;
	
	// Theme support
		
		add_editor_style();
		add_theme_support( 'automatic-feed-links' );
		add_custom_background('shaken_custom_background_cb');
		
		// Set featured image sizes
		add_theme_support('post-thumbnails');
			set_post_thumbnail_size(810, 1800);
			add_image_size('archive', 500, 1800);
			add_image_size('album_cover', 500, 500, true);
			add_image_size('album_cover_mini', 110, 110, true);
			add_image_size('sidebar', 75, 75, true);
	
	// Disable support for gigs temporarily
		add_action( 'admin_menu', 'remove_gigs_menu', 13 );

	// Actions
	
		/* Add your nav menus function to the 'init' action hook. */
		add_action( 'init', 'shaken_register_menus' );
		
		/* Add your sidebars function to the 'widgets_init' action hook. */
		add_action( 'widgets_init', 'shaken_register_sidebars' );
		
		// Threaded comments
		add_action('get_header', 'shaken_enable_threaded_comments');
		
		// Disable some widgets
		add_action('widgets_init', 'unregister_default_wp_widgets', 1);
	
	// Filters
		
		// Add wmode='transparent' to auto embedded Flash videos
		add_filter('embed_oembed_html', 'add_video_wmode', 10, 3);
		
		// Nav links
		add_filter( 'next_posts_link_attributes', 'shaken_next_posts_link_class');
		add_filter( 'previous_posts_link_attributes', 'shaken_previous_posts_link_class');
	
	/* Make theme available for translation
	 * Translations can be filed in the /languages/ directory */
	load_theme_textdomain( 'shaken', TEMPLATEPATH . '/languages' );
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}

function remove_gigs_menu(){
	remove_menu_page('gigs');
}

/** 
 * shaken_custom_background_cb()
 * Create a callback for custom backgrounds
 * Removes the old background so the user defined background can display.
 *
 * @since 1.0
**/
function shaken_custom_background_cb() {
	$background = get_background_image();
	$color = get_background_color();
	if ( ! $background && ! $color )
		return;
 
	$style = $color ? "background-color: #$color;" : '';
 
	if ( $background ) {
		$image = " background-image: url('$background');";
 
		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";
 
		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";
 
		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";
 
		$style .= $image . $repeat . $position . $attachment;
	}
?>
<style type="text/css">
body {background:none; <?php echo trim( $style ); ?> }
</style>
<?php }

// --------------  Register Sidebars -------------- 
function shaken_register_sidebars(){
	register_sidebar(array(
		'name'=> __('Blog Sidebar'),
		'id' => 'shaken-blog-sidebar',
		'description' => __('Displayed on the blog and archive pages'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// --------------  Register Menus -------------- 
function shaken_register_menus(){
	register_nav_menus( array(
		'main_menu' => __( 'Main Menu'),
	) );	
}

// --------------  Unegister Widgets -------------- 
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Tag_Cloud');
}

// smart jquery inclusion
function shaken_frontend_scripts(){
    if (!is_admin()) {
    	wp_enqueue_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'shaken_frontend_scripts' );

// enable threaded comments
function shaken_enable_threaded_comments(){
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
			wp_enqueue_script('comment-reply');
	}
}

// Add wmode=transparent 
if(!function_exists('add_video_wmode')){
function add_video_wmode($html, $url, $attr) {
    if ( strpos( $html, "<embed src=" ) !== false ){ 
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); 
    } elseif ( strpos ( $html, 'feature=oembed' ) !== false ){ 
        return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); 
    } else{ 
        return $html;
    }
}}

/**
 * Add class to next and previous posts link
 *
 * @since 1.0
 */
function shaken_previous_posts_link_class(){
    return 'class="new"';
}
function shaken_next_posts_link_class(){
    return 'class="old"';
}

if ( ! defined( 'AUDIOTHEME_DIR' ) )
  define( 'AUDIOTHEME_DIR', get_template_directory() . '/audiotheme-framework/' );
if ( ! defined( 'AUDIOTHEME_URI' ) )
  define( 'AUDIOTHEME_URI', get_template_directory_uri() . '/audiotheme-framework/' );

require( TEMPLATEPATH . '/audiotheme-framework/audiotheme.php' );
require( $functions_path.'audiotheme-setup.php' );
require( $functions_path.'custom-functions.php' );

?>