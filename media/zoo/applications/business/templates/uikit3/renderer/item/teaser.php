<?php  

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<?php if ($this->checkPosition('media')) : ?>
<div class="<?php echo 'uk-align-'.$view->params->get('template.items_media_alignment').($view->params->get('template.items_media_alignment') == "left" || $view->params->get('template.items_media_alignment') == "right" ? '@m' : ''); ?>">
	<?php echo $this->renderPosition('media'); ?>
</div>
<?php endif; ?>

<div class="uk-overflow-hidden">

<?php if ($this->checkPosition('title')) : ?>
<h2 class="uk-h3 uk-margin-remove">
	<?php echo $this->renderPosition('title'); ?>
</h2>
<?php endif; ?>

<?php if ($this->checkPosition('subtitle')) : ?>
<p class="uk-text-muted uk-margin-remove">
	<?php echo $this->renderPosition('subtitle', array('style' => 'comma')); ?>
</p>
<?php endif; ?>

<?php if ($this->checkPosition('description')) : ?>
    <?php echo $this->renderPosition('description', array('style' => 'uikit_blank')); ?>
<?php endif; ?>

<?php if ($this->checkPosition('links')) : ?>
<ul class="uk-subnav uk-subnav-divider">
	<?php echo $this->renderPosition('links', array('style' => 'uikit_subnav')); ?>
</ul>
<?php endif; ?>

</div>
