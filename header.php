<?php
/**
 * Header Template
 *
 * This file is responsible for generating the
 * top-most html for all public-facing views.
 * It's content is generated via core WordPress
 * functions as well as custom actions defined
 * in functions.php.
 *
 * Child themes are encouraged to work with the
 * actions defined herein to add or remove data
 * to/from the top of the template. In the event
 * that the html needs to be modified, this
 * template may be duplicated inside a child theme
 * and edited there.
 *
 * @author       Sawyer Hollenshead <hello@shakenandstirredweb.com>
 * @copyright    Copyright 2012
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.0
 * @alter        1.0
 *
 */
 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js ie6" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 7]>     <html class="no-js ie7" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 8]>     <html class="no-js ie8" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php language_attributes(); ?>"> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,<?php bloginfo( 'html_type' ); ?>">
	
	<title><?php shaken_title_tag(); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=20120420211601" type="text/css" media="screen" />
		
	<?php wp_head(); ?>
	<script type="text/javascript">
	    // Google Web Fonts
        WebFontConfig = {
            google: { families: [ 'Crimson+Text:400,400italic,700,700italic:latin' ] }
        };
        (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
        })();
    </script>
</head>

<body <?php body_class( 'shaken_stirred' ); ?>>

    <div class="wrap">