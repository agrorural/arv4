<?php //

add_action( 'init', 'create_my_post_types' );
function create_my_post_types() {
	$labels_producto = array(
		'name'               => _x( 'Productos', 'post type general name', 'incl' ),
		'singular_name'      => _x( 'Producto', 'post type singular name', 'incl' ),
		'menu_name'          => _x( 'Productos', 'admin menu', 'incl' ),
		'name_admin_bar'     => _x( 'Producto', 'Agregar Nuevo on admin bar', 'incl' ),
		'add_new'            => _x( 'Agregar Nuevo', 'Producto', 'incl' ),
		'add_new_item'       => __( 'Agregar Nuevo Producto', 'incl' ),
		'new_item'           => __( 'Nuevo Producto', 'incl' ),
		'edit_item'          => __( 'Editar Producto', 'incl' ),
		'view_item'          => __( 'Ver Producto', 'incl' ),
		'all_items'          => __( 'Todos', 'incl' ),
		'search_items'       => __( 'Buscar Productos', 'incl' ),
		'parent_item_colon'  => __( 'Producto Padre:', 'incl' ),
		'not_found'          => __( 'Ningún Producto encontrado.', 'incl' ),
		'not_found_in_trash' => __( 'Ningún Producto encontrado en la Papelera.', 'incl' )
	);

	$args_producto = array(
		'labels'             => $labels_producto,
        'description'        => __( 'Productos de AGRO RURAL.', 'incl' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type' => 'producto',
			'capabilities' => array(
				'publish_posts' => 'publish_productos',
				'edit_posts' => 'edit_productos',
				'edit_others_posts' => 'edit_others_productos',
				'delete_posts' => 'delete_productos',
				'delete_others_posts' => 'delete_others_productos',
				'read_private_posts' => 'read_private_productos',
				'edit_post' => 'edit_producto',
				'delete_post' => 'delete_producto',
				'read_post' => 'read_producto',
			),
		'has_archive'        => true,
		'hierarchical'       => true,
		'rewrite'            => array( 'slug' => 'productos' ),
		'menu_position'      => 10,
		'menu_icon'			 => 'dashicons-cart',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type('producto', $args_producto);
}

add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
	// Agregar Nuevo taxonomy, make it hierarchical (like categories)
	$labels_producto_presentacion = array(
		'name'              => _x( 'Presentaciones', 'taxonomy general name' ),
		'singular_name'     => _x( 'Presentación', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar Presentaciones' ),
		'all_items'         => __( 'Todas las  Presentaciones' ),
		'parent_item'       => __( 'Presentación Padre' ),
		'parent_item_colon' => __( 'Presentación Padre:' ),
		'edit_item'         => __( 'Editar Presentación' ),
		'update_item'       => __( 'Actualizar Presentación' ),
		'add_new_item'      => __( 'Agregar Nueva Presentación' ),
		'new_item_name'     => __( 'Nombre de Nueva Presentación' ),
		'menu_name'         => __( 'Presentaciones' ),
	);

	$args_producto_presentacion = array(
		'public' 			=> true,
		'hierarchical'      => true,
		'labels'            => $labels_producto_presentacion,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'presentacion', 'producto', $args_producto_presentacion );
}