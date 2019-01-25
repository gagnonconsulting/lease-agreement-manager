<?php

/**
 * @package LeaseAgreementManagerPlugin
 */

/*
Plugin Name: Lease Agreement Manager for Essential Real Estate
Plugin URI: http://www.the-computer-guy.com
Description: This is a plugin to enable managing, creating and logging lease agreements while assigning them to users of a specified type
Version: 1.0.0
Author: Aperture Indigo
Author URI: http://www.the-computer-guy.com
License: GPLv2 or later
Text Domain: lease-agreement-manager
 */

defined( 'ABSPATH' ) or die('You do not have permission to view this file.');

class LeaseAgreementPlugin
{
  // Public - Can be accessed everywhere

  // Protected - Can be accessed only within the class itself or extentions of that class

  // Private- Can be accessed only within the class itself

  function __construct() {
    //$this->print_stuff();
  }

  function register() {

  }

  protected function create_post_type() {
    add_action( 'init', array( $this, 'lease_agreements'));
  }

  function activate() {
    // run what needs to be run on activation
    $this->lease_agreements();
    // flush rewrite rules (Make wordpress away the database has changed and needs to be refreshed)
    flush_rewrite_rules();
  }

  function deactivate() {
    // flush rewrite rules
    flush_rewrite_rules();
  }

  function lease_agreements() {
    // Code to be run when LeaseAgreementPlugin is created
    register_post_type( 'lease_agreement', ['public' => true, 'label' => 'Lease Agreements'] );

  }

  function enqueue(){
    // Enqueue all our scripts and styles
    // My Styles - CSS
    wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
    // Bootstrap - CSS
    wp_enqueue_style( 'mypluginbootstrapcss', plugins_url( '/assets/bootstrap.min.css', __FILE__ ) );
    // My Scripts - Javascript
    wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
    // Bootstrap - Javascript
    wp_enqueue_script( 'mypluginbootstrapjs', plugins_url( '/assets/bootstrap.min.js', __FILE__ ) );
  }

  private function print_stuff() {
    echo 'Test.';
  }
}

class SecondClass extends LeaseAgreementPlugin
{
  function register_post_type() {
    $this->create_post_type();
  }

  // private function print_more_stuff() {
  //   echo 'Test.';
  // }
  //
  // function print_it_all() {
  //   $this->print_more_stuff();
  // }

}

if( class_exists('LeaseAgreementPlugin')) {
  $leaseAgreementPlugin = new LeaseAgreementPlugin();
  $leaseAgreementPlugin->register();
}

$secondClass = new SecondClass();
$secondClass->register_post_type();
//$secondClass->print_it_all();

// activation
register_activation_hook( __FILE__, array($leaseAgreementPlugin, 'activate'));

// deactivation
register_deactivation_hook( __FILE__, array($leaseAgreementPlugin, 'deactivate'));

// Include the includes file which has includes for all files in the plugin
include ( plugin_dir_path( __FILE__ ) . 'includes.php');
