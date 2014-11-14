<?php

// Retorna o Custom Field
function slider_get_field( $value ) {
	global $post;

    $custom_field = get_post_meta( $post->ID, $value, true );
    if ( !empty( $custom_field ) )
	    return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

    return false;
}

// Registra o metabox
function metabox_add_custom_meta_box() {
	add_meta_box( 'slider-meta-box', __( 'Link', 'textdomain' ), 'metabox_output', 'sliders', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'metabox_add_custom_meta_box' );

// Formulario do Metabox
function metabox_output( $post ) {
	// create a nonce field
	wp_nonce_field( 'my_metabox_nonce', 'metabox_nonce' ); ?>
	
	<p>
		<label for="slider_link"><?php _e( 'http://', 'textdomain' ); ?>:</label>
		<input type="text" name="slider_link" id="slider_link" value="<?php echo slider_get_field( 'slider_link' ); ?>" size="50" />
    </p>
    
	<?php
}

// Salva os valores
function metabox_save( $post_id ) {
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	if( !isset( $_POST['metabox_nonce'] ) || !wp_verify_nonce( $_POST['metabox_nonce'], 'my_metabox_nonce' ) ) return;

	if( !current_user_can( 'edit_post' ) ) return;

	if( isset( $_POST['slider_link'] ) )
		update_post_meta( $post_id, 'slider_link', esc_attr( $_POST['slider_link'] ) );
}
add_action( 'save_post', 'metabox_save' );
