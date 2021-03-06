<?php
/**
 * Custom Functions
 *
 * @package WordPress
 * @subpackage Charitas
 * @since Charitas 1.0
 */

/*-----------------------------------------------------------
	Custom Tag cloud Widget
-----------------------------------------------------------*/

function wplook_tag_cloud_widget($args) {
	$args['largest'] = 14;
	$args['smallest'] = 14;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'wplook_tag_cloud_widget' );

/*-----------------------------------------------------------
	Get Date
-----------------------------------------------------------*/

function wplook_get_date() {
	the_time(get_option('date_format'));
}

/*-----------------------------------------------------------
	Get Time
-----------------------------------------------------------*/

function wplook_get_time() {
	the_time(get_option('time_format'));
}

/*-----------------------------------------------------------
	Get Date and Time
-----------------------------------------------------------*/

function wplook_get_date_time() {
	the_time(get_option('date_format')); 
	_e( ' at ', 'wplook');
	the_time(get_option('time_format'));
}


/*-----------------------------------------------------------
	Display Navigation for post, pages, search
-----------------------------------------------------------*/

function wplook_content_navigation( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<div class="nav-previous"><?php previous_posts_link( __( '<span>&larr;</span>  <span class="mobile-nav">Newer</span>', 'wplook' ) ); ?></div>
			<div class="nav-next"><?php next_posts_link( __( '<span class="mobile-nav">Older</span> <span>&rarr;</span>', 'wplook' ) ); ?></div>
			<div class="clear"></div>
		</nav><!-- #nav -->
	<?php endif;
}


/*-----------------------------------------------------------------------------------*/
/*	Display share buttons on posts
/*-----------------------------------------------------------------------------------*/

function wplook_get_share_buttons() { ?>
<ul class="share-buttons">
	<li class="share-desc"><i class="icon-share"></i> <?php _e('Share via','wplook'); ?>
		<ul class="share-items">
			<li><a class="share-icon-fb" id="fbbutton" onclick="fbwindows('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>'); return false;"><i class="icon-facebook-sign"></i> Facebook</li></a> 
			<li><a class="share-icon-tw" id="twbutton" onClick="twwindows('http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>'); return false;"><i class="icon-twitter"></i> Twitter</li></a>
			<li><a class="share-icon-pt" id="pinbutton" onClick="pinwindows('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=');"><i class="icon-pinterest"></i> Pinterest</li></a>
		</ul>
	</li>
</ul>
<?php }

/*-----------------------------------------------------------
	Breadcrumbs
-----------------------------------------------------------*/

function wplook_breadcrumbs() {

	$showOnHome 	= '0'; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter 	= '>'; // delimiter between crumbs
	$hometext 	= 'Home'; // text for the 'Home' link
	$showCurrent 	= '1'; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before 		= '<span class="current">'; // tag before the current crumb
	$after 		= '</span>'; // tag after the current crumb
 
	global $post;
	$homeLink = home_url( '/' );

	echo '<a href="' . $homeLink . '">' . $hometext . '</a> ' . $delimiter . ' ';

	if ( is_category() ) {
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
		echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

	} elseif ( is_search() ) {
		echo $before . 'Search results for "' . get_search_query() . '"' . $after;

	} elseif ( is_day() ) {
		echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		echo $before . get_the_time('d') . $after;

	} elseif ( is_month() ) {
		echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		echo $before . get_the_time('F') . $after;

	} elseif ( is_year() ) {
		echo $before . get_the_time('Y') . $after;

	} elseif ( is_single() && !is_attachment() ) {
		if ( get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		} else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);
			echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
		}

	} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		$post_type = get_post_type_object(get_post_type());
		echo $before . $post_type->labels->singular_name . $after;

	} elseif ( is_attachment() ) {
		$parent = get_post($post->post_parent);
		//$cat = get_the_category($parent->ID); $cat = $cat[0];
		//echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	} elseif ( is_page() && !$post->post_parent ) {
		if ($showCurrent == 1) echo $before . get_the_title() . $after;

	} elseif ( is_page() && $post->post_parent ) {
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) echo $crumb;
		if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	} elseif ( is_tag() ) {
		echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

	} elseif ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		echo $before;
		echo __('Articles posted by:', 'wplook');
		echo $userdata->display_name . $after;

	} elseif ( is_404() ) {
		echo $before . 'Error 404' . $after;
	}

	if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		echo ' ' . $delimiter . ' '; echo __('Page', 'wplook') . ' ' . get_query_var('paged');
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
	}


} // end breadcrumbs()


