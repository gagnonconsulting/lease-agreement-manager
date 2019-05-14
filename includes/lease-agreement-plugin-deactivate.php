<?php

/**
 * @package LeaseAgreementManagerPlugin
 */

 class LeaseAgreementManagerPluginDeactivate
 {
   public static function deactivate(){
     remove_role('lessee');

     flush_rewrite_rules();
   }
 }
