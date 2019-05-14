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

      <!-- <tr>
          <tr>
            <th><label for="lessee_lease_agreement"><?php //esc_html_e( 'Lease Agreement', 'crf' ); ?></label></th>
            <td name="lessee_lease_agreement">Lease Agreement</td>
          </tr>
          <tr>
            <th><label for="lessee_property_unit"><?php //esc_html_e( 'Property Location & Unit', 'crf' ); ?></label></th>
    			  <td name="lessee_property_unit">Property Location Unit</td>
          </tr>
  		</tr> -->
  	</table>
  	<?php
  }
}
