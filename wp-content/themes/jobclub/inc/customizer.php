<?php
/**
 * Jobclub Theme Customizer
 *
 * @package Jobclub
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function jobclub_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$jobclub_options = jobclub_theme_options();

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'jobclub_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'jobclub_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_panel(
        'theme_options',
        array(
            'title' => esc_html__('Theme Options', 'jobclub'),
            'priority' => 2,
        )
    );



//Social Links
    $wp_customize->add_section(
    'social_section',
	    array(
	        'title' => esc_html__( 'Social Links','jobclub' ),
		     'description' => esc_html__( 'More Social Links are available in Premium Version','jobclub' ),
	        'panel'=>'theme_options',
	        'capability'=>'edit_theme_options',
	    )
	);
	$wp_customize->add_setting('jobclub_theme_options[fb_url]',
	    array(
	        'type' => 'option',
	        'default' => $jobclub_options['fb_url'],
	        'sanitize_callback' => 'jobclub_sanitize_url',
	    )
	);
	$wp_customize->add_control('jobclub_theme_options[fb_url]',
	    array(
	        'label' => esc_html__('Facebook Link', 'jobclub'),
	        'type' => 'text',
	        'section' => 'social_section',
	        'settings' => 'jobclub_theme_options[fb_url]',
	    )
	);
		$wp_customize->add_setting('jobclub_theme_options[insta_url]',
	    array(
	        'type' => 'option',
	        'default' => $jobclub_options['insta_url'],
	        'sanitize_callback' => 'jobclub_sanitize_url',
	    )
	);
	$wp_customize->add_control('jobclub_theme_options[insta_url]',
	    array(
	        'label' => esc_html__('Instagram Link', 'jobclub'),
	        'type' => 'text',
	        'section' => 'social_section',
	        'settings' => 'jobclub_theme_options[insta_url]',
	    )
	);
		$wp_customize->add_setting('jobclub_theme_options[twitter_url]',
	    array(
	        'type' => 'option',
	        'default' => $jobclub_options['twitter_url'],
	        'sanitize_callback' => 'jobclub_sanitize_url',
	    )
	);
	$wp_customize->add_control('jobclub_theme_options[twitter_url]',
	    array(
	        'label' => esc_html__('Twiiter X Link', 'jobclub'),
	        'type' => 'text',
	        'section' => 'social_section',
	        'settings' => 'jobclub_theme_options[twitter_url]',
	    )
	);


    $wp_customize->add_section(
    'article_section',
	    array(
	        'title' => esc_html__( 'Single Article/Blog Page','jobclub' ),
	        'panel'=>'theme_options',
	        'capability'=>'edit_theme_options',
	    )
	);

	$wp_customize->add_setting('jobclub_theme_options[sidebar_show]',
	    array(
	        'type' => 'option',
	        'default'        => true,
	        'default' => $jobclub_options['sidebar_show'],
	        'sanitize_callback' => 'jobclub_sanitize_checkbox',
	    )
	);

	$wp_customize->add_control('jobclub_theme_options[sidebar_show]',
	    array(
	        'label' => esc_html__('Show Sidebar in Single Article?', 'jobclub'),
	        'type' => 'Checkbox',
	        'section' => 'article_section',

	    )
	);



//Header Section
    $wp_customize->add_section(
    'header_section',
	    array(
	        'title' => esc_html__( 'Header Section','jobclub' ),
	        'panel'=>'theme_options',
	        'capability'=>'edit_theme_options',
	    )
	);


       $wp_customize->add_setting( 'jobclub_theme_options[header_layout]', array(
          'capability' => 'edit_theme_options',
          'default' => 'header1',
          'sanitize_callback' => 'jobclub_sanitize_radio',
          'type' => 'option',
    ) );

    $wp_customize->add_control( 'jobclub_theme_options[header_layout]', array(
          'type' => 'radio',
          'section' => 'header_section', // Add a default or your own section
          'label' => esc_attr( __('Choose Header Layout', 'jobclub') ),
          'choices' => array(
            'header1' => esc_attr( __('Default Header', 'jobclub') ),
            'header2' => esc_attr( __('Centered Layout', 'jobclub') ),
            'header3' => esc_attr( __('Bottom Menu Layout', 'jobclub') ),
          ),
    ) );


	$wp_customize->add_setting('jobclub_theme_options[dark_header]',
	    array(
	        'type' => 'option',
	        'default'        => true,
	        'default' => $jobclub_options['dark_header'],
	        'sanitize_callback' => 'jobclub_sanitize_checkbox',
	    )
	);

	$wp_customize->add_control('jobclub_theme_options[dark_header]',
	    array(
	        'label' => esc_html__('Dark Header?', 'jobclub'),
	        'type' => 'Checkbox',
	        'section' => 'header_section',

	    )
	);

	$wp_customize->add_setting('jobclub_theme_options[header_full_width]',
	    array(
	        'type' => 'option',
	        'default'        => true,
	        'default' => $jobclub_options['header_full_width'],
	        'sanitize_callback' => 'jobclub_sanitize_checkbox',
	    )
	);

	$wp_customize->add_control('jobclub_theme_options[header_full_width]',
	    array(
	        'label' => esc_html__('Full Width?', 'jobclub'),
	        'type' => 'Checkbox',
	        'section' => 'header_section',

	    )
	);




	$wp_customize->add_section(
    'footer_section',
	    array(
	        'title' => esc_html__( 'Footer Option','jobclub' ),
	       	'description' => esc_html__( 'Copyright text can be changed in Premium Version','jobclub' ),
	        'panel'=>'theme_options',
	        'capability'=>'edit_theme_options',
	    )
	);

	$wp_customize->add_setting('jobclub_theme_options[show_widgets]',
	    array(
	        'type' => 'option',
	        'default'        => true,
	        'default' => $jobclub_options['show_widgets'],
	        'sanitize_callback' => 'jobclub_sanitize_checkbox',
	    )
	);

	$wp_customize->add_control('jobclub_theme_options[show_widgets]',
	    array(
	        'label' => esc_html__('Show Widgets', 'jobclub'),
	        'type' => 'Checkbox',
	        'priority' => 1,
	        'section' => 'footer_section',

	    )
	);


}
add_action( 'customize_register', 'jobclub_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function jobclub_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function jobclub_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function jobclub_customize_preview_js() {
	wp_enqueue_script( 'jobclub-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'jobclub_customize_preview_js' );
