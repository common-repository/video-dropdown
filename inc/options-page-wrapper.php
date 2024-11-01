<?php
global $wpdb;
$prefix = $wpdb->prefix;
?>
<div class="wrap">
	<h1 class="bwvd_title"><?php esc_attr_e( 'Video Dropdown Settings', 'wp_admin_style' ); ?></h1>
	<div id="bwvd_menu">
		<?php
		if(isset( $_GET['bwvd'])) {
			if($_GET['bwvd'] == 'e') {
				?>
				<div class="bwvd_button"><span><div class="dashicons dashicons-edit"></div> Edit Video</span><span class="alignright">click to open</span></div>
				<div class="bwvd_content">
					<?php
					if(isset( $_GET['id'])) {
						$id = esc_sql($_GET['id']);
						$result = $wpdb->get_results("SELECT * FROM ".$prefix."bwvideodropdown WHERE id=".$id."");
						if($result) {
							foreach($result as $row) {
								$video_url = $row->video_url;
								$video_title = $row->video_title;
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
								?>
								<p style="font-size: 15px;"><?php echo '<strong>Editing:</strong> '.$video_title; ?></p>
								<form method="post" action="">
									<input type="hidden" name="bwvideodropdown_edit_video_form_submitted" value="Y" />
									<input type="hidden" name="bwvideodropdown_edit_video_id" value="<?php echo $id ?>" />
									
									<label for="bwvideodropdown_video_title">Video Title</label>
									<br />
									<input name="bwvideodropdown_video_title" id="bwvideodropdown_video_title" type="text" value="<?php echo $video_title; ?>" class="regular-text" />
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_url">Video URL</label>
									<br />
									<input name="bwvideodropdown_video_url" id="bwvideodropdown_video_url" type="text" value="<?php echo $video_url; ?>" class="regular-text" />
									<p>
										Use a YouTube video link like this: <strong><i>http://youtube.com/watch?v=xxxxxxxxxx</strong></i> or like even like this: <strong><i>/watch?v=xxxxxxxxxx</i></strong>
										<br>
										Just as long as you have the <strong><i>?v=xxxxxxxxxx</strong></i> part of the url
									</p>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_width">Width (px)</label>
									<br />
									<input name="bwvideodropdown_video_width" id="bwvideodropdown_video_width" type="text" value="<?php echo $video_width; ?>" class="regular-text" />
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_height">Height (px)</label>
									<br />
									<input name="bwvideodropdown_video_height" id="bwvideodropdown_video_height" type="text" value="<?php echo $video_height; ?>" class="regular-text" />
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_autoplay">Autoplay</label>
									<select name="bwvideodropdown_video_autoplay" id="bwvideodropdown_video_autoplay">
										<?php
										if($video_autoplay == 1) {
											?>
											<option value="1">On</option>
											<option value="0">Off</option>
											<?php
										} else {
											?>
											<option value="0">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_progress">Progress bar color</label>
									<select name="bwvideodropdown_video_progress" id="bwvideodropdown_video_progress">
										<?php
										if($video_progress == 'red') {
											?>
											<option value="red">Red</option>
											<option value="white">White</option>
											<?php
										} else {
											?>
											<option value="white">White</option>
											<option value="red">Red</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_controls">Show controls</label>
									<select name="bwvideodropdown_video_controls" id="bwvideodropdown_video_controls">
										<?php
										if($video_controls == 1) {
											?>
											<option value="1">On</option>
											<option value="0">Off</option>
											<?php
										} else {
											?>
											<option value="0">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_kcontrols">Keyboard controls</label>
									<select name="bwvideodropdown_video_kcontrols" id="bwvideodropdown_video_kcontrols">
										<?php
										if($video_kcontrols == 1) {
											?>
											<option value="1">On</option>
											<option value="0">Off</option>
											<?php
										} else {
											?>
											<option value="0">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_fs">Fullscreen button</label>
									<select name="bwvideodropdown_video_fs" id="bwvideodropdown_video_fs">
										<?php
										if($video_fs == 1) {
											?>
											<option value="1">On</option>
											<option value="0">Off</option>
											<?php
										} else {
											?>
											<option value="0">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_annotations">Show annotations</label>
									<select name="bwvideodropdown_video_annotations" id="bwvideodropdown_video_annotations">
										<?php
										if($video_annotations == 1) {
											?>
											<option value="1">On</option>
											<option value="3">Off</option>
											<?php
										} else {
											?>
											<option value="3">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_logo">Show YouTube logo</label>
									<select name="bwvideodropdown_video_logo" id="bwvideodropdown_video_logo">
										<?php
										if($video_logo == 0) {
											?>
											<option value="0">On</option>
											<option value="1">Off</option>
											<?php
										} else {
											?>
											<option value="1">Off</option>
											<option value="0">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_recommended">Show recommended videos</label>
									<select name="bwvideodropdown_video_recommended" id="bwvideodropdown_video_recommended">
										<?php
										if($video_recommended == 1) {
											?>
											<option value="1">On</option>
											<option value="0">Off</option>
											<?php
										} else {
											?>
											<option value="0">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<label for="bwvideodropdown_video_showinfo">Show video information</label>
									<select name="bwvideodropdown_video_showinfo" id="bwvideodropdown_video_showinfo">
										<?php
										if($video_showinfo == 1) {
											?>
											<option value="1">On</option>
											<option value="0">Off</option>
											<?php
										} else {
											?>
											<option value="0">Off</option>
											<option value="1">On</option>
											<?php
										}
										?>
									</select>
									
									<br />
									<br />
									
									<input class="button-primary" type="submit" name="bwvideodropdown_edit_video_submit" value="Save" />
								</form>
								
								<br />
								
								<form method="post" action="">
									<input type="hidden" name="bwvideodropdown_delete_video_form_submitted" value="Y" />
									<input type="hidden" name="bwvideodropdown_delete_video_id" value="<?php echo $id ?>" />
									<input class="button" type="submit" name="bwvideodropdown_delete_video_submit" id="bwvideodropdown_delete_video_submit" value="Delete Video" />
								</form>
								<?php
							}
						} else {
							echo 'Sorry, that video could not be found. Please try again later';
						}
					} else {
						echo 'Sorry, that video could not be found. Please try again later';
					}
				?>
				</div>
				<?php
			}
		}
		?>
		<div class="bwvd_button"><span><div class="dashicons dashicons-plus"></div> New Video</span><span class="alignright">click to open</span></div>
		<div class="bwvd_content">
			<form method="post" action="">
				<input type="hidden" name="bwvideodropdown_new_video_form_submitted" value="Y" />
				
				<label for="bwvideodropdown_video_title">Video Title</label>
				<br />
				<input name="bwvideodropdown_video_title" id="bwvideodropdown_video_title" type="text" value="" class="regular-text" />
				
				<br />
				<br />
				
				<label for="bwvideodropdown_video_url">Video URL</label>
				<br />
				<input name="bwvideodropdown_video_url" id="bwvideodropdown_video_url" type="text" class="regular-text" />
				<p>
					Use a YouTube video link like this: <strong><i>http://youtube.com/watch?v=xxxxxxxxxx</strong></i> or like even like this: <strong><i>/watch?v=xxxxxxxxxx</i></strong>
					<br>
					Just as long as you have the <strong><i>?v=xxxxxxxxxx</strong></i> part of the url
				</p>
				
				<br />
				<br />
				
				<input class="button-primary" type="submit" name="bwvideodropdown_video_submit" value="Save" />
			</form>
		</div>
		
		<div class="bwvd_button section_last" id="section_last"><span><div class="dashicons dashicons-video-alt3"></div> All Videos</span><span class="alignright">click to open</span></div>
		<div class="bwvd_content">
			<ul id="bwvd_list">
				<?php
				$result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwvideodropdown");
				$num_rows = $wpdb->num_rows;
				$count = 1;
				if(!$result == "") {
					foreach($result as $row) {
						if($count == $num_rows) {
							echo '<a href="?page=bwvideodropdown&bwvd=e&id='.$row->id.'"><li id="bwvd_list_last">'.$row->video_title.'</li></a>';
						} else {
							echo '<a href="?page=bwvideodropdown&bwvd=e&id='.$row->id.'"><li>'.$row->video_title.'</li></a>';
						}
						$count++;
					}
				} else {
					echo '<li>'.esc_attr_e( 'There are no videos', 'wp_admin_style' ).'</li>';
				}
				?>
			</ul>
		</div>
	</div>
	<h2>Shortcodes</h2>
	<p>To display the dropdown box, use shortcode <strong><i>[VD_dropdown]</i></strong></p>
	<p>To display the video, use shortcode <strong><i>[VD_video]</i></strong></p>
</div>
