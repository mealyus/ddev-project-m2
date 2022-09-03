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

namespace Sunday\CustomField\Block\Adminhtml;

use Magento\Framework\AppInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderInterface;

class Attributes extends \Magento\Backend\Block\Template
{
    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    public $orderRepository;

    /**
     * Attributes constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        array $data = []
    ) {
        $this->orderRepository = $orderRepository;
        parent::__construct($context, $data);
    }

    /**
     * Returns current order object
     *
     * @return bool|OrderInterface
     */
    public function getOrder()
    {
        try {
            $orderId = $this->getRequest()->getParam('order_id');
            return $this->orderRepository->get($orderId);
        } catch (NoSuchEntityException $e) {
            return false;
        }
    }
}
