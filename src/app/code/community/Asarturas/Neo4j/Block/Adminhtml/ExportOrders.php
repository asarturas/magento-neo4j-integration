<?php

class Asarturas_Neo4j_Block_Adminhtml_ExportOrders
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected $_template = 'asarturas_neo4j/config/exportOrders.phtml';

    public function getExportAllOrdersUrl()
    {
        return Mage::getSingleton('adminhtml/url')->getUrl('asarturas_neo4j/exportOrders/all');
    }

    /**
     * Generate synchronize button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id'        => 'export_all_orders_button',
                'label'     => $this->helper('adminhtml')->__('Export All Orders'),
                'onclick'   => 'javascript:exportAllOrders(); return false;'
            ));

        return $button->toHtml();
    }

    public function isConfigured()
    {
        return Mage::getStoreConfig('asarturas_neo4j/config/username')
            && Mage::getStoreConfig('asarturas_neo4j/config/password');
    }

    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
}
