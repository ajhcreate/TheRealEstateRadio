<?php
/**
 * @package 	Plugin Content Filter PRO for Joomla! 3.X
 * @version 	1.0.0
 * @author 		Function90.com
 * @copyright 	C) 2013- Function90.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
**/
defined('_JEXEC') or die;
$counter = 0;
?>
<div id="f90filter-content-sample-row">
	<?php if(isset($this->value) && !empty($this->value)):?>
	<?php foreach ($this->value as $values):?>
		<?php  $values = is_array($values) ? (object)$values : $values;?>
		<?php if(empty($values->token)) : ?>
			<?php continue;?>
		<?php endif;?>
		<div class="row-fluid">
			<div class="span4">
				<input type="text" placeholder="<?php echo JText::_('PLG_CONTENT_F90FILTERPRO_ENTER_TOKEN_GROUP_NAME');?>" name="<?php echo $this->name;?>[<?php echo $counter;?>][token]" value="<?php echo $values->token;?>"></input>
			</div>
			<div class="span6">
				<select name="<?php echo $this->name;?>[<?php echo $counter;?>][groups][]" multiple="multiple">
				<?php foreach ($groups as $group) : ?>
					<option value="<?php echo $group->id;?>" <?php echo in_array($group->id, $values->groups) ? 'selected="selected"' : '';?> ><?php echo $group->title;?></option>
				<?php endforeach;?>
				</select>
			</div>
		</div>
		<hr/>
		<?php $counter++;?>
	<?php endforeach;?>
	<?php endif;?>
	
	<div class="row-fluid">
		<div class="span4">
			<input type="text" placeholder="<?php echo JText::_('PLG_CONTENT_F90FILTERPRO_ENTER_TOKEN_GROUP_NAME');?>" name="<?php echo $this->name;?>[<?php echo $counter;?>][token]"></input>
		</div>
		<div class="span6">
			<select name="<?php echo $this->name;?>[<?php echo $counter;?>][groups][]" multiple="multiple">
			<?php foreach ($groups as $group) : ?>
				<option value="<?php echo $group->id;?>"><?php echo $group->title;?></option>
			<?php endforeach;?>
			</select>
		</div>
	</div>
	<hr/>
</div>

<div id="f90filter-content-mapping">
</div>
<div class="row-fluid">
	<button class="btn btn-small btn-success" onclick=" Joomla.submitbutton('plugin.apply'); return false;" href="#">
		<i class="icon-new icon-white"></i>
		<?php echo JText::_('PLG_CONTENT_F90FILTERPRO_ADD_NEW');?>
	</button>
</div>
