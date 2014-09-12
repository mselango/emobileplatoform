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
 * This class is the main file for the eMobilePlatform - SDK package. This class
 * controls the creating of the properly formatted XML and the transmitting of 
 * said XML to the eMobilePlatform systems.
 *
 * @copyright (c) 2013, AvidMobile, LLC
 * @license ../license.txt
 * @package eMobilePlatform_SDK
 * @version 1.0
 */
final class Param {
	
	/**
	 * This data member contains the count of the number of parameters.
	 * 
	 * @var int
	 */
	private $paramCount;
	
	/**
	 * 	This data member contains the array of parameters for the API call.
	 * 
	 * @var array
	 */
	private $data;
	
	public function __construct() {
		
		$this->paramCount = 0;
		
		$this->data = array();
	}
	
	/**
	 * Returns a clone of the data structure for processing by the API.
	 * 
	 * @return array A clone of the array.
	 */
	public function getArray() {
		
		return $this->data;	
	}
	
	/**
	 * Returns the count of the number of parameters in the Param
	 * object.
	 * 
	 * @return int The number of parameters.
	 */
	public function getSize() {
		
		return $this->paramCount;	
	}
	
	/**
	 * Adds a parameter to the object. This function is required to be used
	 * than accessing the data structure manually. If the supplied name
	 * is already in use, it will be overwritten.
	 * 
	 * @param string $name The name of the API parameter.
	 * @param string|int|bool|array $value The value of the API parameter.
	 * @throws \InvalidArgumentException
	 */
	public function addParam($name, $value, $required = true) {
		
		if (empty($name) || (empty($value) && $required) || !is_string($name) || 
				(!is_string($value) && !is_numeric($value) && !is_bool($value))
				&& !is_array($value))
			throw new \InvalidArgumentException('Invalid Arguments Supplied');
		
		$this->data[$name] = $value;
		
		$this->paramCount++;
	}
	
	/**
	 * Removes the specified parameter from this param object. This function
	 * returns true if the param was successfully removed. If the param
	 * does not exist, false is returned.
	 * 
	 * @param string $name The parameter name to remove.
	 * @return bool True if the param was removed; false otherwise.
	 * @throws \InvalidArgumentException
	 */
	public function removeParam($name) {
		
		if (empty($name) || !is_string($name))
			throw new \InvalidArgumentException('Invalid Arguments Supplied');
		
		if (!isset($this->data[$name]))
			return false;
		
		unset($this->data[$name]);
		
		$this->paramCount--;
	}
	
}

?>