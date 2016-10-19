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

	$labels_banner = array(
		'name'               => _x( 'Banners', 'post type general name', 'incl' ),
		'singular_name'      => _x( 'Banner', 'post type singular name', 'incl' ),
		'menu_name'          => _x( 'Banners', 'admin menu', 'incl' ),
		'name_admin_bar'     => _x( 'Banner', 'Agregar Nuevo on admin bar', 'incl' ),
		'add_new'            => _x( 'Agregar Nuevo', 'Banner', 'incl' ),
		'add_new_item'       => __( 'Agregar Nuevo Banner', 'incl' ),
		'new_item'           => __( 'Nuevo Banner', 'incl' ),
		'edit_item'          => __( 'Editar Banner', 'incl' ),
		'view_item'          => __( 'Ver Banner', 'incl' ),
		'all_items'          => __( 'Todos', 'incl' ),
		'search_items'       => __( 'Buscar Banners', 'incl' ),
		'parent_item_colon'  => __( 'Banner Padre:', 'incl' ),
		'not_found'          => __( 'Ningún Banner encontrado.', 'incl' ),
		'not_found_in_trash' => __( 'Ningún Banner encontrado en la Papelera.', 'incl' )
	);
 
	$args_banner = array(
		'labels'             => $labels_banner,
        'description'        => __( 'Banners de AGRO RURAL.', 'incl' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type' => 'banner',
			'capabilities' => array(
				'publish_posts' => 'publish_banners',
				'edit_posts' => 'edit_banners',
				'edit_others_posts' => 'edit_others_banners',
				'delete_posts' => 'delete_banners',
				'delete_others_posts' => 'delete_others_banners',
				'read_private_posts' => 'read_private_banners',
				'edit_post' => 'edit_banner',
				'delete_post' => 'delete_banner',
				'read_post' => 'read_banner',
			),
		'has_archive'        => true,
		'hierarchical'       => true,
		'rewrite'            => array( 'slug' => 'banners' ),
		'menu_position'      => 10,
		'menu_icon'			 => 'dashicons-image-flip-horizontal',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
	);

	register_post_type('producto', $args_producto);
	register_post_type('banners', $args_banner);
}

