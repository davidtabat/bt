<?php
namespace Alliance\Linkedin\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckoutSubmitAllAfterObserver implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if(empty($observer->getEvent()->getOrder()) || empty($observer->getEvent()->getQuote()
            )) {
            return $this;
        }

        $shippingAddress = $observer->getEvent()->getQuote()->getShippingAddress();
        if ($shippingAddress->getLinkedin()) {
            $orderShippingAddress = $observer->getEvent()->getOrder()->getShippingAddress();
            $orderShippingAddress->setLinkedin($shippingAddress->getLinkedin())->save();
        }
        return $this;
    }
}
