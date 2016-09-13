<?php

namespace Drupal\sharekit\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Annotations for ShareKit plugins.
 *
 * @Annotation
 */
class ReusableForm extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

}