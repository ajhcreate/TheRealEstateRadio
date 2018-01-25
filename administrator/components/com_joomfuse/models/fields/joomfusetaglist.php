<?php
/**
 * Joomfuse fields
 * @package     admin.com_joomfuse
 * @subpackage	models.fields.joomfusetaglist
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

//Import/register the IFSFactory that takes care of all the required files
class_exists('IFSFactory') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsfactory.php';
JLoader::register('IFSApi', JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/ifsapi.php');

//Load the field element that we extend upon
JFormHelper::loadFieldClass('GroupedList');

/**
 * Joomfuse field for listing all Infusionsoft tags in a select list
 * @author Georgios Ntampitzias (nonickch@gmail.com)
 *
 */
class JFormFieldJoomfusetaglist extends JFormFieldGroupedList {
    //The field class must know its own type through the variable $type.
    protected $type = 'joomfusetaglist';

    protected function getGroups(){
        //@TODO-GN: add onClick (throw event?) functionality to the custom fields and the options
        // in the xml so we can catch that event from the CB/JomSocial etc map-to fiels so we can gray-out the irrelevant ones
        //We can't use the onClick since it's not printed by JFormFieldGroupedList::getInput(). So custom JS it is...
        //Fetch the groups/elements in the xml manifest
        $parent_groups = parent::getGroups();
        $groups = array();
         
        //Fetch the custom fields and their tabs/groups.
        //Notice: Don't worry about caching/multiple API calls, this is taken care of from the IFSApi
        $ifs_tags = IFSApi::getTagList();
        $ifs_tag_groups = IFSApi::getTagGroupList();
        
        //Append our 'uncategorized' tag group so we group all group-less tags inside a
        $uncategorized = new stdClass();
        $uncategorized->Id = 0;
        $uncategorized->CategoryName = 'General';
        $uncategorized->CategoryDescription = '';
        $ifs_tag_groups[] = $uncategorized;
        
        //Merge the two arrays in an easier to parse array
        foreach($ifs_tag_groups AS $tag_group){
            $groupName = isset($tag_group->CategoryName) ? $tag_group->CategoryName : false;
            $groupId = isset($tag_group->Id) ? $tag_group->Id : false;
            
            //Check for values, just in case. 0's are the uncategorized so strict checks against false (also we may have empty-string group names)
            if($groupName === false || $groupId === false){
                continue;
            }
            
            //Creat the entry in $grouped_array and search for all member tags in the tag list
            $groups[$groupName] = array();
            foreach($ifs_tags AS $tag){
                $tag_group_id = isset($tag->GroupCategoryId) ? $tag->GroupCategoryId : 0;
                if($tag_group_id == $groupId){
                    $groups[$groupName][$tag->GroupName] = JHtml::_('select.option', $tag->Id, $tag->GroupName, 'value', 'text', false);
                }
            }
            
            //Finally, sort the elements in the tag group according to their name
            uksort($groups[$groupName],'strcasecmp');
        }
        
        //Sort the array by category name
        uksort($groups, 'strcasecmp');
        //But keep 'General' at the top while also making sure that the xml-defined values(if any) always come first
        $general = $groups['General'];
        unset($groups['General']);
        $groups = array_merge($parent_groups,array('General'=> $general), $groups);
         
        //Reset the counter and return
        reset($groups);
        return $groups;
    }

}