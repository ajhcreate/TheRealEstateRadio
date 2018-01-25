<?php
/**
 * Joomfuse libs
 * @package     admin.com_joomfuse
 * @subpackage	lib.classes.apiCalls.contactService
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;

//Include all contact service implementations
class_exists('JoomfuseApiCallCreateContact') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService/createContact.php';
class_exists('JoomfuseApiCallUpdateContact') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService/updateContact.php';
class_exists('JoomfuseApiCallRunActionSequence') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService/runActionSequence.php';

//The following are not really extensions of this class, but they are in the contact service
class_exists('JoomfuseApiCallGroupfunctions') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService/groupFunctions.php';


abstract class JoomfuseContactService extends JoomfuseApiCall{
    private $api_error_code = null;
    private $api_error_message = null;

    protected $call_params_fields = array();

    /**
     * Constructs a ContactService API call
     * @param array $api_fields
     * @throws Exception			In case the API parameters given are bad
     */
    public function __construct($apiLocation, array $api_fields){
        parent::__construct($apiLocation);
        
        //Sanitize the parameters
        foreach($api_fields AS $field){
            /* @var $field JoomfuseAPIField */
            if(!is_a($field, 'JoomfuseAPIField')){
                throw new Exception('JoomfuseApiCallCreateContact::__construct received a non-JoomfuseAPIField parameter', 1);
            }
            
            //Save the parameter to be used in the API call
            $this->call_params_fields[$field->getFieldName()] = $field->getAPIValue();
        }

        //Ask the concrete implementations to check the parameters. We may throw an exception here
        $this->checkParameters();
    }

    //Concrete implementation for JoomfuseApiCall->getServiceName()
    protected function getServiceName(){return 'ContactService';}

    //Concrete implementation for JoomfuseApiCall->getError()
    //TODO-GN: This is defunct. remove it
    public function getError(){
        //@TODO-GN: stub
        return $this->api_error_code.": ".$this->api_error_message;
    }
    
     protected function getCallArray($apiKey){
          return array(
                    php_xmlrpc_encode($apiKey),
                    php_xmlrpc_encode($this->call_params_fields,array('auto_dates'))
                    );
     }

    /**
     * Checks the $this->call_params_fields for any issues
     * @throws Exception	In case there is a fault with the parameters, and the message is the problem
     */
    abstract protected function checkParameters();
}