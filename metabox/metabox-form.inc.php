                
    <ul class="keyword-density-widget">
        <li><label style="font-weight:bold" for="kd_keyword" ><?= __( 'Keyword phrase' ) ?></label></li>
        <li><input type='text' id='kd_keyword' name='kd_keyword' value='<?=$keyword?>' style='width:98%' /></li>
        <li><input type='checkbox' id='kd_case_sensitive' name='kd_case_sensitive' value='1' <?= ( $case_sensitive ? "checked='checked'" : '' ) ?> /><label for='kd_case_sensitive'> <?= __( 'Case sensitive' ) ?></label></li>
        <li><input type='checkbox' id='kd_exact_match' name='kd_exact_match' value='1' <?= ( $exact_match ? "checked='checked'" : '' ) ?> /><label for='kd_exact_match'> <?= __( 'Exact match' ) ?></label></li>
        <li><span class='kd-output-title' title="<?= __( 'Content words count' )?>" ><?= __( 'Content Length:' )?> </span><span class='kd-output-value'><?=$density[ 'info' ][ 'content_length' ]?></span></li>
        <li><span class='kd-output-title'><?= __( 'Repeats count:' )?> </span><span class='kd-output-value'><?=$density[ 'info' ][ 'repeat' ]?></span></li>
        <li><span class='kd-output-title'><?= __( 'Density is:') ?> </span><span class='kd-output-value'><?= vsprintf( '%0.1f', $density[ 'info' ][ 'percentage' ] )?>%</span></li>
        <li>
            <div id="kd-details">
                <h3><?= __( 'Keywords' ) ?></h3>
                <div class="kd-keywords-list">
                    <?php
                        $content = '';
                        foreach( $density[ 'keyword' ] as $keyword => $keyword_info ){
                            $content .= "<div class='kd-details-link'><a href='#'>{$keyword}</a></div>";
                            $content .= "<ul class='kd-details-list' >";
                            $content .= "<li><span class='kd-output-title'>" . __( 'Repeats count:' ) . " </span><span class='kd-output-value'>{$keyword_info[ 'repeat' ]}</span></li>";
                            $content .= "<li><span class='kd-output-title'>" . __( 'Density is:' ) . " </span><span class='kd-output-value'>" . vsprintf( '%0.1f', $keyword_info[ 'percentage' ] ) . "%</span></li>";
                            $content .= '</ul>';
                        }                
                        echo $content;
                    ?>
                </div>
            </div>
        </li>
    </ul>
    <script type="text/javascript">
        jQuery( "#kd-details .kd-details-link" ).click( function(){ jQuery(this).next().toggle( "fast" ); return false; } ).next().hide();
    </script>