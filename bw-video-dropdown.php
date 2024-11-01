<?php
/*
 *	Plugin Name: Video Dropdown
 *	Plugin URI: http://tech-centralhq.com
 *	Description: This is a tool to create a dropdown box to select YouTube videos.
 *	Version: 1.0
 *	Author: Brendan Wolfe
 *	Author URI: http://tech-centralhq.com
 *	License: GPL2
 *
 */

$bwvd_version = '1.0';
include('inc/bwvideodropdown-activation.php');

/*
 * Run when activated, but only if it doesn't already exist or the version is older
 */
register_activation_hook(__FILE__,'bwvideodropdown_check_db');

/*
 * Add a link to plugin in the admin menu at 'Settings > Video dropdown'
 */

function bwvideodropdown_menu() {	
	add_options_page(
		'Video Dropdown',
		'Video Dropdown',
		'manage_options',
		'bwvideodropdown',
		'bwvideodropdown_options_page'
		);
}
add_action('admin_menu', 'bwvideodropdown_menu');

/*
 * Shortcode for Dropdown
 */
add_shortcode('VD_dropdown', 'bwvideodropdown_shortcode_dropdown');
function bwvideodropdown_shortcode_dropdown() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$to_return = '<select id="VD_dropdown">';
	$result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwvideodropdown");
	if($result) {
		foreach($result as $row) {
			$pieces = explode("?v=", $row->video_url);
			$values = $pieces[1].'-_-_-'
					  .$row->video_autoplay.'-_-_-'
					  .$row->video_progress.'-_-_-'
					  .$row->video_controls.'-_-_-'
					  .$row->video_kcontrols.'-_-_-'
					  .$row->video_fs.'-_-_-'
					  .$row->video_annotations.'-_-_-'
					  .$row->video_logo.'-_-_-'
					  .$row->video_recommended.'-_-_-'
					  .$row->video_showinfo.'-_-_-'
					  .$row->video_width.'-_-_-'
					  .$row->video_height;
			$to_return .= '<option value="'.$values.'">'.$row->video_title.'</option>';
		}
	} else {
		$to_return .= '<option value="">There was an error. ERROR #1</option>';
	}
	
	$to_return .= '</select>';
	return $to_return;
}

/*
 * Shortcode for Video
 */
add_shortcode('VD_video', 'bwvideodropdown_shortcode_video');
function bwvideodropdown_shortcode_video() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$to_return = '<iframe id="VD_video"';
	$result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwvideodropdown LIMIT 1");
	if($result) {
		foreach( $result as $row ) {
			$video_url = $row->video_url;
			$video_autoplay = $row->video_autoplay;
			$video_progress = $row->video_progress;
			$video_controls = $row->video_controls;
			$video_kcontrols = $row->video_kcontrols;
			$video_fs = $row->video_fs;
			$video_annotations = $row->video_annotations;
			$video_logo = $row->video_logo;
			$video_recommended = $row->video_recommended;
			$video_showinfo = $row->video_showinfo;
			$video_width = $row->video_width;
			$video_height = $row->video_height;
		}
		$pieces = explode("?v=", $video_url);
		$to_return .= ' width="'.$video_width.'px" height="'.$video_height.'px" src="https://www.youtube.com/embed/'.$pieces[1].'?autoplay='.$video_autoplay.
					  '&color='.$video_progress.
					  '&controls='.$video_controls.
					  '&disablekb='.$video_kcontrols.
					  '&fs='.$video_fs.
					  '&iv_load_policy='.$video_annotations.
					  '&modestbranding='.$video_logo.
					  '&rel='.$video_recommended.
					  '&showinfo='.$video_showinfo.'" frameborder="0"></iframe>';
	} else {
		$to_return = 'There was an error. ERROR #1';
	}
	return $to_return;
}

