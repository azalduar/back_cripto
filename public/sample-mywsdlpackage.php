<?php
/**
 * Test with MyWsdlPackage for 'var/wsdltophp.com/storage/wsdls/0eb1e771810808d4f6a04a8020c221fe/wsdl.xml'
 * @package MyWsdlPackage
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-11-08
 */
ini_set('memory_limit','512M');
ini_set('display_errors',true);
error_reporting(-1);
/**
 * Load autoload
 */
require_once dirname(__FILE__) . '/MyWsdlPackageAutoload.php';
/**
 * Wsdl instanciation infos. By default, nothing has to be set.
 * If you wish to override the SoapClient's options, please refer to the sample below.
 * 
 * This is an associative array as:
 * - the key must be a MyWsdlPackageWsdlClass constant beginning with WSDL_
 * - the value must be the corresponding key value
 * Each option matches the {@link http://www.php.net/manual/en/soapclient.soapclient.php} options
 * 
 * Here is below an example of how you can set the array:
 * $wsdl = array();
 * $wsdl[MyWsdlPackageWsdlClass::WSDL_URL] = 'var/wsdltophp.com/storage/wsdls/0eb1e771810808d4f6a04a8020c221fe/wsdl.xml';
 * $wsdl[MyWsdlPackageWsdlClass::WSDL_CACHE_WSDL] = WSDL_CACHE_NONE;
 * $wsdl[MyWsdlPackageWsdlClass::WSDL_TRACE] = true;
 * $wsdl[MyWsdlPackageWsdlClass::WSDL_LOGIN] = 'myLogin';
 * $wsdl[MyWsdlPackageWsdlClass::WSDL_PASSWD] = '**********';
 * etc....
 * Then instantiate the Service class as: 
 * - $wsdlObject = new MyWsdlPackageWsdlClass($wsdl);
 */
/**
 * Examples
 */


/**************************************
 * Example for MyWsdlPackageServiceList
 */
$myWsdlPackageServiceList = new MyWsdlPackageServiceList();
// sample call for MyWsdlPackageServiceList::_list()
if($myWsdlPackageServiceList->_list($_int))
    print_r($myWsdlPackageServiceList->getResult());
else
    print_r($myWsdlPackageServiceList->getLastError());

/***************************************
 * Example for MyWsdlPackageServiceCheck
 */
$myWsdlPackageServiceCheck = new MyWsdlPackageServiceCheck();
// sample call for MyWsdlPackageServiceCheck::check()
if($myWsdlPackageServiceCheck->check($_int))
    print_r($myWsdlPackageServiceCheck->getResult());
else
    print_r($myWsdlPackageServiceCheck->getLastError());
