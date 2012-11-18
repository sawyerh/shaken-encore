<?php 
/* 
    Template name: Home 
*/
?>

<?php get_header(); ?>

    <!-- Site title / Logo -->
    <?php if( has_post_thumbnail() ){ ?>
        <span class="feature-image"><?php the_post_thumbnail(); ?></span>
	<?php } else if(get_audiotheme_theme_option('logo')) { ?>
    	<img src="<?php echo get_audiotheme_theme_option('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
    <?php } else { ?>
		<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
    	<p class="tagline"><?php bloginfo( 'description' ); ?></p>
    <?php } ?>
	
    <?php if( get_audiotheme_theme_option( 'home_audioplayer_record' ) ){ ?>
	<section class="audio-player">
        <?php get_audio_player( get_audiotheme_theme_option( 'home_audioplayer_record' ), false ); ?>
    </section>
    <?php } ?>
    
    <nav class="primary-nav">
        <?php wp_nav_menu( array('menu_class' => 'primary-nav', 'container' => '', 'theme_location' => 'main_menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
    </nav>

<?php get_shaken_footer(); ?>
<?php get_footer(); ?>