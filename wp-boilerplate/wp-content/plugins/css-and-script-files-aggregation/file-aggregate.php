<?php
/*
Plugin Name: CSS And Script File Aggregation
Plugin URI: http://yacobi.info/
Description: Aggregates css and js files to minimize HTTP requests sent from browsers and speed up page load.
Version: 1.3.1
Author: Ronen Yacobi
Author URI: http://yacobi.info/
License:  GPL2
*/
define('CJFA_VERSION',1.31);

$fa_enabled = get_option('fa_enabled',array('css','js')); //if option not set, set default values
if ($fa_enabled=='') $fa_enabled=array();
if (!is_admin() && !strpos($_SERVER['REQUEST_URI'],'wp-login.php')) {
	$fa_new_ver = false;
	$faoptions = get_option('faoptions');
	if (CJFA_VERSION>$faoptions['pluginver']) {
		$fa_new_ver = true;  //plugin has been upgraded - rewrite all
		$faoptions['pluginver'] = CJFA_VERSION;
		update_option('faoptions',$faoptions);
	}
	if (in_array('css',$fa_enabled)) add_action('wp_print_styles', 'combine_css_files',99999);
	if (in_array('js',$fa_enabled)) add_action('wp_print_scripts', 'combine_js_files',99999);
}
else {
	add_filter('plugin_row_meta', 'FARegisterPluginLinks',10,2);
	add_action('admin_menu', 'facj_info_menu');
}

function facj_info_menu() {
  add_options_page('CSS & JS File Aggregate', 'File Aggregate', 'administrator', 'facjpluginpage', 'facj_settings_page');
  add_action('admin_init', 'facj_admin_init');
}


