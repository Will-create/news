<?php
/**
 * Remember user preference to hide auto column switch notification
 */
function graphene_hide_auto_column_switch_alert(){
	if ( current_user_can( 'edit_post' ) ) {
		$user_id = get_current_user_id();
		if ( $user_id ) {
			update_user_meta( $user_id, 'graphene_hide_auto_column_switch_alert', true );
			echo 0;
		}
	}
	
	die();
}
add_action( 'wp_ajax_graphene-hide-auto-column-switch-alert', 'graphene_hide_auto_column_switch_alert' );