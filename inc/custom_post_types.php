<?php
// Register Custom Post Type
function register_custom_post_types() {
	/**
     * Post Type: Galeria
     */
    $labels = array(
        'name'                => __( 'Galeria', 'codix' ),
        'singular_name'       => __( 'Galeria', 'codix' ),
        'all_items'           => __( 'Toda a Galeria', 'codix' ),
        'add_new'             => __( 'Adicionar Nova Galeria', 'codix' ),
        'add_new_item'        => __( 'Adicionar Nova Galeria', 'codix' ),
    );
    $rewrite = array(
        'slug'                => 'galeria',
        'with_front'          => true
    );
    $args = array(
        'label'               => __( 'Galeria', 'codix' ),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_rest'        => false,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post',
        'menu_position'       => 5,
        'map_meta_cap'        => true,
        'hierarchical'        => false,
        'rewrite'             => $rewrite,
        'query_var'           => true,
        'menu_icon'           => 'dashicons-image-filter',
        'supports'            => array( 'title', 'editor','thumbnail' ),
    );
    register_post_type( 'galeria', $args );

    // flush_rewrite_rules();

    /**
     * Post Type: Documentação
     */
    $labels = array(
        'name' => _x('Documentações', 'nome do post no geral', 'codix'),
        'singular_name' => _x('Documentação', 'nome do post no singular', 'codix'),
        'menu_name' => _x('Documentação', 'nome do post no menu', 'codix'),
        'add_new' => __('Adicionar nova', 'codix'),
        'add_new_item' => __('Adicionar nova documentação', 'codix'),
        'new_item' => __('Nova documentação', 'codix'),
        'edit_item' => __('Editar documentação', 'codix'),
        'view_item' => __('Ver documentação', 'codix'),
        'all_items' => __('Documentações', 'codix')
    );
    $rewrite = array(
        'slug'                => 'docs'
    );
    $args = array(
        'label'               => __( 'Documentação', 'codix' ),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_rest'        => true,
        'exclude_from_search' => true,
        'capatibility_type'     => 'post',
        'menu_position'       => 6,
        'hierarchical'        => false,
        'rewrite'             => $rewrite,
        'query_var'           => true,
        'menu_icon'           => 'dashicons-info',
        'supports'            => array( 'title', 'editor','thumbnail', 'excerpt' ),
        'has_archive'           => true
    );
    register_post_type( 'docs', $args );

    // flush_rewrite_rules();
}
add_action( 'init', 'register_custom_post_types' );