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