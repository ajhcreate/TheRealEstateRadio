<?php
/**
 * @package     site.com_jfportal
 * @subpackage  models.invoice
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('JfportalModelInvoices', JPATH_SITE.'/components/com_jfportal/models/invoices.php');

/**
 * Invoice model
 * Overrides the invoices model and simply fetches the data of the exact invoice that we need
 * We don't really care about overfetching data: We do the same amount of API calls
 */
class JfportalModelInvoice extends JfportalModelInvoices{
    protected $_context = 'com_jfportal.omvpoce';

    public function getItem(){
        $params = JFactory::getApplication()->getParams();
        if(!($pk = JFactory::getApplication()->input->getUint('id',0))){
            JErrorPage::render('No Invoice id defined');
        }

        //Fetch all the items. It's the same amount of API calls anyway.
        //@TODO-GN: See if refreshing the subs page keeps the list.limit=all
        //This seems like a joomla bug. If we don't getState, the setState doesn't work for some reason
        $this->getState('list.limit');
        $this->setState('list.limit',0);
        $items = $this->getItems();

        //Return the relevant item
        foreach($items AS $item){
            if(!isset($item->Id)){continue;}    //Should never happen, but check anyways
            if($item->Id == $pk){
                //Set the optional modal classname
                $item->classname = $params->get('modal_classname','');

                return $item;
            }
        }

        $this->setError('No such subscription found');
        return false;
    }

}
