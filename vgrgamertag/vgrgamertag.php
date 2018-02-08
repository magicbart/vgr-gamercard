<?php
/*
Plugin Name: VGR Gamertag
Description: Adds your VGR Gamertag to your sidebar.
Author: Benard David
Version: 1.1
Author URI: http://www.vgr-magicbart.com
*/

function widget_vgrgamertag_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_vgrgamertag($args) {
		extract($args);
		$options = get_option('widget_vgrgamertag');
		$title = $options['title'];
		$gamertag = $options['gamertag'];
		echo $before_widget . $before_title . $title . $after_title;
		echo '<br><iframe src="https://www.video-games-records.com/gamercard?pseudo='.urlencode($gamertag).'" scrolling="no" frameBorder="0" height="136" width="210">'.$gamertag.'</iframe>';
		echo $after_widget;
	}

	function widget_vgrgamertag_control() {

		$options = get_option('widget_vgrgamertag');
		if ( !is_array($options) )
			$options = array('title'=>'VGR Gamertag', 'gamertag'=>'');
		if ( $_POST['vgrgamertag-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['vgrgamertag-title']));
			$options['gamertag'] = strip_tags(stripslashes($_POST['vgrgamertag-gamertag']));
			update_option('widget_vgrgamertag', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$gamertag = htmlspecialchars($options['gamertag'], ENT_QUOTES);
		echo '<p style="text-align:right;"><label for="vgrgamertag-title">Title: <input style="width: 200px;" id="vgrgamertag-title" name="vgrgamertag-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:right;"><label for="vgrgamertag-gamertag">Gamertag: <input style="width: 200px;" id="vgrgamertag-gamertag" name="vgrgamertag-gamertag" type="text" value="'.$gamertag.'" /></label></p>';
		echo '<input type="hidden" id="vgrgamertag-submit" name="vgrgamertag-submit" value="1" />';
	}

	register_sidebar_widget('VGR Gamertag', 'widget_vgrgamertag');
	register_widget_control('VGR Gamertag', 'widget_vgrgamertag_control', 300, 100);

}
add_action('plugins_loaded', 'widget_vgrgamertag_init');

?>