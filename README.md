Installation
============

1. Copy all files to corresponding folders of your Magento setup
2. Add Donwload Links to template-file (e.g. /magento/app/design/frontend/default/default/template/sales/order/history.phtml):
```PHP
    [...]
    <a href="<?php echo Mage::getUrl('sales/order/orderpdf', array('order_id' => $_order->getId())); ?>"><?php echo $this->__('View Order as PDF') ?></a>
    <a href="<?php echo Mage::getUrl('sales/order/invoicepdf', array('order_id' => $_order->getId())); ?>"><?php echo $this->__('View Invoice as PDF') ?></a>
    <a href="<?php echo Mage::getUrl('sales/order/shipmentpdf', array('order_id' => $_order->getId())); ?>"><?php echo $this->__('View Shipment as PDF') ?></a>
    [...]
```
3. Enjoy your new feature!