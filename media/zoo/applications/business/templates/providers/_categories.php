<?php

/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

// remove empty categories
$selected_categories = $this->selected_categories;
if (!$this->params->get('config.show_empty_categories', false))
    {
    $selected_categories = array_filter($selected_categories, create_function('$category', 'return $category->totalItemCount();'));
    }

foreach ($selected_categories as $category) :
    ?>

    <?php echo $this->partial('category', compact('category')); ?>

<?php endforeach; ?>

