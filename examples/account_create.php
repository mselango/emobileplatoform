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

/*
 * This file demonstrates how to create an account through the API. 
 */

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'ENTER_USERNAME_HERE');

define('EMOBILE_API_KEY', 'ENTER_API_KEY_HERE');

try
{
	$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

	$p = new eMobile\Param();

	/**
	 * @param type string first_name. The first name for the account
	 */
	$p->addParam('first_name', 'John');

	/**
	 * @param type string last_name. The last name for the account
	 */
	$p->addParam('last_name', 'Doe');

	/**
	 * @param type string company_name. The company name for the account
	 */
	$p->addParam('company_name', 'ACME Test Company');

	/**
	 * @param type string email. The email address for the account
	 *  Must be a unique and valid e-mail address
	 */
	$p->addParam('email', 'john.doe16@example.com');

	/**
	 * @param type int mobile. The mobile phone number for the account
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('mobile', XXXXXXXXXX);

	/**
	 * @param type int phone. The phone number for the account
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('phone', XXXXXXXXXX);

	/**
	 * @param type string website. The website for the account
	 *  Must be a valid domain name.
	 */
	$p->addParam('website', 'example.com');

	/**
	 * @param type string subdomain. The subdomain for the account
	 *  Must be a valid sub-domain and must be unique.
	 */
	$p->addParam('subdomain', 'acme16'); 

	/**
	 * @param type string business_details. The description about the comapny
	 */
	$p->addParam('business_details', 'Mobile Marketing');

	/**
	 * @param type string address_type
	 *  Must be either 'business', 'apartment', or 'house'.
	 */
	$p->addParam('address_type', 'business');

	/**
	 * @param type string address_line1. The mailing address for the account
	 *  Address_line2 can be used in the optional parameters section
	 */
	$p->addParam('address_line1', '12345 Maple Ln.');

	/**
	 * @param type string city
	 */
	$p->addParam('city', 'Madison');

	/**
	 * @param type string state
	 *  Must contain a two character state abbreviation.
	 */
	$p->addParam('state', 'XX');

	/**
	 * @param type string/int zip
	 *  Must contain a 5 or 6 digit zip code with no spaces. 
	 */
	$p->addParam('zip', 'XXXXX');

	/**
	 * @param type string country
	 *  Must contain a two character country code. US or CA.
	 */
	$p->addParam('country', 'US');

	/**
	 * @param type string username. The username used to login to the account
	 *  Must be a unique username. Only letters, numbers and _ allowed.
	 */
	$p->addParam('username', 'rprincipe_test16'); 

	/**
	 * @param type string password. The password used with username to access the account
	 *  Must contain upper and lower case letters with number. Must be between 8-32 characters.
	 */
	$p->addParam('password', 'rprincipeQWERTY202016'); 

	/**
	 * @param type int parent_id. The parent account id under which this account has to be created
	 */
	$p->addParam('parent_id', XXXX);

	/**
	 * @param type array shortcodes. The shortcodes that the created account will have access to.
	 *  May contain a single shortcode, or an array of shortcodes.
	 */
	$p->addParam('shortcodes', array('72727'));
		
	/**
	 * @todo Remove any parameters below that you are not using 
	 *
	 * All parameters below are optional
	 * If you do not want to pass any of these parameters to the API simply remove those addParam statements
	 */
	
	/**
	 * @param type int fax. The fax number for the account
	 */
	$p->addParam('fax', 5555555555);
	
	/**
	 * @param type string address_line2. The address line 2 for the mailing address for the account
	 */
	$p->addParam('address_line2', 'APT 101');


	$r = $e->executeAction('account', 'create', $p);

	if ($r->isSuccessful())
	{
		$data = $r->getData();

		echo 'Account Created Susccessfully';

		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	else
	{
		echo $r->getMessage();
	}
}
catch (\Exception $a)
{
	error_log($a->getMessage());
	echo 'Exception: ' . $a->getMessage();
}

?>