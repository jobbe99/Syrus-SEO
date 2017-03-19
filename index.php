<?php
/*
Plugin Name: Syrus SEO
Plugin URI: https://wordpress.org/plugins/syrus-seo/
Description: Inserimento automatico del Title e della Description o personalizzazione con strumento di analisi per vedere la densità delle keywords sulla pagina.
Version: 1.0.0
Author: Syrus Industry
Author URI: https://www.syrusindustry.com/
Text Domain: SEO
*/


 defined('ABSPATH') or die('Cheatin\' uh?');

 define('SYRUS_SEO_VERSION', '1.0.0');
 define('SYRUS_SEO_PATH', plugin_dir_path( __FILE__ ) );

 require(SYRUS_SEO_PATH.'form.php');

 /*
  * Load plugin assets
  *
  * @since 1.0
  */
 function syrus_seo_load() {
 	register_setting('syrus-seo-settings-group', 'syrus_seo_default_meta_title');
 	register_setting('syrus-seo-settings-group', 'syrus_seo_default_meta_description');
 	register_setting('syrus-seo-settings-group', 'syrus_seo_default_meta_keywords');

 	syrus_seo_register();
 }

 add_action('admin_init', 'syrus_seo_load');

 /**
  * Registers JS and CSS.
  *
  * @since  1.0.0
  */
 function syrus_seo_register() {
 	wp_register_style('syrusseoAdminStyle', plugins_url('style.css', __FILE__), false, SYRUS_SEO_VERSION);
 	wp_register_script('syrusseoAdminScript', plugins_url('script.js', __FILE__), array('jquery'), SYRUS_SEO_VERSION, true);
 }

 /**
  * Enqueues the CSS and JS files.
  *
  * @since  1.0.0
  */
 function syrus_seo_enqueue() {
 	wp_enqueue_style('syrusseoAdminStyle', plugins_url('style.css', __FILE__), false, SYRUS_SEO_VERSION);
 	wp_enqueue_script('syrusseoAdminScript', plugins_url('script.js', __FILE__), array('jquery'), SYRUS_SEO_VERSION, true);
 }

 add_action('admin_enqueue_scripts', 'syrus_seo_enqueue');

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_meta_boxes() {
     add_meta_box( 'syrus-seo', __('Syrus SEO'),'syrus_seo_show_meta_boxes');
 }

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_show_meta_boxes($post, $params) {
     /* Use nonce for verification */
     echo '<input type="hidden" name="syrus_seo_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

 	$syrus_seo_meta_title = get_post_meta($post->ID, 'syrus_seo_meta_title', true);
 	$syrus_seo_meta_description = get_post_meta($post->ID, 'syrus_seo_meta_description', true);
 	$syrus_seo_meta_keywords = get_post_meta($post->ID, 'syrus_seo_meta_keywords', true);

 	/* SSEO Input Fields */
 	$syrus_seo_form = new syrus_seo_form_helper();
 	echo $syrus_seo_form->input('syrus_seo_meta_title', array(
 		'label' => 'Meta Title',
 		'value' => $syrus_seo_meta_title,
 	));

 	echo '<p><span id="sseo_title_count">0</span>/60 caratteri. La maggior parte dei motori di ricerca mostra 60 caratteri del titolo.</p>';

 	echo $syrus_seo_form->textarea('syrus_seo_meta_description', array(
 		'label' => 'Meta Description',
 		'value' => $syrus_seo_meta_description,
 	));

 	echo '<p><span id="sseo_desc_count">0</span>/155 caratteri. La maggior parte dei motori di ricerca mostra 155 caratteri della descrizione.</p>';

 	echo $syrus_seo_form->textarea('syrus_seo_meta_keywords', array(
 		'label' => 'Meta Keywords',
 		'value' => $syrus_seo_meta_keywords,
 	));

 	echo '<p>Inserire le paroli chiave separate dalla virgola.</p>';
 }

 add_action('add_meta_boxes', 'syrus_seo_meta_boxes');

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_admin_menu() {
 	add_options_page('SEO Options', 'Syrus SEO', 'manage_options', 'syrus_seo_options', 'syrus_seo_options');
 }

 add_action('admin_menu', 'syrus_seo_admin_menu');

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_options() {
 ?>
 <h1>Impostazioni Syrus SEO</h1>

 <div class="postbox-container" style="width:70%;">

 	<form method="post" action="options.php" novalidate>



 	<div class="metabox-holder">
 		<div class="meta-box-sortables ui-sortable" style="min-height: 0">
 			<div id="simple_seo_buy" class="postbox">
 				<h3 class="hndle ui-sortable-handle"><span>Home Page Default Meta Tag</span></h3>
 				<div class="inside">
 					<div class="main">
 						<?php settings_fields('syrus-seo-settings-group'); ?>
 						<?php do_settings_sections('syrus-seo-settings-group'); ?>

 						<div id="sseo_data">
 							<?php

 							$syrus_seo_form = new syrus_seo_form_helper();
 							echo $syrus_seo_form->input('syrus_seo_default_meta_title', array(
 								'label' => 'Default Meta Title',
 								'value' => esc_attr(get_option('syrus_seo_default_meta_title')),
 							));

 							echo '<p><span id="sseo_title_count">0</span>/60 caratteri. La maggior parte dei motori di ricerca mostra 60 caratteri del titolo.</p>';

 							echo $syrus_seo_form->textarea('syrus_seo_default_meta_description', array(
 								'label' => 'Default Meta Description',
 								'value' => esc_attr(get_option('syrus_seo_default_meta_description')),
 							));

 							echo '<p><span id="sseo_desc_count">0</span>/155 caratteri. La maggior parte dei motori di ricerca mostra 155 caratteri della descrizione.</p>';

 							echo $syrus_seo_form->textarea('syrus_seo_default_meta_keywords', array(
 								'label' => 'Default Meta Keywords',
 								'value' => esc_attr(get_option('syrus_seo_default_meta_keywords')),
 							));

 							echo '<p>Inserire le paroli chiave separate dalla virgola.</p>';

 							?>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<?php submit_button(); ?>

 	</form>
 </div>

 <div class="postbox-container" >
 	<div class="metabox-holder">
    			<div class="postbox">
    				<h3 class="hndle ui-sortable-handle"><span>Syrus Industry</span></h3>
            <div class="mbl-logo" align="center">
              <a href="https://www.syrusindustry.com/" target="_blank" alt="Logo Web Agency Roma" title="Agenzia Google Partner Roma">
                <img src="https://www.syrusindustry.com/wp-content/uploads/2017/02/cropped-SYSind_Def3-logo-1-e1487289005181.png">
              </a>
            </div>
            <div class="inside">
    					<p>Chi smette di fare pubblicità<br> per risparmiare soldi è come se fermasse<br> l'orologio per risparmiare il tempo.</p>
    					<p>- Stay Connected <a href="https://www.syrusindustry.com/" target="_blank" title="Web Agency Roma">SYRUS INDUSTRY</a><br> Internet Senza Confini…</p>
    				</div>
    			</div>
    		</div>
    	</div>


 <?php }

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_save_postdata($post_id) {
 	/* verify nonce */
 	if (!wp_verify_nonce($_POST['syrus_seo_nonce'], basename(__FILE__))) {
 		return $post_id;
 	}

 	if ( wp_is_post_revision( $post_id ) ) {
 		return $post_id;
 	}

 	/* check autosave */
 	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
 		return $post_id;
 	}

 	/* Check permissions */
 	if ($_POST['post_type'] == 'page') {
 		if (!current_user_can('edit_page', $post_id)) {
         	return $post_id;
         }
 	} elseif (!current_user_can('edit_post', $post_id)) {
     	return $post_id;
 	}

 	if (!wp_is_post_revision($post_id)) {
 		$old_meta_title = get_post_meta($post_id, 'syrus_seo_meta_title', true);
 		$new_meta_title = null;
 		if (isset($_POST['syrus_seo_meta_title'])) {
 			$new_meta_title = sanitize_text_field($_POST['syrus_seo_meta_title']);
 		}

 		if ($new_meta_title && $new_meta_title != $old_meta_title) {
 			update_post_meta($post_id, 'syrus_seo_meta_title', $new_meta_title);
 		} elseif (empty($new_meta_title) && $old_meta_title) {
 			delete_post_meta($post_id, 'syrus_seo_meta_title', $old_meta_title);
 		}

 		$old_meta_description = get_post_meta($post_id, 'syrus_seo_meta_description', true);
 		$new_meta_description = null;
 		if (isset($_POST['syrus_seo_meta_description'])) {
 			$new_meta_description = sanitize_text_field($_POST['syrus_seo_meta_description']);
 		}

 		if ($new_meta_description && $new_meta_description != $old_meta_description) {
 			update_post_meta($post_id, 'syrus_seo_meta_description', $new_meta_description);
 		} elseif (empty($new_meta_description) && $old_meta_description) {
 			delete_post_meta($post_id, 'syrus_seo_meta_description', $old_meta_description);
 		}

 		$old_meta_keywords = get_post_meta($post_id, 'syrus_seo_meta_keywords', true);
 		$new_meta_keywords = null;
 		if (isset($_POST['syrus_seo_meta_keywords'])) {
 			$new_meta_keywords = sanitize_text_field($_POST['syrus_seo_meta_keywords']);
 		}

 		if ($new_meta_keywords && $new_meta_keywords != $old_meta_keywords) {
 			update_post_meta($post_id, 'syrus_seo_meta_keywords', $new_meta_keywords);
 		} elseif (empty($new_meta_keywords) && $old_meta_keywords) {
 			delete_post_meta($post_id, 'syrus_seo_meta_keywords', $old_meta_keywords);
 		}
 	}
 }

 add_action('save_post', 'syrus_seo_save_postdata');

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_keywords() {
 	global $post;

 	if (!is_object($post)) {
 		return;
 	}

 	if (is_archive()) {
 		return;
 	}

 	$keywords = null;
 	if (is_front_page()) {
 		$keywords = esc_attr(get_option('syrus_seo_default_meta_keywords'));
 		$keywords = apply_filters('syrus_seo_default_meta_keywords', $keywords);
 	}

 	if (empty($keywords)) {
 		$keywords = get_post_meta($post->ID, 'syrus_seo_meta_keywords', true);
 		$keywords = apply_filters('syrus_seo_meta_keywords', $keywords);
 	}

 	if (empty($keywords)) {
 		return false;
 	}

 	echo '<meta name="keywords" content="'.$keywords.'" />'."\n";
 }

 add_action('wp_head', 'syrus_seo_keywords');

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_description() {
 	global $post;

 	if (!is_object($post)) {
 		return;
 	}

 	if (is_archive()) {
 		return;
 	}

 	$description = null;
 	if (is_front_page()) {
 		$description = esc_attr(get_option('syrus_seo_default_meta_description'));
 		$description = apply_filters('syrus_seo_default_meta_description', $description);
 	}

 	if (empty($description)) {
 		$description = get_post_meta($post->ID, 'syrus_seo_meta_description', true);
 		$description = apply_filters('syrus_seo_meta_description', $description);
 	}

 	if (empty($description)) {
    $description = wp_trim_words( wp_strip_all_tags( $post->post_content ), 25 );
 	}

 	echo '<meta name="description" content="'.$description.'" />'."\n";
 }

 add_action('wp_head', 'syrus_seo_description');

 /**
  * Description
  *
  * @since  1.0.0
  */
 function syrus_seo_title($title) {
 	global $post;

 	if (!is_object($post)) {
 		return;
 	}

 	if (is_archive()) {
 		return;
 	}

 	$meta_title = null;

 	/* default */
 	$default_title = esc_attr(get_option('syrus_seo_default_meta_title'));
 	$default_title = apply_filters('syrus_seo_default_meta_title', $default_title);
 	/* static page */
 	$meta_title = get_post_meta($post->ID, 'syrus_seo_meta_title', true);
 	$meta_title = apply_filters('syrus_seo_meta_title', $meta_title);

 	if (is_front_page() && is_home()) {
 		// Default homepage
 		if (empty($meta_title)) {
 			$meta_title = $default_title;
 		}
 	} elseif ( is_front_page() ) {
 		// static homepage
 		if (empty($meta_title)) {
 			$meta_title = $default_title;
 		}
 	} elseif ( is_home() ) {
 	  	// blog page
 		if (empty($meta_title)) {
 			$meta_title = $default_title;
 		}
 	}

 	if (empty($meta_title)) {
 		$meta_title = isset( $post->post_title ) ? $post->post_title: '';
 	}

 	return $meta_title;
 }

 add_filter('wp_title', 'syrus_seo_title', 22);

 ?>
