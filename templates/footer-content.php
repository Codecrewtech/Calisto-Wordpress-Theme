<?php
$spyropress_footer_layout = get_setting( 'footer_layout', '0col' );
$spyropress_areas = array( 'footer-1', 'footer-2', 'footer-3', 'footer-4', 'footer-5', 'footer-6' );
$spyropress_footer_layouts = array(
    '0col'  =>  array(),
    '1col'  =>  array(12),
    '2col'  =>  array(6,6),
    '3col'  =>  array(4,4,4),
    '4col'  =>  array(3,3,3,3),
    '6col'  =>  array(2,2,2,2,2,2),
    'h2col' =>  array(6,3,3),
    '2hcol' =>  array(3,3,6),
    'h3col' =>  array(6,2,2,2),
    '3hcol' =>  array(2,2,2,6),
    't4col' =>  array(4,2,2,2,2),
    '4tcol' =>  array(2,2,2,2,4)
);

$spyropress_footer_layout = $spyropress_footer_layouts[$spyropress_footer_layout];
?>
<section class="footer">
    <?php if ( !empty( $spyropress_footer_layout ) ): ?>
    <div class="container">
        <div class="<?php get_row_class(); ?>">
        <?php
            echo '<!-- footer-widget-areas -->' . "\n";
            foreach($spyropress_footer_layout as $spyropress_k => $spyropress_area ) :
                echo '<div class="col-md-'. $spyropress_area .'">';
                    dynamic_sidebar( $spyropress_areas[$spyropress_k] );
                echo '</div>';
            endforeach;
            echo '<!-- /footer-widget-areas -->' . "\n";
        ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer - Copyright -->
    <?php if( $spyropress_footer_copyright = get_setting( 'footer_copyright' ) ): ?>
        <div class="footer-copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo tomato_html($spyropress_footer_copyright); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>