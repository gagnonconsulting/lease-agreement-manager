<?php

// Add to admin_init function
add_filter('manage_edit-lease_agreement_columns', 'add_new_lease_agreement_columns');

function add_new_lease_agreement_columns($lease_agreement_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';

    $new_columns['title'] = _x('Lease Agreement', 'column name');
    $new_columns['status'] = __('Status');

    $new_columns['start_date'] = __('Start Date');
    $new_columns['end_date'] = __('End Date');

    $new_columns['date'] = _x('Publish Date', 'column name');
    $new_columns['author'] = __('Author');
    $new_columns['id'] = __('ID');

    return $new_columns;
}

add_action('manage_lease_agreement_posts_custom_column', 'manage_lease_agreement_columns', 10, 2);

function manage_lease_agreement_columns($column_name, $id) {
  global $wpdb;
  switch ($column_name) {
    case 'id':
      echo $id;
        break;
  } // end switch
  switch ($column_name) {
   case 'start_date':
    if ( 'start_date' === $column_name ) {
      $start_date = get_post_meta( $id, '_lease_agreement_start_date_value_key', true );
      if ( ! $start_date ) {
        _e( 'n/a' );
      }
      else {
        $newDateStart = date("m/d/Y", strtotime($start_date));
        echo $newDateStart;
      }
    }
  }
  switch ($column_name) {
   case 'end_date':
    if ( 'end_date' === $column_name ) {
      $end_date = get_post_meta( $id, '_lease_agreement_end_date_value_key', true );
      if ( ! $end_date ) {
        _e( 'n/a' );
      }
      else {
        $newDateEnd = date("m/d/Y", strtotime($end_date));
        echo $newDateEnd;
      }
    }
  }
}

add_action( 'add_meta_boxes', 'lease_agreement_start_date_add_meta_box' );
add_action( 'save_post', 'lease_agreement_save_start_date_data' );

add_action( 'add_meta_boxes', 'lease_agreement_end_date_add_meta_box' );
add_action( 'save_post', 'lease_agreement_save_end_date_data' );

/* Lease Agreement Meta Box */
function lease_agreement_start_date_add_meta_box() {
  add_meta_box( 'lease_agreement_start_date', 'Start Date', 'lease_agreement_start_date_callback', 'lease_agreement', 'side', 'default');
}

function lease_agreement_start_date_callback( $post ) {
  wp_nonce_field( 'lease_agreement_save_start_date_data', 'lease_agreement_start_date_meta_box_nonce' );

  $value = get_post_meta( $post->ID, '_lease_agreement_start_date_value_key', true );

  echo '<label for="lease_agreement_start_date_field">Lease Agreement Start Date: </label><br>';
  echo '<input type="date" id="lease_agreement_start_date_field" name="lease_agreement_start_date_field" value="' . esc_attr( $value ) . '" size="25" />';
}

function lease_agreement_save_start_date_data( $post_id ) {
  // Check of the custom nonce is set
  if( ! isset( $_POST['lease_agreement_start_date_meta_box_nonce'] ) ){
    return;
  }

  if( ! wp_verify_nonce( $_POST['lease_agreement_start_date_meta_box_nonce'], 'lease_agreement_save_start_date_data' ) ) {
    return;
  }

  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  if( ! current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  if( ! isset( $_POST['lease_agreement_start_date_field']) ){
    return;
  }

  $my_data = $_POST['lease_agreement_start_date_field'];
  update_post_meta( $post_id, '_lease_agreement_start_date_value_key', $my_data );
}

function lease_agreement_end_date_add_meta_box() {
  add_meta_box( 'lease_agreement_end_date', 'End Date', 'lease_agreement_end_date_callback', 'lease_agreement', 'side', 'default');
}

function lease_agreement_end_date_callback( $post ) {
  wp_nonce_field( 'lease_agreement_save_end_date_data', 'lease_agreement_end_date_meta_box_nonce' );

  $value = get_post_meta( $post->ID, '_lease_agreement_end_date_value_key', true );

  $lease_agreement_start_date = get_post_meta( $post->ID, '_lease_agreement_start_date_value_key', true );
  echo '<label for="lease_agreement_end_date_field">Lease Agreement End Date: </label><br>';
  echo '<input type="date" min="' . $lease_agreement_start_date . '" id="lease_agreement_end_date_field" name="lease_agreement_end_date_field" value="' . esc_attr( $value ) . '" size="25" />';
}

function lease_agreement_save_end_date_data( $post_id ) {
  // Check of the custom nonce is set
  if( ! isset( $_POST['lease_agreement_end_date_meta_box_nonce'] ) ){
    return;
  }

  if( ! wp_verify_nonce( $_POST['lease_agreement_end_date_meta_box_nonce'], 'lease_agreement_save_end_date_data' ) ) {
    return;
  }

  if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  if( ! current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  if( ! isset( $_POST['lease_agreement_end_date_field']) ){
    return;
  }

  $my_data = $_POST['lease_agreement_end_date_field'];
  update_post_meta( $post_id, '_lease_agreement_end_date_value_key', $my_data );
}
