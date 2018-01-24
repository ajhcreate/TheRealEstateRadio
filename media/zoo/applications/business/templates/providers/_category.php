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



<table class="uk-table uk-table-hover uk-table-striped">
    <thead>
        <tr>
            <th style=" background-color: #062956!important;
            color: #fff;font-weight: bold;font-size: 18px;" colspan="2"><?php echo $category->name; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $items = $category->getItems(true, NULL, $this->params->get('config.item_order')); ?>
        <?php echo $this->partial('categoryitems', array('items' => $items)); ?>
    </tbody>
</table>