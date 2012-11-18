<?php get_header(); ?>
<?php get_sidebar(); ?>
    
    <div class="page-wrap">
        <?php 
        query_posts('posts_per_page=-1&post_type=audiotheme_gallery');
        if( have_posts() ): while ( have_posts() ) : the_post(); 
        ?>
            <article class="album">
                <a href="<?php the_permalink(); ?>">
                    <?php if( has_post_thumbnail() ){
                        the_post_thumbnail('album_cover');
                    } else {
                        // Grab the first image of the gallery
                        $args = array(
                            'post_type' => 'attachment',
                            'post_mime_type' => 'image',
                            'numberposts' => 1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'post_parent' => $post->ID
                        );
                        $images = get_posts($args);

                        if($images):
                            echo wp_get_attachment_image($images[0]->ID, $size='album_cover');
                        endif;
                    } ?>
                    <h1><?php the_title(); ?></h1>
                </a>
            </article>
    	<?php endwhile; else: ?>
            You haven't posted any galleries yet!
        <?php endif; ?>
    </div><!-- #page -->
<?php get_footer(); ?>