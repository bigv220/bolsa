<?php
/**
 * Charitas functions and definitions
 *
 * @package WordPress
 * @subpackage Charitas
 * @since Charitas 1.0
 */


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
	$content_width = 790; /* pixels */

/*-----------------------------------------------------------------------------------*/
/*	Include Option Tree
/*-----------------------------------------------------------------------------------*/

	/*-----------------------------------------------------------
		Optional: set 'ot_show_pages' filter to false.
		This will hide the settings & documentation pages.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_pages', '__return_true' );


	/*-----------------------------------------------------------
		Optional: set 'ot_show_new_layout' filter to false.
		This will hide the "New Layout" section on the Theme Options page.
	-----------------------------------------------------------*/

	add_filter( 'ot_show_new_layout', '__return_false' );


	/*-----------------------------------------------------------
		Required: set 'ot_theme_mode' filter to true.
	-----------------------------------------------------------*/

	add_filter( 'ot_theme_mode', '__return_true' );


	/*-----------------------------------------------------------
		Required: include OptionTree.
	-----------------------------------------------------------*/

	include_once( get_template_directory() . '/option-tree/ot-loader.php' );
	include_once( get_template_directory() . '/inc/theme-options.php' );
	include_once( get_template_directory() . '/inc/custom-post-type/meta-boxes.php' );


/*-----------------------------------------------------------------------------------*/
/*	Theme setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wplook_setup' ) ) :

function wplook_setup() {


	/*-----------------------------------------------------------
		Make theme available for translation
	-----------------------------------------------------------*/

	load_theme_textdomain( 'wplook', get_template_directory() . '/languages' );


	/*-----------------------------------------------------------
		Theme style for the visual editor
	-----------------------------------------------------------*/
	
	add_editor_style( 'css/editor-style.css' );

	/*-----------------------------------------------------------
		Add default posts and comments RSS feed links to head
	-----------------------------------------------------------*/
	
	add_theme_support( 'automatic-feed-links' );


	/*-----------------------------------------------------------
		Enable support for Post Thumbnails on posts and pages
	-----------------------------------------------------------*/
	
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'small-thumb', 272, 150, true );
	add_image_size( 'medium-thumb', 500, 277, true );
	add_image_size( 'big-thumb', 1200, 661, true );
	add_image_size( 'candidate-thumb', 225, 235, true );
	add_image_size( 'parallax-thumb', 1920, 714, true );
	add_image_size( 'publications-thumb', 200, 9999 );
	
	/*-----------------------------------------------------------
		Register menu
	-----------------------------------------------------------*/
	
	function register_my_menus() {
		register_nav_menus(
				array(
					'primary' => __( 'Main Menu', 'wplook' ),
					'language' => __( 'Language Menu', 'wplook' ),
				) 
		);
	}
		
	add_action( 'init', 'register_my_menus' );
	wp_create_nav_menu( 'Main Menu', array( 'slug' => 'primary' ) );
	wp_create_nav_menu( 'Language Menu', array( 'slug' => 'language' ) );
	
	/*-----------------------------------------------------------
		Enable support for Post Formats
	-----------------------------------------------------------*/
	
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'status' ) );


	/*-----------------------------------------------------------
		Add theme Support Custom Background
	-----------------------------------------------------------*/
	
	add_theme_support( 'custom-background' );


	/*-----------------------------------------------------------
		Add theme Support  Custom Header
	-----------------------------------------------------------*/
	
	add_theme_support( 'custom-header' );

}
endif; // wplook_setup
add_action( 'after_setup_theme', 'wplook_setup' );



/*-----------------------------------------------------------------------------------*/
/*	Include Theme specific functionality
/*-----------------------------------------------------------------------------------*/

