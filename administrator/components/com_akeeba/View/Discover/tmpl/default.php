<?php
/**
 * @package   AkeebaBackup
 * @copyright Copyright (c)2006-2017 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

// Protect from unauthorized access
defined('_JEXEC') or die();

/** @var \Akeeba\Backup\Admin\View\Discover\Html $this */

$js = <<< JS

;// This comment is intentionally put here to prevent badly written plugins from causing a Javascript error
// due to missing trailing semicolon and/or newline in their code.
var akeeba_browser_callback = null;

akeeba.System.documentReady(function(){
	akeeba.Configuration.URLs['browser'] = 'index.php?option=com_akeeba&view=Browser&processfolder=1&tmpl=component&folder=';
	akeeba.System.addEventListener(document.getElementById('browserbutton'), 'click', function(el){
		var directory = document.getElementById('directory');
		akeeba.Configuration.onBrowser( directory.value, directory );
    });
})

JS;

$this->getContainer()->template->addJSInline($js);

?>

<?php echo $this->loadAnyTemplate('admin:com_akeeba/CommonTemplates/FolderBrowser'); ?>

<div class="alert alert-info">
	<?php echo \JText::sprintf('COM_AKEEBA_DISCOVER_LABEL_S3IMPORT','index.php?option=com_akeeba&view=S3Import'); ?>
	<br/>
	<a class="btn btn-small" href="index.php?option=com_akeeba&view=S3Import">
		<span class="icon-box-add"></span>
		<?php echo \JText::_('COM_AKEEBA_S3IMPORT'); ?>
	</a>
</div>

<form name="adminForm" id="adminForm" action="index.php" method="post" class="form-horizontal">
	<input type="hidden" name="option" value="com_akeeba" />
	<input type="hidden" name="view" value="Discover" />
	<input type="hidden" name="task" value="discover" />
	<input type="hidden" name="<?php echo $this->container->platform->getToken(true); ?>" value="1" />

	<div class="control-group">
		<label class="control-label">
			<?php echo \JText::_('COM_AKEEBA_DISCOVER_LABEL_DIRECTORY'); ?>
		</label>
		<div class="controls">
			<input type="text" name="directory" id="directory" value="<?php echo $this->escape($this->directory); ?>" />
			<button class="btn btn-inverse btn-mini" onclick="return false;" id="browserbutton">
				<span class="icon-folder-open icon-white"></span>
				<?php echo \JText::_('COM_AKEEBA_CONFIG_UI_BROWSE'); ?>
			</button>
			<p class="help-block">
				<?php echo \JText::_('COM_AKEEBA_DISCOVER_LABEL_SELECTDIR'); ?>
			</p>
		</div>
	</div>
	<div class="form-actions">
		<button class="btn btn-primary" onclick="this.form.submit(); return false;">
			<?php echo \JText::_('COM_AKEEBA_DISCOVER_LABEL_SCAN'); ?>
		</button>
	</div>
</form>