<?php

class Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
        parent::__construct();
        $this->_blockGroup = 'vijay_festivalbackgroundimage';
        $this->_controller = 'adminhtml_festivalbackground';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('vijay_festivalbackgroundimage')->__('Save Festivalbackground')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('vijay_festivalbackgroundimage')->__('Delete Festivalbackground')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('vijay_festivalbackgroundimage')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    protected function _prepareLayout() {
    	if (Mage::registry('current_festivalbackground') && Mage::registry('current_festivalbackground')->getId()) {
    		$type = Mage::registry('current_festivalbackground')->getType();
    		if ($type == 1){
    			$this->getLayout()->getBlock('head')->addJs('festivalbackgroundimage/customimage.js');
    		} elseif ($type == 2){
    			$this->getLayout()->getBlock('head')->addJs('festivalbackgroundimage/customcolor.js');
    		} else {
    			
    		}
    		
    	} else {
    		$this->getLayout()->getBlock('head')->addJs('festivalbackgroundimage/custom.js');
    	}
    	
    	return parent::_prepareLayout();
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_festivalbackground') && Mage::registry('current_festivalbackground')->getId()) {
            return Mage::helper('vijay_festivalbackgroundimage')->__(
                "Edit Festivalbackground '%s'",
                $this->escapeHtml(Mage::registry('current_festivalbackground')->getFestivalname())
            );
        } else {
            return Mage::helper('vijay_festivalbackgroundimage')->__('Add Festivalbackground');
        }
    }
}
