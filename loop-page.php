<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div class="page-wrap">
    <?php if (have_posts()) : ?>
           
        <?php while (have_posts()) : the_post(); ?>
            
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <div class="entry">
                    <?php if( get_the_audiotheme_post_video() ){
                        echo '<div class="video video-flex">';
                        the_audiotheme_post_video();
                        echo '</div>';
                    } else if( has_post_thumbnail() ){ ?>
                        <span class="feature-image"><?php the_post_thumbnail(); ?></span>
                    <?php } ?>
                    
                    <h1> <?php the_title(); ?> </h1>
                    
                    <?php the_content( __('Continue reading &rarr;', 'shaken') ); ?>
                    
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'shaken' ), 'after' => '</div>' ) ); ?>
                    <?php edit_post_link( __('Edit', 'shaken') ); ?>
                    
                </div><!-- #entry -->
            </article>

        <?php endwhile; ?>
        
    <?php else : ?>
        <article class="post not-found">
            <div class="entry">
                <h1><?php _e( 'Uh Oh', 'shaken' ); ?>&hellip;</h1>
                <p><?php _e( 'Sorry, but you are looking for something that isn\'t here. Try searching for it', 'shaken' ); ?>&hellip;</p>
                <?php get_search_form(); ?>
            </div><!-- #entry -->
        </article><!-- #post -->
    <?php endif; ?>
    </div><!-- #page -->

<?php get_footer(); ?>