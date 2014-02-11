<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//Theme Shortname
$shortname = "hurry";


//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');


//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:"); 


//Access the WordPress Categories via an Array
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");

$tt_posts = array();  
$args = array( 'numberposts' => -1);
$tt_posts_obj = get_posts($args);
foreach ($tt_posts_obj as $tt_pst) {
	$tt_posts[$tt_pst->pst_ID] = $tt_pst->pst_name;
}
$posts_tmp = array_unshift($tt_posts, "Select a post:");



//get list of fonts, decode them and push them in a php array
$json = file_get_contents("https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAh5UVIJElMtiWS4hfK4nytIqVluUnRtsg", true);
$decode = json_decode($json, true);

$webfonts = array();

foreach ($decode['items'] as $key => $value) {

$item_family= $decode['items'][$key]['family'];

$item_family_trunc =  str_replace(' ','+',$item_family);

$webfonts[$item_family_trunc] = $item_family;

}


/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall
			
			
/* Option Page 1 - All Options */	
$options[] = array( "name" => 'Main Options',
			"type" => "heading");

$options[] = array( "name" => __('Favicon','framework_localize'),
			"desc" => __('Upload a 32px x 32x image which will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading (or not). (<a href="http://www.favicon.cc/"  target="_blank">www.favicon.cc</a>)</em>','framework_localize'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");	

$options[] = array( "name" => __('Enable Responsive','framework_localize'),
			"desc" => "Uncheck if you don't want a responsive website (ready for all the screen sizes).",
			"id" => $shortname."_responsive",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Enable Retina Images','framework_localize'),
			"desc" => "Uncheck if you don't want a website ready for the high-resolution screens.",
			"id" => $shortname."_retina",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('See the scroll button','framework_localize'),
			"desc" => "Button to scroll to the top of the page.",
			"id" => $shortname."_scroll",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Custom CSS','framework_localize'),
			"desc" => __('Without the tags: "&lt;style&gt;"','framework_localize'),
			"id" => $shortname."_custom_css",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Custom Javascript','framework_localize'),
			"desc" => __('Without the tags: "&lt;script&gt;"','framework_localize'),
			"id" => $shortname."_custom_js",
			"std" => "",
			"type" => "textarea");	
			
$options[] = array( "name" => __('Bookmark icon for IOS (retina)','framework_localize'),
			"desc" => __('Upload a 114px x 114px image displayed on your Apple\'s devices.','framework_localize'),
			"id" => $shortname."_ios_114",
			"std" => "",
			"type" => "upload");	
			
$options[] = array( "name" => __('Bookmark icon for IOS (not retina)','framework_localize'),
			"desc" => __('Upload a 72px x 72px image displayed on your Apple\'s devices.','framework_localize'),
			"id" => $shortname."_ios_72",
			"std" => "",
			"type" => "upload");	
					
/* Option Page 2 - HEADER */	
$options[] = array( "name" => 'Header',
			"type" => "heading");

$options[] = array( "name" => __('Display the top bar (slogan with arrow for the widgets).','framework_localize'),
			"desc" => "",
			"id" => $shortname."_header_topbar",
			"std" => "true",
			"type" => "checkbox");		
			
$options[] = array( "name" => __('Logo','framework_localize'),
			"desc" => __('Upload your logo here, not necessarily required.','framework_localize'),
			"id" => $shortname."_header_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Logo Width','framework_localize'),
			"desc" => 'Set Here your logo width, used to set it "retina ready" (just have to upload an image 2x more large that this width).',
			"id" => $shortname."_logo_width",
			"std" => "",
			"type" => "text");	

$options[] = array( "name" => __('Logo Height','framework_localize'),
			"desc" => 'Set Here your logo height, used to set it "retina ready" (just have to upload an image 2x more large that this height).',
			"id" => $shortname."_logo_height",
			"std" => "",
			"type" => "text");		


/* Option Page 3 - Styling */	
$options[] = array( "name" => __('Design','framework_localize'),
			"type" => "heading");					
					
$options[] = array( "name" => __('Main Color','framework_localize'),
			"desc" => __('Color all the elements colored in this theme(links, some headings, post hover in the home page...)','framework_localize'),
			"id" => $shortname."_color",
			"std" => "#dc7075",
			"type" => "color");		

$options[] = array( "name" => __('Color 2','framework_localize'),
			"desc" => __('Light grey used mainly on the text which is on the background (menu, footer)','framework_localize'),
			"id" => $shortname."_color2",
			"std" => "#B0B0B0",
			"type" => "color");		

$options[] = array( "name" => __('Color 3','framework_localize'),
			"desc" => __('Mainly used for all the rest (texts...) (.','framework_localize'),
			"id" => $shortname."_color3",
			"std" => "#40434c",
			"type" => "color");		

$options[] = array( "name" => __('Font','framework_localize'),
			"desc" => __('Choose your font if you doesn\'t like the default one. Otherwise, we use "helvetica neue"<br /><br /><em>To show them: <a href="http://www.google.com/webfonts"  target="_blank">www.google.com/webfonts</a></em>','framework_localize'),
			"id" => $shortname."_font1",
			"std" => "",
			"type" => "select",
			"options" => $webfonts);	

$options[] = array( "name" => __('Enable Custom Font','framework_localize'),
			"desc" => 'Check if you want <strong>to enable the font 1</strong>. Otherwise, we use "helvetica neue"',
			"id" => $shortname."_font1_on",
			"std" => "false",
			"type" => "checkbox");	

$options[] = array( "name" => __('Background Color','framework_localize'),
			"desc" => __('','framework_localize'),
			"id" => $shortname."_background",
			"std" => "#40434c",
			"type" => "color");	

$options[] = array( "name" => __('Background image','framework_localize'),
			"desc" => __('Upload your own background (used as a pattern). <strong>Not necessary needed, it\'ll replace the colored background</strong>','framework_localize'),
			"id" => $shortname."_background_image",
			"std" => "",
			"type" => "upload");


/* Option Page X - Gallery */
$options[] = array( "name" => __('Gallery','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Projects per page','framework_localize'),
			"desc" => "Only numbers in this field please.",
			"id" => $shortname."_gallery_per_pages",
			"std" => "16",
			"type" => "text");

$options[] = array( "name" => __('Display the filters ?','framework_localize'),
			"desc" => __('','framework_localize'),
			"id" => $shortname."_gallery_filters",
			"std" => "true",
			"type" => "checkbox");	

/* Option Page X - Footer */
$options[] = array( "name" => __('Footer','framework_localize'),
			"type" => "heading");				

$options[] = array( "name" => __('Footer text','framework_localize'),
			"desc" => "You can use HTML.",
			"id" => $shortname."_footer_text",
			"std" => "Copyright © 2013 Hurry. Powered by WordPress.",
			"type" => "textarea");	

$options[] = array( "name" => __('Display the menu-footer in the footer.','framework_localize'),
			"desc" => "Manage it from the Menus page in wordpress (Theme location field)",
			"id" => $shortname."_footer_menu",
			"std" => "true",
			"type" => "checkbox");	

$options[] = array( "name" => __('Display the social icons in the footer.','framework_localize'),
			"desc" => "Manage them in the Social section",
			"id" => $shortname."_footer_social",
			"std" => "true",
			"type" => "checkbox");		


/* Option Page 6 - Social */
$options[] = array( "name" => __('Social','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Show RSS icon ?','framework_localize'),
			"desc" => "Managed in the Wordpress settings.",
			"id" => $shortname."_social_rss",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Flickr ID','framework_localize'),
			"desc" => "Enter your Flickr ID used for the Flickr widget. Find it <a href='http://idgettr.com/' target='blank'>here</a>",
			"id" => $shortname."_social_flickr_user",
			"std" => "envato",
			"type" => "text");

$options[] = array( "name" => __('Dribbble USER name','framework_localize'),
			"desc" => "Enter your Dribbble user name used for the Dribbble widget.",
			"id" => $shortname."_social_dribbble_user",
			"std" => "2F_webd",
			"type" => "text");

$options[] = array( "name" => __('Twitter URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_twitter",
			"std" => "http://twitter.com/2F_webd",
			"type" => "text");

$options[] = array( "name" => __('Facebook URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Pinterest URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_pinterest",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Plus URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_google",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Dribbble URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_dribbble",
			"std" => "http://dribbble.com/2F_webd",
			"type" => "text");

$options[] = array( "name" => __('Flickr URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_flickr",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Vimeo URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_vimeo",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Instagram URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Linkedin URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_linkedin",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Github URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_github",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Stumbleupon URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_stumbleupon",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Spotify URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_spotify",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Lastfm URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_lastfm",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Tumblr URL','framework_localize'),
			"desc" => "Enter your URL to enable it.",
			"id" => $shortname."_social_tumblr",
			"std" => "",
			"type" => "text");

/* Option Page 7 - SE0 */
$options[] = array( "name" => __('SEO','framework_localize'),
			"type" => "heading");				
									
$options[] = array( "name" => __('Tracking Code','framework_localize'),
			"desc" => __('Paste Google Analytics (or other) tracking code here. Without the &lt;script&gt; tags please.','framework_localize'),
			"id" => $shortname."_tracking",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('SEO famous plugin','framework_localize'),
			"desc" => "",
			"id" => $shortname."_seo_plugins",
			"std" => "The following fields are very basics and I advice you to take a look to <a href='http://wordpress.org/extend/plugins/all-in-one-seo-pack/'>All in One SEO pach</a>, it's more complete",
			"type" => "info");

$options[] = array( "name" => __('Site Description','framework_localize'),
			"desc" => __('Description used for SEO in all yor site','framework_localize'),
			"id" => $shortname."_description",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Keywords','framework_localize'),
			"desc" => __('Keywords used in all your site for the SEO (separated with a comma please)','framework_localize'),
			"id" => $shortname."_keywords",
			"std" => "",
			"type" => "textarea");


					


update_option('of_template',$options); 		 
update_option('of_shortname',$shortname);

}
}
?>