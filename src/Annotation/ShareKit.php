<?php

namespace Drupal\sharekit\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Annotations for ShareKit plugins.
 *
 * @Annotation
 */
class ShareKit extends Plugin {

  /**
   * The plugin ID. In most cases just social network name.
   */
  public $id;

  /**
   * Marks, this social network is allow to count share link count or not.
   * If so, the special method will be called.
   */
  public $is_countable;

}