add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
	// Agregar Nuevo taxonomy, make it hierarchical (like categories)
	$labels_producto_productor = array(
		'name'              => _x( 'Productores', 'taxonomy general name' ),
		'singular_name'     => _x( 'Productor', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar productores' ),
		'all_items'         => __( 'Todos los  productores' ),
		'parent_item'       => __( 'Productor Padre' ),
		'parent_item_colon' => __( 'Productor Padre:' ),
		'edit_item'         => __( 'Editar productor' ),
		'update_item'       => __( 'Actualizar productor' ),
		'add_new_item'      => __( 'Agregar Nuevo productor' ),
		'new_item_name'     => __( 'Nombre de Nuevo productor' ),
		'menu_name'         => __( 'Productores' )
	);

	$args_producto_productor = array(
		'public' 			=> true,
		'hierarchical'      => false,
		'labels'            => $labels_producto_productor,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'capabilities'		=> array(
			'manage_terms' => 'manage_productor',
			'edit_terms' => 'edit_productor',
			'delete_terms' => 'delete_productor',
			'assign_terms' => 'assign_productor'
		)
	);

	$labels_producto_marca = array(
		'name'              => _x( 'Marcas', 'taxonomy general name' ),
		'singular_name'     => _x( 'Marca', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar Marcas' ),
		'all_items'         => __( 'Todos las  Marcas' ),
		'parent_item'       => __( 'Marca Padre' ),
		'parent_item_colon' => __( 'Marca Padre:' ),
		'edit_item'         => __( 'Editar Marca' ),
		'update_item'       => __( 'Actualizar Marca' ),
		'add_new_item'      => __( 'Agregar Nueva Marca' ),
		'new_item_name'     => __( 'Nombre de Nueva Marca' ),
		'menu_name'         => __( 'Marcas' )
	);

	$args_producto_marca = array(
		'public' 			=> true,
		'hierarchical'      => false,
		'labels'            => $labels_producto_marca,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'capabilities'		=> array(
			'manage_terms' => 'manage_marca',
			'edit_terms' => 'edit_marca',
			'delete_terms' => 'delete_marca',
			'assign_terms' => 'assign_marca'
		)
	);

	$labels_producto_lugar = array(
		'name'              => _x( 'Lugares', 'taxonomy general name' ),
		'singular_name'     => _x( 'Lugar', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar Lugares' ),
		'all_items'         => __( 'Todos los  Lugares' ),
		'parent_item'       => __( 'Lugar Padre' ),
		'parent_item_colon' => __( 'Lugar Padre:' ),
		'edit_item'         => __( 'Editar Lugar' ),
		'update_item'       => __( 'Actualizar Lugar' ),
		'add_new_item'      => __( 'Agregar Nuevo Lugar' ),
		'new_item_name'     => __( 'Nombre de Nuevo Lugar' ),
		'menu_name'         => __( 'Lugares' )
	);

	$args_producto_lugar = array(
		'public' 			=> true,
		'hierarchical'      => true,
		'labels'            => $labels_producto_lugar,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'capabilities'		=> array(
			'manage_terms' => 'manage_lugar',
			'edit_terms' => 'edit_lugar',
			'delete_terms' => 'delete_lugar',
			'assign_terms' => 'assign_lugar'
		)
	);

	$labels_producto_clasificacion = array(
		'name'              => _x( 'Clasificaciones', 'taxonomy general name' ),
		'singular_name'     => _x( 'Clasificación', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar Clasificaciones' ),
		'all_items'         => __( 'Todos las Clasificaciones' ),
		'parent_item'       => __( 'Clasificación Padre' ),
		'parent_item_colon' => __( 'Clasificación Padre:' ),
		'edit_item'         => __( 'Editar Clasificación' ),
		'update_item'       => __( 'Actualizar Clasificación' ),
		'add_new_item'      => __( 'Agregar Nueva Clasificación' ),
		'new_item_name'     => __( 'Nombre de Nueva Clasificación' ),
		'menu_name'         => __( 'Clasificaciones' )
	);

	$args_producto_clasificacion = array(
		'public' 			=> true,
		'hierarchical'      => true,
		'labels'            => $labels_producto_clasificacion,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'capabilities'		=> array(
			'manage_terms' => 'manage_clasificacion',
			'edit_terms' => 'edit_clasificacion',
			'delete_terms' => 'delete_clasificacion',
			'assign_terms' => 'assign_clasificacion'
		)
	);

	$labels_banner_posicion = array(
		'name'              => _x( 'Posiciones', 'taxonomy general name' ),
		'singular_name'     => _x( 'Posición', 'taxonomy singular name' ),
		'search_items'      => __( 'Buscar Posiciones' ),
		'all_items'         => __( 'Todas las  Posiciones' ),
		'parent_item'       => __( 'Posición Padre' ),
		'parent_item_colon' => __( 'Posición Padre:' ),
		'edit_item'         => __( 'Editar posición' ),
		'update_item'       => __( 'Actualizar posición' ),
		'add_new_item'      => __( 'Agregar Nueva posición' ),
		'new_item_name'     => __( 'Nombre de Nueva posición' ),
		'menu_name'         => __( 'Posiciones' )
	);

	$args_banner_posicion = array(
		'public' 			=> true,
		'hierarchical'      => false,
		'labels'            => $labels_banner_posicion,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'capabilities'		=> array(
			'manage_terms' => 'manage_posicion',
			'edit_terms' => 'edit_posicion',
			'delete_terms' => 'delete_posicion',
			'assign_terms' => 'assign_posicion'
		)
	);

	register_taxonomy( 'productor', 'producto', $args_producto_productor );
	register_taxonomy( 'marca', 'producto', $args_producto_marca );
	register_taxonomy( 'lugar', 'producto', $args_producto_lugar );
	register_taxonomy( 'clasificacion', 'producto', $args_producto_clasificacion );
	register_taxonomy( 'posiciones', 'banner', $args_banner_posicion );
}