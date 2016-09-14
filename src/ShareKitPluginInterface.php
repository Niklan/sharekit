<?php

namespace Drupal\sharekit;

use Drupal\Component\Plugin\PluginInspectionInterface;

interface ShareKitPluginInterface extends PluginInspectionInterface {

  /**
   * {@inheritdoc}
   */
  public function getName();

  /**
   * {@inheritdoc}
   *
   * @var boolean
   */
  public function isCountable();

}