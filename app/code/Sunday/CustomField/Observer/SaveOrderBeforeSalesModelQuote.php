<?php
/**
 * Sunday - Checkout Custom Field
 *
 * @category Sunday
 * @package  Sunday/CustomField
 * @author   Ali Us. <mealyus@gmail.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/mealyus/
 */

namespace Sunday\CustomField\Observer;

use Magento\Framework\DataObject\Copy;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

class SaveOrderBeforeSalesModelQuote implements ObserverInterface
{
    /**
     * @var Copy
     */
    public $objectCopyService;

    /**
     * SaveOrderBeforeSalesModelQuote constructor.
     * @param Copy $objectCopyService
     */
    public function __construct(
        Copy $objectCopyService
    ) {
        $this->objectCopyService = $objectCopyService;
    }

    /**
     * Copy data from quote to order after order placed
     *
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $this->objectCopyService->copyFieldsetToTarget(
            'sales_convert_quote',
            'to_order',
            $observer->getEvent()->getQuote(),
            $observer->getEvent()->getOrder()
        );

        return $this;
    }
}
