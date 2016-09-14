<?php

/**
 * @file
 * Main class for working with all social networks.
 * This class use Plugin system, so you can easly add missing social networks
 * by implementing your ShareKit plugin, or redefine available.
 */
namespace Drupal\sharekit;

class ShareKit {

  /**
   * List of available ShareKit plugins.
   */
  private $_pluginDefinitions;

  /**
   * ShareKit constructor.
   */
  public function __construct() {
    $this->_pluginDefinitions = \Drupal::service('plugin.manager.sharekit')->getDefinitions();
  }

  /**
   * List of available networks to share defined by ShareKit plugins.
   */
  public function getAvailableNetworks() {
    $networks = [];
    foreach ($this->_pluginDefinitions as $plugin_id => $plugin) {
      $networks[] = $plugin_id;
    }
    return $networks;
  }

  // $instance = \Drupal::service('plugin.manager.sharekit')->createInstance($plugin_id, []);
  //ksm($instance);

}