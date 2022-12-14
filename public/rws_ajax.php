<?php

function rws_form_save() {
    if(isset($_POST['rws_name']) or isset($_POST['rws_description'])) {
        $post_id = wp_insert_post( [
            'post_type'    => 'rws_reviews',
            'post_status'  => 'publish',
            'post_title'   => wp_strip_all_tags( $_POST['rws_title'] ),
            'post_content' => wp_strip_all_tags( $_POST['rws_description'] ),
            'meta_input'  => [
                'rws_name' => wp_strip_all_tags( $_POST['rws_name'] ),
                'social_links' => wp_strip_all_tags( $_POST['rws_social_link'] ),
            ],
        ] );
        
        if( is_wp_error( $post_id ) ){
            wp_send_json_error( [ 'message' => $post_id->get_error_message() ], 401 );
        }
    }
}

add_action( 'init', 'rws_form_save' );

?>