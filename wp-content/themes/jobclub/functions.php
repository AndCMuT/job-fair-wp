<?php
/**
 * Jobclub functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jobclub
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jobclub_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Jobclub, use a find and replace
		* to change 'jobclub' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'jobclub', get_template_directory() . '/languages' );

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
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'jobclub' ),
		)
	);

	add_image_size( 'jobclub-blog-thumbnail-img', 650, 450, true);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'jobclub_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'jobclub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jobclub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jobclub_content_width', 640 );
}
add_action( 'after_setup_theme', 'jobclub_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jobclub_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jobclub' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jobclub' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name' => esc_html__('Jobclub Footer Widget', 'jobclub') . $i,
            'id' => 'jobclub_footer_' . $i,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-heading">',
            'after_title' => '</h3>',
        ));
    }
}
add_action( 'widgets_init', 'jobclub_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jobclub_scripts() {
	wp_enqueue_style( 'jobclub-style', get_stylesheet_uri() );
    wp_enqueue_style( 'jobclub-font', jobclub_fonts(), array(), null);
    wp_enqueue_style(
        'jobclub-fontawesome',
        get_template_directory_uri() . '/assets/fontawesome/css/all.css',
        array(),
        '1.0'
    );
   	wp_enqueue_style( 'jobclub-bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '1.0' );
   	wp_enqueue_style( 'jobclub-chosen-css', get_template_directory_uri() . '/assets/css/chosen.css', array(), '1.0' );
	wp_enqueue_style( 'jobclub-css', get_template_directory_uri() . '/assets/css/jobclub.css', array(), '1.0' );
	wp_enqueue_style( 'jobclub-media-queries', get_template_directory_uri() . '/assets/css/media-queries.css', array(), '1.0' );

	wp_enqueue_script( 'jobclub-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'jobclub-chosen-script', get_template_directory_uri() . '/assets/js/chosen.jquery.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'jobclub-custom-script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jobclub_scripts',99  );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/plugin-activation.php';
require get_template_directory() . '/lib/jobclub-tgmp.php';
require get_template_directory() . '/elementor/jobclub-elementor-widget.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jobclub-customizer-default.php';
require get_template_directory() . '/inc/customize-control.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



if (!function_exists('jobclub_fonts')) :
    function jobclub_fonts()
    {
        $fonts_url = '';
        $fonts = array();


		if ('off' !== _x('on', 'Bricolage Grotesque font: on or off', 'jobclub')) {
            $fonts[] = 'Bricolage Grotesque:400,600';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
            ), '//fonts.googleapis.com/css');
        }

        return $fonts_url;
    }
endif;


if(!function_exists('jobclub_blog_get_category')) {
    function jobclub_blog_get_category()
    {

        $terms = get_terms('category',array(
            'hide_empty' => true,
        ));
        $options = ['' => ''];

        foreach ($terms as $t) {
            $options[$t->term_id] = $t->name;
        }
        return $options;
    }
}


if (!function_exists('jobclub_get_excerpt')) :
    function jobclub_get_excerpt($post_id, $count)
    {
        $content_post = get_post($post_id);
        $excerpt = $content_post->post_content;

        $excerpt = strip_shortcodes($excerpt);
		$regex = array (
			'/<h2[^>]*>.*?<\/h2>/i',
			'/<h1[^>]*>.*?<\/h1>/i',
			'/<h3[^>]*>.*?<\/h3>/i',
			'/<h4[^>]*>.*?<\/h4>/i',
			'/<h5[^>]*>.*?<\/h5>/i',
			'/<h6[^>]*>.*?<\/h6>/i',
		);
		
		$excerpt = preg_replace($regex, '', $excerpt);
        $excerpt = strip_tags($excerpt);


        $excerpt = preg_replace('/\s\s+/', ' ', $excerpt);
        $excerpt = preg_replace('#\[[^\]]+\]#', ' ', $excerpt);




        $strip = explode(' ', $excerpt);
        foreach ($strip as $key => $single) {
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        $excerpt = implode(' ', $strip);

        $excerpt = substr($excerpt, 0, $count);
        if (strlen($excerpt) >= $count) {
            $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
            $excerpt = $excerpt . '...';
        }
        return $excerpt;
        
        
    }
endif;


if (!function_exists('jobclub_archive_link')) {
    function jobclub_archive_link($post)
    {
        $year = date('Y', strtotime($post->post_date));
        $month = date('m', strtotime($post->post_date));
        $day = date('d', strtotime($post->post_date));
        $link = site_url('') . '/' . $year . '/' . $month . '?day=' . $day;
        return $link;
    }
}


if (!function_exists('jobclub_blank_widget')) {

    function jobclub_blank_widget()
    {
        echo '<div class="col-md-4">';
        if (is_user_logged_in() && current_user_can('edit_theme_options')) {
            echo '<a href="' . esc_url(admin_url('widgets.php')) . '" target="_blank">' . esc_html__('Add Footer Widget', 'jobclub') . '</a>';
        }
        echo '</div>';
    }
}


//radio box sanitization function
function jobclub_sanitize_radio( $input, $setting ){

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}




if (!function_exists('jobclub_archive_link')) {
    function jobclub_archive_link($post)
    {
        $year = date('Y', strtotime($post->post_date));
        $month = date('m', strtotime($post->post_date));
        $day = date('d', strtotime($post->post_date));
        $link = site_url('') . '/' . $year . '/' . $month . '?day=' . $day;
        return $link;
    }
}



function jobclub_job_manager_enqueue_styles() {
    if ( is_singular() ) {
		  $check_plugin = ( in_array( 'wp-job-manager/wp-job-manager.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ? true : false );
		
		 if ( $check_plugin ) {
        	wp_enqueue_style('job-manager-frontend-css', plugins_url('/assets/dist/css/frontend.css', WP_PLUGIN_DIR . '/wp-job-manager/wp-job-manager.php'));
		 }
    }
}
add_action('wp_enqueue_scripts', 'jobclub_job_manager_enqueue_styles');




function jobclub_enqueue_styles() {
    wp_enqueue_style('jobclub-welcome-style', get_template_directory_uri() . '/welcome/welcome.css', array(), '1.0' );
    wp_enqueue_script( 'jobclub-welcome-script', get_template_directory_uri() . '/welcome/welcome-script.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'jobclub_enqueue_styles');

// Add admin notice
function jobclub_admin_notice() { 
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'jobclub_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();

    if( 'themes.php' == $pagenow && !$meta ){
	    if( is_network_admin() ){
	        return;
	    }

	    if( ! current_user_can( 'manage_options' ) ){
	        return;
	    } ?>
	    <div class="notice notice-success">
	        <h1><?php esc_html_e('Hey, Thank you for installing Jobclub Theme!', 'jobclub'); ?></h1>
	        <p><?php esc_html_e('Jobclub is now installed and ready to use. Click below to see theme documentation, and other details to get started.', 'jobclub'); ?></p>
	        <p><a class="btn btn-default" href="<?php echo esc_url( admin_url( 'themes.php?page=jobclub-welcome' ) ); ?>"><?php esc_html_e('Welcome to Jobclub', 'jobclub'); ?></a></p>
	        <p class="dismiss-link"><strong><a href="?jobclub_admin_notice=1"><?php esc_html_e( 'Dismiss', 'jobclub' ); ?></a></strong></p>
	    </div>
	    <?php

	}
}

add_action( 'admin_notices', 'jobclub_admin_notice' );

if( ! function_exists( 'jobclub_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function jobclub_update_admin_notice(){
    if ( isset( $_GET['jobclub_admin_notice'] ) && $_GET['jobclub_admin_notice'] = '1' ) {
        update_option( 'jobclub_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'jobclub_update_admin_notice' );


/**
 * Add a menu item to the admin menu.
 */
function jobclub_add_welcome_page() {
    add_theme_page(
        esc_html__('About Jobclub', 'jobclub'),
        esc_html__('Welcome to Jobclub', 'jobclub'),
        'manage_options',
        'jobclub-welcome',
        'jobclub_welcome_page'
    );
}
add_action('admin_menu', 'jobclub_add_welcome_page');

/**
 * Display the welcome page content.
 */
function jobclub_welcome_page() {
    include get_template_directory() . '/welcome/welcome.php';
}