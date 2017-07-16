<?php
class Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        $this->_controller         = 'adminhtml_festivalbackground';
        $this->_blockGroup         = 'vijay_festivalbackgroundimage';
        parent::__construct();
        $this->_headerText         = Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground');
        $this->_updateButton('add', 'label', Mage::helper('vijay_festivalbackgroundimage')->__('Add Festivalbackground'));

    }
}
