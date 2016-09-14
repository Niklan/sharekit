<?php

namespace Drupal\sharekit\Plugin\ShareKit;
use Drupal\sharekit\Annotation\ShareKit;

/**
 * ShareKit plugin for Facebook.
 *
 * @ShareKit(
 *   id="facebook",
 * )
 */
class Facebook extends ShareKitPluginBase {

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return 'facebook';
  }

  /**
   * {@inheritdoc}
   */
  public function isCountable() {
    return TRUE;
  }

}