/*-----------------------------------------------------------------------------------*/
/*	Open Graph
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'wplook_open_graph' ) ) {
	function wplook_open_graph() {
		global $wp_query;
		$wplook_postid = $wp_query->post->ID;
		$wplook_title = single_post_title('', false);
		$wplook_url = get_permalink($wplook_postid);
		$wplook_blogname = get_bloginfo('name');
			echo "\n<meta property='og:title' content='$wplook_title' />",			
				"\n<meta property='og:site_name' content='$wplook_blogname' />",				
				"\n<meta property='og:url' content='$wplook_url' />",				
				"\n<meta property='og:type' content='article' />";

		}
	add_action('wp_head', 'wplook_open_graph');
}

if ( ! function_exists( 'wplook_fb_thumb' ) ) {
	function wplook_fb_thumb() {
	if ( is_single() || is_page() ) {
			if (has_post_thumbnail()) {
				$fbthumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium-thumb');
				$fbthumburl = $fbthumb[0];
				echo "\n<meta property='og:image' content='$fbthumburl' />\n";
			}
		}
	}
	add_action( 'wp_head', 'wplook_fb_thumb' );
}

/*-----------------------------------------------------------------------------------*/
/*	Include the thumbnail in the RSS feed
/*-----------------------------------------------------------------------------------*/

