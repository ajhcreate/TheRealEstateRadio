<?php
/**
 * Joomfuse views
 * @package     admin.com_joomfuse
 * @subpackage	views.main.tmpl.default
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('jquery.framework');
JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen', 'select');

//Shortcute vars
$app		= JFactory::getApplication();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<div class="span12">
    <form action="<?php echo JRoute::_('index.php?option=com_joomfuse&view=main'); ?>" method="post" name="adminForm" id="adminForm">
    	<?php echo JHtml::_( 'form.token' ); ?>
    	
    	<!-- User in the "Associate user" action-button -->
    	<input type="hidden" name="user_id" id="user_id" value="" />
    	
    	<div id="j-main-container">
    		<!-- Serach toolbar -->
    		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));	?>
    		
    		<table class="table table-striped" id="userList">
    			<thead>
    				<tr>
    					<!-- Checkall column -->
    					<th width="1%" class="hidden-phone">
    						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
    					</th>
    					
    					<!-- Joomla User id column -->
    					<th width="1%" style="min-width:55px" class="nowrap center">
    						<?php echo JHtml::_('searchtools.sort', 'COM_JOOMFUSE_VIEW_MAIN_TABLE_COLUMN_JOOMLA_USER_ID', 'jusers.id', $listDirn, $listOrder); ?>
    					</th>
    					
    					<!-- Contact id column -->
    					<th width="1%" style="min-width:55px" class="nowrap center">
    						<?php echo JHtml::_('searchtools.sort', 'COM_JOOMFUSE_VIEW_MAIN_TABLE_COLUMN_INFUSIONSOFT_CONTACT_ID', 'joomfuseusers.ifs_id', $listDirn, $listOrder); ?>
    					</th>
    					
    					<!-- Name column -->
    					<th class="center">
    						<?php echo JHtml::_('searchtools.sort', 'COM_JOOMFUSE_VIEW_MAIN_TABLE_COLUMN_JOOMLA_NAME', 'jusers.name', $listDirn, $listOrder); ?>
    					</th>
    					
    					<!-- Email column -->
    					<th class="center">
    						<?php echo JHtml::_('searchtools.sort', 'COM_JOOMFUSE_VIEW_MAIN_TABLE_COLUMN_JOOMLA_EMAIL', 'jusers.email', $listDirn, $listOrder); ?>
    					</th>
    					
    					<!-- Association date column -->
    					<th class="center">
    						<?php echo JHtml::_('searchtools.sort', 'COM_JOOMFUSE_VIEW_MAIN_TABLE_COLUMN_JOOMFUSE_ASSOCIATION_DATE', 'joomfuseusers.last_update', $listDirn, $listOrder); ?>
    					</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php foreach ($this->items as $i => $item) :?>
    					<tr class="row<?php echo $i % 2; ?>" >
    						<!-- Check column -->
    						<td class="center hidden-phone">
    						    <?php echo JHtml::_('grid.id', $i, $item->id); ?>
    						</td>
    						
    						<!-- Joomla user id column -->
    						<td class="center hidden-phone">
    							<a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id=' . (int) $item->id); ?>"><?php echo $item->id; ?></a>
    						</td>
    						
    						<!-- Infusionsoft contact id column -->
    						<td class="center hidden-phone">
    							<?php if($item->ifs_id):?>
    								<a href="https://<?php echo $this->app_name?>.infusionsoft.com/Contact/manageContact.jsp?view=edit&ID=<?php echo $item->ifs_id; ?>" target="_blank" ><?php echo $item->ifs_id; ?></a>
    							<?php else:?>
    								<button onclick="document.getElementById('user_id').setAttribute('value','<?php echo $item->id?>');Joomla.submitbutton('main.associateUser');" class="btn btn-small hasTooltip" title="No Association found. Click to Associate">
    									<span class="icon-arrow-up-4"></span>
    								</button>
    							<?php endif;?>
    						</td>
    						
    						<!-- Name column -->
    						<td class="center">
    					        <?php echo $this->escape($item->name); ?>
    						</td>
    						
    						<!-- Email column -->
    						<td class="center">
    					        <?php echo $this->escape($item->email); ?>
    						</td>
    						
    						<!-- 'Associated' column -->
    						<td class="center">
    					        <?php if($item->last_update): ?>
    					        	<?php echo JHtml::_('date', $item->last_update, JText::_('DATE_FORMAT_LC4')); ?>
    					        <?php else:?>
    					        	N/A
    					        <?php endif;?>
    						</td>
    						
    						
    						
    					</tr>
    				<?php endforeach;?>
    			</tbody>
    		</table>
    		
    		
    		<?php echo $this->pagination->getListFooter(); ?>
    
    		<input type="hidden" name="task" value="" />
    		<input type="hidden" name="boxchecked" value="0" />
    	</div>
    </form>
</div>


<!-- 'Associate all users modal, in case it is needed' -->
<?php 
echo JHtml::_(
	'bootstrap.renderModal',
	'associateAllModal',
	array(
		'title'       => 'Associating '.$this->numUnassociated.' user(s)...',
		'backdrop'    => 'static',
		'keyboard'    => false,
		'closeButton' => false,
		'url'         => 'index.php?option=com_joomfuse&view=associateall&tmpl=component',
		'footer'      => '<a type="button" class="btn" data-dismiss="modal" aria-hidden="true" onClick="window.location=window.location.href;">'. JText::_("JLIB_HTML_BEHAVIOR_CLOSE") . '</a>'
	)
); ?>