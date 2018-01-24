<?php  

// no direct access
defined('_JEXEC') or die('Restricted access');

$css_class = $this->application->getGroup().'-'.$this->template->name;

?>

<div class="yoo-zoo <?php echo $css_class; ?> <?php echo $css_class.'-tag'; ?>">

	<?php if ($this->params->get('template.show_title')) : ?>
	<h1 class="uk-h1 <?php echo 'uk-text-'.$this->params->get('template.alignment'); ?>"><?php echo JText::_('Tagged with').': '.$this->tag; ?></h1>
	<?php endif; ?>

	<?php

		// render items
		if (count($this->items)) {
			$has_categories = false;
			echo $this->partial('items', compact('has_categories'));
		}

	?>

</div>
