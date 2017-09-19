<?php

class NoName_ShippingMethodsForCustomerGroup_Model_System_Source_Customer_Group
{
    /**
     * Customer group collection
     * @var Mage_Customer_Model_Resource_Group_Collection 
     */
    private $collection = null;
    
    /**
     * Customer group options array 
     * @return array
     */
    private $options = array();
    
    /**
     * Customer gtoup collection to option array
     * @return array
     */
    public function toOptionArray()
    {
        if (
            $this->getCustomerGroupCollection() && 
            !$this->options
        ) {
            foreach ($this->collection as $item) {
                array_push($this->options, array('value' => $item->getCustomerGroupId(), 'label' => $item->getCustomerGroupCode()));
            }
        }
    
        return $this->options;
    }

    /**
     * Get customer group collection
     * @return Mage_Customer_Model_Resource_Group_Collection
     */
    private function getCustomerGroupCollection() 
    {
        if (!$this->collection) {
            $this->collection = Mage::getResourceModel('customer/group_collection');
        }
        
        return $this->collection;
    }
}