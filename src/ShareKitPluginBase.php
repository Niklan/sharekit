<?php

namespace Drupal\sharekit;

use Drupal\Component\Plugin\PluginBase;

abstract class ShareKitPluginBase extends PluginBase implements ShareKitPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function isCountable() {
    return $this->pluginDefinition['is_countable'];
  }

  /**
   * {@inheritdoc}
   */
  public function getShareUrl() {
    // TODO: Implement getShareUrl() method.
  }

}