<?php
/*
Plugin Name: Keyword Density
Plugin URI: http://projects.codealizer.com/projects/wordpress/plugins/keyword-density
Description: Calculate how much times a Keyword Phrase repeated in the post content.
Version: 1.0
Author: AHMED HAMED
Author URI: http://projects.codealizer.com
License: 
        Copyright (C) 2011  AHMED HAMED

        This program is free software; you can redistribute it and/or
        modify it under the terms of the GNU General Public License
        as published by the Free Software Foundation; either version 2
        of the License, or (at your option) any later version.

        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.

        You should have received a copy of the GNU General Public License
        along with this program; if not, write to the Free Software
        Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/  
    if( !defined( 'ABSPATH' ) )
        die( 'Access denied' );
    /**
    * Defining current version number    
    */
    define( 'KD_VERSION', '1.0' );
    /**
    * Enqueue admin style sheet.
    */
    add_action( 'admin_print_styles', 'kd_print_styles' );
    function kd_print_styles(){
        wp_enqueue_style( 'kd-style', plugins_url( 'keyword-density/style.css' ) );
    }
    /**
    * Add "Settings" link to the plugins page.
    */
    add_filter( 'plugin_action_links', 'kd_add_settings_link', 10, 2 );
    function kd_add_settings_link( $links, $file ){
        static $plugin_file;
        if( !$plugin_file )
            $plugin_file = plugin_basename( __FILE__ );
        if( $plugin_file == $file ){
            $settings_link = '<a href="options-writing.php?kd_=1#kd-options">' .  __( 'Settings' ) . '</a>';
            array_push( $links, $settings_link );
        }
        return $links;
    }
    /**
    * Include both admin options & Meta-box Widget files.
    */
    require( 'admin/options.php' );  // Options page
    require( 'metabox/metabox.php' ); // Post edit screen Meta-box Widget
?>
