<?php
/**
 * File for class MyWsdlPackageServiceCheck
 * @package MyWsdlPackage
 * @subpackage Services
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-11-08
 */
/**
 * This class stands for MyWsdlPackageServiceCheck originally named Check
 * @package MyWsdlPackage
 * @subpackage Services
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-11-08
 */
class MyWsdlPackageServiceCheck extends MyWsdlPackageWsdlClass
{
    /**
     * Method to call the operation originally named check
     * @uses MyWsdlPackageWsdlClass::getSoapClient()
     * @uses MyWsdlPackageWsdlClass::setResult()
     * @uses MyWsdlPackageWsdlClass::saveLastError()
     * @param int $_int
     * @return boolean
     */
    public function check($_int)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->check($_int));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Returns the result
     * @see MyWsdlPackageWsdlClass::getResult()
     * @return boolean
     */
    public function getResult()
    {
        return parent::getResult();
    }
    /**
     * Method returning the class name
     * @return string __CLASS__
     */
    public function __toString()
    {
        return __CLASS__;
    }
}
