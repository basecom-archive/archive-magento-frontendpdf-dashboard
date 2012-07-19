<?php
/**
 * erweitert sales order controller um pdf druck funktion hinzu zu fügen
 * 11.04.2012 s.kroll - sek@basecom.de  
 */

require_once 'Mage/Sales/controllers/OrderController.php';

class Skroll_Dashboardpdf_OrderController extends Mage_Sales_OrderController
{
	//gibt alle rechnungenen zu einer bestellung als pdf zurück
	public function invoicepdfAction()
	{
		//order id aus url request lesen
		$orderId = $this->getRequest()->getParam('order_id', false);
		$order = Mage::getModel('sales/order')->load($orderId);
		
		//kundensitzung auslesen
		$customerId = Mage::getSingleton('customer/session')->getCustomerId();
		
		// wenn es die bestellung gibt, den kunden, beide zusammenpassen und bereits rechnugnen zu der bestellung
		if ($order->getId() && $order->getCustomerId() && $order->getCustomerId() == $customerId && $order->hasInvoices()) {
				
			//alle rechnungen zur bestelluing laden
			$invoices = $order->getInvoiceCollection();			
				
			//pdf u. download header an browser schicken
			header('Content-type: application/pdf');
			header('Content-Disposition: attachment; filename="bestellung_'.$order->getIncrementId().'_rechnung.pdf"');
			
			//pdf aus rechnungen erzeugen
			//$pdf = Mage::getModel('sales/order_pdf_invoice')->getPdf( $invoices );
			$pdf = Mage::getModel('invoicepdf/pdf_invoice')->getPdf($invoices,true);
			
			//an den browser schicken
			die($pdf->render());			   
		}
		//irgendwas passt nicht, eventuell url manipulation, 404 seite anzeigen
		else
		{
        	$this->_forward('noRoute');
        	return;			
		}		
	}

	//gibt alle sendungen zu einer bestellung als pdf zurück
	public function shipmentpdfAction()
	{		
		//order id aus url request lesen
		$orderId = $this->getRequest()->getParam('order_id', false);
		$order = Mage::getModel('sales/order')->load($orderId);
		
		//kundensitzung auslesen
		$customerId = Mage::getSingleton('customer/session')->getCustomerId();
		
		// wenn es die bestellung gibt, den kunden, beide zusammenpassen und bereits sendungen zu der bestellung
		if ($order->getId() && $order->getCustomerId() && $order->getCustomerId() == $customerId && $order->hasShipments()) {
				
			//alle sendungen zur bestelluing laden
			$shipments = $order->getShipmentsCollection();			
				
			//pdf u. download header an browser schicken
			header('Content-type: application/pdf');
			header('Content-Disposition: attachment; filename="bestellung_'.$order->getIncrementId().'_sendung.pdf"');
			
			//pdf aus sendungen erzeugen
			$pdf = Mage::getModel('sales/order_pdf_shipment')->getPdf( $shipments );
			
			//an den browser schicken
			die($pdf->render());			   
		}
		//irgendwas passt nicht, eventuell url manipulation, 404 seite anzeigen
		else
		{
			
        	$this->_forward('noRoute');
        	return;			
		}		
	}

	//gibt alle sendungen zu einer bestellung als pdf zurück
	public function orderpdfAction()
	{
				
		//order id aus url request lesen
		$orderId = $this->getRequest()->getParam('order_id', false);
		$order = Mage::getModel('sales/order')->load($orderId);
		
		//kundensitzung auslesen
		$customerId = Mage::getSingleton('customer/session')->getCustomerId();
		
		
		
		// wenn es die bestellung gibt, den kunden, beide zusammenpassen und bereits sendungen zu der bestellung
		if ($order->getId() && $order->getCustomerId() && $order->getCustomerId() == $customerId) {
						
			
			//pdf aus sendungen erzeugen
			//$pdf = Mage::getModel('dashboardpdf/pdf_order')->getPdf($order);
			$pdf = Mage::getModel('invoicepdf/pdf_invoice')->getOrderPdf($order,true);
			//die(var_dump($pdf));
			
			//pdf u. download header an browser schicken
			header('Content-type: application/pdf');
			header('Content-Disposition: attachment; filename="bestellung_'.$order->getIncrementId().'.pdf"');			
			
			//an den browser schicken
			die($pdf->render());			   
		}
		//irgendwas passt nicht, eventuell url manipulation, 404 seite anzeigen
		else
		{			
        	$this->_forward('noRoute');
        	return;			
		}		
	}

	// ursprüngliche ansicht auf pdf druck umleiten
	public function invoiceAction()
	{
		$this->invoicepdfAction();
	}
	
	// ursprüngliche ansicht auf pdf druck umleiten
	public function printInvoiceAction()
	{
		$this->invoicepdfAction();
	}	
	
	// ursprüngliche ansicht auf pdf druck umleiten
	public function shipmentAction()
	{
		$this->shipmentpdfAction();
	}
	
	// ursprüngliche ansicht auf pdf druck umleiten
	public function printShipmentAction()
	{
		$this->invoicepdfAction();
	}	
}