<?php get_header(); ?>
<?php get_sidebar(); ?>

    <?php 
    if (have_posts()) : while (have_posts()) : the_post(); 

        $tracks = get_audiotheme_record_tracks( $post->ID );
        $release_date = get_post_meta( $post->ID, '_audiotheme_release_year', true );
        $artist = get_post_meta( $post->ID, '_audiotheme_artist', true );
        $genre = get_post_meta( $post->ID, '_audiotheme_genre', true );

        $metadata = array();
        if( $release_date ) $metadata['release_date'] = $release_date;
        if( $artist ) $metadata['artist'] = $artist;
        if( $genre ) $metadata['genre'] = $genre;

        $links = get_audiotheme_record_links( $post->ID );
    ?>
        <section id="post-<?php the_ID(); ?>" <?php post_class( 'page page-wrap post-bubble' ); ?>>
            
            <header>
                <?php if( has_post_thumbnail() ){ ?>
                    <figure class="album-cover"><?php the_post_thumbnail( 'album_cover_mini' ); ?></figure>
                <?php } ?>
                
	            <h1><?php the_title(); ?></h1>
	            
                <?php if( count($metadata) > 0 ){ ?>
                <p class="record-metadata">
                    <?php foreach ($metadata as $k => $v) {
                        echo $v;

                        if( $v != end( $metadata ) )
                            echo ' / ';
                    } ?>
                </p>
                <?php } ?>

	            <div class="buttons">
                    <?php foreach ($links as $l){ ?>
                        <a href="<?php echo $l['url'] ?>" class="button"><?php echo $l['name'] ?></a>
                    <?php } ?>

                    <span class="button show-share-button">Share</span>
                    <?php global $shaken_share_buttons; $shaken_share_buttons = true; ?>
                    <div class="share-buttons">
        				<div class="tweet-button">
        				    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="<?php urlencode(get_permalink()); ?>" data-text="Currently listening to <?php the_title_attribute(); ?>" data-count="none">Tweet</a>
        				</div>
        				<div class="like-button">
        				    <div class="fb-like" data-send="false" data-layout="button_count" data-width="10" data-show-faces="false"></div>
        				</div>
                    </div><!-- #share -->
                    
                    <br />
                </div><!-- #buttons -->
            </header>

            <div class="record-info">
            	<?php the_content(); ?>
            </div>
        	
        	<div id="tabs">
                <ul class="tab-nav">
                    <?php if( $tracks ) { ?><li><a href="#tracklist-tab">Tracklist</a></li><?php } ?>
                </ul>
                
                <?php if( $tracks ) { ?>
                <div id="tracklist-tab">
                    <?php get_audio_player( $post->ID, false, 'single' ); ?>
                </div><!-- #tracklist -->
                <?php } ?>
            </div><!-- #tabs -->
        </section>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>