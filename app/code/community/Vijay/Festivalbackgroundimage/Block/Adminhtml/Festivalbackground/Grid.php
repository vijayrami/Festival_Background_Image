<?php
class Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('festivalbackgroundGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground')
            ->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Id'),
                'index'  => 'entity_id',
                'type'   => 'number'
            )
        );
        $this->addColumn(
            'festivalname',
            array(
                'header'    => Mage::helper('vijay_festivalbackgroundimage')->__('Festival Name'),
                'align'     => 'left',
                'index'     => 'festivalname',
            )
        );
        
        $this->addColumn(
            'status',
            array(
                'header'  => Mage::helper('vijay_festivalbackgroundimage')->__('Status'),
                'index'   => 'status',
                'type'    => 'options',
                'options' => array(
                    '1' => Mage::helper('vijay_festivalbackgroundimage')->__('Enabled'),
                    '0' => Mage::helper('vijay_festivalbackgroundimage')->__('Disabled'),
                )
            )
        );
        $this->addColumn(
            'startdate',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Festival Start Date'),
                'index'  => 'startdate',
                'type'=> 'date',

            )
        );
        $this->addColumn(
            'enddate',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Festival End Date'),
                'index'  => 'enddate',
                'type'=> 'date',

            )
        );
		$this->addColumn(
            'background_target',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Background Target'),
                'index'  => 'background_target',
                'type'  => 'options',
                'options' => Mage::helper('vijay_festivalbackgroundimage')->convertOptions(
                    Mage::getModel('vijay_festivalbackgroundimage/background_attribute_source_backgroundtarget')->getAllOptions(false)
                )

            )
        );
		$this->addColumn(
            'background_custom_target',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Custom CSS selector'),
                'index'  => 'background_custom_target',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'type',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Background Type'),
                'index'  => 'type',
            	'align'     =>'left',
                'type'=> 'number',
            	'renderer'  => 'Vijay_Festivalbackgroundimage_Block_Adminhtml_Renderer_Value',

            )
        );
        $this->addColumn(
            'background',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Background'),
            	'align'     =>'left',
                'index'  => 'background',
                'type'=> 'text',
            	'renderer'  => 'Vijay_Festivalbackgroundimage_Block_Adminhtml_Renderer_Backgroundimg',

            )
        );
        $this->addColumn(
            'created_at',
            array(
                'header' => Mage::helper('vijay_festivalbackgroundimage')->__('Created at'),
                'index'  => 'created_at',
                'width'  => '120px',
                'type'   => 'datetime',
            )
        );
        $this->addColumn(
            'updated_at',
            array(
                'header'    => Mage::helper('vijay_festivalbackgroundimage')->__('Updated at'),
                'index'     => 'updated_at',
                'width'     => '120px',
                'type'      => 'datetime',
            )
        );
        $this->addColumn(
            'action',
            array(
                'header'  =>  Mage::helper('vijay_festivalbackgroundimage')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('vijay_festivalbackgroundimage')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('vijay_festivalbackgroundimage')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('vijay_festivalbackgroundimage')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('vijay_festivalbackgroundimage')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('festivalbackground');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('vijay_festivalbackgroundimage')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('vijay_festivalbackgroundimage')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'      => Mage::helper('vijay_festivalbackgroundimage')->__('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('vijay_festivalbackgroundimage')->__('Status'),
                        'values' => array(
                            '1' => Mage::helper('vijay_festivalbackgroundimage')->__('Enabled'),
                            '0' => Mage::helper('vijay_festivalbackgroundimage')->__('Disabled'),
                        )
                    )
                )
            )
        );
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param Vijay_Festivalbackgroundimage_Model_Festivalbackground
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * after collection load
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Block_Adminhtml_Festivalbackground_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
