<?php get_header(); ?>
<?php get_sidebar(); ?>

    <?php
    /* Run the loop to output the posts.
    * If you want to overload this in a child theme then include a file
    * called loop-single.php and that will be used instead.
    */
    get_template_part( 'loop', 'page' );
    ?>

<?php get_footer(); ?>