<?php
    /**
    * Direct access to this file is not allowed.
    */
    if( !defined( 'KD_VERSION' ) )
        die( 'Access denied' );
?>
    <table id="kd-options" class="form-table" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td colspan="2"><?=__( 'Set up the default post options' )?></td>
        </tr>
        <tr>
            <th scope="row"><label for="kd_default_keyword"><?=__( 'Keyword' )?></label></th>
            <td><input type="text" name="kd_default_keyword" id="kd_default_keyword" value="<?=get_option( 'kd_default_keyword' )?>" /></td>
        </tr>
        <tr>
            <th scope="row"><?=__( 'Case sensitive' )?></th>
            <td><input type="checkbox" name="kd_default_case_sensitive" id="kd_default_case_sensitive" value="1" <?= get_option( 'kd_default_case_sensitive' ) ? 'checked="checked"' : '' ?>/><label for="kb_default_case_sensitive"> <?= __( 'If checked the plugin will search for the keyword "as it", lowercase and Uppercase letters will treated differentially.' )?></label></td></tr>
        <tr>
            <th scope="row"><?=__( 'Exact match' )?></th>
            <td><input type="checkbox" name="kd_default_exact_match" id="kd_default_exact_match" value="1" <?= get_option( 'kd_default_exact_match' ) ? 'checked="checked"' : '' ?> /><label for="kb_default_exact_match"> <?= __( 'Search for the exact match for the phrase.' )?></label></td>
        </tr>
        <tr>
            <th scope="row">Post types</th>
            <td>   
                <ul>
                    <?php
                        /**
                        * Show all the registered post types,
                        * so the user can select in which post type the Meta-box Widget will get displayed.
                        */
                        echo '<p>' . __( 'You can select in which post types the keyword density metabox would displayed' ) . '</p><br />';
                        $selected_post_types = !is_array( $post_types_array = get_option( 'kd_post_types' ) ) ? array() : $post_types_array ;
                        $selected_post_types = array_flip( $selected_post_types );
                        $ignore_list_post_types = array( 'revision', 'nav_menu_item', 'attachment' );
                        $post_types = get_post_types( array(), 'objects' );
                        $check_box_list = '';
                        foreach( $post_types as $post_type_name => $post_type ){
                            if( !in_array( $post_type_name, $ignore_list_post_types ) )
                                $check_box_list .= "<li><input type='checkbox' name='kd_post_types[]' id='kd_post_types' value='{$post_type_name}'" . ( isset( $selected_post_types[ $post_type_name ] ) ? "checked='checked'" : '' )  . " /> {$post_type->labels->name}</li>";
                        }
                        echo $check_box_list;
                    ?>
                </ul>
            </td>
        </tr>
    </table>