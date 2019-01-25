<?php

/**
 * Trigger this file on Plugin install
 *
 * @package LeaseAgreementManagerPlugin
 */

 if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
   die;
 }

// - Clear DB via Wordpress Functions
// -- Grabs all custom posts of type 'lease_agreement'
// $lease_agreements = get_posts( array( 'post_type' => 'lease_agreement', 'numberposts' => -1 ) );

// -- Runs through the array of retrieved posts and deletes each by ID
// foreach($lease_agreements as $lease_agreement) {
//   wp_delete_post( $lease_agreement->ID, true);
// }

// -- Clear DB Via SQL
 global wpdb;
// -- Deletes all of the custom posts of type 'lease_agreement'
 $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'lease_agreement'" );
/*** Deletes all meta by ID NOT IN a query of current post IDs
    (all custom 'lease_agreement' posts have been deleted above)
    Checks and deletes any meta pointing to previously deleted posts */
 $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
 $wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
