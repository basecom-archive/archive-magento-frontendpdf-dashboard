dashboardpdf
============

"dashboardpdf" is a Magento Frontendcontroller which overwrites the default Sales-Order-Controller (Mage_Sales_OrderController) from Magento and offers functions for frontend-PDF-generation  (e.g. in a customer's orderhistory).
The funtions generate PDFs for orders, invoices or shipments.

Installation
------------

1. Copy all files to corresponding folders of your Magento setup

2. Add Donwload Links to template-file (e.g. /magento/app/design/frontend/default/default/template/sales/order/history.phtml)

	...
	<a href="<?php echo Mage::getUrl('sales/order/orderpdf', array('order_id' => $_order->getId())); ?>"><?php echo $this->__('View Order as PDF') ?></a>
	<a href="<?php echo Mage::getUrl('sales/order/invoicepdf', array('order_id' => $_order->getId())); ?>"><?php echo $this->__('View Invoice as PDF') ?></a>
	<a href="<?php echo Mage::getUrl('sales/order/shipmentpdf', array('order_id' => $_order->getId())); ?>"><?php echo $this->__('View Shipment as PDF') ?></a>
	...