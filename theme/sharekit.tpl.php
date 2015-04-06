<?php
/**
 * @file
 * This is basic template for all share buttons.
 *
 * Variables:
 * - $network
 * - $share_url
 * - $share_title
 * - $label
 * - $popup_width
 * - $popup_height
 * - $attributes: print default attributes. If you don't want to print them,
 *                you must add them manually.
 * - $classes
 * - $share_count
 * - $clickable: mark element as clickable. This means, click on this element
 *               call popup with share.
 *
 * Template suggestions:
 * - sharekit--NETWORK--STYLE.tpl.php
 * - sharekit--STYLE.tpl.php
 * - sharekit--NETWORK.tpl.php
 * - sharekit.tpl.php
 *
 * For example. Button called buy sharekit_get('facebook', 'flat) can be
 * themed by templates:
 * - sharekit--facebook--flat.tpl.php
 * - sharekit--flat.tpl.php
 * - sharekit--facebook.tpl.php
 * - sharekit.tpl.php
 */
?>
<div class="<?php print $classes; ?>" <?php print $attributes; ?> <?php print $clickable; ?>>
  <span class="share-label"><?php print $label; ?></span>
  <span class="share-count"><?php print $share_count; ?></span>
</div>
