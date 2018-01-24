<?php
/**
 * @package	Things To Do
 * @author	Ray Lawlor
 * @copyright	Copyright (C) Ray Lawlor - Elm House Creative
 * @license	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
$i = 0;
?>
<?php foreach ($items as $item) : ?>
    <?php if (in_array(0, $item->getRelatedCategoryIds())) : ?>
            <tr><?php echo $this->partial('item', compact('item', 'i')); ?></tr>
    <?php endif; ?>
<?php endforeach; ?>

