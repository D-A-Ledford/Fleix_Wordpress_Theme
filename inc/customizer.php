<?php
/**
 * flexi Theme Customizer
 *
 * @package flexi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function flexi_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	

	function flexi_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function flexi_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'flexi_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function flexi_customize_preview_js()
{
	wp_enqueue_script( 'flexi_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130515', true );
}

add_action( 'customize_preview_init', 'flexi_customize_preview_js' );

function flexi_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function flexi_sanitize_int( $value )
{
	return (int)$value;
}

function flexi_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'flexi_homepage', array(
		'title'    => __( 'Homepage Setup', 'flexi' ),
		'priority' => 10,
	) );

	$wp_customize->add_panel( 'flexi_site_identity', array(
		'title'    => __( 'Site Identity', 'flexi' ),
		'priority' => 10,
	) );

	// move "site identity" to a panel first
	$wp_customize->add_section( 'title_tagline', array(
		'title'    => __( 'Title and Tagline', 'flexi' ),
		'priority' => 50,
		'panel'    => 'flexi_site_identity',
	) );

	// header logo
	$wp_customize->add_section( 'flexi_header_logo', array(
		'title'    => __( 'Header logo', 'flexi' ),
		'priority' => 50,
		'panel'    => 'flexi_site_identity',
	) );

	$wp_customize->add_setting( 'flexi_header_logo_show', array(
		'default'           => 'logo',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_header_logo_show', array(
		'label'    => __( 'Show header logo or text', 'flexi' ),
		'section'  => 'flexi_header_logo',
		'settings' => 'flexi_header_logo_show',
		'type'     => 'select',
		'choices'  => array( 'logo' => __( 'Logo', 'flexi' ), 'text' => __( 'Text', 'flexi' ) ),
	) );

	$wp_customize->add_setting( 'flexi_header_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'flexi_header_logo_image', array(
		'label'    => __( 'Header logo image', 'flexi' ),
		'section'  => 'flexi_header_logo',
		'settings' => 'flexi_header_logo_image',
	) ) );
	// end header logo

	// hero banner
	$wp_customize->add_section( 'flexi_hero', array(
		'title'       => __( 'Hero Banner', 'flexi' ),
		'priority'    => 50,
		'description' => __( 'Big banner section on the front page - background image', 'flexi' ),
		'panel'       => 'flexi_homepage',
	) );



	$wp_customize->add_setting( 'flexi_hero_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/header.jpg',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'flexi_hero_bg_image', array(
		'label'    => __( 'Background image', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_bg_image',
	) ) );

	$wp_customize->add_setting( 'flexi_hero_title', array(
		'default'           => __( 'Im a Designer.', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_hero_title', array(
		'label'   => __( 'Title', 'flexi' ),
		'section' => 'flexi_hero',
	) );

	$wp_customize->add_setting( 'flexi_hero_text', array(
		'default'           => 'flexi is a light-weight and simple WordPress portfolio theme for showing off your latest photos and designs. It works with the <a href="http://www.woothemes.com/woocommerce/">Free WooCommerce plugin</a> to create your own eCommerce site. It is super simple to setup with some nice options controlled using the Live Customizer.',
		'sanitize_callback' => 'flexi_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_text', array(
		'label'    => __( 'Main text', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_text',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'flexi_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_hero_button1_show', array(
		'label'    => __( 'Show button 1', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'flexi' ), 'no' => __( 'No', 'flexi' ) ),
	) );

	$wp_customize->add_setting( 'flexi_hero_button1_text', array(
		'default'           => __( 'About us', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_button1_text', array(
		'label'    => __( 'Button 1 text', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'flexi_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_button1_link', array(
		'label'    => __( 'Button 1 link', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'flexi_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_hero_button2_show', array(
		'label'    => __( 'Show button 2', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'flexi' ), 'no' => __( 'No', 'flexi' ) ),
	) );

	$wp_customize->add_setting( 'flexi_hero_button2_text', array(
		'default'           => __( 'Contact', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_button2_text', array(
		'label'    => __( 'Button 2 text', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'flexi_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_button2_link', array(
		'label'    => __( 'Button 2 link', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_button2_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'flexi_hero_blur_enabled', array(
		'default'           => 0,
		'sanitize_callback' => 'flexi_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_blur_enabled', array(
		'label'    => __( 'Blur amount (pixels)', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_blur_enabled',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'flexi_hero_overlay_enabled', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_hero_overlay_enabled', array(
		'label'    => __( 'Overlay the image with color', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_overlay_enabled',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'flexi' ), 'no' => __( 'No', 'flexi' ) ),
	) );

	$wp_customize->add_setting( 'flexi_hero_overlay_color', array(
		'default'           => '#000',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'flexi_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_overlay', array(
		'label'    => __( 'Hero image overlay color', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_overlay_color',
	) ) );


	$wp_customize->add_setting( 'flexi_hero_overlay_opacity', array(
		'default'           => '80',
		'sanitize_callback' => 'flexi_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_hero_overlay_opacity', array(
		'label'    => __( 'Overlay opacity (between 0 and 100)', 'flexi' ),
		'section'  => 'flexi_hero',
		'settings' => 'flexi_hero_overlay_opacity',
		'type'     => 'text',
	) );

	// end hero banner
	

	// social
	$wp_customize->add_section( 'flexi_header_social', array(
		'title'    => __( 'Social', 'flexi' ),
		'priority' => 50,
		'panel'    => 'flexi_homepage',
	) );
	$wp_customize->add_setting( 'flexi_header_social_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_header_social_show', array(
		'label'    => __( 'Show social icons below the hero banner text', 'flexi' ),
		'section'  => 'flexi_header_social',
		'settings' => 'flexi_header_social_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'flexi' ), 'no' => __( 'No', 'flexi' ) ),
	) );

	$wp_customize->add_setting( 'flexi_header_social_twitter', array(
		'default'           => __( 'http://twitter.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_twitter', array(
		'label'   => __( 'Twitter URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_facebook', array(
		'default'           => __( 'http://facebook.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_facebook', array(
		'label'   => __( 'Facebook URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_pinterest', array(
		'default'           => __( 'http://pinterest.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_pinterest', array(
		'label'   => __( 'Pinterest URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_linkedin', array(
		'default'           => __( 'http://linkedin.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_linkedin', array(
		'label'   => __( 'LinkedIn URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_gplus', array(
		'default'           => __( 'http://plus.google.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_gplus', array(
		'label'   => __( 'Google+ URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_behance', array(
		'default'           => __( 'http://behance.net', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_behance', array(
		'label'   => __( 'Behance URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_dribbble', array(
		'default'           => __( 'http://dribbble.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_dribbble', array(
		'default'           => __( 'http://dribbble.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_dribbble', array(
		'label'   => __( 'Dribbble URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_flickr', array(
		'default'           => __( 'http://flickr.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_flickr', array(
		'label'   => __( 'Flickr URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_500px', array(
		'default'           => __( 'http://500px.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_500px', array(
		'label'   => __( '500px URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_reddit', array(
		'default'           => __( 'http://reddit.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_reddit', array(
		'label'   => __( 'Reddit URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_wordpress', array(
		'default'           => __( 'http://wordpress.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_wordpress', array(
		'label'   => __( 'Wordpress URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_youtube', array(
		'default'           => __( 'http://youtube.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_youtube', array(
		'label'   => __( 'Youtube URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_soundcloud', array(
		'default'           => __( 'http://soundcloud.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_soundcloud', array(
		'label'   => __( 'Soundcloud URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );

	$wp_customize->add_setting( 'flexi_header_social_medium', array(
		'default'           => __( 'http://medium.com', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_header_social_medium', array(
		'label'   => __( 'Medium URL', 'flexi' ),
		'section' => 'flexi_header_social',
	) );
	// end social

	// footer logo
	$wp_customize->add_section( 'flexi_footer_logo', array(
		'title'    => __( 'Footer logo', 'flexi' ),
		'priority' => 50,
		'panel'    => 'flexi_site_identity',
	) );

	$wp_customize->add_setting( 'flexi_footer_logo_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_footer_logo_show', array(
		'label'    => __( 'Show footer logo', 'flexi' ),
		'section'  => 'flexi_footer_logo',
		'settings' => 'flexi_footer_logo_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'flexi' ), 'no' => __( 'No', 'flexi' ) ),
	) );

	$wp_customize->add_setting( 'flexi_footer_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo-footer.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'flexi_footer_logo_image', array(
		'label'    => __( 'Footer logo image', 'flexi' ),
		'section'  => 'flexi_footer_logo',
		'settings' => 'flexi_footer_logo_image',
	) ) );
	// end footer logo
	
		// Latest Text
	$wp_customize->add_section( 'Latest_Text', array(
		'title'       => __( 'Latest Work', 'flexi' ),
		'priority'    => 51,
		'description' => __( 'Latest Work Text', 'flexi' ),
		'panel'       => 'flexi_homepage',
	) );

	
		$wp_customize->add_setting( 'flexi_latest_title_l', array(
		'default'           => __( 'Check out My Latest Work', 'flexi' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'flexi_latest_title_l', array(
		'label'   => __( 'Latest Work Title', 'flexi' ),
		'section' => 'Latest_Text',
	) );

	$wp_customize->add_setting( 'flexi_latest_text_l', array(
		'default'           => 'Here is a selection of images, photographs and designs I have created.',
		'sanitize_callback' => 'flexi_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'flexi_latest_text_l', array(
		'label'    => __( 'Latest Work Text', 'flexi' ),
		'section'  => 'Latest_Text',
		'settings' => 'flexi_latest_text_l',
		'type'     => 'textarea',
	) );


	
	//End footer feature

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'flexi_google_fonts', array(
		'title'    => __( 'Fonts', 'flexi' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'flexi_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'flexi' ),
		'section'  => 'flexi_google_fonts',
		'settings' => 'flexi_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'flexi_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'flexi_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'flexi' ),
		'section'  => 'flexi_google_fonts',
		'settings' => 'flexi_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors

	$wp_customize->add_setting( 'flexi_accent_color', array(
		'default'           => '#f0be0f',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'flexi_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => __( 'Accent color', 'flexi' ),
		'section'  => 'colors',
		'settings' => 'flexi_accent_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'flexi_customizer', 11 );