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

<td class="uk-width-3-4">
    <a href="<?php echo $this->app->route->item($this->_item); ?>"><?php echo $this->_item->name; ?></a>
</td>

<td class="uk-width-1-4">
    <?php if ($this->checkPosition('provider')) : ?>
        <?php echo $this->renderPosition('provider'); ?>
    <?php endif; ?>
</td>
