<?php get_header(); ?>
<?php get_sidebar(); ?>
    
    <div class="page-wrap">
        <?php 
        query_posts('posts_per_page=-1&post_type=audiotheme_video');
        if( have_posts() ): while ( have_posts() ) : the_post(); 
        ?>
            <article class="album">
                <?php if( get_the_audiotheme_post_video() ){
                    echo '<div class="video video-flex">';
                    the_audiotheme_post_video();
                    echo '</div>';
                } ?>
                <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
            </article>
    	<?php endwhile; else: ?>
            You haven't posted any videos yet!
        <?php endif; ?>
    </div><!-- #page -->
<?php get_footer(); ?>