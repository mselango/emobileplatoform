<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 06/27/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 */

namespace eMobilePlatform_SDK;

require_once('includes/classes/Param.php');
require_once('includes/classes/Result.php');

/**
 * This class is the main file for the eMobilePlatform - SDK package. This class
 * controls the creating of the properly formatted XML and the transmitting of 
 * said XML to eMobilePlatform's systems.
 *
 * @copyright (c) 2013, AvidMobile, LLC
 * @license ../license.txt
 * @package eMobilePlatform_SDK
 * @version 1.0
 */
final class eMobilePlatform {

	const API_URL = 'https://api.emobileplatform.com/V1/';

	//const API_URL = '../../cwv/AvidMobile_API/V1/';
	/**
	 * The username that is used to connect to the API.
	 * 
	 * @var string
	 */
	private $username;

	/**
	 * The API key that is used to authenticate the API user.
	 * Contact the support department for a replacement.
	 * 
	 * @var string 
	 */
	private $apiKey;

	/**
	 * The default constructor for this class. It is recommended that 
	 * the values passed be named constants in your PHP5 application.
	 * 
	 * @param string $username
	 * @param string $apiKey
	 * @throws \InvalidArgumentException
	 */
	public function __construct($username, $apiKey) {

		if (empty($username) || empty($apiKey))
			throw new \InvalidArgumentException('Credentials must be supplied');

		$this->username = $username;

		$this->apiKey = $apiKey;
	}

	/**
	 * This function executes the eMobilePlatform operation. Simply supply
	 * the group and method name. Most actions will require an additional 
	 * parameter object. See the documentation for more information.
	 * 
	 * @param string $groupName The family of functions to access.
	 * @param string $methodName The specific operation to preform.
	 * @param Param $params An optional param object.
	 * @return Result A result object.
	 * @throws \InvalidArgumentException
	 */
	public function executeAction($groupName, $methodName, Param $params = null) {

		if (!is_string($groupName) || !is_string($methodName) ||
				(!($params instanceof Param) && $params !== null))
			throw new \InvalidArgumentException('Invalid Arguments Supplied');

		$xml = $this->generateXML($groupName, $methodName, $params->getArray());

		if ($xml === null)
			return new Result(Result::ERROR_LEVEL_FATAL, 'XML content could not be generated!');
		
		$responseXML = $this->sendXML($xml);

		if ($responseXML === null)
			return new Result(Result::ERROR_LEVEL_FATAL, 'A cURL error occured');

		$result = $this->parseResult($responseXML);

		return $result;
	}

	/**
	 * Generates and returns the XML required by the eMobilePlatform API.
	 * 
	 * @param string $groupName The family of functions to access.
	 * @param string $methodName The specific operation to preform.
	 * @param array|null $params An optional array of parameters.
	 * @return string The returned XML as a string.
	 * @throws \InvalidArgumentException
	 */
	private function generateXML($groupName, $methodName, $params = null) {

		if (!is_string($groupName) || !is_string($methodName) ||
				(!is_array($params) && $params !== null))
			throw new \InvalidArgumentException('Invalid Arguments Supplied');

		$xmlWriter = new \XMLWriter();

		$xmlWriter->openMemory();

		$xmlWriter->startDocument('1.0', 'UTF-8');

		$xmlWriter->setIndent(4);

		$xmlWriter->startElement('operation');
		$xmlWriter->writeAttribute('api_version', '1.0');
		$xmlWriter->writeAttribute('type', 'submit');

		/* Writes the auth element section. */
		$xmlWriter->startElement('auth');
		$xmlWriter->writeAttribute('username', $this->username);
		$xmlWriter->writeAttribute('api_key', $this->apiKey);
		$xmlWriter->endElement();

		/* Writes the action element section. */
		$xmlWriter->startElement('action');
		$xmlWriter->writeAttribute('group', $groupName);
		$xmlWriter->writeAttribute('method', $methodName);
		$xmlWriter->endElement();

		/* Writes the optional param element. */
		$xmlWriter->startElement('param');

		if ($params !== null) 
		{
			$xmlWriter->writeAttribute('null', 'false');
			
			foreach ($params as $key => $value) 
			{
				if (is_array($value)) 
				{
					foreach ($value as $item) 
					{

						$xmlWriter->startElement($key);
						$xmlWriter->writeAttribute('type', gettype($item));
						$xmlWriter->endAttribute();
						$xmlWriter->text($item);
						$xmlWriter->endElement();
					}
				} 
				else 
				{
					$xmlWriter->startElement($key);
					$xmlWriter->writeAttribute('type', gettype($value));
					$xmlWriter->endAttribute();
					$xmlWriter->text($value);
					$xmlWriter->endElement();
				}
			}
		} 
		else 
		{
			$xmlWriter->writeAttribute('null', 'true');
		}

		/* Close the optional data element. */
		$xmlWriter->endElement();

		/* Close the response element. */
		$xmlWriter->endElement();

		/* End the XML document. */
		$xmlWriter->endDocument();

		$xml = $xmlWriter->outputMemory(true);

		return $xml;
	}

	/**
	 * Parses the returned XML and creates an API result object.
	 * 
	 * @param string $resultXML The XML string from cURL.
	 * @return Result An API result object.
	 * @throws \InvalidArgumentException
	 */
	private function parseResult($resultXML) {

		if (empty($resultXML))
			throw new \InvalidArgumentException('Invalid XML document');

		libxml_use_internal_errors(true);
		
		$xml = new \XMLReader();
		$xml->XML($resultXML);
		$data = self::xml2assoc($xml);

		try 
		{
			$responseObj = new \SimpleXMLElement($resultXML);
		} 
		catch (\Exception $ex) 
		{
			return new Result(Result::ERROR_LEVEL_FATAL, 'A cURL error occurred. Bad response - ' . $ex->getMessage());
		}

		$statusObj = $responseObj->status[0]->attributes();

		$code = (int) $statusObj->code;

		$message = (string) $statusObj->message;
		
		$result = new Result($code, $message, $data['response']['data']);

		return $result;
	}
	
	/**
	 * Helper function for parseResult function
	 * Parses xml content and converts it into an associative array
	 * 
	 * @param type $xml
	 * @return associative array
	 */
	public function xml2assoc($xml) 
	{
		$assoc = null;
		while ($xml->read()) 
		{
			switch ($xml->nodeType) 
			{
				case \XMLReader::END_ELEMENT: return $assoc;
				
				case \XMLReader::ELEMENT:
					$assoc[$xml->name]= ($xml->isEmptyElement ? '' :self::xml2assoc($xml));
					break;
				
				case \XMLReader::TEXT:
					
				case \XMLReader::CDATA: $assoc .= $xml->value;
			}
		}
		return $assoc;
	}

	/**
	 * Sends the XML to the API servers and then receives a response. The response
	 * is returned as a XML string. This function writes to the the PHP
	 * error log if there is a cURL error.
	 * 
	 * @param string $xml
	 * @return string|null XML
	 * @throws \InvalidArgumentException
	 */
	private function sendXML($xml) 
	{

		if (empty($xml))
			throw new \InvalidArgumentException('Invalid XML document');

		$curl = curl_init(self::API_URL);

		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=UTF-8'));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) .
				'/includes/certs/cacert_mozilla_bundle.pem');
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);

		$response = curl_exec($curl);

		if (curl_errno($curl) !== 0)
			error_log(curl_error($curl));

		curl_close($curl);
		if (empty($response))
			return null;

		return $response;
	}

}

?>