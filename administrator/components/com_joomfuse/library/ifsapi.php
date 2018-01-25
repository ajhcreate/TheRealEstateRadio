<?php
/**
 * Joomfuse admin controller
 * @package     admin.com_joomfuse
 * @subpackage	lib.ifsapi
 *
 * @copyright   Copyright Zacaw Enterprises Inc. All rights reserved.
 * @license     GNU General Public License v3; see LICENSE.txt
 */

defined('_JEXEC') or die;


class IFSApi{
    private static $apiLocation = null;
    private static $apiKey = null;
    private static $messagedForMissingAppname = false;
    private static $messagedForMissingApiKey = false;
    
    private static $products = null;

    private static $customFields = null;    //List of custom fields for contacts
    private static $dataFormGroups = null;
    private static $dataFormTabs = null;

    private static $tagList = null;
    private static $tagGroupList = null;

    private static $actionsetList = null;

    private static $subscriptionList = null;

    //@TODO-GN: Most of these functions return boolean or IFSApiCallResult. Decide which one to use

    public static function dsQuery($tableName, $searchFields, $returnFields = false){
        //Get The ActionSequence Table
        $tabe_class = 'JoomfuseTable'.$tableName;
        $table = new $tabe_class();

        //If no return fields specified, return everything
        if($returnFields === false){
            $returnFields = $table->getAPIFields();
        }

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchFields, $returnFields);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getTagList could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(IFSApi::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    /**
     * Updates an IFS table row with the provided data
     * WARNING: be sure that the provided fields are editable
     * @param String $tableName					The name of the IFS table
     * @param Numeric $recordId					The id of the DB row
     * @param array $updateFields				An array of JoomfuseAPIField s with the value(s) to set
     * @throws Exception						In case of an API error propagated up from $apiCall->execute()
     * @return boolean							True upon success
     */
    public static function dsUpdate($tableName, $recordId ,$updateFields){
        $apiCall = new JoomfuseApiCallUpdate(self::getApiLocation(), $tableName, $recordId, $updateFields);
        $result = $apiCall->execute(IFSApi::getApiKey());

        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
        }

        //Everything checks out
        return true;
    }

    /**
     * Creates an IFS table row with the provided data
     * WARNING: be sure that the provided fields are Add-able
     * @param String $tableName					The name of the IFS table
     * @param array $updateFields				An array of JoomfuseAPIField s with the value(s) to set
     * @throws Exception						In case of an API error propagated up from $apiCall->execute()
     * @return boolean							True upon success
     */
    public static function dsAdd($tableName, $updateFields){
        $apiCall = new JoomfuseApiCallAdd(self::getApiLocation(), $tableName, $updateFields);
        $result = $apiCall->execute(IFSApi::getApiKey());

        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
        }

