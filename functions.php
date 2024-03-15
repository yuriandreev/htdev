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


add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
    register_taxonomy( 'mytaxonomy', [ 'my_post_type' ], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Таксономии',
            'singular_name'     => 'Таксономия',
            'search_items'      => 'Поиск таксономий',
            'all_items'         => 'Все таксономии',
            'view_item '        => 'Посмотреть таксономию',
            'parent_item'       => 'Родительская таксономия',
            'parent_item_colon' => 'Родительская таксономия:',
            'edit_item'         => 'Редакировать таксономию',
            'update_item'       => 'Обновить таксономию',
            'add_new_item'      => 'Добавить таксономию',
            'new_item_name'     => 'Новая таксономия',
            'menu_name'         => 'Таксономии',
            'back_to_items'     => '← Перейти к таксономиям',
        ],
    ] );
}
add_action( 'init', 'register_post_types' );

function register_post_types(){
    register_post_type( 'my_post_type', [
        'label'  => null,
        'labels' => [
            'name'               => 'Кастомные типы',
            'singular_name'      => 'Кастомный тип',
            'add_new'            => 'Добавить кастомный тип',
            'add_new_item'       => 'Добавление кастомного типа',
            'edit_item'          => 'Редактирование кастомного типа',
            'new_item'           => 'Новый кастомный тип',
            'view_item'          => 'Смотреть кастомного тип',
            'search_items'       => 'Искать кастомного тип',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
        ],
        'public'                 => true,
        'show_in_menu'           => true,
        'menu_position'       => 1,
        'menu_icon'           => 'dashicons-admin-customizer',
        'supports'            => [ 'title', 'editor' ],
        'taxonomies'          => ['mytaxonomy'],
    ] );
}
