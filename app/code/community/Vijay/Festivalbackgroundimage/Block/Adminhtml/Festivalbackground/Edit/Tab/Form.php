<?php

class Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('festivalbackground_');
        $form->setFieldNameSuffix('festivalbackground');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'festivalbackground_form',
            array('legend' => Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground'))
        );
		
        /* Custom Code Start */
        $URLID=$this->getRequest()->getParam('id');
        if (!empty($URLID) && $URLID != '') {
        	$true = false;
        } else {
        	$true = true;
        }
        $_edited_banner = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground')->load($URLID);
        $_edited_banner = ($_edited_banner->getdata());
        $type=$_edited_banner['type'];
        $bimg="";
        $bcolor="";
        if($type==1)
        {
        	$bimg='<br/>&nbsp;<div style="padding-top:5px;padding-bottom:5px" id="imagetag"><img src="'.Mage::getBaseUrl('media') . 'festivalbackgroundimage'.DS.$_edited_banner['background'].'" width=250px height=250/></div>';
        }
        else
        {
        	$bcolor='<br/>&nbsp;<div style="padding-top:5px;padding-bottom:5px;width:30px;height:30px; background-color:'.$_edited_banner['background'].'" id="colortag" ></div>';
        }
        /* Custom Code ends */
        
        $fieldset->addField(
            'festivalname',
            'text',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Festival Name'),
                'name'  => 'festivalname',
                'note'	=> $this->__('Enter Festival Name Here'),
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'startdate',
            'date',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Festival Start Date'),
                'name'  => 'startdate',
                'note'	=> $this->__('Enter Festival Start Date Here'),
                'required'  => true,
                'class' => 'required-entry validate-date validate-date-range date-range-festivalbackground-from',

            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format'  => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
           )
        );

        $fieldset->addField(
            'enddate',
            'date',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Festival End Date'),
                'name'  => 'enddate',
                'note'	=> $this->__('Enter Festival End Date Here'),
                'required'  => true,
                'class' => 'required-entry validate-date validate-date-range date-range-festivalbackground-to',

            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format'  => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
           )
        );
		$typefield = $fieldset->addField(
            'background_target',
            'select',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Background Target'),
                'name'  => 'background_target',
                'required'  => true,
                'class' => 'required-entry',

                'values'=> Mage::getModel('vijay_festivalbackgroundimage/background_attribute_source_backgroundtarget')->getAllOptions(true),
                'onchange' => 'onchangeStyleShow(this.value)',
           )
        );
		$typefield->setAfterElementHtml("<script type=\"text/javascript\">
            function onchangeStyleShow(e){
                if (e == 'custom'){
 				$('festivalbackground_background_custom_target').addClassName('required-entry');
                } else {
               	$('festivalbackground_background_custom_target').removeClassName('required-entry');
                }
            }
        </script>");
		$fieldset->addField(
            'background_custom_target',
            'text',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Custom CSS selector'),
                'name'  => 'background_custom_target',
                'required'  => false,
                'note'=>'Input CSS selector, like .class or #id',
           )
        );
		$this->setChild(
		'form_after', 
		$this->getLayout()
			->createBlock('adminhtml/widget_form_element_dependence')
			->addFieldMap('festivalbackground_background_target', 'festivalbackground_background_target')
	        ->addFieldMap('festivalbackground_background_custom_target', 'festivalbackground_background_custom_target')
	        ->addFieldDependence('festivalbackground_background_custom_target', 'festivalbackground_background_target', 'custom')
		);
        /*$fieldset->addField(
            'type',
            'radios',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Background Type'),
                'name'  => 'type',
            		'values' => array(
            				array('id'=>'image','value'=>'1','label'=>'Image'),
            				array('id'=>'color','value'=>'2','label'=>'Color'),
            		),
                'required'  => false,
                'class' => 'validate-one-required',

           )
        );*/
        
       $fieldset->addField('type', 'radios', array(
          'label'     => Mage::helper('vijay_festivalbackgroundimage')->__('Background Type'),
          'name'      => 'type',
		  'onclick' => "",
		  'onchange' => "",
		  'value'  => '2',
		  'values' => array(
		  					array('id'=>'image','value'=>'1','label'=>'Image'),
            				array('id'=>'color','value'=>'2','label'=>'Color'),
		  			   ),
		  'disabled' => false,
		  'readonly' => false,
		  //'after_element_html' => '<small>Comments</small>',
		  'tabindex' => 1,
		  'class' => 'validate-one-required-by-name',
		));
		
        $fieldset->addField('backgroundcolor', 'text', array(
        		'label'     => Mage::helper('vijay_festivalbackgroundimage')->__('Background Color'),
        		'name'      => 'backgroundcolor',
        		'class'     => 'color {required:true, adjust:true, hash:true} validate-hex',
        		'required'  => $true,
        		'after_element_html' => $bcolor,
        ));
        
        
        $fieldset->addField('backgroundimage', 'file', array(
        		'label'     => Mage::helper('vijay_festivalbackgroundimage')->__('Background Image'),
        		'name'      => 'backgroundimage',
        		'required'  => $true,
        		'after_element_html' =>$bimg,
        ));
        
        /*$fieldset->addField(
            'background',
            'text',
            array(
                'label' => Mage::helper('vijay_festivalbackgroundimage')->__('background'),
                'name'  => 'background',
                'required'  => true,
                'class' => 'required-entry',

           )
        );*/
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('vijay_festivalbackgroundimage')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('vijay_festivalbackgroundimage')->__('Disabled'),
                    ),
                ),
            )
        );
        
        $formValues = Mage::registry('current_festivalbackground')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getFestivalbackgroundData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getFestivalbackgroundData());
            Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData(null);
        } elseif (Mage::registry('current_festivalbackground')) {
            $formValues = array_merge($formValues, Mage::registry('current_festivalbackground')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
