<?php

/**
 * @package   com_zoo
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();

$doc->addStylesheet('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/css/uikit.min.css');
$doc->addScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.4/js/uikit.min.js');
?>

<style>
    .uk-panel-box {
        padding: 15px!important;

        .uk-table thead th {
            background-color: #062956!important;
            color: #fff;
        }
    }


</style>


<?php echo $this->application->getText($this->application->description); ?>
<?php

// render categories
$has_categories = false;
if ($this->params->get('template.show_categories', true) && ($this->category->childrenHaveItems() || ($this->params->get('config.show_empty_categories', false) && !empty($this->selected_categories))))
    {
    $has_categories = true;
    echo $this->partial('categories');
    }
?>
