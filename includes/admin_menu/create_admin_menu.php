<?php

function add_lease_dashboard_menu(){
// add_menu_page(
// 	'Active Lease Agreements',
// 	 'Lease Agreements',
// 	  'create_users',
// 		 'lease_agreement_info_page',
// 		  'lease_agreement_page_build', // Function that is called to build 'Lease Agreement' Page
// 			 'dashicons-media-text', // Icon that displays next to menu item
// 			  10);
//   add_submenu_page(
// 	 'lease_agreement_info_page',
// 	  'New Lease Agreement',
// 	   'New Lease Agreement',
// 	    'create_users',
// 	     'new_lease_page_build',
//  		    'new_lease_page_build');
//   add_submenu_page(
//    'lease_agreement_info_page',
//     'Expired Lease Agreement',
//      'Expired Lease Agreement',
//       'create_users',
//        'expired_lease_page_build',
//   		    'expired_lease_page_build');
	// add_submenu_page(
	//  'users.php',
	//   'Lessees',
	//    'Lessees',
	//     'create_users',
	//      'role=lessee',
 	// 	    'lessees_page_build');
  global $submenu;
    $url = admin_url() . "/users.php?role=lessee";
    $submenu['users.php'][] = array('Lessees', 'create_users', $url);
}
//$user = wp_get_current_user();
//if ( in_array( 'administrator', (array) $user->roles ) ) {
  add_action('admin_menu', 'add_lease_dashboard_menu');
//}