function featuredtoRSS($content) {

	global $post;

	if ( has_post_thumbnail( $post->ID ) ){
		$content = '' . get_the_post_thumbnail( $post->ID, 'medium-thumb', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for pledges
/*-----------------------------------------------------------------------------------*/

function add_new_pledge_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Tranzaction ID', 'wplook' ),
		'wpl_pledge_cause' => __( 'Cause', 'wplook' ),
		'wpl_pledge_first_name' => __( 'First Name', 'wplook' ),
		'wpl_pledge_last_name' => __( 'Last Name', 'wplook' ),
		'wpl_pledge_donation_amount' => __( 'Donation amount', 'wplook' ),
		'wpl_pledge_payment_source' => __( 'Payment Source', 'wplook' ),
		'wpl_pledge_payment_Status' => __( 'Payment Status', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_pledges_columns", "add_new_pledge_columns");
// Add to admin_init function

 
function wpl_pledge_columns( $column, $post_id ) {
	
	switch ($column) {

		
		/*-----------------------------------------------------------
			Case: First Name
		-----------------------------------------------------------*/
		case 'wpl_pledge_cause' :

		$wpl_pledge_cause = get_post_meta( $post_id, 'wpl_pledge_cause', true );

		if ( empty( $wpl_pledge_cause ) )
			echo __( 'Unknown', 'wplook' );

		else
			echo get_the_title( $wpl_pledge_cause );
		break;


		/*-----------------------------------------------------------
			Case: First Name
		-----------------------------------------------------------*/
		case 'wpl_pledge_first_name' :

		$wpl_pledge_first_name = get_post_meta( $post_id, 'wpl_pledge_first_name', true );

		if ( empty( $wpl_pledge_first_name ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_pledge_first_name );

		break;

		/*-----------------------------------------------------------
			Case: Last Name
		-----------------------------------------------------------*/
		case 'wpl_pledge_last_name' :

		$wpl_pledge_last_name = get_post_meta( $post_id, 'wpl_pledge_last_name', true );

		if ( empty( $wpl_pledge_last_name ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_pledge_last_name );

		break;
		

		/*-----------------------------------------------------------
			Case: Donation amount
		-----------------------------------------------------------*/
		case 'wpl_pledge_donation_amount' :

		$wpl_pledge_donation_amount = get_post_meta( $post_id, 'wpl_pledge_donation_amount', true );

		if ( empty( $wpl_pledge_donation_amount ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_pledge_donation_amount );

		break;


		/*-----------------------------------------------------------
			Case: Payment Source
		-----------------------------------------------------------*/
		case 'wpl_pledge_payment_source' :

		$wpl_pledge_payment_source = get_post_meta( $post_id, 'wpl_pledge_payment_source', true );

		if ( empty( $wpl_pledge_payment_source ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_pledge_payment_source );

		break;


		/*-----------------------------------------------------------
			Case: Payment Status
		-----------------------------------------------------------*/
		case 'wpl_pledge_payment_Status' :

		$wpl_pledge_payment_Status = get_post_meta( $post_id, 'wpl_pledge_payment_Status', true );

		if ( empty( $wpl_pledge_payment_Status ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_pledge_payment_Status );

		break;
			
	} // end switch
}
add_action('manage_post_pledges_posts_custom_column', 'wpl_pledge_columns', 10, 2);



/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Staff
/*-----------------------------------------------------------------------------------*/

function add_new_staff_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Name', 'wplook' ),
		'wpl_candidate_position' => __( 'Position', 'wplook' ),
		'wpl_candidate_phone' => __( 'Phone', 'wplook' ),
		'wpl_candidate_email' => __( 'Email', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_staff_columns", "add_new_staff_columns");

 
function wpl_staff_columns( $column, $post_id ) {
	
	switch ($column) {
		

		/*-----------------------------------------------------------
			Staff: Position
		-----------------------------------------------------------*/
		case 'wpl_candidate_position' :

		$wpl_candidate_position = get_post_meta( $post_id, 'wpl_candidate_position', true );

		if ( empty( $wpl_candidate_position ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_candidate_position );

		break;


		/*-----------------------------------------------------------
			Staff: Phone
		-----------------------------------------------------------*/
		case 'wpl_candidate_phone' :

		$wpl_candidate_phone = get_post_meta( $post_id, 'wpl_candidate_phone', true );

		if ( empty( $wpl_candidate_phone ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_candidate_phone );

		break;
		

		/*-----------------------------------------------------------
			Staff: Email
		-----------------------------------------------------------*/
		case 'wpl_candidate_email' :

		$wpl_candidate_email = get_post_meta( $post_id, 'wpl_candidate_email', true );

		if ( empty( $wpl_candidate_email ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_candidate_email );

		break;

	
	} // end switch
}
add_action('manage_post_staff_posts_custom_column', 'wpl_staff_columns', 10, 2);



/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Events
/*-----------------------------------------------------------------------------------*/

function add_new_events_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Tranzaction ID', 'wplook' ),
		'wpl_event_date' => __( 'Date', 'wplook' ),
		'wpl_event_time' => __( 'Time', 'wplook' ),
		'wpl_event_address' => __( 'Address', 'wplook' ),
	);

return $columns;

}
add_filter("manage_edit-post_events_columns", "add_new_events_columns");

 
function wpl_events_columns( $column, $post_id ) {
	
	switch ($column) {
		/*-----------------------------------------------------------
			Events: Position
		-----------------------------------------------------------*/
		case 'wpl_event_date' :

		$wpl_event_date = get_post_meta( $post_id, 'wpl_event_date', true );

		if ( empty( $wpl_event_date ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_event_date );

		break;

		/*-----------------------------------------------------------
			Events: Phone
		-----------------------------------------------------------*/
		case 'wpl_event_time' :

		$wpl_event_time = get_post_meta( $post_id, 'wpl_event_time', true );

		if ( empty( $wpl_event_time ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_event_time );

		break;
		

		/*-----------------------------------------------------------
			Events: Email
		-----------------------------------------------------------*/
		case 'wpl_event_address' :

		$wpl_event_address = get_post_meta( $post_id, 'wpl_event_address', true );

		if ( empty( $wpl_event_address ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_event_address );

		break;

	
	} // end switch
}
add_action('manage_post_events_posts_custom_column', 'wpl_events_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Causes
/*-----------------------------------------------------------------------------------*/

function add_new_causes_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title', 'wplook' ),
		'wpl_goal_amount' => __( 'Goal Amount', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_causes_columns", "add_new_causes_columns");

 
function wpl_causes_columns( $column, $post_id ) {
	
	switch ($column) {
		
		/*-----------------------------------------------------------
			causes: Goal Amount
		-----------------------------------------------------------*/
		case 'wpl_goal_amount' :

		$wpl_goal_amount = get_post_meta( $post_id, 'wpl_goal_amount', true );

		if ( empty( $wpl_goal_amount ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_goal_amount );

		break;
	
	} // end switch
}
add_action('manage_post_causes_posts_custom_column', 'wpl_causes_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Manage columns for Publications
/*-----------------------------------------------------------------------------------*/

function add_new_publications_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title', 'wplook' ),
		'wpl_file_size' => __( 'File size', 'wplook' ),
		'date' => __( 'Date', 'wplook' )
	);

return $columns;

}
add_filter("manage_edit-post_publications_columns", "add_new_publications_columns");

 
function wpl_publications_columns( $column, $post_id ) {
	
	switch ($column) {
		
		/*-----------------------------------------------------------
			causes: Goal Amount
		-----------------------------------------------------------*/
		case 'wpl_file_size' :

		$wpl_file_size = get_post_meta( $post_id, 'wpl_publication_file_size', true );

		if ( empty( $wpl_file_size ) )
			echo __( 'Unknown', 'wplook' );

		else
			printf( __( '%s', 'wplook' ), $wpl_file_size );

		break;
	
	} // end switch
}
add_action('manage_post_publications_posts_custom_column', 'wpl_publications_columns', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Trim excerpt
/*-----------------------------------------------------------------------------------*/

function wplook_short_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
 

/*-----------------------------------------------------------------------------------*/
/*	Trim content
/*-----------------------------------------------------------------------------------*/

function wplook_short_content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	} else {
		$content = implode(" ",$content);
	}	
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content); 
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}


/*	----------------------------------------------------------
	Buttons
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if (!function_exists('wplook_button')) {
	function wplook_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '#',
			'target' => '_self',
			'style' => 'grey',
			'size' => 'small',
			'type' => 'round'
	    ), $atts));
		
	   return '<a target="'.$target.'" class="button '.$size.' '.$style.' '. $type .'" href="'.$url.'">' . do_shortcode($content) . '</a>';
	}
	add_shortcode('button', 'wplook_button');
}


/*	----------------------------------------------------------
	Alerts
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if (!function_exists('wplook_alert')) {
	function wplook_alert( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'style'   => 'white'
		), $atts));
		
		return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('alert', 'wplook_alert');
}


/*	----------------------------------------------------------
	Awesome icons
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = */

if (!function_exists('wplook_awesome_icons')) {
	function wplook_awesome_icons( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'name'  => 'icon-wrench'
		), $atts));
		
		return '<i class="'.$name.'"><span>' . do_shortcode($content) . '</span></i>';
	}
	add_shortcode('icon', 'wplook_awesome_icons');
}