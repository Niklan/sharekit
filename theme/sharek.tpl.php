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
 *
 * Template suggestions:
 * - sharek--NETWORK--STYLE.tpl.php
 * - sharek--STYLE.tpl.php
 * - sharek--NETWORK.tpl.php
 * - sharek.tpl.php
 *
 * For example. Button called buy sharek_get_ubtton('facebook', 'flat) can be
 * themed by templates:
 * - sharek--facebook--flat.tpl.php
 * - sharek--flat.tpl.php
 * - sharek--facebook.tpl.php
 * - sharek.tpl.php
 */
?>
<div class="<?php print $classes; ?>" <?php print $attributes; ?>>
  <span class="share-label"><?php print $label; ?></span>
  <span class="share-count"><?php print $share_count; ?></span>
</div>
