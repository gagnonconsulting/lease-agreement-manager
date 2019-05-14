<?php

/**
 * @package LeaseAgreementManagerPlugin
 */

 class LeaseAgreementManagerPluginActivate
 {
   public static function activate(){
     // Adds a new user role of type lessee with only read permissions
     add_role(
         'lessee',
         __( 'Lessee' ),
         array(
             'read'                     => true,  // true allows this capability
             'edit_posts'               => false,
             'delete_published_posts'   => false,
             'publish_posts'            => false,
             'upload_files'             => false,
             'edit_published_posts'     => false,
             'edit_users'               => false
         )
     );

     remove_role('ere_customer');
     remove_role('es_buyer');
     remove_role('wpc_admin');
     remove_role('wpc_manager');
     remove_role('wpc_client_staff');
     remove_role('wpc_client');

     flush_rewrite_rules();

   }
 }
