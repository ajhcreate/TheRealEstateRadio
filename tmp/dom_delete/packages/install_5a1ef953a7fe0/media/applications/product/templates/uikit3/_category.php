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

<?php if ($category) : ?>

	<?php $link = $this->app->route->category($category); ?>

	<?php if ($this->params->get('template.show_categories_titles')) : ?>
	<h2 class="uk-h3 uk-margin-remove">

		<a href="<?php echo $link; ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>

		<?php if ($this->params->get('template.show_categories_item_count')) : ?>
			<span class="uk-text-muted">(<?php echo $category->totalItemCount(); ?>)</span>
		<?php endif; ?>

	</h2>
	<?php endif; ?>

	<?php if ($this->params->get('template.show_categories_descriptions') && $category->getParams()->get('content.teaser_description')) : ?>
	<?php echo $category->getParams()->get('content.teaser_description'); ?>
	<?php endif; ?>

	<?php if (($image = $category->getImage('content.teaser_image')) && $this->params->get('template.show_categories_images')) : ?>
	<div class="uk-margin">
		<a href="<?php echo $link; ?>" title="<?php echo $category->name; ?>">
			<img class="<?php echo 'uk-align-'.$this->params->get('template.alignment').($this->params->get('template.alignment') == "left" || $this->params->get('template.alignment') == "right" ? '@m' : ''); ?> uk-margin-remove-bottom" src="<?php echo $image['src']; ?>" title="<?php echo $category->name; ?>" alt="<?php echo $category->name; ?>" <?php echo $image['width_height']; ?>/>
		</a>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('template.show_sub_categories') && $category->getChildren()): ?>
	<ul class="uk-list">
		<?php

			foreach ($category->getChildren() as $child) {
				if (!$child->totalItemCount() && !$this->params->get('config.show_empty_categories', false) ) continue;
				$link = $this->app->route->category($child);
				$item_count = ($this->params->get('template.show_sub_categories_item_count')) ? ' <span class="uk-text-muted">('.$child->totalItemCount().')</span>' : '';
				echo '<li><a href="'.$link.'" title="'.$child->name.'">'.$child->name.'</a>'.$item_count.'</li>';
			}

		?>
	</ul>
	<?php endif; ?>

<?php endif;