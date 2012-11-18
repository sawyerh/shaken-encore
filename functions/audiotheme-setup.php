<?php

function shaken_audiotheme_setup(){
    add_theme_support( 'audiotheme-options', array( 'default_options' => true ) );
}
add_action( 'after_setup_theme', 'shaken_audiotheme_setup' );

function shaken_theme_options(){

	$records_query = array(
		'numberposts' => -1,
		'post_type' => 'audiotheme_record'
	);
	$records = get_posts( $records_query );

	if( !count($records) > 0 ){
		$records_array = array( false => 'No records available' );
	} else {
		$records_array = array( false => '' );
	}

	foreach ($records as $record) {
		$records_array[$record->ID] = $record->post_title;
	}

    $options = AudioTheme_Options::get_instance();

    $panel = $options->set_panel( 'theme-options' );

    $section = $options->add_section( '_default', '' );

    $homepage_options = $options->add_section( '_home', 'Homepage' );
    
    $options->add_field( 
    	'image', // type
    	'logo',  // id
    	__( 'Logo', 'audiotheme' ), // label
    	$section, // section
    	array( 
    		'description' => '<br>(300px max width)' 
    	)
    );

    // Homepage specific
    $options->add_field( 
    	'select', 
    	'home_audioplayer_record', 
    	__( 'Audio player record', 'audiotheme-i18n' ), 
    	$homepage_options, 
	    array( 
	    	'description' => 'Place an audio player on the homepage for this record.',
	        'class'       => 'regular-text',
	        'field_value' => $records_array
	    ) 
	);
}
add_action( 'admin_init', 'shaken_theme_options' );

?>