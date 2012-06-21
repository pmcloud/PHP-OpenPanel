<?php

/** 
 * Copyright (c) 2012 <copyright Aruba spa>
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software 
 * and associated documentation files (the "Software"), to deal in the Software without restriction, 
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES 
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
 * IN THE SOFTWARE.
 * 
 */
/**
 * This is the main class to provide WSEndUser's method invocation.
 * 
 * This object builds the header authentication used in every "client" call.
 * 
 */
include_once 'WsEndUser.php';
include_once 'WSEndpoint.php';

define("DEF_WS_URL",    			WSEndpoint::DEF_WS_URL);
define("DEF_ENDUSER_API_VERSION",  	WSEndpoint::DEF_ENDUSER_API_VERSION);


final class WsEndUserExt extends WsEndUser implements WSEndpoint {
	
	
	private $username = null;
    private $password = null;
	private $options = null;
	
    private static $def_params = array(
    						'debug' => false,		
    						'trace'=>true,    						
    						//'exception'=>
    						'compression'=> SOAP_COMPRESSION_ACCEPT,
    						'ws_url' => DEF_WS_URL,
    						'enduser_api_version' => DEF_ENDUSER_API_VERSION, 
    						'soap_version'=> SOAP_1_1,
    						'default_timezone' => "Europe/Rome",
    						'cache_wsdl'=>WSDL_CACHE_MEMORY
    						);
    
    
	/**
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		
		// the $classmap field in 'parent' WsEndUser.php file, must be re-declared as 'protected'
		foreach(parent::$classmap as $key => $value)
		{
			if(!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}
		// setting default parameters if not yet defined in '$options'...
		foreach (self::$def_params as $key =>$value) {
			if(!isset($options[$key])) {
				$options[$key] = $value;
			}
			else if ($options[$key] == null || sizeof($options[$key]) == 0) { //..or has empty definition
				$options[$key] = $value;
			}
		}
		
		// setting location for WS calls...
		if (SOAP_1_2 === $options['soap_version']) {
			$location = $options['ws_url'] ."/WsEndUser/" .$options['enduser_api_version']."/WsEndUser.svc";
			$this->__setLocation($location);
		}
		else {
			$location = $options['ws_url'] ."/WsEndUser/" .$options['enduser_api_version']."/WsEndUser.svc/soap11";
			$this->__setLocation($location);
		}
		
		$wsdlEndPoint = $options['ws_url'] ."/WsEndUser/" .$options['enduser_api_version']."/WsEndUser.svc?wsdl";
		$options['wdsl_endpoint'] = $wsdlEndPoint;
				
		if(!isset($options['default_timezone'])) {
			date_default_timezone_set("Europe/Rome");			
		}
		else {		
			date_default_timezone_set($options['default_timezone']);
		}
		
		// keeping defined options...
		$this->options = $options;
		
		// calling parent constructor (generated)
		parent::__construct($options, $wsdlEndPoint);
	}
	

	
	/**
	 * Enter description here ...
	 */
	private final function logLastWSRequest($my_request) {
		
		print "\nWSDL End-point: ".$this->options['wdsl_endpoint']; 
		print "\nRequest Header: \n".$this->__getLastRequestHeaders();
		print "\nRequest: \n". $my_request ."\n";
	}
	
	/**
	 * Enter description here ...
	 */
	private final function logLastWSResponse() {	
		
		print "\n\nResponse Header: \n". $this->__getLastResponseHeaders();
		print "\nResponse: \n". $this->__getLastResponse()."\n";		
	}
	
	
    /**
     *
     */
    public final function setCredentials($username, $passwordOrToken) {
        $this->username = $username;
        $this->password = $passwordOrToken;
    }
    
    

	/* (non-PHPdoc)
	 * @see SoapClient::__doRequest()
	 */
	final function __doRequest($request, $location, $action, $version, $one_way = 0)
	{		
		$request = str_replace("/jsonp", "", $request);
		
		if (isset($this->options['debug']) && $this->options['debug']) {	
			$this->logLastWSRequest($request);
		}
		  		
		$response = parent::__doRequest($request, $location,$action, $version, $one_way);		
		return $response;
	}
	
    /**
     * Generates de WSSecurity header
     * 
     * @return SoapHeader
     */
    private final function getWSsecurityHeader() {

        /* The timestamp. The computer must be on time or the server you are
         * connecting may reject the password digest for security.
         */
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');
        
        /* A random word. The use of rand() may repeat the word if the server is
         * very loaded.
         */        
        $nonce = mt_rand();

        /* This is the right way to create the password digest. Using the
         * password directly may work also, but it's not secure to transmit it
         * without encryption. And anyway, at least with axis+wss4j, the nonce
         * and timestamp are mandatory anyway.
         */
//        $passdigest = base64_encode(pack('H*',sha1(pack('H*', $nonce) . pack('a*',$timestamp).pack('a*',$this->password))));
                   
		$nonce = base64_encode(pack('H*', sha1(pack('H*', $nonce))));
		
		$auth= null;
		if ($this->username != null && $this->password != null) {
        $auth='
        		<wsse:Security SOAP-ENV:mustUnderstand="true" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
					<wsse:UsernameToken wsu:Id="UsernameToken-1" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
						<wsse:Username>'.$this->username.'</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$this->password.'</wsse:Password>
						<wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$nonce.'</wsse:Nonce>
						<wsu:Created>'.$timestamp.'</wsu:Created>
					</wsse:UsernameToken>
				</wsse:Security>
				';
		}
		
        /* XSD_ANYXML (or 147) is the code to add xml directly into a SoapVar.
         * Using other codes such as SOAP_ENC, it's really difficult to set the
         * correct namespace for the variables, so the axis server rejects the
         * xml.
         */
        $authvalues = new SoapVar($auth,XSD_ANYXML);
        $header = new SoapHeader("http://docs.oasis-open.org/wss/2004/01/oasis-".
            "200401-wss-wssecurity-secext-1.0.xsd", "Security", $authvalues, true);

        return $header;
    }

    
 	/** 
 	 * Overwrites the original method adding the security header. As you can
     * see, if you want to add more headers, the method needs to be modifyed
     */
    public final function __soapCall($function_name, $arguments, $options=array(), $input_headers= array(), &$output_headers=array()) {	
            	  
    	$result = parent::__soapCall($function_name, $arguments, $options, $this->getWSsecurityHeader(),$output_headers);
    	
    	if (isset($this->options['debug']) && $this->options['debug']) {		
			$this->logLastWSResponse();
		}
		return $result;
    }
   
	public final function getUsername() {
		return $this->username;
	}
}