function FARegisterPluginLinks($links,$file) {
	 if ( $file == plugin_basename(__FILE__) ) {
		 $links[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7KGK3D9TRDF6E">Liked The Plugin? Buy me a beer</a>';
	 }
	 return $links;
}

function facj_admin_init() {
   register_setting( 'facjoptions', 'fa_enabled' );
}

function facj_settings_page() {
?>
  <div class="wrap" style="float:left;">
  <h2>File Aggregate</h2>
<?php
	global $fa_enabled;
	$fafiles = get_option('faoptions');
	if ($fafiles) {
		$fafiles=array_keys($fafiles);
		$css=$js=0;
		foreach ($fafiles as $file ) {
			if (strpos($file,'css-')===0) $css++;
			if (strpos($file,'js-')===0) $js++;
		}		
		if ($css > 0 && in_array('css',$fa_enabled)) echo "<p style='font-weight:bold;'>CSS Files Aggregated: $css</p>";
		if ($js > 0 && in_array('js',$fa_enabled)) echo "<p style='font-weight:bold;'>Javascript Files Aggregated: $js</p>";
	}
?>

  <form method="post" action="options.php">
  <?php settings_fields( 'facjoptions' ); ?>
  <table class="form-table">
  <tr valign="top">
  <th scope="row">Enable CSS Files Aggregation</th>
  <td><input type="checkbox" name="fa_enabled[]" value="css" <?php if (in_array('css',$fa_enabled)) echo 'checked="true"'; ?> /></td>
  </tr>
  <tr valign="top">
  <th scope="row">Enable JS (Javascript) Files Aggregation</th>
  <td><input type="checkbox" name="fa_enabled[]" value="js" <?php if (in_array('js',$fa_enabled)) echo 'checked="true"'; ?> /></td>
  </tr>
  </table>
  <p class="submit">
  <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
  </p>
  </form>
  </div>
  <div style="float:left;padding-top:30px;text-align:center;"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7KGK3D9TRDF6E" target="_blank"><img src="http://yacobi.info/images/donate.jpg"><p style="font-size:14px;font-weight:bold;">Found this plugin useful? Any donation would be highly appreciated!</p></a> <div>
  
<?php
}

function css_content_fixed_urls($css_file) { //returns the content of the css file after modifying relative urls
	$source_file=fopen($css_file,'r') or die("ERROR OPENING CSS FILE:".$css_src);
	$content = fread($source_file,filesize($css_file));
	fclose($source_file);
	if (strrpos($css_file,"/")) {
		$css_path = get_option('siteurl') ."/" . substr($css_file,0,strrpos($css_file,"/")) . "/";
	}
	else {
		$css_path = get_option('siteurl') ."/";
	}
	$content = preg_replace("/\burl\b\s*?\((\s*?[\"'])?(?!\/)(?!http)(.*?)([\"']?\s*)?\)/","url('".$css_path."$2')",$content); //changes relative url to absolute
	return $content;
}

function combine_css_files() {
	global $wp_styles; global $fa_new_ver;
	define('CSS_BASE_NAME','combined-style-');
	$faoptions = get_option('faoptions');
	if (!is_array($faoptions)) $faoptions=array();
	$css_files_modify=array();
	$css_files=array();
	if (is_array($wp_styles->queue)) {  //is there anything in the queue?
		$wp_styles->all_deps($wp_styles->queue); //preparing the queue taking dependencies into account
		foreach ($faoptions As $css => $value) { //going through all the already found css files, checking that they are still required
			if ((!in_array(substr($css,4),$wp_styles->to_do)) && substr($css,0,4)=='css-') {  //if the css is not queued, rewrite the file
				$css_media=$value['type'];
				$css_files_modify[$css_media] = true;
				unset($faoptions[$css]);
			}
		}
		foreach ($wp_styles->to_do As $css) {
			$css_src=$wp_styles->registered[$css]->src;
			$css_media=$wp_styles->registered[$css]->args;
			if ((!(strpos($css_src,get_bloginfo('url'))===false)  || substr($css_src,0,1)==="/" || substr($css_src,0,1)===".") && (substr($css_src,strrpos($css_src,"."),4)==".css") ) { //the css is hosted localy AND is a css file
				if (!is_array($css_files[$css_media])) {
					$css_files[$css_media]=array();
				}
				if (strpos($css_src,get_bloginfo('url'))===false) {
					$css_relative_url=substr($css_src,1);
				}
				else {
					$css_relative_url=substr($css_src,strlen(get_bloginfo('url'))+1);
				}
				if (strpos($css_relative_url,"?")) $css_relative_url=substr($css_relative_url,0,strpos($css_relative_url,"?")); //removing parameters
				$css_m_time=null;
				@$css_m_time=filemtime($css_relative_url); //getting the mofified time of the css file. extracting the file's dir
				if ($css_m_time) { //only add the file if it's accessible
					array_push($css_files[$css_media],$css_relative_url); 
					if ( (!file_exists(dirname(__FILE__)."/". CSS_BASE_NAME .$css_media.".css")) //combined css doesn't exist
						|| (isset($faoptions['css-'.$css]) && (($css_m_time <> $faoptions['css-'.$css]['modified']) || $faoptions['css-'.$css]['type']<>$css_media )) //css file has changed or the media type changed
						|| (!isset($faoptions['css-'.$css]))  //css file is first identified
						|| $fa_new_ver ) { //new plugin version - rewrite
							$css_files_modify[$css_media] = true;  //the combined file containing this media type css should be changed
							if (isset($faoptions['css-'.$css]) && $faoptions['css-'.$css]['type']<>$css_media) { //if the media type changed - rewrite both css files
								$tmp=$faoptions['css-'.$css]['type'];
								$css_files_modify[$tmp] = true;
							}
							if (!is_array($faoptions['css-'.$css])) $faoptions['css-'.$css]=array();
							$faoptions['css-'.$css]['modified'] = $css_m_time; //write the new modified date
							$faoptions['css-'.$css]['type'] = $css_media;
					}
					$wp_styles->remove($css);  //removes the css file from the queue
				}
			}
		}
	}
	foreach ($css_files_modify As $key => $value) {
		$combined_file=fopen(dirname(__FILE__)."/". CSS_BASE_NAME .$key.".css", 'w') or die("ERROR OPENING CSS FILE:".dirname(__FILE__)."/". CSS_BASE_NAME .$key.".css");
		$css_content='';
		if (is_array($css_files[$key])) {
			foreach ($css_files[$key] As $css_src) {				
				$css_content .= "/* File Aggregate Plugin - ". $css_src." content: */ \n" . css_content_fixed_urls($css_src) ."\n";
			}
		}
		if (!isset($faoptions['ver'][$key])) $faoptions['ver'][$key]=0;
		$faoptions['ver'][$key]++;
		fwrite($combined_file,$css_content);
		fclose($combined_file);
	}
	foreach ($css_files As $key => $value) { //enqueue the combined css files
		wp_enqueue_style(CSS_BASE_NAME.$key,WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__))."/". CSS_BASE_NAME.$key.".css", array(), $faoptions['ver'][$key], $key );
	}
	update_option('faoptions',$faoptions);
}

