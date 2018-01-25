<?php
/**
 * Joomfuse view for displaying the editors-xtd shortcode fields
 * @package     admin.com_joomfuse
 * @subpackage	models.shortcodefields
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of currently mapped Infusionsoft contact fields
 *
 * @since       1.6
 */
class JoomfuseModelShortcodefields extends JModelList{
    public function getItems(){
        $fields = array();
         
        JPluginHelper::importPlugin('joomfuse');
        $dispatcher = JEventDispatcher::getInstance();

        //Retrieve the contact fields mapped
        $results = $dispatcher->trigger('getJoomFuseContactFields',array(JFactory::getUser()->get('id')));
        foreach($results AS $map){
            foreach($map AS $association){
                /* @var $association JoomfuseAPIField */
                //var_dump($result);
                $fields[] = $association->getFieldName();
            }
        }

        //Retrieve the custom contact field mappings from the event call.
        $results = $dispatcher->trigger('getCustomFieldMappings');

        foreach($results AS $pluginMap){
            /* @var $mapping JoomfuseFieldMapping  */
            $map = $pluginMap->getFields();
            foreach($map AS $association){
                /* @var $association JoomfuseFieldMapElement */
                $fields[] = $association->getIFSField();
            }
        }

        return array_unique($fields);
    }
}
