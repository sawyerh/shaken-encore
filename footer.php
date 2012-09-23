</div><!-- #wrap -->

<?php global $shaken_jplayer;
    if( $shaken_jplayer ){ ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jplayer/jplayer.playlist.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jplayer/jquery.jplayer.min.js"></script>
<?php } ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>

<?php global $shaken_share_buttons;
    if( $shaken_share_buttons ){ ?>
    <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
    </script>
    
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
