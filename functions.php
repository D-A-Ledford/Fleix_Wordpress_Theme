<?php
/**
 * flexi functions and definitions
 *
 * @package flexi
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( !isset( $content_width ) ) {
	$content_width = 1060; /* pixels */
}

if ( !function_exists( 'flexi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flexi_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on flexi, use a find and replace
		 * to change 'flexi' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'flexi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		// enable featured images
		add_theme_support( 'post-thumbnails' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'flexi_custom_background_args', array(
			'default-color' => '#fff',
			'default-image' => '',
			'panel'         => 'flexi_colors',
		) ) );

		add_image_size( 'flexi-full', 1060, 700, true );
		add_image_size( 'flexi-blog-thumb', 690, 542, true ); 
	}
endif;
add_action( 'after_setup_theme', 'flexi_setup' );


// WooCommerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'flexi' ),
) );
function flexi_set_sample_content()
{


	// Add default items to primary menu
	$primary_menu_items = wp_get_nav_menu_items( 'primary' );
	if ( empty( $primary_menu_items ) ) {
		$name = 'primary';
		$menu_id = wp_create_nav_menu( $name );
		$menu = get_term_by( 'name', $name, 'nav_menu' );

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Home', 'flexi' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Pricing', 'flexi' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Blog', 'flexi' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Contact', 'flexi' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Members', 'flexi' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Sign up', 'flexi' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['primary'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// set sample content - text, images, titles, team members
	if ( !get_theme_mod( 'flexi_content_set', false ) ) {
		// set up default widgets
		$active_sidebars = get_option( 'sidebars_widgets' );
		$search_widget = get_option( 'widget_search' );
		$search_widget[1] = array( 'title' => __( 'Search', 'flexi' ) );

		$admin = get_user_by( 'email', get_option( 'admin_email' ) );
		$userId = $admin->ID;
		$author_box_widget = get_option( 'widget_flexi-author-box-widget' );
		$author_box_widget[1] = array(
			'title-' . $userId               => __( 'AUTHOR PROFILE', 'flexi' ),
			'textbox-' . $userId             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.',
			'image_url-' . $userId           => get_template_directory_uri() . '/images/author_profile.png',
			'social_twitter-' . $userId      => 'http://twitter.com',
			'social_facebook-' . $userId     => 'https://facebook.com',
			'social_linkedin-' . $userId     => 'https://linkedin.com',
			'social_pinterest-' . $userId    => 'https://pinterest.com',
			'social_dribbble-' . $userId     => 'https://dribbble.com',
			'social_drupal-' . $userId       => 'https://drupal.com',
			'social_wordpress-' . $userId    => 'https://wordpress.com',
			'social_y-combinator-' . $userId => 'https://ycombinator.com',
			'social_gplus-' . $userId        => 'https://plus.google.com',
		);


		$popular_recent_posts_widget = get_option( 'widget_flexi-recent-popular-posts-widget' );
		$popular_recent_posts_widget[1] = array( 'title-popular' => 'Popular', 'title-recent' => 'Recent', 'timeflexi' => 'week', 'limit' => 3 );

		$text_widget = get_option( 'widget_text' );
		$text_widget[1] = array( 'title' => __( 'Text Widget', 'flexi' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );
		$text_widget[2] = array( 'title' => __( 'Text Widget', 'flexi' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );
		$text_widget[3] = array( 'title' => __( 'Text Widget', 'flexi' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );
		$text_widget[4] = array( 'title' => __( 'Text Widget', 'flexi' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );


		$active_sidebars['flexi-footer'] = array( 'text-1', 'text-2', 'text-3', 'text-4' );
		update_option( 'widget_flexi-author-box-widget', $author_box_widget );
		update_option( 'widget_flexi-recent-popular-posts-widget', $popular_recent_posts_widget );
		update_option( 'sidebars_widgets', $active_sidebars );

		$active_sidebars['sidebar-1'] = array( 'flexi-author-box-widget-1', 'text-4', 'search-1', 'flexi-recent-popular-posts-widget-1' );
		update_option( 'widget_search', $search_widget );
		update_option( 'widget_text', $text_widget );
		update_option( 'sidebars_widgets', $active_sidebars );


		$feature_widget = get_option( 'widget_flexi-feature-widget' );
		$feature_widget[1] = array(
			'title'   => __( 'Modern Design', 'flexi' ),
			'textbox' => 'flexi has a nice homepage with a hero header area so you can write some into text with call to action buttons and links to your social media profiles.',
			'url'     => get_home_url(),
			'icon'    => 'fa-desktop',

		);
		$feature_widget[2] = array(
			'title'   => __( 'eCommerce Ready', 'flexi' ),
			'textbox' => 'Use flexi with the <a href="http://www.woothemes.com/woocommerce/">WooCommerce plugin</a> and you can create your own online store to sell digital or tangible products with no fuss.',
			'url'     => get_home_url(),
			'icon'    => ' fa-shopping-basket',

		);
		$feature_widget[3] = array(
			'title'   => __( 'Live Customize', 'flexi' ),
			'textbox' => 'Using the built-in WordPress Customizer you can change colors, fonts, text, buttons and upload your own logo for the footer and the header area.',
			'url'     => get_home_url(),
			'icon'    => 'fa-gears',

		);
		$feature_widget[4] = array(
			'title'   => __( 'Coded With Care', 'flexi' ),
			'textbox' => 'We have coded the flexi theme to be fast loading, with no bloated extras and it complies with all the latest WordPress theme requirements.',
			'url'     => get_home_url(),
			'icon'    => 'fa-file-code-o',

		);
		$active_sidebars['flexi-features'] = array( 'flexi-feature-widget-1', 'flexi-feature-widget-2', 'flexi-feature-widget-3', 'flexi-feature-widget-4' );
		update_option( 'widget_flexi-feature-widget', $feature_widget );
		update_option( 'sidebars_widgets', $active_sidebars );

		// set customizer options
		set_theme_mod( 'flexi_header_logo_image', get_template_directory_uri() . '/images/logo.png' );
		set_theme_mod( 'flexi_header_logo_show', 'logo' );
		set_theme_mod( 'flexi_footer_logo_image', get_template_directory_uri() . '/images/logo-footer.png' );
		set_theme_mod( 'flexi_footer_logo_show', 'yes' );
		set_theme_mod( 'flexi_header_logo_text', get_bloginfo( 'name' ) );
		set_theme_mod( 'flexi_hero_show', 'yes' );
		set_theme_mod( 'flexi_hero_bg_image', get_template_directory_uri() . '/images/header.jpg' );
		set_theme_mod( 'flexi_hero_title', 'I&rsquo;m a Designer.' );
		set_theme_mod( 'flexi_hero_text', 'flexi is a light-weight and simple WordPress portfolio theme for showing off your latest photos and designs. It works with the <a href="http://www.woothemes.com/woocommerce/">Free WooCommerce plugin</a> to create your own eCommerce site. It is super simple to setup with some nice options controlled using the Live Customizer.' );
		set_theme_mod( 'flexi_hero_overlay_enabled', 'yes' );
		set_theme_mod( 'flexi_hero_overlay_opacity', 80 );

		set_theme_mod( 'flexi_header_social_twitter', 'http://twitter.com' );
		set_theme_mod( 'flexi_header_social_facebook', 'https://facebook.com' );
		set_theme_mod( 'flexi_header_social_pinterest', 'https://pinterest.com' );
		set_theme_mod( 'flexi_header_social_linkedin', 'https://linkedin.com' );
		set_theme_mod( 'flexi_header_social_gplus', 'https://plus.google.com' );
		set_theme_mod( 'flexi_header_social_behance', 'http://behance.net' );
		set_theme_mod( 'flexi_header_social_dribbble', 'http://dribbble.com' );
		set_theme_mod( 'flexi_header_social_flickr', 'http://flickr.com' );
		set_theme_mod( 'flexi_header_social_500px', 'http://500px.com' );
		set_theme_mod( 'flexi_header_social_reddit', 'http://reddit.com' );
		set_theme_mod( 'flexi_header_social_wordpress', 'http://wordpress.com' );
		set_theme_mod( 'flexi_header_social_youtube', 'http://youtube.com' );
		set_theme_mod( 'flexi_hero_button1_text', __( 'About us', 'flexi' ) );
		set_theme_mod( 'flexi_hero_button2_text', __( 'Contact us', 'flexi' ) );

		set_theme_mod( 'flexi_content_set', true );
	}
}

add_action( 'after_switch_theme', 'flexi_set_sample_content', 100 );

// Style the Tag Cloud
function flexi_tag_cloud_widget( $args )
{
	$args['largest'] = 12; //largest tag
	$args['smallest'] = 12; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['number'] = '8'; //number of tags
	return $args;
}

add_filter( 'widget_tag_cloud_args', 'flexi_tag_cloud_widget' );


// add custom class to tags
function flexi_add_class_the_tags( $html )
{
	$html = str_replace( '<a', '<a class="button seethrough small"', $html );

	return $html;
}

add_filter( 'the_tags', 'flexi_add_class_the_tags' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function flexi_widgets_init()
{

	register_sidebar( array(
		'name'          => __( 'Footer', 'flexi' ),
		'id'            => 'flexi-footer',
		'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
    
    register_sidebar(array(
		'name' => 'about',
        'id'  => 'about', 
		'before_widget' => '<div class="sidebarwidget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="sidehead">',
		'after_title' => '</h4>',
	));


	register_sidebar(array(
		'name' => 'getintouch',
        'id' => 'getintouch',
		'before_widget' => '<div class="sidebarwidget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="sidehead">',
		'after_title' => '</h4>',
	));

}

add_action( 'widgets_init', 'flexi_widgets_init' );
 


// Load Roboto Font
function flexi_fonts_url()
{
	$fonts_url = '';
	$font_families = array();

	// default fonts - Roboto and Arimo
	$roboto = _x( 'on', 'Montserrat font: on or off', 'flexi' );
	$arimo = _x( 'on', 'Arimo font: on or off', 'flexi' );
	$heading_font_family = get_theme_mod( 'flexi_google_fonts_heading_font', null );
	$body_font_family = get_theme_mod( 'flexi_google_fonts_body_font', null );

	if ( 'off' !== $roboto ) {
		$font_families[] = 'Montserrat, sans-serif;:400,700';
	}

	if ( 'off' !== $arimo ) {
		$font_families[] = 'Arimo:400,400italic,700,700italic';
	}

	if ( !empty( $heading_font_family ) && $heading_font_family !== 'none' ) {
		$heading_font = _x( 'on', $heading_font_family . ' font: on or off', 'flexi' );
		if ( 'off' !== $heading_font ) {
			$font_families[] = $heading_font_family;
		}
	}

	if ( !empty( $body_font_family ) && $body_font_family !== 'none' && $body_font_family !== $heading_font_family ) {
		$body_font = _x( 'on', $body_font_family . ' font: on or off', 'flexi' );
		if ( 'off' !== $body_font ) {
			$font_families[] = $body_font_family;
		}
	}


	// if both body and heading fonts are set in customizer,
	// don't include default Roboto and Arimo fonts
	if ( count( $font_families ) === 4 ) {
		array_slice( $font_families, 2 );
	}

	if ( !empty( $font_families ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function flexi_scripts()
{
	wp_enqueue_style( 'flexi-style', get_stylesheet_uri() );
	wp_enqueue_style( 'flexi-font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css' );
	wp_enqueue_style( 'flexi-fonts', flexi_fonts_url(), array(), null );
	wp_enqueue_script( 'flexi-footer-scripts', get_template_directory_uri() . '/inc/js/script.js', array( 'jquery' ), '20151107', true );
	wp_enqueue_script( 'flexi-nanobar', get_template_directory_uri() . '/inc/js/nanobar.min.js', array( 'jquery' ), '20151107' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'flexi_scripts' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis) and sets character length to 35
 */
/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function flexi_custom_excerpt_length( $length )
{
	return 20;
}

add_filter( 'excerpt_length', 'flexi_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function flexi_excerpt_more( $more )
{
	return '';
}

add_filter( 'excerpt_more', 'flexi_excerpt_more' );

function flexi_esc_html( $text )
{
	return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
}

function flexi_pagination( $wp_query_object = null )
{
	global $wp_query;
	$query_object = !empty( $wp_query_object ) ? $wp_query_object : $wp_query;
	if ( !is_page() && $query_object->max_num_pages < 2 ) {
		return;
	}
	$big = 999999999; // need an unlikely integer
	echo '<div class="pagination">';
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total'   => $query_object->max_num_pages
	) );
	echo '</div>';
}

//init the meta box
add_action( 'after_setup_theme', 'custom_postimage_setup' );
function custom_postimage_setup(){
    add_action( 'add_meta_boxes', 'custom_postimage_meta_box' );
    add_action( 'save_post', 'custom_postimage_meta_box_save' );
}

function custom_postimage_meta_box(){

    //on which post types should the box appear?
    $post_types = array('post','page');
    foreach($post_types as $pt){
        add_meta_box('custom_postimage_meta_box',__( 'More Featured Images', 'yourdomain'),'custom_postimage_meta_box_func',$pt,'side','low');
    }
}

function custom_postimage_meta_box_func($post){

    //an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
    $meta_keys = array('second_featured_image','third_featured_image');

    foreach($meta_keys as $meta_key){
        $image_meta_val=get_post_meta( $post->ID, $meta_key, true);
        ?>
        <div class="custom_postimage_wrapper" id="<?php echo $meta_key; ?>_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo ($image_meta_val!=''?wp_get_attachment_image_src( $image_meta_val)[0]:''); ?>" style="width:100%;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" alt="">
            <a class="addimage button" onclick="custom_postimage_add_image('<?php echo $meta_key; ?>');"><?php _e('add image','yourdomain'); ?></a><br>
            <a class="removeimage" style="color:#a00;cursor:pointer;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" onclick="custom_postimage_remove_image('<?php echo $meta_key; ?>');"><?php _e('remove image','yourdomain'); ?></a>
            <input type="hidden" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $image_meta_val; ?>" />
        </div>
    <?php } ?>
    <script>
    function custom_postimage_add_image(key){

        var $wrapper = jQuery('#'+key+'_wrapper');

        custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php _e('select image','yourdomain'); ?>',
            button: {
                text: '<?php _e('select image','yourdomain'); ?>'
            },
            multiple: false
        });
        custom_postimage_uploader.on('select', function() {

            var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
            var img_url = attachment['url'];
            var img_id = attachment['id'];
            $wrapper.find('input#'+key).val(img_id);
            $wrapper.find('img').attr('src',img_url);
            $wrapper.find('img').show();
            $wrapper.find('a.removeimage').show();
        });
        custom_postimage_uploader.on('open', function(){
            var selection = custom_postimage_uploader.state().get('selection');
            var selected = $wrapper.find('input#'+key).val();
            if(selected){
                selection.add(wp.media.attachment(selected));
            }
        });
        custom_postimage_uploader.open();
        return false;
    }

    function custom_postimage_remove_image(key){
        var $wrapper = jQuery('#'+key+'_wrapper');
        $wrapper.find('input#'+key).val('');
        $wrapper.find('img').hide();
        $wrapper.find('a.removeimage').hide();
        return false;
    }
    </script>
    <?php
    wp_nonce_field( 'custom_postimage_meta_box', 'custom_postimage_meta_box_nonce' );
}

function custom_postimage_meta_box_save($post_id){

    if ( ! current_user_can( 'edit_posts', $post_id ) ){ return 'not permitted'; }

    if (isset( $_POST['custom_postimage_meta_box_nonce'] ) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'],'custom_postimage_meta_box' )){

        //same array as in custom_postimage_meta_box_func($post)
        $meta_keys = array('second_featured_image','third_featured_image');
        foreach($meta_keys as $meta_key){
            if(isset($_POST[$meta_key]) && intval($_POST[$meta_key])!=''){
                update_post_meta( $post_id, $meta_key, intval($_POST[$meta_key]));
            }else{
                update_post_meta( $post_id, $meta_key, '');
            }
        }
    }
}


require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/themesetup.php';
require get_template_directory() . '/inc/customizer.php';
