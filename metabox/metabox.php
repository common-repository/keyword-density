<?php
    /**
    * Direct access to this file is not allowed.
    */
    if( !defined( 'KD_VERSION' ) || KD_VERSION != '1.0' )
        die( 'Access denied' );
    /**
    *  Add Meta-boxes Widgets for the selected post types ( specified from options page ).
    */
    add_action( 'admin_init', 'kd_add_meta_box' );
    function kd_add_meta_box(){
        $post_types = get_option( 'kd_post_types' ) ;
        foreach( $post_types as $post_type_name )
            add_meta_box( 'keyword-density', 'Keyword density', 'kd_meta_box_form', $post_type_name, 'side', 'high', null );
    }
    /**
    * Get post Meta-box options (last entred Keyword, case sensitive...) from post meta.
    * 
    * @param mixed $post_id The id for the post begin edited.
    * @return array Meta-box options values.
    */
    function kd_get_post_options( $post_id ){
        if( get_post_meta( $post_id, 'kd_', true ) != 'true' ){
            update_post_meta( $post_id, 'kd_keyword', get_option( 'kd_default_keyword' ) );
            update_post_meta( $post_id, 'kd_case_sensitive', get_option( 'kd_default_case_sensitive' ) );
            update_post_meta( $post_id, 'kd_exact_match', get_option( 'kd_default_exact_match' ) );
            update_post_meta( $post_id, 'kd_', 'true' );
        }
        $options[ 'keyword' ] = get_post_meta( $post_id, 'kd_keyword', true );
        $options[ 'case_sensitive' ] = get_post_meta( $post_id, 'kd_case_sensitive', true );
        $options[ 'exact_match' ] = get_post_meta( $post_id, 'kd_exact_match', true );        
        return $options;
    }
    /**
    * Print out Keyword density Meta-box admin Widget, this method get called by Wordpress filters engine,
    * because of the prior calls to add_post_meta function.
    * 
    * @arg mixed The last parameter passed to add_met_box function (in out case its = null).
    * @return void
    */
    function kd_meta_box_form( $arg ){
        global $post;
        extract( kd_get_post_options( $post->ID ) );
        $density = kd_calculate_density( $keyword, $case_sensitive, $exact_match, $post->post_content );
        wp_nonce_field( 'keyword-density', 'keyword-density-nf', true, true );
        require( 'metabox-form.inc.php' );
    }
    /**
    * Recalculate Keyword density when post get updated.
    */
    add_action( 'save_post', 'kd_update_form' );
    function kd_update_form( $post_id ){
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return $post_id; 
        else if( !wp_verify_nonce( $_POST[ 'keyword-density-nf' ], 'keyword-density' ) )
            return $post_id;
        update_post_meta( $post_id, 'kd_keyword', $_POST[ 'kd_keyword' ] );
        update_post_meta( $post_id, 'kd_case_sensitive', $_POST[ 'kd_case_sensitive' ] );
        update_post_meta( $post_id, 'kd_exact_match', $_POST[ 'kd_exact_match' ] );
    }
    /**
    * These few lines has all the calculation that the plug-in do. 
    * 
    * @param $keyword The keywords to search for.
    * @param $case_sensitive Is to use case sensitive.
    * @param $exact_match If to search for the exact match keyword.
    * @param $content Content of the post to search for keywords.
    * @return array Keyword density for each Keyword and the total for all Keywords densities.
    */
    function kd_calculate_density( $keyword, $case_sensitive, $exact_match, $content ){
        $density = array( 'keyword' => array(), 'info' => array( 'repeat' => 0, 'percentage' => 0 ) );
        $content = strip_tags( html_entity_decode( $content ) );
        $content = !$case_sensitive ? strtolower( $content )  : $content;
        $keyword = !$case_sensitive ? strtolower( $keyword )  : $keyword;
        $content_words_count = str_word_count( $content );
        $phrases = !$exact_match ? explode( ' ' , $keyword ) : (array)$keyword;
        foreach( $phrases as $phrase ){
            if( empty( $phrase ) || $content_words_count == 0 )
                continue;
            $matches_count = preg_match_all( '/' . addcslashes( $phrase, '/\'"-.:{}[]()$!@#^&*+%<>' ) . '/', $content, $matches, PREG_SET_ORDER ); 
            // the most important equation, when exact match is == 1, we may get a muliple words length keyword phrase,
            // the idea is to remove (keyword phrase length - 1) * how many times the Keyword is found to calculate the percentage,
            // for example if we've matched 3 Words long keyword phrase for 5 times we'll subtract ( (3 - 1) * 5 ) = 10 from the content length
            // to calculate the percentage!
            $adj_total = ( $content_words_count - ( $matches_count * ( str_word_count( $phrase ) - 1 ) ) );
            $density[ 'keyword' ][ $phrase ][ 'percentage' ] =( 100 * $matches_count / $adj_total );
            $density[ 'keyword' ][ $phrase ][ 'repeat' ] = $matches_count; 
            $density[ 'info' ][ 'repeat' ] += $matches_count;
            $density[ 'info' ][ 'percentage' ] += $density[ 'keyword' ][ $phrase ][ 'percentage' ];
        }
        $density[ 'info' ][ 'content_length' ] = $content_words_count;
        return $density;
    }
?>