include_once( get_template_directory() . '/inc/widgets/widget-init.php' );				// Initiate all widgets
include_once( get_template_directory() . '/inc/headerdata.php' );						// Include header data
include_once( get_template_directory() . '/inc/library.php' );							// Include other functions
include_once( get_template_directory() . '/inc/custom-post-type/causes.php' );			// Include Post Type Causes
include_once( get_template_directory() . '/inc/custom-post-type/events.php' );			// Include Post Type Events
include_once( get_template_directory() . '/inc/custom-post-type/staff.php' );			// Include Post Type Staff
include_once( get_template_directory() . '/inc/custom-post-type/publications.php' );	// Include Post Type Publications
include_once( get_template_directory() . '/inc/custom-post-type/pledges.php' );			// Include Post Type Pledges
include_once( get_template_directory() . '/inc/custom-post-type/gallery.php' );			// Include Post Type Pledges
require_once (get_template_directory() . '/inc/' . 'comment.php');						// Comments


/*-----------------------------------------------------------------------------------*/
/*	Custom Background
/*-----------------------------------------------------------------------------------*/

$defaults = array(
	'default-color'          => 'ffffff',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );


/*-----------------------------------------------------------
	Custom Header
-----------------------------------------------------------*/

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => '1920',
	'height'                 => '636',
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );


/*-----------------------------------------------------------
	Add custom Colors to the theme
-----------------------------------------------------------*/

