<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Rohde_AdvancedCms_Block_Adminhtml_Cms_Page_Grid_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public $isModule;
    public $isPageConfig;
    public $isPageMass;
    public $isPageEditAction;
    public $isPageEditInline;


    public function __construct()
    {
        $this->isModule = Mage::getStoreConfig('rohde_advancedcms/general_config/enabled');
        $this->isPageConfig = Mage::getStoreConfig('rohde_advancedcms/page_config/enabled');
        $this->isPageMass = Mage::getStoreConfig('rohde_advancedcms/page_config/page_mass_action');
        $this->isPageEditAction = Mage::getStoreConfig('rohde_advancedcms/page_config/page_edit_action');
        $this->isPageEditInline = Mage::getStoreConfig('rohde_advancedcms/page_config/page_edit_inline');
    }

    public function render(Varien_Object $row)
    {
        $urlModel = Mage::getModel('core/url')->setStore($row->getData('_first_store_id'));
        $href = $urlModel->getUrl(
            $row->getIdentifier(), array(
                '_current' => false,
                '_query' => '___store='.$row->getStoreCode()
           )
        );
        $getData = $row->getData();
        $message = Mage::helper('rohde_advancedcms')->__('Are you sure you want to delete this page?');
        $pageID = $getData['page_id'];
        $editLink = $this->getUrl('*/*/edit',array('page_id' => $pageID));
        if($this->isModule && $this->isPageConfig && $this->isPageEditAction){
            $editOption = '<a href="'.$editLink.'">Edit</a>&nbsp;&nbsp;&nbsp;';
        }else{
            $editOption = '';
        }
        $delete = Mage::helper('adminhtml')->getUrl('adminhtml/advancedcms/delete', array('page_id' => $pageID));
        if($this->isModule && $this->isPageConfig) {
            $deleteOption = '<a href="#" onclick="deleteConfirm(\''.$message.'\', \'' . $delete . '\')">Delete</a>';
        }else{
            $deleteOption = '';

        }
        $link = '<a href="'.$href.'" target="_blank">'.$this->__('Preview').'</a>&nbsp;&nbsp;&nbsp;' . $editOption . $deleteOption;
        return $link;
    }
}
