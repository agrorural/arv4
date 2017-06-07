<?php

add_filter( 'map_meta_cap', 'producto_meta_cap', 10, 4 );

function producto_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a producto, get the post and post type object. */
	if ( 'edit_producto' == $cap || 'delete_producto' == $cap || 'read_producto' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a producto, assign the required capability. */
	if ( 'edit_producto' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a producto, assign the required capability. */
	elseif ( 'delete_producto' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private producto, assign the required capability. */
	elseif ( 'read_producto' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'banner_meta_cap', 10, 4 );

function banner_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a banner, get the post and post type object. */
	if ( 'edit_banner' == $cap || 'delete_banner' == $cap || 'read_banner' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a banner, assign the required capability. */
	if ( 'edit_banner' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a banner, assign the required capability. */
	elseif ( 'delete_banner' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private banner, assign the required capability. */
	elseif ( 'read_banner' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'documento_meta_cap', 10, 4 );

function documento_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a documento, get the post and post type object. */
	if ( 'edit_documento' == $cap || 'delete_documento' == $cap || 'read_documento' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a documento, assign the required capability. */
	if ( 'edit_documento' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a documento, assign the required capability. */
	elseif ( 'delete_documento' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private documento, assign the required capability. */
	elseif ( 'read_documento' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'convocatoria_meta_cap', 10, 4 );

function convocatoria_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a convocatoria, get the post and post type object. */
	if ( 'edit_convocatoria' == $cap || 'delete_convocatoria' == $cap || 'read_convocatoria' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a convocatoria, assign the required capability. */
	if ( 'edit_convocatoria' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a convocatoria, assign the required capability. */
	elseif ( 'delete_convocatoria' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private convocatoria, assign the required capability. */
	elseif ( 'read_convocatoria' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'servicio_meta_cap', 10, 4 );

function servicio_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a servicio, get the post and post type object. */
	if ( 'edit_servicio' == $cap || 'delete_servicio' == $cap || 'read_servicio' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a servicio, assign the required capability. */
	if ( 'edit_servicio' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a servicio, assign the required capability. */
	elseif ( 'delete_servicio' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private servicio, assign the required capability. */
	elseif ( 'read_servicio' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

add_filter( 'map_meta_cap', 'directorio_meta_cap', 10, 4 );

function directorio_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a directorio, get the post and post type object. */
	if ( 'edit_directorio' == $cap || 'delete_directorio' == $cap || 'read_directorio' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a directorio, assign the required capability. */
	if ( 'edit_directorio' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a directorio, assign the required capability. */
	elseif ( 'delete_directorio' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private directorio, assign the required capability. */
	elseif ( 'read_directorio' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}
