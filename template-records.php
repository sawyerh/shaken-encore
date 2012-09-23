<?php 
/* 
    Template name: Record Archive 
*/
?>

<?php get_header(); ?>
<?php get_sidebar(); ?>
    
    <div class="page-wrap">
    <?php 
    $record_query = array(
        'post_type' => 'audiotheme_record',
        'posts_per_page' => -1
    );
    $records = new WP_Query( $record_query );
    if( $records->have_posts() ): while ( $records->have_posts() ) : $records->the_post(); 
    ?>
        <article class="album">
            <a href="<?php the_permalink(); ?>">
                <?php if( has_post_thumbnail() ){
                    the_post_thumbnail('album_cover');
                } ?>
                <h1><?php the_title(); ?></h1>
            </a>
        </article>
	<?php endwhile; endif; ?>
    </div><!-- #page -->
<?php get_footer(); ?>