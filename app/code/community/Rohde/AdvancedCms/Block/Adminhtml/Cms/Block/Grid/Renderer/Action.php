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

class Rohde_AdvancedCms_Block_Adminhtml_Cms_Block_Grid_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public $isModule;
    public $isBlockConfig;
    public $isBlockMass;
    public $isBlockEditAction;
    public $isBlockEditInline;

    public function __construct()
    {

        $this->isModule = Mage::getStoreConfig('rohde_advancedcms/general_config/enabled');
        $this->isBlockConfig = Mage::getStoreConfig('rohde_advancedcms/block_config/enabled');
        $this->isBlockMass = Mage::getStoreConfig('rohde_advancedcms/block_config/block_mass_action');
        $this->isBlockEditAction = Mage::getStoreConfig('rohde_advancedcms/block_config/block_edit_action');
        $this->isBlockEditInline = Mage::getStoreConfig('rohde_advancedcms/block_config/block_edit_inline');
    }

    public function render(Varien_Object $row)
    {

        $getData = $row->getData();
        $message = Mage::helper('rohde_advancedcms')->__('Are you sure you want to delete this block?');
        $blockID = $getData['block_id'];
        $editLink = $this->getUrl('*/*/edit',array('block_id' => $blockID));
        $delete = Mage::helper('adminhtml')->getUrl('adminhtml/advancedblock/delete',array('block_id' => $blockID));
        if($this->isModule && $this->isBlockConfig && $this->isBlockEditAction){
            $editAction = '<a href="'.$editLink.'">Edit</a>&nbsp;&nbsp;&nbsp';
        }else{
            $editAction = '';
        }
        $link = $editAction . '<a href="#" onclick="deleteConfirm(\''.$message.'\', \'' . $delete . '\')">Delete</a>';
        return $link;

    }
}
