<?php
/**
 * Joomfuse layout for displaying the editors-xtd shortcode fields
 * @package     admin.com_joomfuse
 * @subpackage	views.shortcodefields.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;
$app = JFactory::getApplication();

/*
if ($app->isSite()){
	JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));
}
*/

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.framework', true);

?>

<table class="table table-striped table-condensed">
	<tbody>
		<?php foreach ($this->items as $i => $item) : ?>
			<tr class="row<?php echo $i % 2; ?> center">
				<td>
					<a href="javascript:void(0)" onclick="if (window.parent){window.parent.jfSelectShortcode('<?php echo $item; ?>');}">
						<?php echo $this->escape($item); ?></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

