<?php

/*
 * Application: eMobilePlatform SDK
 * Date Created: 11/26/2013
 * Copyright: AvidMobile, LLC 2013
 * Version: 1.0
 *
 * This application exists to allow outside connections to the eMobilePlatform.
 * This API works by sending and receiving both well-formed and valid
 * XML documents. See the documentation for more information.
 */

/*
 * This file demonstrates how to update an account via the API.
 * 
 * The fields/arguments required are:
 * 
  a. Subdomain
  b. Company Name
  c. Business Details
  d. Address Type
  e. Address Line1
  f. City
  g. State
  h. Zip
  i. Phone
  j. Account Permission Group ID
  k. Shortcodes
  l. Account_id

 */

require_once('../eMobilePlatform.php');

use eMobilePlatform_SDK as eMobile;

define('EMOBILE_USERNAME', 'ENTER_USERNAME_HERE');

define('EMOBILE_API_KEY', 'ENTER_API_KEY_HERE');

$e = new eMobile\eMobilePlatform(EMOBILE_USERNAME, EMOBILE_API_KEY);

$p = new eMobile\Param();
try
{
	/**
	 * @param type int account_id The account_id of the account to be updated
	 */
	$p->addParam('account_id', XXXX);

	/**
	 * @param type string company_name
	 */
	$p->addParam('company_name', 'ACME Test Company');

	/**
	 * @param type string business_details. The description about the comapny
	 */
	$p->addParam('business_details', 'Mobile Marketing');

	/**
	 * @param type string subdomain. The subdomain for the account
	 *  Must be a valid sub-domain and must be unique.
	 */
	$p->addParam('subdomain', 'acme');

	/**
	 * @param type string address_type
	 *  Must be either 'business', 'apartment', or 'house'.
	 */
	$p->addParam('address_type', 'business');

	/**
	 * @param type string address_line1. The mailing address for the account
	 *  Address_line2 can also be used. Look in the optional parameters section below
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
	$p->addParam('state', 'MO');

	/**
	 * @param type string/int zip
	 *  Must contain a 5 or 7 digit zip code.
	 */
	$p->addParam('zip', 'XXXXX');

	/**
	 * @param type string country
	 *  Must contain a two character country code. US or CA.
	 */
	$p->addParam('country', 'US');

	/**
	 * @param type string/int phone. The phone number for the account
	 *  Must be a 10 digit phone number
	 */
	$p->addParam('phone', 'XXXXXXXXXX');

	/**
	 * @param type array shortcodes. The shortcodes that the created account will have access to.
	 *  May contain a single shortcode, or an array of shortcodes.
	 */
	$p->addParam('shortcodes', array('72727'));
	
	/**
	 * @param type int account_permission_group_id. The permissions for the account
	 */
	$p->addParam('account_permission_group_id', XXXX);
	
	
	/**
	 * @todo Remove any parameters below that you are not using 
	 *
	 * All parameters below are optional
	 * If you do not want to pass any of these parameters to the API simply remove those addParam statements
	 */

	/**
	 * @param type string address_line2. The address line 2 for the mailing address for the account
	 */
	$p->addParam('address_line2', 'APT 1001');
	
	/**
	 * @param type string/int fax. The fax number for the account
	 */
	$p->addParam('fax', '5555555555');

	
	$r = $e->executeAction('account', 'update', $p);

	if ($r->isSuccessful())
	{
		echo 'Account Updated Susccessfully';
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