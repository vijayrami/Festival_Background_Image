<?php

class Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('festivalbackground_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_festivalbackground',
            array(
                'label'   => Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground'),
                'title'   => Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground'),
                'content' => $this->getLayout()->createBlock(
                    'vijay_festivalbackgroundimage/adminhtml_festivalbackground_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve festivalbackground entity
     *
     * @access public
     * @return Vijay_Festivalbackgroundimage_Model_Festivalbackground
     * @author Ultimate Module Creator
     */
    public function getFestivalbackground()
    {
        return Mage::registry('current_festivalbackground');
    }
}
