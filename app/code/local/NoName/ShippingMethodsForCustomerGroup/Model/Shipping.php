<?php

class NoName_ShippingMethodsForCustomerGroup_Model_Shipping extends Mage_Shipping_Model_Shipping
{
    /**
     * Collect rates of given carrier
     *
     * @rewrite For added allow/disallow for specific custoemr grpoups
     * 
     * @param string                           $carrierCode
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Shipping
     */
    public function collectCarrierRates($carrierCode, $request)
    {
        if (!Mage::helper('spmethodsforcustoemrgroup')->isAllowed($carrierCode)) {
            return $this;
        }
        
        return parent::collectCarrierRates($carrierCode, $request);
    }
}
