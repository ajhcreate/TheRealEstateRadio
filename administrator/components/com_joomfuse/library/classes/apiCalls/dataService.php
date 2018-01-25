<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.dataService
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include all contact service implementations
class_exists('JoomfuseApiCallEcho') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/dataService/echo.php';
class_exists('JoomfuseApiCallFindByField') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/dataService/findByField.php';
class_exists('JoomfuseApiCallUpdate') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/dataService/update.php';
class_exists('JoomfuseApiCallAdd') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/dataService/add.php';
class_exists('JoomfuseApiCallGetAppSetting') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/dataService/getappsetting.php';



abstract class JoomfuseDataService extends JoomfuseApiCall{
	//Default result pagination values
    protected $limit = 1000;
    protected $page = 0;
    protected $hasMorePages = false;

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'DataService';}
    
    
    /**
     * Override the execution in order to inject pagination information to the result object 
     * 
     * {@inheritDoc}
     * @see JoomfuseApiCall::execute()
     */
    public function execute($apiKey){
    	//Make the normal execution call
    	$result = parent::execute($apiKey);
    	
    	//Figure out if there's more pages, by looking at the number of results
    	//Checking against !empty($this->limit) is a bit of an overkill, but should it ever be set to 0, we'd fall in an endless loop
    	if($this->hasMorePages =(
    			$this->limit && 
    			$result->wasSuccess() && 
    			(count($result->getResult()) == $this->limit) 
    			)
    		){
    		$this->page++;
    	}
    	
    	//Done
    	return $result;
    }
    
    /**
     * Checks whether this API call has any more pages of results
     * @return boolean
     */
    public function hasMorePages(){return $this->hasMorePages;}
    
}