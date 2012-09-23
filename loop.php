<div class="page-wrap">
<?php if (have_posts()) : ?>
	   
	<?php while (have_posts()) : the_post(); ?>
		
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <div class="entry">
               
                <?php if( has_post_thumbnail() ){ ?>
                    <?php if( is_single() ) { ?>
                        <span class="feature-image"><?php the_post_thumbnail(); ?></span>
                    <?php } else { ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="feature-image"><?php the_post_thumbnail(); ?></a>
                    <?php } ?>
                <?php } ?>
                
                <h1>
                    <?php if( is_single() ){ 
                        the_title();
                    } else { ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    <?php } ?>
                </h1>
                
                <?php if( !is_single() && has_excerpt() ){
                    the_excerpt();
                    echo '<a href="'.get_permalink().'">'.__( '[more]', 'shaken' ).'</a>';
                } else {
                    the_content( __('Continue reading &rarr;', 'shaken') );
                } ?>
                
                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'shaken' ), 'after' => '</div>' ) ); ?>
                <?php edit_post_link( __('Edit', 'shaken') ); ?>
                
            </div><!-- #entry -->
            
            <div class="postmeta">
                <time datetime="<?php the_time( 'Y-F-j' ); ?>"><span class="month"><?php the_time( 'F' ); ?> </span><?php the_time( 'j, Y' ); ?></time>
                <?php $categories = get_the_category(); 
                if( $categories ){ ?>
                    <ul class="categories">
                    <?php foreach( $categories as $cat ){ ?>
                        <li><?php echo '<a href="'.get_category_link($cat->term_id ).'"><span>'.$cat->cat_name.'</span></a>'; ?></li>
                    <?php } ?>
                    </ul>
                <?php } ?>
            </div><!-- #postmeta -->
        </article>

    <?php endwhile; ?>
    
    <?php // Display pagination when applicable
    if ( !is_single() && $wp_query->max_num_pages > 1 ) : ?>
        <nav class="post-navigation">
            <?php if( get_next_posts_link() ){
                next_posts_link( __( 'Older posts', 'shaken' ) );
            } else {
                echo '<span class="old">'.__( 'Older posts', 'shaken' ).'</span>';
            } ?>
            
            <?php if( get_previous_posts_link() ){
                previous_posts_link( __( 'Newer posts', 'shaken' ) );
            } else {
                echo '<span class="new">'.__( 'Newer posts', 'shaken' ).'</span>';
            } ?>
        </nav>
    <?php endif; ?>
    
    <?php if( is_single() ) comments_template( '', true ); ?>
    
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