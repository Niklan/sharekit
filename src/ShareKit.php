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
   * Renderable array of loaded shares.
   */
  private $_loadedShares;

  /**
   * Style of share buttons.
   */
  private $_style;

  /**
   * ShareKit constructor.
   */
  public function __construct() {
    $this->_pluginDefinitions = \Drupal::service('plugin.manager.sharekit')->getDefinitions();
    $this->_style = NULL;
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

  /**
   * Name of style. Will be used in template suggestions. You can use it
   * for different share button styles render. Use only letters and numbers.
   *
   * @param $style_name string
   */
  public function setStyle($style_name) {
    $this->_style = $style_name;
  }

  /**
   * Load social network button (single).
   *
   * @param $social_network string
   * @return string
   */
  public function shareLoad($social_network) {
    return $this->shareLoadMultiple([$social_network]);
  }

  /**
   * Load multiple social share buttons.
   *
   * @param $social_networks array
   * @return string
   */
  public function shareLoadMultiple($social_networks) {
    $theme_suggestions = [];
    if ($this->_style) {
      $theme_suggestions[] = 'sharekit__' . $this->_style;
    }
    $theme_suggestions[] = 'sharekit';
    $this->_loadedShares = [
      '#theme' => $theme_suggestions,
      '#items' => [],
    ];

    foreach ($social_networks as $k => $network) {
      $instance = \Drupal::service('plugin.manager.sharekit')->createInstance($network, []);
    }
    return $this->_loadedShares;
  }

  /**
   * Render share buttons.
   *
   * @return mixed|null
   */
  public function render() {
    ksm($this->_loadedShares);
    return render($this->_loadedShares);
  }

}