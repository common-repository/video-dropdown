<?php
function bwvideodropdown_dbcreate() {
	global $wpdb;
	$bwvideodropdown_version = '1.0';
	
	$bwvideodropdown_table_name = $wpdb->prefix . "bwvideodropdown"; 
	
	$bwvideodropdown_charset_collate = $wpdb->get_charset_collate();
	
	$bwvideodropdown_sql = "CREATE TABLE $bwvideodropdown_table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		timestamp varchar(50) NOT NULL,
		video_url varchar(300) NOT NULL,
		video_title varchar(100) NOT NULL,
		video_autoplay int(1) NOT NULL,
		video_progress varchar(5) NOT NULL,
		video_controls int(1) NOT NULL,
		video_kcontrols int(1) NOT NULL,
		video_fs int(1) NOT NULL,
		video_annotations int(1) NOT NULL,
		video_logo int(1) NOT NULL,
		video_recommended int(1) NOT NULL,
		video_showinfo int(1) NOT NULL,
		video_width int(5) NOT NULL,
		video_height int(5) NOT NULL,
		plugin_version varchar(20) NOT NULL,
		UNIQUE KEY id (id)
	) $bwvideodropdown_charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $bwvideodropdown_sql );
}

function bwvideodropdown_check_db() {
	global $wpdb;
	$bwvideodropdown_result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwvideodropdown");
	
	if(!$bwvideodropdown_result) {
		bwvideodropdown_dbcreate();
	} else {
		foreach($bwvideodropdown_result as $bwvideodropdown_row) {
			$bwvideodropdown_version_installed = $bwvideodropdown_row->plugin_version;
			$bwvideodropdown_id = $bwvideodropdown_row->id;
			
			if($bwvideodropdown_version < $bwvideodropdown_version_installed) {
				$bwvideodropdown_current_version_samller = 1;
			} elseif($bwvideodropdown_version > $bwvideodropdown_version_installed) {
				$wpdb->update( 
					$bwvideodropdown_table_name,
					array( 
						'plugin_version' => $bwvideodropdown_version, 
					),
					array( 'id' => $bwvideodropdown_id )
				);
			}
		}	
	}
}
?>