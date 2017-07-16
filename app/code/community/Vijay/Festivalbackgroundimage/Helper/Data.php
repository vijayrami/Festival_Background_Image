<?php

class Vijay_Festivalbackgroundimage_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * convert array to options
     *
     * @access public
     * @param $options
     * @return array
     * @author Ultimate Module Creator
     */
    public function convertOptions($options)
    {
        $converted = array();
        foreach ($options as $option) {
            if (isset($option['value']) && !is_array($option['value']) &&
                isset($option['label']) && !is_array($option['label'])) {
                $converted[$option['value']] = $option['label'];
            }
        }
        return $converted;
    }
    public function canShowjQuery()
    {
    	if(Mage::getStoreConfig('vijay_festivalbackgroundimage/general/is_enabled') == true && Mage::getStoreConfig('vijay_festivalbackgroundimage/frontend/includejquery') == true) {
    		return 'festivalbackgroundimage/jquery-3.1.1.min.js';
    	}
    }
}
