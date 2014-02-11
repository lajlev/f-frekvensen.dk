<?php
/*
 * BUTTON
 */
function buttons($atts, $content = null) {
    extract(shortcode_atts(array('link' => '#'), $atts));
    return '<a class="button" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'buttons');

function buttons_colored($atts, $content = null) {
    extract(shortcode_atts(array('link' => '#'), $atts));
    return '<a class="button colored" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button_colored', 'buttons_colored');
/*
 * TOOLTIP
 */
function tooltips($atts, $content = null) {
    extract(shortcode_atts(array('tcontent' => 'Tooltip Content'), $atts));
    return '<a  href="#" data-rel="tooltip" data-tip="top" data-original-title="'.$tcontent.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('tooltip', 'tooltips');
/*
 * DROPCAP
 */
function dropcaps($atts, $content = null) {
    return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'dropcaps');
/*
 * SEPARATION
 */
function breaker($atts, $content = null) {
    return '<div class="breaker"></div>';
}
add_shortcode('separation', 'breaker');
/*
 * HIGHLIGHT
 */
function highlights($atts, $content = null) {
    return '<span class="highlight">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight', 'highlights');
/*
 * ICON
 */
function icons($atts, $content = null) {
    return '<span class="icon">' . do_shortcode($content) . '</span>';
}
add_shortcode('icon', 'icons');
/*
 * ICON LARGE
 */
function iconlarges($atts, $content = null) {
    return '<span class="icon large">' . do_shortcode($content) . '</span>';
}
add_shortcode('icon_large', 'iconlarges');
/*
 * BOX
 */
function boxs($atts, $content = null) {
    return '<div class="box">' . do_shortcode($content) . '</div>';
}
add_shortcode('box', 'boxs');



/*
Plugin Name: Fluid Column Layout Shortcodes
Plugin URI: http://tutorials.mysitemyway.com
Description: Adds percentage based infintley nestable column shortcodes.
Version: 1.0
Author: Webtreats
Author URI: http://mysitemyway.com
License: GPL2
*/

/*  Copyright 2010  Webtreats

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Thanks to TheBinaryPenguin, see http://wordpress.org/support/topic/plugin-remove-wpautop-wptexturize-with-a-shortcode
 *
 * Takes the content and splits it into pieces.
 *
 * The pieces can be either 
 *   (1) Text wrapped in a [raw][/raw] shortcode   
 * or
 *   (2) Text not wrapped in a [raw][/raw] shortcode
 *
 * The pieces retain their order in the content. 
 * 
 * Think of it as a crazy version of explode() where the delimiter 
 * is a regular expression and the delimiter is also returned in the array.
 *
 * Then loop over the pieces
 *     If the piece contains a [raw][/raw] shortcode then append the interior text to the new_content string
 * Else
 *     Apply the wpautop() and wptexturize() formatters to the piece and append it to the new_content string
 */
if ( !function_exists('webtreats_formatter') ) :

function webtreats_formatter($content) {
	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {
			
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {
			
			/* Format and append to content */
			$new_content .= $piece;		
		}
	}
	
	return $new_content;
}

// Before displaying for viewing, apply this function
add_filter('the_content', 'webtreats_formatter', 99);
add_filter('widget_text', 'webtreats_formatter', 99);

endif;

/**
 * Enqueue style-file, if it exists.
 * Register with hook 'wp_print_styles'
 *
 */
function webtreats_column_stylesheet() {
    $my_style_url = WP_PLUGIN_URL . '/webtreats-column-shortcodes/styles.css';
    $my_style_file = WP_PLUGIN_DIR . '/webtreats-column-shortcodes/styles.css';

    if ( file_exists($my_style_file) ) {
        wp_register_style('column-styles', $my_style_url);
        wp_enqueue_style('column-styles');
    }
}
add_action('wp_print_styles', 'webtreats_column_stylesheet');

/**
 * Columns Shortcodes
 *
 */
function webtreats_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'webtreats_one_third');

function webtreats_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'webtreats_one_third_last');

function webtreats_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'webtreats_two_third');

function webtreats_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'webtreats_two_third_last');

function webtreats_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'webtreats_one_half');

function webtreats_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'webtreats_one_half_last');

function webtreats_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'webtreats_one_fourth');

function webtreats_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'webtreats_one_fourth_last');

function webtreats_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'webtreats_three_fourth');

function webtreats_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'webtreats_three_fourth_last');

function webtreats_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'webtreats_one_fifth');

function webtreats_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'webtreats_one_fifth_last');

function webtreats_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'webtreats_two_fifth');

function webtreats_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'webtreats_two_fifth_last');

function webtreats_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'webtreats_three_fifth');

function webtreats_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'webtreats_three_fifth_last');

function webtreats_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'webtreats_four_fifth');

function webtreats_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'webtreats_four_fifth_last');

function webtreats_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'webtreats_one_sixth');

function webtreats_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'webtreats_one_sixth_last');

function webtreats_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'webtreats_five_sixth');

function webtreats_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'webtreats_five_sixth_last');

?>