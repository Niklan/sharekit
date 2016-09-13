<?php

namespace Drupal\sharekit;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;

interface ShareKitPluginInterface extends PluginInspectionInterface, ContainerFactoryPluginInterface {

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