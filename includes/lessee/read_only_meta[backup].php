<?php

add_action( 'show_user_profile', 'crf_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'crf_show_extra_profile_fields' );

function crf_show_extra_profile_fields( $user ) {
  if(in_array('lessee', $user->roles)){

    ?>
  	<h3><?php esc_html_e( 'Lessee Information', 'crf' ); ?></h3>

  	<table class="form-table">
        <?php
        $post_id = 'user_' . (string)$user->ID;
        $value = get_field( 'lessee_property_location_unit', $post_id );
        ?>

      <tr>
        <?php
        $value2 = get_field( 'lessee_lease_agreement', $post_id );
        $current_lessee_id_for_lease = null;
        $lease_agreement_id = null;
        if($value2 != null){
        $lease_agreement_id = $value2->ID;
        }
        $lease_agreement_lessee = get_field( 'lease_agreement_lessee', $lease_agreement_id );
        if($lease_agreement_lessee != null){
          $current_lessee_id_for_lease = $lease_agreement_lessee['ID'];
        }
        if($current_lessee_id_for_lease != $user->ID){?>
          <tr>
            <th><label for="lessee_lease_agreement"><?php esc_html_e( 'Lease Agreement', 'crf' ); ?></label></th>
            <td name="lessee_lease_agreement">N/A</td>
          </tr>
          <tr>
            <th><label for="lessee_property_unit"><?php esc_html_e( 'Property Location & Unit', 'crf' ); ?></label></th>
    			  <td name="lessee_property_unit">N/A</td>
          </tr><?php
        }

        elseif($current_lessee_id_for_lease == $user->ID){
          // Reset the users
          update_field($selector, $value, $post_id);
          ?>
          <tr>
            <th><label for="lessee_lease_agreement"><?php esc_html_e( 'Lease Agreement', 'crf' ); ?></label></th>
    			  <td name="lessee_lease_agreement"><?php echo $value2->post_title; ?></td>
          </tr>
          <tr>
            <th><label for="lessee_property_unit"><?php esc_html_e( 'Property Location & Unit', 'crf' ); ?></label></th>
    			  <td name="lessee_property_unit"><?php echo $value->post_title; ?></td>
          </tr><?php
        }

        else {?>
          <th><label for="lessee_lease_agreement"><?php esc_html_e( 'Lease Agreement', 'crf' ); ?></label></th>
          <td name="lessee_lease_agreement">User is not linked to any active Leases</td><?php
        }
        ?>

  		</tr>
  	</table>
  	<?php
  }
}