function bwvideodropdown_options_page() {
	if(!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permision to access this page');
	}
	
	global $wpdb;
	$bwvd_version = '1.0';
	
	if(isset($_POST['bwvideodropdown_new_video_form_submitted'])) {
		
		$bwvd_hidden_field = esc_html($_POST['bwvideodropdown_new_video_form_submitted']);
		$bwvd_hidden_field = esc_sql($bwvd_hidden_field);
		
		if($bwvd_hidden_field == 'Y') {
			$bwvd_video_title = esc_sql($_POST['bwvideodropdown_video_title']);
			$bwvd_video_url = esc_sql($_POST['bwvideodropdown_video_url']);
			$bwvd_timestamp = time();
			$bwvd_plugin_version = $bwvd_version;
			
			$bwvd_table_name = $wpdb->prefix . 'bwvideodropdown';
			
			$wpdb->insert( 
				$bwvd_table_name, 
				array( 
					'timestamp' => $bwvd_timestamp, 
					'video_url' => $bwvd_video_url, 
					'video_title' => $bwvd_video_title,
					'video_autoplay' => 0,
					'video_progress' => 'red',
					'video_controls' => 1,
					'video_kcontrols' => 1,
					'video_fs' => 1,
					'video_annotations' => 1,
					'video_logo' => 0,
					'video_recommended' => 1,
					'video_showinfo' => 1,
					'video_width' => 600,
					'video_height' => 400,
					'plugin_version' => $bwvd_plugin_version
				) 
			);
		}
	}
	if(isset( $_POST['bwvideodropdown_edit_video_form_submitted'])) {
		
		$bwvd_hidden_field = esc_html($_POST['bwvideodropdown_edit_video_form_submitted']);
		$bwvd_hidden_field = esc_sql($bwvd_hidden_field);
		
		if($bwvd_hidden_field == 'Y') {
			$bwvd_video_title = esc_sql($_POST['bwvideodropdown_video_title']);
			$bwvd_video_url = esc_sql($_POST['bwvideodropdown_video_url']);
			$bwvd_video_id = esc_sql($_POST['bwvideodropdown_edit_video_id']);
			$bwvd_video_autoplay = esc_sql($_POST['bwvideodropdown_video_autoplay']);
			$bwvd_video_progress = esc_sql($_POST['bwvideodropdown_video_progress']);
			$bwvd_video_controls = esc_sql($_POST['bwvideodropdown_video_controls']);
			$bwvd_video_kcontrols = esc_sql($_POST['bwvideodropdown_video_kcontrols']);
			$bwvd_video_fs = esc_sql($_POST['bwvideodropdown_video_fs']);
			$bwvd_video_annotations = esc_sql($_POST['bwvideodropdown_video_annotations']);
			$bwvd_video_logo = esc_sql($_POST['bwvideodropdown_video_logo']);
			$bwvd_video_recommended = esc_sql($_POST['bwvideodropdown_video_recommended']);
			$bwvd_video_showinfo = esc_sql($_POST['bwvideodropdown_video_showinfo']);
			$bwvd_video_width = esc_sql($_POST['bwvideodropdown_video_width']);
			$bwvd_video_height = esc_sql($_POST['bwvideodropdown_video_height']);
			$bwvd_timestamp = time();
			$bwvd_plugin_version = $bwvd_version;
			
			$bwvd_table_name = $wpdb->prefix.'bwvideodropdown';
			
			$wpdb->update( 
				$bwvd_table_name, 
				array( 
					'timestamp' => $bwvd_timestamp, 
					'video_url' => $bwvd_video_url, 
					'video_title' => $bwvd_video_title,
					'video_autoplay' => $bwvd_video_autoplay,
					'video_progress' => $bwvd_video_progress,
					'video_controls' => $bwvd_video_controls,
					'video_kcontrols' => $bwvd_video_kcontrols,
					'video_fs' => $bwvd_video_fs,
					'video_annotations' => $bwvd_video_annotations,
					'video_logo' => $bwvd_video_logo,
					'video_recommended' => $bwvd_video_recommended,
					'video_showinfo' => $bwvd_video_showinfo,
					'video_width' => $bwvd_video_width,
					'video_height' => $bwvd_video_height,
					'plugin_version' => $bwvd_plugin_version
				),
				array('id' => $bwvd_video_id)
			);
		}
	}
	if(isset($_POST['bwvideodropdown_delete_video_form_submitted'])) {
		
		$bwvd_hidden_field = esc_html($_POST['bwvideodropdown_delete_video_form_submitted']);
		$bwvd_hidden_field = esc_sql($bwvd_hidden_field);
		
		if($bwvd_hidden_field == 'Y') {
			$bwvd_video_id = esc_sql($_POST['bwvideodropdown_delete_video_id']);
			
			$bwvd_table_name = $wpdb->prefix . 'bwvideodropdown';
			
			$wpdb->delete( 
				$bwvd_table_name, 
				array( 'id' => $bwvd_video_id )
			);
		}
	}
	
	require('inc/options-page-wrapper.php');
}

function bwvideodropdown_add_js() {
	wp_register_script('bwvideodropdown_js', plugins_url('/js/bwvideodropdown_js.js', __FILE__), array('jquery'), true);
	wp_enqueue_script('bwvideodropdown_js');
}
add_action('wp_enqueue_scripts', 'bwvideodropdown_add_js');

function bwvideodropdown_add_js_admin() {
	wp_register_script('bwvideodropdown_js_admin', plugins_url('/js/bwvideodropdown_js.js', __FILE__), array('jquery'), true);
	wp_enqueue_script('bwvideodropdown_js_admin');
}
add_action('admin_enqueue_scripts', 'bwvideodropdown_add_js_admin');

function bwvideodropdown_add_css() {
	wp_register_style('bwvideodropdown_css', plugins_url('/css/bwvideodropdown_css.css', __FILE__));
	wp_enqueue_style('bwvideodropdown_css');
}
add_action('admin_head', 'bwvideodropdown_add_css');
?>