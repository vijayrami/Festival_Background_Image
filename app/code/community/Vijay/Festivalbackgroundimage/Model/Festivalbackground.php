<?php

class Vijay_Festivalbackgroundimage_Model_Festivalbackground extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'vijay_festivalbackgroundimage_festivalbackground';
    const CACHE_TAG = 'vijay_festivalbackgroundimage_festivalbackground';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'vijay_festivalbackgroundimage_festivalbackground';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'festivalbackground';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('vijay_festivalbackgroundimage/festivalbackground');
    }

    /**
     * before save festivalbackground
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Model_Festivalbackground
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * save festivalbackground relation
     *
     * @access public
     * @return Vijay_Festivalbackgroundimage_Model_Festivalbackground
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        return $values;
    }
    
}
