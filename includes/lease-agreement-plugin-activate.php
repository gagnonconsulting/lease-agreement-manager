<?php

/**
 * @package LeaseAgreementManagerPlugin
 */

 class LeaseAgreementManagerPluginActivate
 {
   public static function activate(){
     flush_rewrite_rules();
   }
 }
