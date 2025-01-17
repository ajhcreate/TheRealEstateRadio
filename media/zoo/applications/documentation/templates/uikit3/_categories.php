<?php  

// no direct access
defined('_JEXEC') or die('Restricted access');

// remove empty categories
$selected_categories = $this->selected_categories;
if (!$this->params->get('config.show_empty_categories', false)) {
	$selected_categories = array_filter($selected_categories, create_function('$category', 'return $category->totalItemCount();'));
}

// init vars
$i       = 0;
$columns = array();
$column  = 0;
$row     = 0;
$rows    = ceil(count($selected_categories) / $this->params->get('template.categories_cols'));

// create columns
foreach ($selected_categories as $category) {

	if ($this->params->get('template.categories_order')) {
		// order down
		if ($row >= $rows) {
			$column++;
			$row  = 0;
			$rows = ceil((count($selected_categories) - $i) / ($this->params->get('template.categories_cols') - $column));
		}
		$row++;
		$i++;
	} else {
		// order across
		$column = $i++ % $this->params->get('template.categories_cols');
	}

	if (!isset($columns[$column])) {
		$columns[$column] = '';
	}

	$columns[$column] .= $this->partial('category', compact('category'));
}

// render columns
$count = count($columns);
if ($count) {

	echo '<div class="uk-grid uk-grid-divider" uk-grid uk-match-height>';
	for ($j = 0; $j < $count; $j++) {
		echo '<div class="uk-width-1-2@s uk-width-1-'.$count.'@m">'.$columns[$j].'</div>';
	}
	echo '</div>';
}