        //Everything checks out
        return true;
    }
    
    public static function getProducts(){
        //See if we have the product list cached
        if(self::$products !== null){
            return self::$products;
        }
        
        //Fetch the products from the cache, if any
        $cache = JFactory::getCache('com_joofuse');
        $result = $cache->call(array(__CLASS__,'__getProducts'));
        
        //Cache and return;
        self::$products = $result;
        return self::$products;
    }
    
    public static function __getProducts(){
        //Get the products table and the wildcard search
        $table = new JoomfuseTableProduct();
        $searchField = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');
        
        //Perform the API call
        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::__getProducts could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }
        
        $result = $apiCall->execute(self::getApiKey());
        if(!$result->wasSuccess()){
            return array();
        }
        
        return $result->getResult();
    }

    public static function getDataFormTabs(){
        //See if we have the tag list cached
        if(self::$dataFormTabs !== null){
            return self::$dataFormTabs;
        }

        //Get the ContactGroup table
        $table = new JoomfuseTableDataFormTab();
        //Set the search field as the id being of any value
        $searchField = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getDataFormTabs could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        //If the API call was a success, fetch the reuslts
        //Otherwise cache/return an empty array in order to avoid repeated API calls when there's an invalid API key
        $dataFormTabs = array();
        if($result->wasSuccess()){
            $dataFormTabs = $result->getResult();
        }

        //Done. Cache and return
        self::$dataFormTabs = $dataFormTabs;
        return self::$dataFormTabs;
    }

    public static function getDataFormGroups(){
        //See if we have the tag list cached
        if(self::$dataFormGroups !== null){
            return self::$dataFormGroups;
        }

        //Get the ContactGroup table
        $table = new JoomfuseTableDataFormGroup();
        //Set the search field as the id being of any value
        $searchField = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getDataFormGroups could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        //If the API call was a success, fetch the reuslts
        //Otherwise cache/return an empty array in order to avoid repeated API calls when there's an invalid API key
        $dataFormGroups = array();
        if($result->wasSuccess()){
            $dataFormGroups = $result->getResult();
        }

        //Done. Cache and return
        self::$dataFormGroups = $dataFormGroups;
        return self::$dataFormGroups;
    }

    public static function getCustomFields(){
        //See if we have the cutom fields list cached
        if(self::$customFields !== null){
            return self::$customFields;
        }

        //Get the ContactGroup table
        $table = new JoomfuseTableDataFormField();
        //Set the search field as the id being of any value
        $searchField = new JoomfuseAPIField('FormId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, JoomfuseTableDataFormField::DataFormFieldValue_FormId_Contact);

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getCustomFields could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        //If the API call was succesfull, return the custom fields
        //Otherwise cache/return an empty array in order to avoid repeated invalidKey errors 
        $customFields = array();
        if($result->wasSuccess()){
            $customFields = $result->getResult();
        }

        self::$customFields = $customFields;

        return self::$customFields;
    }

    public static function optIn($email, $reason){
        if(empty($email)){
            throw new Exception('IFSApi::optIn received an empty email parameter', 1);
        }
         
        try{
            $apiCall = new JoomfuseApiCallOptIn(self::getApiLocation(), $email, $reason);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::optIn could not instantiate a JoomfuseApiCallOptIn: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        return $result->getResult();
    }

    public static function assignTagToContact($tagId, $contactId){
        //Sanitize the parameters
        if(!is_numeric($tagId) || !is_numeric($contactId)){
            throw new Exception('IFSApi::assignTagToContact received a non-numeric parameter: '.$tagId.' '.$contactId, 1);
        }

        try{
            $apiCall = new JoomfuseApiCallAddToGroup(self::getApiLocation(), $contactId, $tagId);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::assignTagToContact could not instantiate a JoomfuseApiCallAddToGroup: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        return $result->wasSuccess();
    }

    public static function removeTagFromContact($tagId, $contactId){
        //Sanitize the parameters
        if(!is_numeric($tagId) || !is_numeric($contactId)){
            throw new Exception('IFSApi::removeTagFromContact received a non-numeric parameter: '.$tagId,' '.$contactId, 1);
        }

        try{
            $apiCall = new JoomfuseApiCallRemoveFromGroup(self::getApiLocation(), $contactId, $tagId);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::JoomfuseApiCallRemoveFromGroup could not instantiate a JoomfuseApiCallRemoveFromGroup: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        return $result->wasSuccess();
    }

    public static function getSubscriptionList(){
        if(self::$subscriptionList !== null){
            return self::$subscriptionList;
        }

        //Get The ActionSequence Table
        $table = new JoomfuseTableCProgram();
        $searchField = new JoomfuseAPIField('ID', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getSubscriptionList could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        self::$subscriptionList = $result->getResult();

        return self::$subscriptionList;
    }

    public static function cancelSubscription($recurringOrderId, JDate $endDate, $reasonStopped){
        $updateFields = array(
        new JoomfuseAPIField('Status', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, 'Inactive'),
        new JoomfuseAPIField('ReasonStopped', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $reasonStopped),
        new JoomfuseAPIField('EndDate', JoomfuseFieldMapElement::IFS_FIELD_TYPE_DATE, $endDate->toUnix())
        );

        return self::dsUpdate('RecurringOrder', $recurringOrderId, $updateFields);
    }

    public static function getSubscriptionListByIFSId($contactId){
        //Get The RecurringOrder table
        $table = new JoomfuseTableRecurringOrder();
        $searchField = new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, $contactId);
        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getTagList could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    public static function getInvoicesByIFSId($contactId){
        //Get The RecurringOrder table
        $table = new JoomfuseTableInvoice();
        $searchField = new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, $contactId);
        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getInvoicesByIFSId could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    public static function getJobsByIFSId($contactId){
        //Get The Jobs table
        $table = new JoomfuseTableJob();
        $searchField = new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, $contactId);
        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getJobsByIFSId could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }
        
        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    public static function getActionsetList(){
        if(self::$actionsetList !== null){
            return self::$actionsetList;
        }

        //Get The ActionSequence Table
        $table = new JoomfuseTableActionSequence();
        $searchField = new JoomfuseAPIField('ID', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getActionsetList could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        self::$actionsetList = $result->getResult();

        return self::$actionsetList;
    }

    /**
     * Runs an actionset
     * @param unknown_type $contactId
     * @throws Exception					Propagated up from apiCall->execute
     * @return boolean
     */
    public static function runActionSet($contactId, $actionsetId){
        //$apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        $apiCall = new JoomfuseApiCallRunActionSequence(self::getApiLocation(), $contactId, $actionsetId);
        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
            return false;
        }

        //All done
        return true;
    }

    /**
     * Achieves a goal for a contact
     * @param unknown_type $contactId
     * @throws Exception					Propagated up from apiCall->execute
     * @return boolean
     */
    public static function achieveGoal($contactId, $callName, $integration){
        //$apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        $apiCall = new JoomfuseApiCallAchieveGoal(self::getApiLocation(), $contactId, $callName,$integration);
        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
            return false;
        }

        //Even though the API call succeeded, this doesn't mean that the API didn't complain about this goal not existing
        $callResult = $result->getResult();
        if(!isset($callResult) || !is_array($callResult[0]) || !isset($callResult[0]['success'])){
            throw new Exception('IFSApi::achieveGoal received a malformed result. Please contact support',1);
        }

        if(!$callResult[0]['success']){
            if(!isset($callResult[0]['msg'])){
                throw new Exception('IFSApi::achieveGoal encountered an unspecified error while completing a goal',2);
            }

            throw new Exception('IFSApi::achieveGoal encountered an error while achieving a goal: '.$callResult[0]['msg'],2);
        }

        //All done
        return true;
    }

    public static function getTagList(){
        //See if we have the tag list cached
        if(self::$tagList !== null){
            return self::$tagList;
        }

        //Get the ContactGroup table
        $table = new JoomfuseTableContactGroup();
        //Set the search field as the id being of any value
        $searchField = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getTagList could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        //Make the API call while checking for pagination
        $tags = array();
        do{
        	//Make the API call
	        $call_result = $apiCall->execute(self::getApiKey());
	
	        //Make sure the API call succeeded
	        if(!$call_result->wasSuccess()){
	        	continue;	//Do nothing. If this was a persistent error like invalidKey, we just cache/return an empty array
	        }
	
	        $tags = array_merge($tags, $call_result->getResult());
        }while($apiCall->hasMorePages());
        
        
		//Done. Cache and return
		self::$tagList = $tags;
        return self::$tagList;
    }

    public static function getTagGroupList(){
        //See if we have the tag list cached
        if(self::$tagGroupList !== null){
            return self::$tagGroupList;
        }

        //Get the ContactGroupCategory table
        $table = new JoomfuseTableContactGroupCategory();
        //Set the search field as the id being of any value
        $searchField = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, '%');

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getTagGroupList could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        //Fetch the results. In case of an error, use an empty array.
        //This way, if there's a persistent API error like invalid key, this would 
        $tagGroupList = array();
        if($result->wasSuccess()){
            $tagGroupList = $result->getResult();
        } else {
        	IFSFactory::logError('IFSApi::getTagGroupList failed to retrieve the tag group list. Reason was: '.$result->getAPIErrorMessage());
        }

        self::$tagGroupList = $tagGroupList;

        return self::$tagGroupList;
    }

    public static function getCreditCardsByIFSId($ifs_id){
        //Get the CreditCard table
        $table = new JoomfuseTableCreditcard();
        $searchField = new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, intval($ifs_id));

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getCreditCardsByIFSId could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    public static function getTagsByIFSId($ifs_id){
        //Get the ContactGroup table
        $table = new JoomfuseTableContactGroupAssign();
        $searchField = new JoomfuseAPIField('ContactId', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, intval($ifs_id));

        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), $table->getName(), $searchField, $table->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getTagsByIFSId could not instantiate a JoomfuseApiCallFindByField: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    private static function getComponentParams(){
        //Get the component params
        $params = JComponentHelper::getParams('com_joomfuse');
        if(!$params){
            JErrorPage::render('IFSApi::getApiLocation could not retrieve the com_joomfuse configuration options');
        }

        return $params;
    }

    private static function getApiLocation($testAppName = false){
        //See if we have the API location cached
        if(!$testAppName && self::$apiLocation){
            return self::$apiLocation;
        }

        //Retrieve the appname from the configuration options and sanitize it
        $params = self::getComponentParams();
        $appName = $params->get('app_name','');
        if(empty($appName) && !self::$messagedForMissingAppname){
            JFactory::getApplication()->enqueueMessage('Joomfuse could not find the application name configuration option','error');
            self::$messagedForMissingAppname = true;
            return '';
        }

        //If the test app name was requested, return the API location
        if($testAppName){
            return 'https://'.$testAppName.'.infusionsoft.com/api/xmlrpc';
        }

        self::$apiLocation = 'https://'.$appName.'.infusionsoft.com/api/xmlrpc';

        //@TODO-GN: should we have a config option that switches SSL on/off? Maybe we could just do this with SSLVerifyPeer
        return self::$apiLocation;
    }

    private static function getApiKey(){
        //See if we have the API location cached
        if(self::$apiKey){
            return self::$apiKey;
        }

        //Retrieve the appname from the configuration options and sanitize it
        $params = self::getComponentParams();
        $apiKey = $params->get('api_key','');
        if(empty($apiKey) && !self::$messagedForMissingApiKey){
            JFactory::getApplication()->enqueueMessage('Joomfuse could not find the api Key configuration option','error');
            self::$messagedForMissingApiKey = true;
            return '';
        }

        self::$apiKey = $apiKey;

        return self::$apiKey;
    }

    public static function getContactsByEmail($email){
        //Search for the email
        $emailField = new JoomfuseAPIField('Email', JoomfuseFieldMapElement::IFS_FIELD_TYPE_STRING, $email);
        $contactTable = new JoomfuseTableContact();
        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), 'Contact', $emailField, $contactTable->getAPIFields());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::createContact could not instantiate a JoomfuseApiCallCreateContact: '.$e->getMessage());
        }

        $result = $apiCall->execute( self::getApiKey());

        //If the API call failed, return false
        if(!$result->wasSuccess()){
            return false;
        }

        //Fetch the results and check them
        $resultArray = $result->getResult();

        //Return the first id found
        return $resultArray;
    }

    public static function getContactByIFSId($ifs_id){
        //Set the search field, which is the contact id
        $idField = new JoomfuseAPIField('Id', JoomfuseFieldMapElement::IFS_FIELD_TYPE_INT, $ifs_id);
        $contactTable = new JoomfuseTableContact();

        //Extrapolate the fields that the plugins need/describe the contact: All contact fields plus the custom fields requested by plugins
        $returnFields  = array_merge($contactTable->getAPIFields(), IFSFactory::getFieldMappings());

        //Fetch the contact
        try{
            $apiCall = new JoomfuseApiCallFindByField(self::getApiLocation(), 'Contact', $idField, $returnFields);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::getContactByIFSId could not instantiate a JoomfuseApiCallCreateContact: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        if(!$result->wasSuccess()){
            return false;
        }

        return $result->getResult();
    }

    public static function createContact(array $apiFields){
        try{
            $apiCall = new JoomfuseApiCallCreateContact(self::getApiLocation(), $apiFields);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::createContact could not instantiate a JoomfuseApiCallCreateContact: '.$e->getMessage());
        }

        $result = $apiCall->execute( self::getApiKey());

        return $result;
    }

    public static function updateContactById(array $apiFields, $ifs_id){
        try{
            $apiCall = new JoomfuseApiCallUpdateContact(self::getApiLocation(), $apiFields, $ifs_id);
            //$apiCall = new JoomfuseApiCallEcho(self::getApiLocation());
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::updateContactById could not instantiate a JoomfuseApiCallUpdateContact: '.$e->getMessage());
        }

        $result = $apiCall->execute(self::getApiKey());

        return $result;
    }

    /*
     * DATA SERVICE
     */


    /**
     * Tests the connection to an API server (without credentials).
     * @param String $apiLocation
     * @return JoomfuseApiCallResult|boolean
     */
    public static function testConnection($appName = false){
        //If no app name was specified, use the one in the component
        $apiLocation = self::getApiLocation($appName);

        //Instantiate the call request and execute it
        try{
            $apiCall = new JoomfuseApiCallEcho($apiLocation);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false,'','IFSApi::updateContactById could not instantiate a JoomfuseApiCallUpdateContact: '.$e->getMessage());
        }

        //Get the call result
        $result = $apiCall->execute();

        return $result->wasSuccess()?true:false;
    }


    /**
     * Tests API credentials against the API server
     * @param String $apiKey		(Optional) The api Key to test. If not set the
     * @param String $apiLocation
     * @return boolean
     */
    public static function testAPICredentials($apiKey= false, $apiLocation=false){
        //@TODO-GN: STUB
        throw new Exception('IFSApi::testAPICredentials is not implemented yet', 1);

        return true;
    }

    /**
     * Fetches an app setting through the DataService
     * @param String $moduleName		The Module Name
     * @param String $settingName		The Setting Name
     * @return String					The setting value
     */
    public static function getAppSetting($moduleName, $settingName){
        //Instantiate the call request and execute it
        $apiCall = new JoomfuseApiCallGetappsetting(self::getApiLocation(), $moduleName, $settingName);

        //Get the call result
        $result = $apiCall->execute(self::getApiKey());
        /* @var $result JoomfuseApiCallResult */
        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
        }

        return $result->getResult();
    }

    /*
     * INVOICE SERVICE
     */
    /**
     * Validates a new credit card
     * WARNING: be sure that the provided fields are Add-able
     * @param String $cardType					The credit card type
     * @param Numeric $contactId				The contact id that owns this card
     * @param String $cardNumber				The credit card number
     * @param String $expirationMonth			The credit card expiration month
     * @param String $expirationYear			The credit card expiration year
     * @param String $cvv2						The credit card CVV2
     * @throws Exception						In case of an API error propagated up from $apiCall->execute()
     * @return boolean							True upon success
     */
    public static function validateNewCreditCard($cardType, $contactId, $cardNumber, $expirationMonth, $expirationYear, $cvv2){
        $apiCall = new JoomfuseApiCallValidateNewCreditCard(self::getApiLocation(), $cardType, $contactId, $cardNumber, $expirationMonth, $expirationYear, $cvv2);
        $result = $apiCall->execute(IFSApi::getApiKey());

        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
        }

        $resultArray = $result->getResult();
        if(!isset($resultArray['Valid']) || $resultArray['Valid'] == 'false'){
            $message = isset($resultArray['Message']) ? $resultArray['Message'] : 'Unknown Validation error';
            throw new Exception($message, 1);
        }

        //Everything checks out
        return true;
    }

    public static function chargeInvoice($invoiceId, $notes, $creditCardId, $merchantAccountId, $bypassComissions){
        $apiCall = new JoomfuseApiCallChargeInvoice(self::getApiLocation(), $invoiceId, $notes, $creditCardId, $merchantAccountId, $bypassComissions);
        $result = $apiCall->execute(IFSApi::getApiKey());

        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
        }

        $resultArray = $result->getResult();
        if(!isset($resultArray['Successful']) || $resultArray['Successful'] == 'false'){
            $message = isset($resultArray['Message']) ? $resultArray['Message'] : 'Unknown error';
            throw new Exception($message, 1);
        }

        //Everything checks out
        return true;
    }

    /*
     * PRODUCT SERVICE
     */

    /**
     * Deactivates the given credit card
     * @param Numeric $cardId		The Credit Card Id
     * @throws Exception			In case of an API error
     */
    public static function deactivateCreditCard($cardId){
        //Instantiate the call request and execute it
        $apiCall = new JoomfuseApiCallDeactivatecreditcard(self::getApiLocation(), (int)$cardId);

        //Get the call result
        $result = $apiCall->execute(self::getApiKey());
        /* @var $result JoomfuseApiCallResult */
        if(!$result->wasSuccess()){
            throw new Exception($result->getAPIErrorMessage(), $result->getAPIErrorCode());
        }
    }

}