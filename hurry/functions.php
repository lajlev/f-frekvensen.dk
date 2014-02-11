<?php
/* 
* OPTIONS PANEL
*/
require_once(get_template_directory() . '/admin/admin-functions.php');
require_once(get_template_directory() . '/admin/admin-interface.php');
require_once(get_template_directory() . '/admin/theme-settings.php');
/* 
* THEME STYLES
*/
require_once(get_template_directory() . '/includes/theme-styles.php');
/* 
* THEME SCRIPTS
*/
require_once(get_template_directory() . '/includes/theme-scripts.php');
/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 960;
/* 
* THEME SETUP
*/
add_action( 'after_setup_theme', 'hurry_setup' );

if ( ! function_exists( 'hurry_setup' ) ):
    
function hurry_setup() {

	/* Make hurry available for translation.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'hurry', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in 2 locations.
        add_theme_support( 'menus' );
        register_nav_menus( array(
                'topnav' => __( 'Header Menu', 'hurry' ),
                'footernav' => __( 'Footer Menu', 'hurry' )
         ));

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

  // This theme supports a variety of post formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'link', 'quote', 'status', 'audio', 'video' ) );
}
endif;
/* 
 * SIDEBAR
*/
function blog_widgets_init() {
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-padding">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );
	register_sidebar( array(
		'name' => 'Widgets in the top bar',
		'id' => 'widget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );
}
add_action( 'widgets_init', 'blog_widgets_init' );
/* 
 * EXCERPT SIZE
*/
add_action('get_header', 'my_method');
function my_method() {
    if( is_home() OR is_search() OR is_archive() ):
        function custom_excerpt_length( $length ) {
        return 20;
        }
        add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
    endif;
}
/* 
 * CUSTOM WIDGETS
*/
require_once(get_template_directory() . '/includes/widget-flickr.php');
require_once(get_template_directory() . '/includes/widget-dribbble.php');
require_once(get_template_directory() . '/includes/widget-social.php');
/* 
 * SHORTCODES
*/
require_once(get_template_directory() . '/includes/shortcodes.php');
/* 
 * TITLES
*/
function hurry_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'hurry' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'hurry_wp_title', 10, 2 );
/* 
 * Gallery
*/
add_action('init', 'gallery_add');

function gallery_add(){
  register_post_type('gallery', array(
    'label' => __('Gallery','hurry'),
    'singular_label' => __('Gallery', 'hurry'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('editor', 'title', 'thumbnail')
  ));
  register_taxonomy( 'gallery_category', 'gallery', array( 'hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => true ) );  
}

if ( ! function_exists( 'hurry_comment' ) ) :
/* 
 * COMMENTS
*/
function hurry_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'hurry' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'hurry' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-author vcard clearfix">
                <?php echo get_avatar( $comment, 36 ); ?>
                <div class="comment-meta">
                    <?php printf( '%1$s %2$s',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span class="url"> ' . __( 'Post author', 'hurry' ) . '</span>' : ''
					); 
                    printf( '<a href="%1$s" class="comment-time"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'hurry' ), get_comment_date(), get_comment_time() )
					);
					?>
                </div>
            </div>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'hurry' ); ?></p>
			<?php endif; ?>

			<div class="comment-text">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'hurry' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-text -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'hurry' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'hurry_audio_grab' ) ) {
/*
 * AUDIO FILES
 */
function hurry_audio_grab( $post_id ) {
	global $wpdb;

	$first_audio = $wpdb->get_var( $wpdb->prepare( "SELECT guid FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'attachment' AND INSTR(post_mime_type, 'audio') ORDER BY menu_order ASC LIMIT 0,1", (int) $post_id ) );

	if ( ! empty( $first_audio ) )
		return $first_audio;

	return false;
}
} // if ( ! function_exists( 'hurry_audio_grab' ) )
/* 
 * META BOXES
*/
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/includes/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/includes/meta-box' ) );
// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';

add_action( 'admin_init', 'rw_register_meta_boxes' );
function rw_register_meta_boxes()
{
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;
    $prefix = 'hurry_';
    $meta_boxes = array();

    $meta_boxes[] = array(
        'title'    => 'Post Options',
        'pages'    => array( 'post' ),
        'context' => 'side',
        'priority' => 'default',
        'fields' => array(
            array(
                'name' => 'Sidebar',
                'desc' => 'Do you want to see the sidebar in the post page ?',
                'id'   => $prefix . 'post_sidebar',
                'type' => 'checkbox',
                'std' => '1',
            ),
            array(
                'name' => 'Author Box',
                'desc' => 'Do you want to see the author box in the post page ?',
                'id'   => $prefix . 'post_author',
                'type' => 'checkbox',
                'std' => '0',
            ),
            array(
                'name' => 'Post metadatas',
                'desc' => 'Do you want to see the post metadatas (author, categories, tags, date...) in the post page ?',
                'id'   => $prefix . 'post_meta',
                'type' => 'checkbox',
                'std' => '1',
            ),
            array(
                'name' => 'Comments',
                'desc' => 'Do you want to see the comments in the post page ?',
                'id'   => $prefix . 'post_comments',
                'type' => 'checkbox',
                'std' => '1',
            ),
        )
    );

    $meta_boxes[] = array(
        'title'    => 'Page Options',
        'pages'    => array( 'page' ),
        'context' => 'side',
        'priority' => 'default',
        'fields' => array(
            array(
                'name' => 'Sidebar',
                'desc' => 'Do you want to see the sidebar in the post page ?',
                'id'   => $prefix . 'page_sidebar',
                'type' => 'checkbox',
                'std' => '1',
            ),
            array(
                'name' => 'Author Box',
                'desc' => 'Do you want to see the author box in the post page ?',
                'id'   => $prefix . 'page_author',
                'type' => 'checkbox',
                'std' => '0',
            ),
            array(
                'name' => 'Post metadatas',
                'desc' => 'Do you want to see the post metadatas (author, categories, tags, date...) in the post page ?',
                'id'   => $prefix . 'page_meta',
                'type' => 'checkbox',
                'std' => '0',
            ),
            array(
                'name' => 'Comments',
                'desc' => 'Do you want to see the comments in the post page ?',
                'id'   => $prefix . 'page_comments',
                'type' => 'checkbox',
                'std' => '0',
            ),
        )
    );

    $meta_boxes[] = array(
        'title'    => 'Home Post Options',
        'pages'    => array( 'post'),
        'fields' => array(
            array(
                'name' => 'Post Hover',
                'desc' => 'Do you want to see additional informations (title, post type like button, number of comments) when you put your mouse over the post.',
                'id'   => $prefix . 'post_hover',
                'type' => 'checkbox',
                'std' => '1',
            ),
            array(
                'name' => 'Post Borders',
                'desc' => 'Do you want to add a big border to this post, that can feature it, or give it a cool effect.',
                'id'   => $prefix . 'post_border',
                'type' => 'checkbox',
                'std' => '0',
            ),
        )
    );

    $meta_boxes[] = array(
        'title'    => 'Post Formats Options',
        'pages'    => array( 'post'),
        'fields' => array(
            array(
                'name' => '<strong>Audio Format</strong>: Upload your Audio File',
                'desc' => 'Have to be an .mp3 file please (Only one please).',
                'id'   => $prefix . 'post_audio_file',
                'type' => 'file',
            ),
            array(
                'name' => "<strong>Quote Format</strong>: Set the quote's author here",
                'id'   => $prefix . 'post_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => "<strong>Link Format</strong>: Set the direct URL of the link",
                'id'   => $prefix . 'post_link_url',
                'type' => 'text',
            ),
            array(
                'name' => "<strong>Gallery Format</strong>: Upload all the images here",
                'id'   => $prefix . 'post_gallery',
                'type' => 'plupload_image',
            ),
			array(
				'name' => "<strong>Video Format</strong>: Video Type",
				'desc' => '<em>'.__('Select Video Type','hurry').'</em>',
				'id' => $prefix.'post_video_type',
				'type' => 'select',
				'options' => array(
					'youtube' => 'Youtube',
					'vimeo' => 'Vimeo',
					'dailymotion' => 'Dalymotion',
				),
			),
			array(
				'name' => "<strong>Video Format</strong>: Video ID",
				'desc' => '<em>'.__('Insert Video ID (e.g. http://www.youtube.com/watch?v=<strong>Y2HIK1lgb3U</strong>)','hurry').'</em>',
				'id' => $prefix.'post_video_id',
				'type' => 'text'
			),
        )
    );

    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}
add_filter('postbox_classes_post_postexcerpt','add_metabox_classes');

function add_metabox_classes($classes) {
    array_push($classes,'another_class');
    return $classes;
}
/* 
 * LIKE SYSTEM
*/
add_action('wp_ajax_nopriv_post-like', 'post_like');  
add_action('wp_ajax_post-like', 'post_like');
function post_like()  
{  
    // Check for nonce security  
    $nonce = $_POST['nonce'];  
   
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )  
        die ( 'Busted!');  
      
    if(isset($_POST['post_like']))  
    {  
        // Retrieve user IP address  
        $ip = $_SERVER['REMOTE_ADDR'];  
        $post_id = $_POST['post_id'];  
          
        // Get voters'IPs for the current post  
        $meta_IP = get_post_meta($post_id, "voted_IP");  
        $voted_IP = $meta_IP[0];  
  
        if(!is_array($voted_IP))  
            $voted_IP = array();  
          
        // Get votes count for the current post  
        $meta_count = get_post_meta($post_id, "votes_count", true);  
  
        // Use has already voted ?  
        if(!hasAlreadyVoted($post_id))  
        {  
            $voted_IP[$ip] = time();  
  
            // Save IP and increase votes count  
            update_post_meta($post_id, "voted_IP", $voted_IP);  
            update_post_meta($post_id, "votes_count", ++$meta_count);  
              
            // Display count (ie jQuery return value)  
            echo $meta_count;  
        }  
        else  
            echo "already";  
    }  
    exit;  
}  
function hasAlreadyVoted($post_id)  {  
    global $timebeforerevote;  
  
    // Retrieve post votes IPs  
    $meta_IP = get_post_meta($post_id, "voted_IP");  
    $voted_IP = $meta_IP;  
      
    if(!is_array($voted_IP))  
        $voted_IP = array();  
          
    // Retrieve current user IP  
    $ip = $_SERVER['REMOTE_ADDR'];  
      
    // If user has already voted  
    if(in_array($ip, array_keys($voted_IP)))  
    {  
        $time = $voted_IP[$ip];  
        $now = time();  
          
        // Compare between current time and vote time  
        if(round(($now - $time) / 60) > $timebeforerevote)  
            return false;  
              
        return true;  
    }  
      
    return false;  
}  
function getPostLikeLink($post_id)  {  
    $themename = "hurry";  
  
    $vote_count = get_post_meta($post_id, "votes_count", true);  
  
    $output = '<li class="post-like">';  
    if(hasAlreadyVoted($post_id))  
        $output .= '<span class="icon alreadyvoted">&hearts;</span>';  
    else  
        $output .= '<a href="#" data-post_id="'.$post_id.'" data-rel="tooltip"data-tip="top" data-original-title="'. __( 'Do you like this post ?', 'hurry' ) .'"> 
                    <span class="icon">&hearts;</span>
                    </a>';  
    $output .= '<span class="count">'.$vote_count.'</span></p>';  
      
    return $output;  
}  
/* 
* ADD PLUGINS
*/
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once(get_template_directory() . '/includes/plugins/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'hurry_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function hurry_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'                  => 'Revolution Slider', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/includes/plugins/revslider.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'                  => 'Zilla Share', // The plugin name
            'slug'                  => 'zilla-share-1.1', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/includes/plugins/zilla-share-1.1.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'hurry';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
        'parent_url_slug'   => 'themes.php',                // Default parent URL slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}
/**
 * Adds a simple WordPress pointer to Appearance menu, to remind the user to configure the theme
**/
function hurry_pointer_script_style( $hook_suffix ) {
    
    // Assume pointer shouldn't be shown
    $enqueue_pointer_script_style = false;

    // Get array list of dismissed pointers for current user and convert it to array
    $dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

    // Check if our pointer is not among dismissed ones
    if( !in_array( 'hurry_settings_pointer', $dismissed_pointers ) ) {
        $enqueue_pointer_script_style = true;
        
        // Add footer scripts using callback function
        add_action( 'admin_print_footer_scripts', 'hurry_pointer_print_scripts' );
    }

    // Enqueue pointer CSS and JS files, if needed
    if( $enqueue_pointer_script_style ) {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
    }
    
}
    add_action( 'admin_enqueue_scripts', 'hurry_pointer_script_style' );

function hurry_pointer_print_scripts() {

    $pointer_content  = '<h3>Hurry needs to be configured</h3>';
    $pointer_content .= '<p>Configure Hurry by clicking Theme Options to the left.</p>';
?>
    
    <script type="text/javascript">
    //<![CDATA[
    jQuery(document).ready( function($) {
        $('#menu-appearance').pointer({
            content:        '<?php echo $pointer_content; ?>',
            position:       {
                                edge:   'left', // arrow direction
                                align:  'center' // vertical alignment
                            },
            pointerWidth:   350,
            close:          function() {
                                $.post( ajaxurl, {
                                        pointer: 'hurry_settings_pointer', // pointer ID
                                        action: 'dismiss-wp-pointer'
                                });
                            }
        }).pointer('open');
    });
    //]]>
    </script>

<?php
}
