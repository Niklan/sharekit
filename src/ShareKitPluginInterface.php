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
   */
  public function isCountable();

  /**
   * {@inheritdoc}
   */
  public function getShareUrl();

}