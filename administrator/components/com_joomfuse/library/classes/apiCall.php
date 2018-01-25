<?php

//Require or available implementations
//DEVELOPERS NOTICE: you can actually override the implementations. If you declare the class before we reach this line (so before ifsactory.php loads)
//you can skip the loading of our implementation. DO THIS AT YOUR OWN RISK THOUGH: you may actually end up breaking a lot of things and break
//compatibility in a future release of the component (i.e the functions/parameters change).
class_exists('JoomfuseContactService') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/contactService.php';
class_exists('JoomfuseDataService') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/dataService.php';
class_exists('JoomfuseInvoiceService') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/invoiceService.php';
class_exists('JoomfuseEmailService') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/emailService.php';
class_exists('JoomfuseProductService') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/productService.php';
class_exists('JoomfuseFunnelService') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCalls/funnelService.php';
class_exists('JoomfuseApiCallResult') OR require JPATH_ADMINISTRATOR.'/components/com_joomfuse/library/classes/apiCallResult.php';


abstract class JoomfuseApiCall{
    protected $client = null;

    protected static $callLog = array();    //Log of all the calls made

    /*
     * ABSTRACT FUNCTIONS
     */

    abstract protected function getServiceName();

    abstract protected function getCallName();

    abstract protected function getCallArray($apiKey);

    abstract protected function validateResult(xmlrpcresp $result);

    abstract protected function getResultObject(xmlrpcresp $result);

    /**
     * Simple constructor
     * @param String $apiLocation	The API location URL as fed to the xmlrpc_client::__construct
     */
    public function __construct($apiLocation){
        $this->client = new xmlrpc_client($apiLocation);
        $this->client->return_type = "phpvals";
        $this->client->setSSLVerifyHost(2);    // libcurl 7.28.1 removes support for the default value of 1
        //@TODO-GN: the following should be a configuration option
        //$this->client->setSSLVerifyPeer(FALSE);
    }

    /**
     * Executes the query as defined by the implementation of the abstract functions
     * @param String $apiKey			The API key to use
     * @return JoomfuseApiCallResult	The API call result object
     */
    public function execute($apiKey){
        //Mark the api call start time
        if(function_exists('microtime')){
            $startTime = microtime(true);
        } else{
            $startTime = time();
        }

        //Create the XML-RPC message and send it
        $api_call = new xmlrpcmsg($this->getFullAPICallName(), $this->getCallArray($apiKey));
        $result = $this->client->send($api_call);

        //Marke the api call end time
        if(function_exists('microtime')){
            $endTime = microtime(true);
        } else{
            $endTime = time();
        }

        //Log the call if debugging is enabled
        if(JDEBUG){
            $this->addLogEntry($result, $startTime, $endTime);
        }

        //Check for API errors
        if($result->faultCode()){
            return new JoomfuseApiCallResult(false, $this->getFullAPICallName(), $result->faultString(), $result->faultCode());
        }

        //Check for per-implementation validation errors
        try{
            $this->validateResult($result);
        } catch (Exception $e){
            return new JoomfuseApiCallResult(false, $this->getFullAPICallName(),$e->getMessage(), $e->getCode());
        }

        //Return success, with the returned payload (if any)
        $callResult = new JoomfuseApiCallResult(true, $this->getFullAPICallName());
        $callResult->assignResult($this->getResultObject($result));

        return $callResult;
    }

    /**
     * Returns the full API CallName, as expected from the IFS API (i.e. 'Dataservice.query')
     * @return string		The API Call Name
     */
    protected function getFullAPICallName(){
        //If there is no service name (echo?) return just the call name
        $serviceName = $this->getServiceName();
        if(empty($serviceName)){
            return $this->getCallName();
        }

        //Return the concatenated ServiceName.callName
        return $serviceName.'.'.$this->getCallName();
    }

    /**
     * Returns the api function name, such as ContactService.updateContact
     * @return string	The api function name
     */
    protected function getApiFunctionName(){
        return $this->serviceName.'.'.$this->callName;
    }

    /*
     * 
     * LOG-RELATED FUNCTIONS
     * Feel free to override each one so things like getLogAPIDisplayName (i.e. add contact id in name) return better human-readable entries
     * 
     */

    /**
     * Fetches the call log.
     * Care must be taken to fetch the log after all the API calls have been executed.
     * The obvious sole place this is true is right after the JoomFuse call to IFSContact::saveAllData()
     * @return Array[stdClass]		An array of log objects (as loosely defined here)
     */
    public static function getCallLog(){return self::$callLog;}

    /**
     * Creates the log entry for this API call.
     * Called from execute() right before parsing the results
     * @param xmlrpcresult $result				The result of the API call
     * @param float $startTime					The microtime() before the API call start
     * @param float $endTime					The microtime() after the API call return
     */
    protected function addLogEntry($result, $startTime, $endTime){
        $logEntry = new stdClass();
        $logEntry->startTime = $startTime;
        $logEntry->endTime = $endTime;
        $logEntry->duration = $endTime - $startTime;
        $logEntry->callName = $this->getLogAPIDisplayName();
        $logEntry->callArray = $this->getLogCallArray();
        $logEntry->explain = $this->getLogExplain();
        $logEntry->resultObject = $this->getResultObject($result);
        $logEntry->faultCode = $this->getLogFaultCode($result);
        $logEntry->faultString = $this->getLogFaultString($result);
        //$logEntry->stackTrace = debug_backtrace(false);
        self::$callLog[] = $logEntry;
        
        //Add to our logger so we can see the API calls even when there's a redirect going on
        $message = 'API Call: '.$logEntry->callName.' ('.$logEntry->explain.') lasted '.round($logEntry->duration, 3).'s.';
        if($logEntry->faultCode){
            $message .= ' But it FAILED with faultcode: '.$logEntry->faultCode. ' and message: '.$logEntry->faultString;
        }
        
        $loglevel = $logEntry->faultCode ? JLog::ALERT : JLog::INFO;
        IFSFactory::logError($message, $loglevel);
    }

    /**
     * Returns the API call name as it should display in the debug log
     * @return string		The full API call name (i.e. 'ContactService.add')
     */
    protected function getLogAPIDisplayName(){
        return $this->getFullAPICallName();
    }

    /**
     * Returns the API call array (call params) as it should display in the debug log
     * We may need to override in concrete classes so we can display a more informative name (i.e. include the contactid in ContactService calls)
     * We may also opt to return empty(or truncated) arrays in case we upload files.
     * WARNING: On overriden functions, remember to redact the API key
     * @return Array		The API Call array
     */
    protected function getLogCallArray(){
        return $this->getCallArray('API KEY REDACTED');
    }
    
    /**
     * Returns a human-readable explanation of the API call for displaying in the debug log (i.e. 'Fetch contact fields for ContactId 3')
     * WARNING: We must override this function on every single api call concrete implementation or the entry will not appear 
     * @return string			The human-readable API call explanation
     */
    protected function getLogExplain(){
        return '';
    }

    /**
     * Returns the API call result as it should display in the deug log
     * @param Array $result	The API Call result
     */
    protected function getLogResultObject($result){
        return $this->getResultObject($result);
    }

    /**
     * Returls the xmlrpcresponse fault code value
     * @param Numeric $result	The faultcode (if any)
     */
    protected function getLogFaultCode($result){
        return $result->faultCode();
    }
    
    protected function getLogFaultString($result){
        return $result->faultString();
    }

}