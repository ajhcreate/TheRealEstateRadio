<?php
/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<h2><?php if ($title) echo $title.' '.JText::_('Files'); ?></h2>
<?php if ($subtitle) : ?>
<p class="uk-text-large"><?php echo $subtitle; ?></p>
<?php endif; ?>

<?php

	// init vars
	$i = 0;
	$columns = $this->params->get('template.items_cols', 2);

	// render rows
	foreach ($this->items as $item) {
		if ($i % $columns == 0) echo ($i > 0 ? '</div><div class="uk-grid" uk-grid uk-match-height>' : '<div class="uk-grid" uk-grid uk-match-height>');
		echo '<div class="uk-width-1-'.$columns.'@m">'.$this->partial('item', compact('item')).'</div>';
		$i++;
	}
	if (!empty($this->items)) {
		echo '</div>';
	}

?>

<?php echo $this->partial('pagination'); ?>
