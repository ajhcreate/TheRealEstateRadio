<?php
/**
 * @package         Sourcerer
 * @version         7.1.6PRO
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2017 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use RegularLabs\Library\Document as RL_Document;
use RegularLabs\Library\Language as RL_Language;
use RegularLabs\Library\Parameters as RL_Parameters;

$user = JFactory::getUser();
if ($user->get('guest')
	|| (
		!$user->authorise('core.edit', 'com_content')
		&& !$user->authorise('core.edit.own', 'com_content')
		&& !$user->authorise('core.create', 'com_content')
	)
)
{
	JError::raiseError(403, JText::_("ALERTNOTAUTH"));
}

$params = RL_Parameters::getInstance()->getPluginParams('sourcerer');

if (JFactory::getApplication()->isSite())
{
	if (!$params->enable_frontend)
	{
		JError::raiseError(403, JText::_("ALERTNOTAUTH"));
	}
}

$class = new PlgButtonSourcererPopup($params);
$class->render();

class PlgButtonSourcererPopup
{
	var $params = null;

	public function __construct(&$params)
	{
		$this->params = $params;
	}

	public function render()
	{

		jimport('joomla.filesystem.file');

		// Load plugin language
		RL_Language::load('plg_system_regularlabs');
		RL_Language::load('plg_editors-xtd_sourcerer');
		RL_Language::load('plg_system_sourcerer');

		JHtml::_('script', 'system/core.js', false, true);
		RL_Document::script('regularlabs/script.min.js');
		RL_Document::style('regularlabs/popup.min.css');
		RL_Document::style('regularlabs/style.min.css');

		JFactory::getDocument()->addStyleSheet('//code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css');
		JFactory::getDocument()->addScript('//code.jquery.com/ui/1.9.2/jquery-ui.js');

		// Tag character start and end
		list($tag_start, $tag_end) = explode('.', $this->params->tag_characters);

		$script = "
			var sourcerer_syntax_word = '" . $this->params->syntax_word . "';
			var sourcerer_tag_characters = ['" . $tag_start . "', '" . $tag_end . "'];
			var sourcerer_editorname = '" . JFactory::getApplication()->input->getString('name', 'text') . "';
			var sourcerer_default_addsourcetags = " . (int) $this->params->addsourcetags . ";
			var sourcerer_root = '" . JUri::root(true) . "';
		";
		RL_Document::scriptDeclaration($script);

		RL_Document::script('sourcerer/script.min.js', '7.1.6.p');
		RL_Document::style('sourcerer/popup.min.css', '7.1.6.p');

		$this->params->code = '';
		if ($this->params->use_example_code == 1 || (JFactory::getApplication()->isAdmin() && $this->params->use_example_code == 2))
		{
			$this->params->code = $this->params->example_code;
		}
		$this->params->code = str_replace(['<br>', '<br />'], "\n", $this->params->code);

		echo $this->getHTML();
	}

	function getHTML()
	{
		$editor_plugin = JPluginHelper::getPlugin('editors', 'codemirror');

		if (empty($editor_plugin))
		{
			JFactory::getApplication()->enqueueMessage(JText::sprintf('SRC_ERROR_CODEMIRROR_DISABLED', '<a href="index.php?option=com_plugins&filter_folder=editors&filter_search=codemirror" target="_blank">', '</a>'), 'error');

			return;
		}

		$editor = JEditor::getInstance('codemirror');

		ob_start();
		?>
		<div class="header">
			<h1 class="page-title">
				<span class="icon-reglab icon-sourcerer"></span>
				<?php echo JText::_('INSERT_CODE'); ?>
			</h1>
		</div>

		<div class="subhead">
			<div class="container-fluid">
				<div class="btn-toolbar" id="toolbar">
					<div class="btn-group" id="toolbar-apply">
						<button href="#" onclick="RegularLabsSourcererPopup.insertText();window.parent.SqueezeBox.close();" class="btn btn-small btn-success">
							<span class="icon-apply icon-white"></span> <?php echo JText::_('SRC_INSERT') ?>
						</button>
					</div>

					<div class="btn-group">
						<button class="btn btn-small hasTip" id="btn-sourcetags" onclick="RegularLabsSourcererPopup.toggleSourceTags();return false;" title="<?php echo JText::_('SRC_TOGGLE_SOURCE_TAGS_DESC'); ?>">
							<span class="icon-reglab icon-src-sourcetags"></span> <?php echo JText::_('SRC_TOGGLE_SOURCE_TAGS') ?>
						</button>
					</div>

					<div class="btn-group">
						<button class="btn btn-small hasTip" id="btn-tagstyle" onclick="RegularLabsSourcererPopup.toggleTagStyle();return false;" title="<?php echo JText::_('SRC_TOGGLE_TAG_STYLE_DESC'); ?>">
							<span class="icon-reglab icon-src-tagstyle"></span> <?php echo JText::_('SRC_TOGGLE_TAG_STYLE') ?>
						</button>
					</div>

					<div class="btn-group" id="toolbar-cancel">
						<button href="#" onclick="if(confirm('<?php echo JText::_('RL_ARE_YOU_SURE'); ?>')){window.parent.SqueezeBox.close();}" class="btn btn-small">
							<span class="icon-cancel "></span> <?php echo JText::_('JCANCEL') ?>
						</button>
					</div>

					<?php if (JFactory::getApplication()->isAdmin() && JFactory::getUser()->authorise('core.admin', 1)) : ?>
						<div class="btn-wrapper" id="toolbar-options">
							<button onclick="window.open('index.php?option=com_plugins&filter_folder=system&filter_search=<?php echo JText::_('SOURCERER') ?>');" class="btn btn-small">
								<span class="icon-options"></span> <?php echo JText::_('JOPTIONS') ?>
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="container-fluid container-main">
			<form action="index.php" id="sourceForm" method="post">

				<div class="control-group form-inline">
				</div>

				<div class="well well-small src_editor">
					<?php echo $editor->display(
						'source',
						$this->params->code,
						'100%', '100%', 10, 10, 0, null, null, null,
						['syntax' => 'php', 'linenumbers' => 1, 'tabmode' => 'shift']
					); ?>
				</div>

				<script type="text/javascript">
					RegularLabsSourcererPopup.init();
				</script>
			</form>
		</div>
		<?php
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
}