add_action( 'customize_register', 'hg_customize_register' );
function hg_customize_register($wp_customize) {
	$colors = array();
	$colors[] = array( 'slug'=>'wpl_link_color', 'default' => '#e53b51', 'label' => __( 'Link color', 'wplook' ) );
	$colors[] = array( 'slug'=>'wpl_hover_link_color', 'default' => '#c9253a', 'label' => __( 'Hover link color', 'wplook' ) );
	$colors[] = array( 'slug'=>'wpl_accent_color', 'default' => '#e53b51', 'label' => __( 'Accent Color', 'wplook' ) );
	$colors[] = array( 'slug'=>'wpl_toolbar_color', 'default' => '#000000', 'label' => __( 'Toolbar Color', 'wplook' ) );


	foreach($colors as $color) {
		// SETTINGS
		$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Print Custom Color Styles
/*-----------------------------------------------------------------------------------*/

function wplook_print_custom_color_style() { ?>
	<?php
		$link_color = get_option('wpl_link_color');
		$hover_link_color = get_option('wpl_hover_link_color');
		$accent_color = get_option('wpl_accent_color');
		$toolbar_color = get_option('wpl_toolbar_color');
	?>
	<style>
		a, a:visited { color: <?php echo $link_color; ?>;}

		a:focus, a:active, a:hover { color: <?php echo $hover_link_color; ?>; }

		.teaser-page-list, #footer-widget-area, .short-content .buttons, .buttons-download, .event-info, .teaser-page-404, .announce-body, .teaser-page, .tagcloud a, .widget ul li:hover, #searchform #searchsubmit, .nav-next a:hover, .nav-previous a:hover, .progress-percent, .progress-money, .progress-percent .arrow, .progress-money .arrow, .donate_now_bt, .toggle-content-donation, .widget-title .viewall a:hover, .flexslider-news .flex-button-red a:hover, .entry-header-comments .reply a:hover, .share-buttons, #flexslider-gallery-carousel, .menu-language-menu-container ul li a:hover, .menu-language-menu-container ul .current a, ul.nav-menu ul a:hover, .nav-menu ul ul a:hover   { background:  <?php echo $accent_color; ?>;}

		h1,h2,h3,h4,h5,h6, .candidate .name, figure:hover .mask-square, .nav-menu .current_page_item > a, .nav-menu .current_page_ancestor > a, .nav-menu .current-menu-item > a, .nav-menu .current-menu-ancestor > a   {color:  <?php echo $accent_color; ?>;}

		.tagcloud a:hover {color: <?php echo $hover_link_color; ?>!important;}

		.nav-next a:hover, .nav-previous a:hover, .toggle-content-donation, .widget-title .viewall a:hover, .flexslider-news .flex-button-red a, .entry-header-comments .reply a:hover {border: 1px solid <?php echo $accent_color; ?>!important;}

		.flex-active {border-top: 3px solid <?php echo $accent_color; ?>;}

		.flex-content .flex-button a:hover {background:<?php echo $accent_color; ?>; }

		.latestnews-body .flex-direction-nav a {background-color: <?php echo $accent_color; ?>;}

		.entry-content blockquote {border-left: 3px solid <?php echo $accent_color; ?>;}
		#toolbar, .site-info, #flexslider-gallery-carousel .flex-active-slide, .mean-container .mean-bar {	background: <?php echo $toolbar_color; ?>; }
		.flickr-widget-body a:hover {border: 1px solid <?php echo $toolbar_color; ?>;;}
	</style>
<?php }
add_action( 'wp_head', 'wplook_print_custom_color_style' );


/*-----------------------------------------------------------------------------------*/
/*	BE Dashbord Widget
/*-----------------------------------------------------------------------------------*/

function wplook_dashboard_widgets() {
	global $wp_meta_boxes;
	unset(
		$wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'],
		$wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'],
		$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
	);
		wp_add_dashboard_widget( 'dashboard_custom_feed', 'WPlook News' , 'dashboard_custom_feed_output' );
}
add_action('wp_dashboard_setup', 'wplook_dashboard_widgets');


function dashboard_custom_feed_output() {
	echo '<div class="rss-widget rss-wplook">';
	wp_widget_rss_output(array(
		'url' => 'http://themeforest.net/feeds/users/wplook.atom',
		'title' => '',
		'items' => 5,
		'show_summary' => 1,
		'show_author' => 0,
		'show_date' => 1
		));
	echo '</div>';
}

if ( ! function_exists( 'wplook_bar_menu' ) ):

	function wplook_bar_menu() {
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
			return;
		$admin_dir = get_admin_url();

		$wp_admin_bar->add_menu( 
			array(
				'id' => 'custom_menu',
				'title' => __( 'WPlook Panel', 'wplook' ),
				'href' => FALSE,
				'meta' => array('title' => 'WPlook Options Panel', 'class' => 'wplookpanel') 
			) 
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_to',
				'parent' => 'custom_menu',
				'title' => __( 'Theme Options', 'wplook' ),
				'href' => $admin_dir .'themes.php?page=ot-theme-options',
				'meta' => array('title' => 'Theme Option') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_sp',
				'parent' => 'custom_menu',
				'title' => __( 'Support', 'wplook' ),
				'href' => 'https://wplook.zendesk.com/',
				'meta' => array('title' => 'Support') 
			)
		);


		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_wt',
				'parent' => 'custom_menu',
				'title' => __( 'Our Themes', 'wplook' ),
				'href' => 'http://themeforest.net/user/WPlook/portfolio',
				'meta' => array('title' => 'Our Themes')
				)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_fb',
				'parent' => 'custom_menu',
				'title' => __( 'Become our fan on Facebook', 'wplook' ),
				'href' => 'http://www.facebook.com/wplookthemes',
				'meta' => array('target' => 'blank', 'title' => 'Become our fan on Facebook') 
			)
		);

		$wp_admin_bar->add_menu(
			array(
				'id' => 'wpl_tw',
				'parent' => 'custom_menu',
				'title' => __( 'Follow us on Twitter', 'wplook' ),
				'href' => 'http://twitter.com/#!/wplook',
				'meta' => array('target' => 'blank', 'title' => 'Follow us on Twitter')
			)
		);
	}
	add_action('admin_bar_menu', 'wplook_bar_menu', '1000');
endif;



/*-----------------------------------------------------------
	Get taxonomies terms links
-----------------------------------------------------------*/


function wplook_custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		} else {
			$return = '';
		}
		return $return;
	}
}


/*-----------------------------------------------------------
	Format money
-----------------------------------------------------------*/

// echo formatMoney(1050); # 1,050 
// echo formatMoney(1321435.4, true); # 1,321,435.40 
function formatMoney($number, $fractional=false) { 
	if ($fractional) { 
		$number = sprintf('%.2f', $number); 
	}
	while (true) {
		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
		if ($replaced != $number) { 
			$number = $replaced; 
		} else {
			break; 
		}
	}
	return $number; 
}

