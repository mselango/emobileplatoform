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

/**
 * This class creates a result object after an API operation has occurred.
 * This result object will contain the status code and status message
 * for every API operation. Additionally, it may contain an array of 
 * results.
 * 
 * @copyright (c) 2013, AvidMobile, LLC
 * @license ../license.txt
 * @package eMobilePlatform_SDK
 * @version 1.0
 */
final class Result {
	
	/** 
	 * The error code that represents the operation completed with success.
	 * 
	 * @var int
	 */
	const ERROR_LEVEL_SUCCESS = 0;
	
	/** 
	 * The error code that represents a warning.
	 * For example, a non-critical name conflict occurs.
	 * 
	 * @var int
	 */
	const ERROR_LEVEL_WARNING = 1;
	
	/** 
	 * The error code that represents a fatal error.
	 * For example, the wrong credentials were supplied.
	 * 
	 * @var int
	 */
	const ERROR_LEVEL_FATAL = 2;
	
	/**
	 * The eMobilePlatform API constants for an error's status.
	 * 
	 * @var int
	 */
	private $code;
	
	/**
	 * An optional parameter that can be used to return information from
	 * the API.
	 * 
	 * @var array
	 */
	private $data;
	
	/**
	 * The human friendly message of the API response.
	 * 
	 * @var string
	 */
	private $message;
	
	/**
	 * The constructor that creates a result object.
	 * 
	 * @param int $code The status code of the operation.
	 * @param string $message The status message of the operation.
	 * @param array|null $data The optional result array.
	 * @throws \InvalidArgumentException
	 */
	public function __construct($code, $message, $data = null) {
		
		if (!isset($code, $message) || !is_int($code) ||
				!is_string($message) || (!is_array($data) && $data !== null))
			throw new \InvalidArgumentException('Invalid Arguments Supplied');
		
		$this->code = $code;
		
		$this->message = $message;
		
		$this->data = $data;
	}
	
	/**
	 * Returns the status code.
	 * 
	 * @return int
	 */ 
	public function getCode() {
		
		 return $this->code;
	 }

	 /**
	  * Returns the structure of data to be returned to the user.
	  * 
	  * @return array
	  */
	 public function getData() {
		 
		 return $this->data;
	 }

	 /**
	  * Gets the human friendly status message.
	  * 
	  * @return string
	  */
	 public function getMessage() {
		 
		 return $this->message;
	 }
	 
	 /**
	  * Returns true if the API operation was successful. It returns false
	  * otherwise.
	  * 
	  * @return bool True on success; false otherwise.
	  */
	 public function isSuccessful() {
		 
		 if ($this->code === self::ERROR_LEVEL_SUCCESS)
			 return true;
		 
		 return false; 
	 }
}

?>