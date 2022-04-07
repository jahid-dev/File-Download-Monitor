<?php
/**
 * Plugin Name:       Download Monitor
 * Plugin URI:        https://viserx.com/
 * Description:       Download Monitor any kinds of file with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            jahidcse
 * Author URI:        https://profiles.wordpress.org/jahidcse/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://profiles.wordpress.org/jahidcse/#content-plugins
 * Text Domain:       vxdownload
 * Domain Path:       /languages
 */


// load textdomain

function vxdownload_load_textdomain() {
    load_plugin_textdomain( 'vxdownload_monitor', false, dirname( __FILE__ ) . "/languages" );
}


// script load

function vxdownload_script_load(){
    
    if ( is_page('forms-and-templates') || is_page('regulatory-library') || ('publications' == get_post_type()) || ('forms-templates' == get_post_type()) || ('regulatory-library' == get_post_type())) {
    wp_enqueue_script( 'vxdownload_monitor_script', plugins_url('/includes/public/js/script.js', __FILE__), array('jquery'), '', true );
    $vxdownload_data = array(
        'ajaxurl' => admin_url('admin-ajax.php')
    );
    wp_localize_script( 'vxdownload_monitor_script', 'vxdownload_monitor_data', $vxdownload_data );
    }
}

add_action('wp_enqueue_scripts','vxdownload_script_load');


// ajax accept

add_action('wp_ajax_vxdownload_increment_counter', 'vxdownload_increment_counter_history');   
add_action('wp_ajax_nopriv_vxdownload_increment_counter', 'vxdownload_increment_counter_history');

function vxdownload_increment_counter_history(){
    
    $vxdownload_post=sanitize_key($_POST['postid']);
    $vxdownload_option_name = 'vxdownload_'.$vxdownload_post;
    
    if ( get_option( $vxdownload_option_name ) !== false ) {
        $new_value = intval(get_option($vxdownload_option_name)) + 1; 
        update_option( $vxdownload_option_name, $new_value );
    } else {
        $deprecated = null;
        $autoload = 'no';
        add_option( $vxdownload_option_name, 1 , $deprecated, $autoload );
    }
    wp_die();

}

// Download publications Column & Data

function vxdownload_publications_download_column($columns){
    
    $columns['download'] = __('Download');
    return $columns;
}

add_filter('manage_publications_posts_columns', 'vxdownload_publications_download_column');


function vxdownload_publications_download_data($columns,$post_id){
    
    if('download'==$columns){
        $vxdownload_option_name= 'vxdownload_'.$post_id;
        echo get_option($vxdownload_option_name);
    }
}
add_action('manage_publications_posts_custom_column','vxdownload_publications_download_data',20,2);



// Download forms-templates Column & Data

function vxdownload_formtemplate_download_column($columns){
    
    $columns['download'] = __('Download');
    return $columns;
}

add_filter('manage_forms-templates_posts_columns', 'vxdownload_formtemplate_download_column');


function vxdownload_formtemplate_download_data($columns,$post_id){
    
    if('download'==$columns){
        $vxdownload_option_name= 'vxdownload_'.$post_id;
        echo get_option($vxdownload_option_name);
    }
}
add_action('manage_forms-templates_posts_custom_column','vxdownload_formtemplate_download_data',20,2);


// Download regulatory-library Column & Data

function vxdownload_regulatorylibrary_download_column($columns){
    
    $columns['download'] = __('Download');
    return $columns;
}

add_filter('manage_regulatory-library_posts_columns', 'vxdownload_regulatorylibrary_download_column');


function vxdownload_regulatorylibrary_download_data($columns,$post_id){
    
    if('download'==$columns){
        $vxdownload_option_name= 'vxdownload_'.$post_id;
        echo get_option($vxdownload_option_name);
    }
}
add_action('manage_regulatory-library_posts_custom_column','vxdownload_regulatorylibrary_download_data',20,2);



