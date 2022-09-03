<?php

namespace Sunday\CustomField\Plugin;

use Magento\Quote\Api\CartRepositoryInterface;
use Psr\Log\LoggerInterface;

class ShippingInformationManagement
{
    /**
    * @var CartRepositoryInterface
    */
    public $cartRepository;

    /**
    * @var LoggerInterface
    **/

    private $logger;

    /**
     * ShippingInformationManagement constructor.
     * @param CartRepositoryInterface $cartRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        LoggerInterface $logger
    ) {
        $this->cartRepository = $cartRepository;
        $this->logger = $logger;
    }

    /**
     * Save custom field data to quote object
     *
     * @param $subject
     * @param $cartId
     * @param $addressInformation
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSaveAddressInformation($subject, $cartId, $addressInformation)
    {
        try {
            $quote = $this->cartRepository->getActive($cartId);
            $deliveryNote = $addressInformation->getShippingAddress()->getExtensionAttributes()->getDeliveryNote();
            $quote->setDeliveryNote($deliveryNote);
            $this->cartRepository->save($quote);
            return [$cartId, $addressInformation];
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
