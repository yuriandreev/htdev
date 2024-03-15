<?php
add_action('after_setup_theme', 'registerMenu');
function registerMenu(){
    register_nav_menu( 'primary', 'Primary Menu' );
}

class My_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "";
    }
    function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        global $wp_query;
        $item = $data_object;
        $output .= "";
        $attributes = !empty( $item->url ) ? ' href="' . esc_attr($item->url) .'"' : '';
        $item_output = sprintf( '<a%1$s>%2$s</a>',
            $attributes, apply_filters( 'the_title',
                $item->title, $item->ID
            ));
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output);
    }

}

function my_nav_menu( $args ) {

    $args = array_merge( [
        'container'       => 'div',
        'container_class' => 'menu',
        'echo'            => false,
        'items_wrap'      => '%3$s',
        'depth'           => 10,
        'walker'          => new My_Walker_Nav_Menu()
    ], $args );

    echo wp_nav_menu( $args );
}
