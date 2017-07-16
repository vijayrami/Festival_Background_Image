<?php

class Vijay_Festivalbackgroundimage_Model_Adminhtml_Search_Festivalbackground extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return Vijay_Festivalbackgroundimage_Model_Adminhtml_Search_Festivalbackground
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('vijay_festivalbackgroundimage/festivalbackground_collection')
            ->addFieldToFilter('festivalname', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $festivalbackground) {
            $arr[] = array(
                'id'          => 'festivalbackground/1/'.$festivalbackground->getId(),
                'type'        => Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground'),
                'name'        => $festivalbackground->getFestivalname(),
                'description' => $festivalbackground->getFestivalname(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/festivalbackgroundimage_festivalbackground/edit',
                    array('id'=>$festivalbackground->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