function combine_js_files() {
	global $wp_scripts;  global $fa_new_ver;
	global $skip_combine_js;
	if (isset($skip_combine_js)) return null; //Don't run twice
	$skip_combine_js=true;
	$faoptions = get_option('faoptions');
	if (!is_array($faoptions)) $faoptions=array();
	$js_files_modify=array();
	$js_files=array();
	if (is_array($wp_scripts->queue)) {  //is there anything in the queue?
		$wp_scripts->all_deps($wp_scripts->queue); //preparing the queue taking dependencies into account
		foreach ($faoptions As $js => $value) { //going through all the already found js files, checking that they are still required
			if ( (!in_array(substr($js,3),$wp_scripts->to_do)) && substr($js,0,3)=='js-') {  //if the js is not queued, rewrite the file
				$js_place=$value['type'];
				$js_files_modify[$js_place] = true;
				unset($faoptions[$js]);
			}
		}
		foreach ($wp_scripts->to_do As $js) {
			$js_src=$wp_scripts->registered[$js]->src;
			$js_place=$wp_scripts->registered[$js]->extra;
			if (is_array($js_place) && $js_place['group']==1) {
				$js_place='footer';
			}
			else {
				$js_place='header';
			}
			if ( (!(strpos($js_src,get_bloginfo('url'))===false) || substr($js_src,0,1)==="/" || substr($js_src,0,1)===".") && (substr($js_src,strrpos($js_src,"."),3)==".js") ) { //the js is hosted localy AND a .js file
				if (!is_array($js_files[$js_place])) {
					$js_files[$js_place]=array();
				}
				if (strpos($js_src,get_bloginfo('url'))===false) {
					$js_relative_url=substr($js_src,1);
				}
				else {
					$js_relative_url=substr($js_src,strlen(get_bloginfo('url'))+1);
				}	
				if (strpos($js_relative_url,"?")) $js_relative_url=substr($js_relative_url,0,strpos($js_relative_url,"?")); //removing parameters
				$js_m_time=null;
				@$js_m_time=filemtime($js_relative_url); //getting the mofified time of the js file. extracting the file's dir
				if ($js_m_time) { //only add the file if it's accessible	
					array_push($js_files[$js_place],$js_relative_url); 			
					if ( (!file_exists(dirname(__FILE__)."/combined-scripts-".$js_place.".js")) //combined js doesn't exist
						|| (isset($faoptions['js-'.$js]) && (($js_m_time <> $faoptions['js-'.$js]['modified']) || $faoptions['js-'.$js]['type']<>$js_place )) //js file has changed or the target place changed
						|| (!isset($faoptions['js-'.$js]))  //js file is first identified
						|| $fa_new_ver ) { //new plugin version - rewrite
							$js_files_modify[$js_place] = true;  //the combined file containing this place js should be changed
							if (isset($faoptions['js-'.$js]) && $faoptions['js-'.$js]['type']<>$js_place) { //if the place type changed - rewrite both js files
								$tmp=$faoptions['js-'.$js]['type'];
								$js_files_modify[$tmp] = true;
							}
							if (!is_array($faoptions['js-'.$js])) $faoptions['js-'.$js]=array();
							$faoptions['js-'.$js]['modified'] = $js_m_time; //write the new modified date
							$faoptions['js-'.$js]['type'] = $js_place;
					}
					$wp_scripts->remove($js);  //removes the js file from the queue
					array_shift($wp_scripts->to_do);
				}
			}
		}
	}
	foreach ($js_files_modify As $key => $value) {
		$combined_file=fopen(dirname(__FILE__)."/combined-scripts-" .$key.".js", 'w') or die("ERROR OPENING JS FILE:".dirname(__FILE__)."/combined-scripts-" .$key.".js");
		$js_content='';
		if (is_array($js_files[$key])) {
			foreach ($js_files[$key] As $js_src) {
					$source_file=fopen($js_src,'r') or die("ERROR OPENING JS FILE:".$js_src);
					$js_content .= "/*  File Aggregate Plugin - ". $js_src." content: */ \n" . fread($source_file,filesize($js_src))."\n";
					fclose($source_file);
			}
		}
		if (!isset($faoptions['ver'][$key."-js"])) $faoptions['ver'][$key."-js"]=0;
		$faoptions['ver'][$key."-js"]++;
		fwrite($combined_file,$js_content);
		fclose($combined_file);
	}
	//enqueue the combined js files
	if (isset($js_files["header"])) {
		wp_enqueue_script('fa-combined-header',WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__))."/combined-scripts-header.js", array(), $faoptions['ver']["header-js"], false );
	}
	if (isset($js_files["footer"])) {
		wp_enqueue_script('fa-combined-footer',WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__))."/combined-scripts-footer.js", array(), $faoptions['ver']["footer-js"], true );
	}
	update_option('faoptions',$faoptions); 
}
?>