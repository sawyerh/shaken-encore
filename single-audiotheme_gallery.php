<?php get_header(); ?>
<?php get_sidebar(); ?>

    <div class="page-wrap">
    <?php if (have_posts()) : ?>
           
        <?php while (have_posts()) : the_post(); ?>
            
            <article <?php post_class('post-bubble'); ?> id="post-<?php the_ID(); ?>">
                <div class="entry">
                    <h1> <?php the_title(); ?> </h1>
                    
                    <?php the_content( __('Continue reading &rarr;', 'shaken') ); ?>
                    
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'shaken' ), 'after' => '</div>' ) ); ?>
                    <?php edit_post_link( __('Edit', 'shaken') ); ?>
                    
                    <div class="gallery-grid">
                        <?php $args = array(
                            'post_type' => 'attachment',
                            'post_mime_type' => 'image',
                            'numberposts' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'post_parent' => $post->ID
                        );
                        $images = get_posts($args);

                        if($images):
                            foreach($images as $image)
                            {
                                $big_array = image_downsize( $image->ID, 'full' );
                                $img_url = $big_array[0];
                                echo '<a href="'.$img_url.'" rel="gallery" title="'.$image->post_excerpt.'" class="gallery-thumb thumb">';
                                echo wp_get_attachment_image($image->ID, $size='album_cover');
                                echo '</a>';
                            }
                        endif;
                        ?>
                    </div>
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