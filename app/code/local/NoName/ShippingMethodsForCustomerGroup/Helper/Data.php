<?php

class NoName_ShippingMethodsForCustomerGroup_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ALLOW  = 'carriers/%s/allowforspecificcustomergroup';
    const XML_PATH_GROUPS = 'carriers/%s/customergroups';
    
    /**
     * Check if current shipping method is allowed for current customer group
     * @param string $carrierCode
     * @return boolean
     */
    public function isAllowed($carrierCode)
    {
        if ($this->getIsAllowForSpecificCustomerGroup($carrierCode)) {
            $allowedGroups = $this->getAllowedCustomerGroups($carrierCode);
            if (!in_array(Mage::getSingleton('customer/session')->getCustomerGroupId(), $allowedGroups)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Get allowforspecificcustomergroup flag for crent sippinmeho
     * @param string $carrierCode
     * @return boolean
     */
    private function getIsAllowForSpecificCustomerGroup($carrierCode)
    {
        if ($carrierCode) {
            return Mage::getStoreConfigFlag(sprintf(self::XML_PATH_ALLOW, $carrierCode));
        }
        
        return false;
    }
    
    /**
     * Get allowed customer gtoup ids for current shipping method
     * @param string $carrierCode
     * @return array
     */
    private function getAllowedCustomerGroups($carrierCode)
    {
        if ($carrierCode) {
            $allowedCustomerGroups = Mage::getStoreConfig(sprintf(self::XML_PATH_GROUPS, $carrierCode));
            if ($allowedCustomerGroups) {
                return explode(',', $allowedCustomerGroups);
            }
        }
        
        return array();
    }
}