<?php  

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<fieldset>
	<legend><?php echo $item->getType()->name; ?></legend>

	<?php if ($this->checkPosition('content')) : ?>
	<?php echo $this->renderPosition('content', array('style' => 'submission.uikit_row')); ?>
	<?php endif; ?>

</fieldset>

<?php if ($this->checkPosition('administration')) : ?>
<fieldset>
	<legend><?php echo JText::_('Administration'); ?></legend>

	<?php echo $this->renderPosition('administration', array('style' => 'submission.uikit_row')); ?>

</fieldset>
<?php endif;
