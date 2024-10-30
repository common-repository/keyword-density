<?php
    /**
    * Direct access to this file is not allowed.
    */
    if( !defined( 'KD_VERSION' ) || KD_VERSION != '1.0' )
        die( 'Access denied' );
    /**
    * Add some options default values.
    */
    register_activation_hook( WP_PLUGIN_DIR . '/keyword-density/keyword-density.php' , 'kd_activate' );
    function kd_activate(){
        add_option( 'kd_version', KD_VERSION );
        add_option( 'kd_show_option_notice', 'true' );
        add_option( 'kd_default_keyword', 'Keyword phrase' );
        add_option( 'kd_default_case_sensitive', '1' );
        add_option( 'kd_default_exact_match', '1' );
        add_option( 'kd_post_types', array( 'post', 'page' ) );
    }
    /**
    * Notice the user about options page when the plugin activated for the first time.
    */
    add_action( 'admin_notices', 'kd_show_options_notice' );
    function kd_show_options_notice(){
        $content = '';
        $display_notice = get_option( 'kd_show_option_notice' );
        if ( basename( $_SERVER[ 'PHP_SELF' ] ) == 'options-writing.php'  ){
            if( $display_notice == 'true' )
                delete_option( 'kd_show_option_notice' );
        }
        else if( $display_notice  == 'true' )
            $content = '<div class="kd-notice"><p><a href="options-writing.php?kd_=1#kd-options">' . __( 'Keyword Density plugin: Some options has been added to the Writing section settings' ) . '</a></p></div>';
        echo $content;
    }
    /**
    * Add Settings -> Writing Menu section for the plugin options
    */
    add_action( 'admin_menu', 'kd_add_writing_section' );
    function kd_add_writing_section(){
        register_setting( 'writing', 'kd_default_keyword' );
        register_setting( 'writing', 'kd_default_case_sensitive' );
        register_setting( 'writing', 'kd_default_exact_match' );
        register_setting( 'writing', 'kd_post_types' );
        add_settings_section( 'kd-options', __( 'Keyword density' ), 'kd_print_options_section', 'writing' );
    }
    /**
    * Print out the options section form.
    */
    function kd_print_options_section(){        
        require( 'options-form.inc.php' );
    }
?>
