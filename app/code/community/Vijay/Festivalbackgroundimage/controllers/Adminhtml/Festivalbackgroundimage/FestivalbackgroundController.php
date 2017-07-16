<?php

class Vijay_Festivalbackgroundimage_Adminhtml_Festivalbackgroundimage_FestivalbackgroundController extends Vijay_Festivalbackgroundimage_Controller_Adminhtml_Festivalbackgroundimage
{
    /**
     * init the festivalbackground
     *
     * @access protected
     * @return Vijay_Festivalbackgroundimage_Model_Festivalbackground
     */
    protected function _initFestivalbackground()
    {
        $festivalbackgroundId  = (int) $this->getRequest()->getParam('id');
        $festivalbackground    = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground');
        if ($festivalbackgroundId) {
            $festivalbackground->load($festivalbackgroundId);
        }
        Mage::register('current_festivalbackground', $festivalbackground);
        return $festivalbackground;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('vijay_festivalbackgroundimage')->__('Festival Background'))
             ->_title(Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackgrounds'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit festivalbackground - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $festivalbackgroundId    = $this->getRequest()->getParam('id');
        $festivalbackground      = $this->_initFestivalbackground();
        if ($festivalbackgroundId && !$festivalbackground->getId()) {
            $this->_getSession()->addError(
                Mage::helper('vijay_festivalbackgroundimage')->__('This festivalbackground no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getFestivalbackgroundData(true);
        if (!empty($data)) {
            $festivalbackground->setData($data);
        }
        Mage::register('festivalbackground_data', $festivalbackground);
        $this->loadLayout();
        $this->_title(Mage::helper('vijay_festivalbackgroundimage')->__('Festival Background'))
             ->_title(Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackgrounds'));
        if ($festivalbackground->getId()) {
            $this->_title($festivalbackground->getFestivalname());
        } else {
            $this->_title(Mage::helper('vijay_festivalbackgroundimage')->__('Add festivalbackground'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new festivalbackground action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save festivalbackground - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
    	$id= $this->getRequest()->getParam('id');
    	 
        if ($data = $this->getRequest()->getPost('festivalbackground')) {
            try {
                $data = $this->_filterDates($data, array('startdate' ,'enddate'));     
				/* Custom Code Start */
				$postData = $this->getRequest()->getPost();
				
                $festivalbackgroundModel = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground');
            	
                if($postData['type']==1)
                {
                    $background = time().$_FILES['festivalbackground']['name']['backgroundimage'];
                }
                else
                {
                	$background=$postData['festivalbackground']['backgroundcolor'];
                }
				
				if($postData['festivalbackground']['background_target']== 'custom')
                {
                    $backgroundcustomtarget = $postData['festivalbackground']['background_custom_target'];
                }
                else
                {
                	$backgroundcustomtarget='';
                }
				
				 // Start date and enddate must be >= today
               	$today= date("Y-m-d");
				
				if($data['startdate'] >= $today && $data['enddate'] >= $today)
                {
                	// Duplicate start date and enddate not allowed.... Code start... 
                	$collection = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground')->getCollection();
		           $collection->getSelect()
		           ->reset(Zend_Db_Select::COLUMNS)
		           ->columns('startdate')
		           ->columns('entity_id')
		           ->columns('enddate');
				   $collection=$collection->getData();
				   foreach($collection as $row) {
				   		if($id!='' && $id==$row['entity_id'])
				        {
				        	continue;
				        }
						$dsd = strtotime($row['startdate']);
			        	$dsd = date('Y-m-d',$dsd);
			        	$ded = strtotime($row['enddate']);
			        	$ded = date('Y-m-d',$ded);
                        $psd = date('Y-m-d',strtotime($data['startdate']));
			        	$ped = date('Y-m-d',strtotime($data['enddate'])); 
						if((($psd >= $dsd && $psd<= $ded) || ($ped <= $ded && $ped >= $dsd)))
				        {
				        	if($id!='' && $dsd==$psd && $ded==$ped) {
				        		
				            } else {
				            	Mage::getSingleton('adminhtml/session')->addError('Slot Booked..'); 
				          	    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				          	    return false;
				          	}
				        } elseif(($dsd >= $psd && $ded <= $ped)) {
			                if($id!='' && $dsd==$psd && $ded==$ped) {
			                	
			                }
			                else {
			                	Mage::getSingleton('adminhtml/session')->addError('Slot Booked..'); 
			                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			                    return false;
			                }
			        } else {
			        	
			        }
				   }
				   // Duplicate start date and enddate not allowed.... Code End...
				   if(isset($_FILES['festivalbackground']['name']['backgroundimage']) && $_FILES['festivalbackground']['name']['backgroundimage'] != '') 
				   {
				   	try {				   		
				   		if($this->getRequest()->getParam('id'))
                            {
                                $festivalbackgroundModel->load($this->getRequest()->getParam('id'));
                                if($festivalbackgroundModel->getImage())
                                {
                                	$this->removeRequiredImages($festivalbackgroundModel->getImage());
                                }
                            }
							/* Upload Image Code Start */
                            foreach($_FILES['festivalbackground']['name']  as $key =>$image){
							if (!empty($image)) {
								try {
									$filesize = $_FILES['festivalbackground']['size'][$key];
									$fileName = time().$_FILES['festivalbackground']['name'][$key];
	                                $uploader = new Varien_File_Uploader(array(
	                                    'name' => $_FILES['festivalbackground']['name'][$key],
	                                    'type' => $_FILES['festivalbackground']['type'][$key],
	                                    'tmp_name' => $_FILES['festivalbackground']['tmp_name'][$key],
	                                    'error' => $_FILES['festivalbackground']['error'][$key],
	                                    'size' => $_FILES['festivalbackground']['size'][$key]
	                                     ));
					
									$uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png'));
									$uploader->setAllowRenameFiles(false);
									$uploader->setFilesDispersion(false);
									$path = Mage::getBaseDir('media') . DS . 'festivalbackgroundimage';
									
									if(!is_dir($path))
		                            {
		                            	mkdir($path, 0777, true);
		                            }
									
									$id = $this->getRequest()->getParam('id'); 
									
									if ($id != '') {
										$remove = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground')->load($id);
		                            	$remove=$remove->getData();
		                            	$removeimg=$remove['background'];
									}
		                            
							 
									if (($filesize > 200000) && ($id == ''))
		                             {
		                             	$uploader->save($path . DS, $fileName );
										
		                             } elseif (($filesize > 200000) && ($id != '')){
		                             	$uploader->save($path . DS, $fileName );
		                             	//$this->removeFile($removeimg);
		                             	unlink($path . DS . $removeimg);
		                             }
		                             else
		                             {
		                             	Mage::getSingleton('adminhtml/session')->addError("Image Size should be minimum 200 KB");
		                             	//$this->_redirect('*/*/');
		                             	$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
		                             	return;
		                             }                           
					                                
								} catch (Exception $e) { 
					            		Mage::log('Error in upload');                        
					            	}
							}
					        } 
                            /* End code for image upload */
				   		
				   	} catch (Exception $e)
      					{
                            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                            //$this->_redirect('*/*/');
                            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                            return;
                        }
				   }
				} else {
					Mage::getSingleton('adminhtml/session')->addError('Selected Date all ready passed');
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return; 
				}
				/* Custom Code Ends */
                $festivalbackground = $this->_initFestivalbackground();
				/* Set Custom Data Start*/
				
				if( $id =='') {
                    $data['background'] = $background;    
					$data['type'] = $postData['type'];                                
                } else {
              			$id = $this->getRequest()->getParam('id'); 
              			$remove = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground')->load($id);
                     	$remove=$remove->getData();
                     	$removeimg=$remove['background'];
                     	//$this->removeFile($removeimg);  
                     	$data['type'] = $postData['type'];
                     	if ($postData['type'] == 2){
                     		if (isset($postData['festivalbackground']['backgroundcolor']) && ($postData['festivalbackground']['backgroundcolor'] != '')){
                     			$data['background'] = $background;
                     		} else {
                     			$data['background'] = $removeimg;
                     		}
                     		
                     	} else {
                     		if (isset($_FILES['festivalbackground']['name']['backgroundimage']) && $_FILES['festivalbackground']['name']['backgroundimage'] != ''){
                     			$data['background'] = time().$_FILES['festivalbackground']['name']['backgroundimage'];
                     			//unlink($path . DS . $removeimg);
                     		} else {
                     			$data['background'] = $removeimg;
                     		}
                     	}
                     	
                     	
						
                }
				
				$festivalbackground->setData('background_custom_target',$backgroundcustomtarget);
				/* Set Custom Data Ends*/
                $festivalbackground->addData($data);
                $festivalbackground->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $festivalbackground->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_festivalbackgroundimage')->__('There was a problem saving the festivalbackground.')
                );
                Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('vijay_festivalbackgroundimage')->__('Unable to find festivalbackground to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete festivalbackground - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $festivalbackground = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground');
                $festivalbackground->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vijay_festivalbackgroundimage')->__('Festivalbackground was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_festivalbackgroundimage')->__('There was an error deleting festivalbackground.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('vijay_festivalbackgroundimage')->__('Could not find festivalbackground to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete festivalbackground - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $festivalbackgroundIds = $this->getRequest()->getParam('festivalbackground');
        if (!is_array($festivalbackgroundIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vijay_festivalbackgroundimage')->__('Please select festivalbackgrounds to delete.')
            );
        } else {
            try {
                foreach ($festivalbackgroundIds as $festivalbackgroundId) {
                    $festivalbackground = Mage::getModel('vijay_festivalbackgroundimage/festivalbackground');
                    $festivalbackground->setId($festivalbackgroundId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vijay_festivalbackgroundimage')->__('Total of %d festivalbackgrounds were successfully deleted.', count($festivalbackgroundIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_festivalbackgroundimage')->__('There was an error deleting festivalbackgrounds.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $festivalbackgroundIds = $this->getRequest()->getParam('festivalbackground');
        if (!is_array($festivalbackgroundIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vijay_festivalbackgroundimage')->__('Please select festivalbackgrounds.')
            );
        } else {
            try {
                foreach ($festivalbackgroundIds as $festivalbackgroundId) {
                $festivalbackground = Mage::getSingleton('vijay_festivalbackgroundimage/festivalbackground')->load($festivalbackgroundId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d festivalbackgrounds were successfully updated.', count($festivalbackgroundIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vijay_festivalbackgroundimage')->__('There was an error updating festivalbackgrounds.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'festivalbackground.csv';
        $content    = $this->getLayout()->createBlock('vijay_festivalbackgroundimage/adminhtml_festivalbackground_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'festivalbackground.xls';
        $content    = $this->getLayout()->createBlock('vijay_festivalbackgroundimage/adminhtml_festivalbackground_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'festivalbackground.xml';
        $content    = $this->getLayout()->createBlock('vijay_festivalbackgroundimage/adminhtml_festivalbackground_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('vijay_festivalbackgroundimage/festivalbackground');
    }
}
