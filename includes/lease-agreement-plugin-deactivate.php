<?php

/**
 * @package LeaseAgreementManagerPlugin
 */

 class LeaseAgreementManagerPluginDeactivate
 {
   public static function deactivate(){
     flush_rewrite_rules();
   }
 }
