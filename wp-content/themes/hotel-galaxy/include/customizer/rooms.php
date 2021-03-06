<?php 
/*****Services section******/

$wp_customize->add_section('service_rooms_sec',array(
	'title' => __( 'Service rooms Section','hotel-galaxy' ),
	'description' => '',
	'panel'=>'hotel_galaxy_theme_option',
	'capability'=>'edit_theme_options',
	'priority' => 37,			
	));

//section show or hide
$wp_customize->add_setting(	'hotel_galaxy_option[service_rooms_show]',array(
	'type'    => 'option',
	'default'=>$hotel_galaxy_option['service_rooms_show'],
	'sanitize_callback'=>'sanitize_text_field',	
	'capability'        => 'edit_theme_options',
	)
);
$wp_customize->add_control( 'service_rooms_show', array(
	'label'        => __( 'Show This Section', 'hotel-galaxy' ),
	'type'=>'checkbox',
	'section'    => 'service_rooms_sec',
	'settings'   => 'hotel_galaxy_option[service_rooms_show]',
	) );

//services title
$wp_customize->add_setting('hotel_galaxy_option[service_rooms_title]',array(
	'type'=>'option',
	'default'=>$hotel_galaxy_option['service_rooms_title'],	
	'sanitize_callback'=>'hotel_galaxy_sanitize_text',
	'capability'        => 'edit_theme_options',
	));
$wp_customize->add_control( 'service_rooms_title', array(
	'label'        => __( 'Service Room Section Title', 'hotel-galaxy' ),
	'type'=>'text',
	'section'    => 'service_rooms_sec',
	'settings'   => 'hotel_galaxy_option[service_rooms_title]',
	));

/******image 1 end*******/
?>