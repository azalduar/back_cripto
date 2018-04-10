<?php
/**
 * File for class MyWsdlPackageServiceList
 * @package MyWsdlPackage
 * @subpackage Services
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-11-08
 */
/**
 * This class stands for MyWsdlPackageServiceList originally named List
 * @package MyWsdlPackage
 * @subpackage Services
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-11-08
 */
class MyWsdlPackageServiceList extends MyWsdlPackageWsdlClass
{
    /**
     * Method to call the operation originally named list
     * @uses MyWsdlPackageWsdlClass::getSoapClient()
     * @uses MyWsdlPackageWsdlClass::setResult()
     * @uses MyWsdlPackageWsdlClass::saveLastError()
     * @param int $_int
     * @return string
     */
    public function _list($_int)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->list($_int));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Returns the result
     * @see MyWsdlPackageWsdlClass::getResult()
     * @return string
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
