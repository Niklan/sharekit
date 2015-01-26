<?php
/**
 * @file
 * This is basic template for all share buttons.
 *
 * Variables:
 * - $network
 * - $share_url
 * - $label
 * - $popup_width
 * - $popup_height
 */
?>
<button data-share-url="<?php print $share_url; ?>" data-popup-width="<?php print $popup_width; ?>" data-popup-height="<?php print $popup_height; ?>">
  <?php print $label; ?>
</button>