<?php
    //Theme Option Translation
    $spyropress_translate['search-placeholder'] = get_setting( 'translate' ) ? get_setting( 'search-placeholder', 'Search..' ) : esc_html__( 'Search..', 'tomato' );
?>
<form class="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
    <input type="text" name="s" class="search" placeholder="<?php echo esc_attr( $spyropress_translate['search-placeholder'] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
    <button><i class="fa fa-chevron-right"></i></button>
</form>
                                   