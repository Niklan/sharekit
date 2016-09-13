<?php

namespace Drupal\sharekit;

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Provides an ShareKit plugin manager.
 */
class ShareKitManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/ShareKit',
      $namespaces,
      $module_handler,
      'Drupal\sharekit\ShareKitPluginInterface',
      'Drupal\sharekit\Annotation\ShareKit'
    );
    // hook_sharekit_info_alter();
    $this->alterInfo('sharekit_info');
    $this->setCacheBackend($cache_backend, 'sharekit');
    $this->factory = new DefaultFactory($this->getDiscovery());
  }

}
